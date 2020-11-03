<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\Rules;

use _PhpScoper8de082cbb8c7\Nette\Utils\Strings;
use _PhpScoper8de082cbb8c7\PhpParser\Node;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Array_;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Assign;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr\FuncCall;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr\MethodCall;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr\StaticCall;
use _PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope;
use _PhpScoper8de082cbb8c7\PHPStan\Type\ObjectType;
use ReflectionClass;
use Symplify\CodingStandard\PhpParser\NodeNameResolver;
/**
 * @see \Symplify\CodingStandard\Tests\Rules\ForbiddenArrayDestructRule\ForbiddenArrayDestructRuleTest
 */
final class ForbiddenArrayDestructRule extends \Symplify\CodingStandard\Rules\AbstractSymplifyRule
{
    /**
     * @var string
     */
    public const ERROR_MESSAGE = 'Array destruct is not allowed. Use value object to pass data instead';
    /**
     * @var string
     * @see https://regex101.com/r/dhGhYp/1
     */
    public const VENDOR_DIRECTORY_REGEX = '#/vendor/#';
    /**
     * @var NodeNameResolver
     */
    private $nodeNameResolver;
    public function __construct(\Symplify\CodingStandard\PhpParser\NodeNameResolver $nodeNameResolver)
    {
        $this->nodeNameResolver = $nodeNameResolver;
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Assign::class];
    }
    /**
     * @param Assign $node
     * @return string[]
     */
    public function process(\_PhpScoper8de082cbb8c7\PhpParser\Node $node, \_PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope $scope) : array
    {
        if (!$node->var instanceof \_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Array_) {
            return [];
        }
        // swaps are allowed
        if ($node->expr instanceof \_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Array_) {
            return [];
        }
        if ($this->isAllowedCall($node)) {
            return [];
        }
        // is 3rd party method call → nothing we can do about it
        if ($this->isVendorProvider($node, $scope)) {
            return [];
        }
        return [self::ERROR_MESSAGE];
    }
    private function isAllowedCall(\_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Assign $assign) : bool
    {
        // "explode()" is allowed
        if ($assign->expr instanceof \_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\FuncCall && $this->nodeNameResolver->isName($assign->expr->name, 'explode')) {
            return \true;
        }
        // Strings::split() is allowed
        return $assign->expr instanceof \_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\StaticCall && $this->nodeNameResolver->isName($assign->expr->name, 'split');
    }
    private function isVendorProvider(\_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Assign $assign, \_PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope $scope) : bool
    {
        if (!$assign->expr instanceof \_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\MethodCall) {
            return \false;
        }
        $callerType = $scope->getType($assign->expr->var);
        if (!$callerType instanceof \_PhpScoper8de082cbb8c7\PHPStan\Type\ObjectType) {
            return \false;
        }
        $reflectionClass = new \ReflectionClass($callerType->getClassName());
        return (bool) \_PhpScoper8de082cbb8c7\Nette\Utils\Strings::match((string) $reflectionClass->getFileName(), self::VENDOR_DIRECTORY_REGEX);
    }
}