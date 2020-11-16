<?php

declare (strict_types=1);
namespace Symplify\RuleDocGenerator\Text;

use _PhpScoper239b374a39c8\Nette\Utils\Strings;
use _PhpScoper239b374a39c8\Rector\NodeTypeResolver\ClassExistenceStaticHelper;
final class KeywordHighlighter
{
    /**
     * @var string[]
     */
    private const TEXT_WORDS = ['Rename', 'EventDispatcher', 'current', 'defined', 'rename', 'next', 'file', 'constant'];
    /**
     * @var string
     * @see https://regex101.com/r/uxtJDA/3
     */
    private const VARIABLE_CALL_OR_VARIABLE_REGEX = '#^\\$([A-Za-z\\-\\>]+)[^\\]](\\(\\))?#';
    /**
     * @var string
     * @see https://regex101.com/r/uxtJDA/1
     */
    private const STATIC_CALL_REGEX = '#([A-Za-z::\\-\\>]+)(\\(\\))$#';
    /**
     * @var string
     * @see https://regex101.com/r/9vnLcf/1
     */
    private const ANNOTATION_REGEX = '#(\\@\\w+)$#';
    public function highlight(string $content) : string
    {
        $words = \_PhpScoper239b374a39c8\Nette\Utils\Strings::split($content, '# #');
        foreach ($words as $key => $word) {
            if (!$this->isKeywordToHighlight($word)) {
                continue;
            }
            $words[$key] = '`' . $word . '`';
        }
        return \implode(' ', $words);
    }
    private function isKeywordToHighlight(string $word) : bool
    {
        if (\_PhpScoper239b374a39c8\Nette\Utils\Strings::match($word, self::ANNOTATION_REGEX)) {
            return \true;
        }
        // already in code quotes
        if (\_PhpScoper239b374a39c8\Nette\Utils\Strings::startsWith($word, '`') || \_PhpScoper239b374a39c8\Nette\Utils\Strings::endsWith($word, '`')) {
            return \false;
        }
        // part of normal text
        if (\in_array($word, self::TEXT_WORDS, \true)) {
            return \false;
        }
        if ($this->isFunctionOrClass($word)) {
            return \true;
        }
        if ($word === 'composer.json') {
            return \true;
        }
        if ((bool) \_PhpScoper239b374a39c8\Nette\Utils\Strings::match($word, self::VARIABLE_CALL_OR_VARIABLE_REGEX)) {
            return \true;
        }
        return (bool) \_PhpScoper239b374a39c8\Nette\Utils\Strings::match($word, self::STATIC_CALL_REGEX);
    }
    private function isFunctionOrClass(string $word) : bool
    {
        if (\function_exists($word) || \function_exists(\trim($word, '()'))) {
            return \true;
        }
        if (\_PhpScoper239b374a39c8\Rector\NodeTypeResolver\ClassExistenceStaticHelper::doesClassLikeExist($word)) {
            // not a class
            if (!\_PhpScoper239b374a39c8\Nette\Utils\Strings::contains($word, '\\')) {
                return \in_array($word, ['Throwable', 'Exception'], \true);
            }
            return \true;
        }
        return \false;
    }
}