<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\ObjectCalisthenics\Rules;

use _PhpScoper8de082cbb8c7\PhpParser\Node;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\Else_;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\ElseIf_;
use _PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope;
use Symplify\CodingStandard\Rules\AbstractSymplifyRule;
/**
 * @see https://github.com/object-calisthenics/phpcs-calisthenics-rules#2-do-not-use-else-keyword
 *
 * @see \Symplify\CodingStandard\ObjectCalisthenics\Tests\Rules\NoElseAndElseIfRule\NoElseAndElseIfRuleTest
 */
final class NoElseAndElseIfRule extends \Symplify\CodingStandard\Rules\AbstractSymplifyRule
{
    /**
     * @var string
     */
    public const MESSAGE = 'Do not use "else/elseif". Prefer early return statement instead.';
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\_PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\Else_::class, \_PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\ElseIf_::class];
    }
    /**
     * @param Else_|ElseIf_ $node
     * @return string[]
     */
    public function process(\_PhpScoper8de082cbb8c7\PhpParser\Node $node, \_PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope $scope) : array
    {
        return [self::MESSAGE];
    }
}