<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\Rules;

use _PhpScoper8de082cbb8c7\Nette\Utils\Strings;
use _PhpScoper8de082cbb8c7\PhpParser\Node;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\Trait_;
use _PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope;
/**
 * @see \Symplify\CodingStandard\Tests\Rules\NoTraitExceptItsMethodsPublicAndRequiredRule\NoTraitExceptItsMethodsPublicAndRequiredRuleTest
 */
final class NoTraitExceptItsMethodsPublicAndRequiredRule extends \Symplify\CodingStandard\Rules\AbstractSymplifyRule
{
    /**
     * @var string
     */
    public const ERROR_MESSAGE = 'Do not use trait';
    /**
     * @var string
     * @see https://regex101.com/r/gn2P0C/1
     */
    private const REQUIRED_DOCBLOCK_REGEX = '#\\*\\s+@required\\n?#';
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\_PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\Trait_::class];
    }
    /**
     * @param Trait_ $node
     * @return string[]
     */
    public function process(\_PhpScoper8de082cbb8c7\PhpParser\Node $node, \_PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope $scope) : array
    {
        $methods = $node->getMethods();
        if ($methods === []) {
            return [self::ERROR_MESSAGE];
        }
        foreach ($methods as $method) {
            $docComment = $method->getDocComment();
            if ($docComment === null || !$method->isPublic()) {
                return [self::ERROR_MESSAGE];
            }
            if (!\_PhpScoper8de082cbb8c7\Nette\Utils\Strings::match($docComment->getText(), self::REQUIRED_DOCBLOCK_REGEX)) {
                return [self::ERROR_MESSAGE];
            }
        }
        return [];
    }
}