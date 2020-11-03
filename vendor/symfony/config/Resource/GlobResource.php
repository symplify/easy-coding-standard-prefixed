<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper8de082cbb8c7\Symfony\Component\Config\Resource;

use _PhpScoper8de082cbb8c7\Symfony\Component\Finder\Finder;
use _PhpScoper8de082cbb8c7\Symfony\Component\Finder\Glob;
/**
 * GlobResource represents a set of resources stored on the filesystem.
 *
 * Only existence/removal is tracked (not mtimes.)
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final since Symfony 4.3
 */
class GlobResource implements \IteratorAggregate, \_PhpScoper8de082cbb8c7\Symfony\Component\Config\Resource\SelfCheckingResourceInterface
{
    private $prefix;
    private $pattern;
    private $recursive;
    private $hash;
    private $forExclusion;
    private $excludedPrefixes;
    /**
     * @param string $prefix    A directory prefix
     * @param string $pattern   A glob pattern
     * @param bool   $recursive Whether directories should be scanned recursively or not
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $prefix, string $pattern, bool $recursive, bool $forExclusion = \false, array $excludedPrefixes = [])
    {
        \ksort($excludedPrefixes);
        $this->prefix = \realpath($prefix) ?: (\file_exists($prefix) ? $prefix : \false);
        $this->pattern = $pattern;
        $this->recursive = $recursive;
        $this->forExclusion = $forExclusion;
        $this->excludedPrefixes = $excludedPrefixes;
        if (\false === $this->prefix) {
            throw new \InvalidArgumentException(\sprintf('The path "%s" does not exist.', $prefix));
        }
    }
    public function getPrefix()
    {
        return $this->prefix;
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'glob.' . $this->prefix . (int) $this->recursive . $this->pattern . (int) $this->forExclusion . \implode("\0", $this->excludedPrefixes);
    }
    /**
     * {@inheritdoc}
     */
    public function isFresh($timestamp)
    {
        $hash = $this->computeHash();
        if (null === $this->hash) {
            $this->hash = $hash;
        }
        return $this->hash === $hash;
    }
    /**
     * @internal
     */
    public function __sleep() : array
    {
        if (null === $this->hash) {
            $this->hash = $this->computeHash();
        }
        return ['prefix', 'pattern', 'recursive', 'hash', 'forExclusion', 'excludedPrefixes'];
    }
    /**
     * @return \Traversable
     */
    public function getIterator()
    {
        if (!\file_exists($this->prefix) || !$this->recursive && '' === $this->pattern) {
            return;
        }
        $prefix = \str_replace('\\', '/', $this->prefix);
        if (0 !== \strpos($this->prefix, 'phar://') && \false === \strpos($this->pattern, '/**/') && (\defined('GLOB_BRACE') || \false === \strpos($this->pattern, '{'))) {
            $paths = \glob($this->prefix . $this->pattern, \GLOB_NOSORT | (\defined('GLOB_BRACE') ? \GLOB_BRACE : 0));
            \sort($paths);
            foreach ($paths as $path) {
                if ($this->excludedPrefixes) {
                    $normalizedPath = \str_replace('\\', '/', $path);
                    do {
                        if (isset($this->excludedPrefixes[$dirPath = $normalizedPath])) {
                            continue 2;
                        }
                    } while ($prefix !== $dirPath && $dirPath !== ($normalizedPath = \dirname($dirPath)));
                }
                if (\is_file($path)) {
                    (yield $path => new \SplFileInfo($path));
                }
                if (!\is_dir($path)) {
                    continue;
                }
                if ($this->forExclusion) {
                    (yield $path => new \SplFileInfo($path));
                    continue;
                }
                if (!$this->recursive || isset($this->excludedPrefixes[\str_replace('\\', '/', $path)])) {
                    continue;
                }
                $files = \iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveCallbackFilterIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::FOLLOW_SYMLINKS), function (\SplFileInfo $file, $path) {
                    return !isset($this->excludedPrefixes[\str_replace('\\', '/', $path)]) && '.' !== $file->getBasename()[0];
                }), \RecursiveIteratorIterator::LEAVES_ONLY));
                \uasort($files, 'strnatcmp');
                foreach ($files as $path => $info) {
                    if ($info->isFile()) {
                        (yield $path => $info);
                    }
                }
            }
            return;
        }
        if (!\class_exists(\_PhpScoper8de082cbb8c7\Symfony\Component\Finder\Finder::class)) {
            throw new \LogicException(\sprintf('Extended glob pattern "%s" cannot be used as the Finder component is not installed.', $this->pattern));
        }
        $finder = new \_PhpScoper8de082cbb8c7\Symfony\Component\Finder\Finder();
        $regex = \_PhpScoper8de082cbb8c7\Symfony\Component\Finder\Glob::toRegex($this->pattern);
        if ($this->recursive) {
            $regex = \substr_replace($regex, '(/|$)', -2, 1);
        }
        $prefixLen = \strlen($this->prefix);
        foreach ($finder->followLinks()->sortByName()->in($this->prefix) as $path => $info) {
            $normalizedPath = \str_replace('\\', '/', $path);
            if (!\preg_match($regex, \substr($normalizedPath, $prefixLen)) || !$info->isFile()) {
                continue;
            }
            if ($this->excludedPrefixes) {
                do {
                    if (isset($this->excludedPrefixes[$dirPath = $normalizedPath])) {
                        continue 2;
                    }
                } while ($prefix !== $dirPath && $dirPath !== ($normalizedPath = \dirname($dirPath)));
            }
            (yield $path => $info);
        }
    }
    private function computeHash() : string
    {
        $hash = \hash_init('md5');
        foreach ($this->getIterator() as $path => $info) {
            \hash_update($hash, $path . "\n");
        }
        return \hash_final($hash);
    }
}