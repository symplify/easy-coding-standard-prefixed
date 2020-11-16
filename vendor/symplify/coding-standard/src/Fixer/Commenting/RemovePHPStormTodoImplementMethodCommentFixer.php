<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\Fixer\Commenting;

use _PhpScoper1103e00fb46b\Nette\Utils\Strings;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;
use Symplify\CodingStandard\Fixer\AbstractSymplifyFixer;
use Symplify\RuleDocGenerator\Contract\DocumentedRuleInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see \Symplify\CodingStandard\Tests\Fixer\Commenting\RemovePHPStormTodoImplementMethodCommentFixer\RemovePHPStormTodoImplementMethodCommentFixerTest
 */
final class RemovePHPStormTodoImplementMethodCommentFixer extends \Symplify\CodingStandard\Fixer\AbstractSymplifyFixer implements \Symplify\RuleDocGenerator\Contract\DocumentedRuleInterface
{
    /**
     * @see https://regex101.com/r/5fQJkz/2
     * @var string
     */
    private const TODO_IMPLEMENT_METHOD_COMMENT_BY_PHPSTORM_REGEX = '#\\/\\/ TODO: Implement .*\\(\\) method.$#';
    /**
     * @var string
     */
    private const ERROR_MESSAGE = 'Remove "// TODO: Implement methodName() method." comment';
    public function getDefinition() : \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition(self::ERROR_MESSAGE, []);
    }
    public function isCandidate(\PhpCsFixer\Tokenizer\Tokens $tokens) : bool
    {
        return $tokens->isAnyTokenKindsFound([\T_DOC_COMMENT, \T_COMMENT]);
    }
    public function fix(\SplFileInfo $file, \PhpCsFixer\Tokenizer\Tokens $tokens) : void
    {
        $reverseTokens = $this->reverseTokens($tokens);
        foreach ($reverseTokens as $index => $token) {
            if (!$token->isGivenKind([\T_DOC_COMMENT, \T_COMMENT])) {
                continue;
            }
            $originalDocContent = $token->getContent();
            $cleanedDocContent = \_PhpScoper1103e00fb46b\Nette\Utils\Strings::replace($originalDocContent, self::TODO_IMPLEMENT_METHOD_COMMENT_BY_PHPSTORM_REGEX, '');
            if ($cleanedDocContent !== '') {
                continue;
            }
            // remove token
            $tokens->clearAt($index);
        }
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition(self::ERROR_MESSAGE, [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
// TODO: Implement whatever() method.
// TODO: Implement not method.
CODE_SAMPLE
, <<<'CODE_SAMPLE'
// TODO: Implement not method.
CODE_SAMPLE
)]);
    }
}
