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
namespace PhpCsFixer\Fixer\Phpdoc;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\DocBlock\DocBlock;
use PhpCsFixer\DocBlock\Line;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Preg;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
/**
 * @author Graham Campbell <graham@alt-three.com>
 * @author Dave van der Brugge <dmvdbrugge@gmail.com>
 */
final class PhpdocVarWithoutNameFixer extends \PhpCsFixer\AbstractFixer
{
    /**
     * {@inheritdoc}
     */
    public function getDefinition()
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition('`@var` and `@type` annotations of classy properties should not contain the name.', [new \PhpCsFixer\FixerDefinition\CodeSample('<?php
final class Foo
{
    /**
     * @var int $bar
     */
    public $bar;

    /**
     * @type $baz float
     */
    public $baz;
}
')]);
    }
    /**
     * {@inheritdoc}
     *
     * Must run before PhpdocAlignFixer.
     * Must run after AlignMultilineCommentFixer, CommentToPhpdocFixer, PhpdocIndentFixer, PhpdocScalarFixer, PhpdocToCommentFixer, PhpdocTypesFixer.
     */
    public function getPriority()
    {
        return 0;
    }
    /**
     * {@inheritdoc}
     */
    public function isCandidate(\PhpCsFixer\Tokenizer\Tokens $tokens)
    {
        return $tokens->isTokenKindFound(\T_DOC_COMMENT) && $tokens->isAnyTokenKindsFound(\PhpCsFixer\Tokenizer\Token::getClassyTokenKinds());
    }
    /**
     * {@inheritdoc}
     */
    protected function applyFix(\SplFileInfo $file, \PhpCsFixer\Tokenizer\Tokens $tokens)
    {
        foreach ($tokens as $index => $token) {
            if (!$token->isGivenKind(\T_DOC_COMMENT)) {
                continue;
            }
            $nextIndex = $tokens->getNextMeaningfulToken($index);
            if (null === $nextIndex) {
                continue;
            }
            // For people writing static public $foo instead of public static $foo
            if ($tokens[$nextIndex]->isGivenKind(\T_STATIC)) {
                $nextIndex = $tokens->getNextMeaningfulToken($nextIndex);
            }
            // We want only doc blocks that are for properties and thus have specified access modifiers next
            if (!$tokens[$nextIndex]->isGivenKind([\T_PRIVATE, \T_PROTECTED, \T_PUBLIC, \T_VAR])) {
                continue;
            }
            $doc = new \PhpCsFixer\DocBlock\DocBlock($token->getContent());
            $firstLevelLines = $this->getFirstLevelLines($doc);
            $annotations = $doc->getAnnotationsOfType(['type', 'var']);
            foreach ($annotations as $annotation) {
                if (isset($firstLevelLines[$annotation->getStart()])) {
                    $this->fixLine($firstLevelLines[$annotation->getStart()]);
                }
            }
            $tokens[$index] = new \PhpCsFixer\Tokenizer\Token([\T_DOC_COMMENT, $doc->getContent()]);
        }
    }
    private function fixLine(\PhpCsFixer\DocBlock\Line $line)
    {
        $content = $line->getContent();
        \PhpCsFixer\Preg::matchAll('/ \\$[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*/', $content, $matches);
        if (isset($matches[0][0])) {
            $line->setContent(\str_replace($matches[0][0], '', $content));
        }
    }
    /**
     * @return Line[]
     */
    private function getFirstLevelLines(\PhpCsFixer\DocBlock\DocBlock $docBlock)
    {
        $nested = 0;
        $lines = $docBlock->getLines();
        foreach ($lines as $index => $line) {
            $content = $line->getContent();
            if (\PhpCsFixer\Preg::match('/\\s*\\*\\s*}$/', $content)) {
                --$nested;
            }
            if ($nested > 0) {
                unset($lines[$index]);
            }
            if (\PhpCsFixer\Preg::match('/\\s\\{$/', $content)) {
                ++$nested;
            }
        }
        return $lines;
    }
}
