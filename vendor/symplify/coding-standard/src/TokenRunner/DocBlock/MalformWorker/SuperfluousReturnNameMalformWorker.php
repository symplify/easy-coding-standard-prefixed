<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\TokenRunner\DocBlock\MalformWorker;

use _PhpScoper8de082cbb8c7\Nette\Utils\Strings;
use PhpCsFixer\DocBlock\DocBlock;
use PhpCsFixer\Tokenizer\Tokens;
final class SuperfluousReturnNameMalformWorker extends \Symplify\CodingStandard\TokenRunner\DocBlock\MalformWorker\AbstractMalformWorker
{
    /**
     * @var string
     * @see https://regex101.com/r/26Wy7Y/1
     */
    private const RETURN_VARIABLE_NAME_REGEX = '#(@return)(?<type>\\s+[|\\\\\\w]+)?(\\s+)(?<variableName>\\$[\\w]+)#';
    /**
     * @var string[]
     */
    private const ALLOWED_VARIABLE_NAMES = ['$this'];
    /**
     * @var string
     * @see https://regex101.com/r/IE9fA6/1
     */
    private const VARIABLE_NAME_REGEX = '#\\$\\w+#';
    public function work(string $docContent, \PhpCsFixer\Tokenizer\Tokens $tokens, int $position) : string
    {
        $docBlock = new \PhpCsFixer\DocBlock\DocBlock($docContent);
        $lines = $docBlock->getLines();
        foreach ($lines as $line) {
            $match = \_PhpScoper8de082cbb8c7\Nette\Utils\Strings::match($line->getContent(), self::RETURN_VARIABLE_NAME_REGEX);
            if ($this->shouldSkip($match, $line->getContent())) {
                continue;
            }
            $newLineContent = \_PhpScoper8de082cbb8c7\Nette\Utils\Strings::replace($line->getContent(), self::RETURN_VARIABLE_NAME_REGEX, function (array $match) {
                $replacement = $match[1];
                if ($match['type'] !== []) {
                    $replacement .= $match['type'];
                }
                return $replacement;
            });
            $line->setContent($newLineContent);
        }
        return $docBlock->getContent();
    }
    /**
     * @param mixed[]|null $match
     */
    private function shouldSkip(?array $match, string $content) : bool
    {
        if ($match === null) {
            return \true;
        }
        if (\in_array($match['variableName'], self::ALLOWED_VARIABLE_NAMES, \true)) {
            return \true;
        }
        // has multiple return values? "@return array $one, $two"
        return \count(\_PhpScoper8de082cbb8c7\Nette\Utils\Strings::matchAll($content, self::VARIABLE_NAME_REGEX)) >= 2;
    }
}