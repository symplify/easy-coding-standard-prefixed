<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\Rules;

use _PhpScoper8de082cbb8c7\PhpParser\Node;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr\PostDec;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr\PostInc;
use _PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope;
/**
 * @see \Symplify\CodingStandard\Tests\Rules\NoPostIncPostDecRule\NoPostIncPostDecRuleTest
 */
final class NoPostIncPostDecRule extends \Symplify\CodingStandard\Rules\AbstractSymplifyRule
{
    /**
     * @var string
     */
    public const ERROR_MESSAGE = 'Post operation are forbidden, as they make 2 values at the same line. Use pre instead';
    /**
     * @return class-string[]
     */
    public function getNodeTypes() : array
    {
        return [\_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\PostInc::class, \_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\PostDec::class];
    }
    /**
     * @param PostDec|PostInc $node
     * @return string[]
     */
    public function process(\_PhpScoper8de082cbb8c7\PhpParser\Node $node, \_PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope $scope) : array
    {
        return [self::ERROR_MESSAGE];
    }
}