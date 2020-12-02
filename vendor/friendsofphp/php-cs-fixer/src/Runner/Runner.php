<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace PhpCsFixer\Runner;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Cache\CacheManagerInterface;
use PhpCsFixer\Cache\Directory;
use PhpCsFixer\Cache\DirectoryInterface;
use PhpCsFixer\Differ\DifferInterface;
use PhpCsFixer\Error\Error;
use PhpCsFixer\Error\ErrorsManager;
use PhpCsFixer\FileReader;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerFileProcessedEvent;
use PhpCsFixer\Linter\LinterInterface;
use PhpCsFixer\Linter\LintingException;
use PhpCsFixer\Linter\LintingResultInterface;
use PhpCsFixer\Tokenizer\Tokens;
use _PhpScoper6a0a7eb6e565\Symfony\Component\EventDispatcher\Event;
use _PhpScoper6a0a7eb6e565\Symfony\Component\EventDispatcher\EventDispatcherInterface;
use _PhpScoper6a0a7eb6e565\Symfony\Component\Filesystem\Exception\IOException;
/**
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 */
final class Runner
{
    /**
     * @var DifferInterface
     */
    private $differ;
    /**
     * @var DirectoryInterface
     */
    private $directory;
    /**
     * @var null|EventDispatcherInterface
     */
    private $eventDispatcher;
    /**
     * @var ErrorsManager
     */
    private $errorsManager;
    /**
     * @var CacheManagerInterface
     */
    private $cacheManager;
    /**
     * @var bool
     */
    private $isDryRun;
    /**
     * @var LinterInterface
     */
    private $linter;
    /**
     * @var \Traversable
     */
    private $finder;
    /**
     * @var FixerInterface[]
     */
    private $fixers;
    /**
     * @var bool
     */
    private $stopOnViolation;
    public function __construct($finder, array $fixers, \PhpCsFixer\Differ\DifferInterface $differ, \_PhpScoper6a0a7eb6e565\Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher = null, \PhpCsFixer\Error\ErrorsManager $errorsManager, \PhpCsFixer\Linter\LinterInterface $linter, $isDryRun, \PhpCsFixer\Cache\CacheManagerInterface $cacheManager, \PhpCsFixer\Cache\DirectoryInterface $directory = null, $stopOnViolation = \false)
    {
        $this->finder = $finder;
        $this->fixers = $fixers;
        $this->differ = $differ;
        $this->eventDispatcher = $eventDispatcher;
        $this->errorsManager = $errorsManager;
        $this->linter = $linter;
        $this->isDryRun = $isDryRun;
        $this->cacheManager = $cacheManager;
        $this->directory = $directory ?: new \PhpCsFixer\Cache\Directory('');
        $this->stopOnViolation = $stopOnViolation;
    }
    /**
     * @return array
     */
    public function fix()
    {
        $changed = [];
        $finder = $this->finder;
        $finderIterator = $finder instanceof \IteratorAggregate ? $finder->getIterator() : $finder;
        $fileFilteredFileIterator = new \PhpCsFixer\Runner\FileFilterIterator($finderIterator, $this->eventDispatcher, $this->cacheManager);
        $collection = $this->linter->isAsync() ? new \PhpCsFixer\Runner\FileCachingLintingIterator($fileFilteredFileIterator, $this->linter) : new \PhpCsFixer\Runner\FileLintingIterator($fileFilteredFileIterator, $this->linter);
        foreach ($collection as $file) {
            $fixInfo = $this->fixFile($file, $collection->currentLintingResult());
            // we do not need Tokens to still caching just fixed file - so clear the cache
            \PhpCsFixer\Tokenizer\Tokens::clearCache();
            if ($fixInfo) {
                $name = $this->directory->getRelativePathTo($file);
                $changed[$name] = $fixInfo;
                if ($this->stopOnViolation) {
                    break;
                }
            }
        }
        return $changed;
    }
    private function fixFile(\SplFileInfo $file, \PhpCsFixer\Linter\LintingResultInterface $lintingResult)
    {
        $name = $file->getPathname();
        try {
            $lintingResult->check();
        } catch (\PhpCsFixer\Linter\LintingException $e) {
            $this->dispatchEvent(\PhpCsFixer\FixerFileProcessedEvent::NAME, new \PhpCsFixer\FixerFileProcessedEvent(\PhpCsFixer\FixerFileProcessedEvent::STATUS_INVALID));
            $this->errorsManager->report(new \PhpCsFixer\Error\Error(\PhpCsFixer\Error\Error::TYPE_INVALID, $name, $e));
            return;
        }
        $old = \PhpCsFixer\FileReader::createSingleton()->read($file->getRealPath());
        \PhpCsFixer\Tokenizer\Tokens::setLegacyMode(\false);
        $tokens = \PhpCsFixer\Tokenizer\Tokens::fromCode($old);
        $oldHash = $tokens->getCodeHash();
        $newHash = $oldHash;
        $new = $old;
        $appliedFixers = [];
        try {
            foreach ($this->fixers as $fixer) {
                // for custom fixers we don't know is it safe to run `->fix()` without checking `->supports()` and `->isCandidate()`,
                // thus we need to check it and conditionally skip fixing
                if (!$fixer instanceof \PhpCsFixer\AbstractFixer && (!$fixer->supports($file) || !$fixer->isCandidate($tokens))) {
                    continue;
                }
                $fixer->fix($file, $tokens);
                if ($tokens->isChanged()) {
                    $tokens->clearEmptyTokens();
                    $tokens->clearChanged();
                    $appliedFixers[] = $fixer->getName();
                }
            }
        } catch (\Exception $e) {
            $this->processException($name, $e);
            return;
        } catch (\ParseError $e) {
            $this->dispatchEvent(\PhpCsFixer\FixerFileProcessedEvent::NAME, new \PhpCsFixer\FixerFileProcessedEvent(\PhpCsFixer\FixerFileProcessedEvent::STATUS_LINT));
            $this->errorsManager->report(new \PhpCsFixer\Error\Error(\PhpCsFixer\Error\Error::TYPE_LINT, $name, $e));
            return;
        } catch (\Throwable $e) {
            $this->processException($name, $e);
            return;
        }
        $fixInfo = null;
        if (!empty($appliedFixers)) {
            $new = $tokens->generateCode();
            $newHash = $tokens->getCodeHash();
        }
        // We need to check if content was changed and then applied changes.
        // But we can't simple check $appliedFixers, because one fixer may revert
        // work of other and both of them will mark collection as changed.
        // Therefore we need to check if code hashes changed.
        if ($oldHash !== $newHash) {
            $fixInfo = ['appliedFixers' => $appliedFixers, 'diff' => $this->differ->diff($old, $new)];
            try {
                $this->linter->lintSource($new)->check();
            } catch (\PhpCsFixer\Linter\LintingException $e) {
                $this->dispatchEvent(\PhpCsFixer\FixerFileProcessedEvent::NAME, new \PhpCsFixer\FixerFileProcessedEvent(\PhpCsFixer\FixerFileProcessedEvent::STATUS_LINT));
                $this->errorsManager->report(new \PhpCsFixer\Error\Error(\PhpCsFixer\Error\Error::TYPE_LINT, $name, $e, $fixInfo['appliedFixers'], $fixInfo['diff']));
                return;
            }
            if (!$this->isDryRun) {
                if (\false === @\file_put_contents($file->getRealPath(), $new)) {
                    $error = \error_get_last();
                    throw new \_PhpScoper6a0a7eb6e565\Symfony\Component\Filesystem\Exception\IOException(\sprintf('Failed to write file "%s", "%s".', $file->getPathname(), $error ? $error['message'] : 'no reason available'), 0, null, $file->getRealPath());
                }
            }
        }
        $this->cacheManager->setFile($name, $new);
        $this->dispatchEvent(\PhpCsFixer\FixerFileProcessedEvent::NAME, new \PhpCsFixer\FixerFileProcessedEvent($fixInfo ? \PhpCsFixer\FixerFileProcessedEvent::STATUS_FIXED : \PhpCsFixer\FixerFileProcessedEvent::STATUS_NO_CHANGES));
        return $fixInfo;
    }
    /**
     * Process an exception that occurred.
     *
     * @param string     $name
     * @param \Throwable $e
     */
    private function processException($name, $e)
    {
        $this->dispatchEvent(\PhpCsFixer\FixerFileProcessedEvent::NAME, new \PhpCsFixer\FixerFileProcessedEvent(\PhpCsFixer\FixerFileProcessedEvent::STATUS_EXCEPTION));
        $this->errorsManager->report(new \PhpCsFixer\Error\Error(\PhpCsFixer\Error\Error::TYPE_EXCEPTION, $name, $e));
    }
    /**
     * @param string $name
     */
    private function dispatchEvent($name, \_PhpScoper6a0a7eb6e565\Symfony\Component\EventDispatcher\Event $event)
    {
        if (null === $this->eventDispatcher) {
            return;
        }
        // BC compatibility < Sf 4.3
        if (!$this->eventDispatcher instanceof \_PhpScoper6a0a7eb6e565\Symfony\Contracts\EventDispatcher\EventDispatcherInterface) {
            $this->eventDispatcher->dispatch($name, $event);
            return;
        }
        $this->eventDispatcher->dispatch($event, $name);
    }
}
