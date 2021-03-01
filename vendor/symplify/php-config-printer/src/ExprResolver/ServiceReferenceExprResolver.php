<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\ExprResolver;

use _PhpScoperf3dc21757def\PhpParser\Node\Arg;
use _PhpScoperf3dc21757def\PhpParser\Node\Expr;
use _PhpScoperf3dc21757def\PhpParser\Node\Expr\FuncCall;
use _PhpScoperf3dc21757def\PhpParser\Node\Name\FullyQualified;
final class ServiceReferenceExprResolver
{
    /**
     * @var StringExprResolver
     */
    private $stringExprResolver;
    public function __construct(\Symplify\PhpConfigPrinter\ExprResolver\StringExprResolver $stringExprResolver)
    {
        $this->stringExprResolver = $stringExprResolver;
    }
    public function resolveServiceReferenceExpr(string $value, bool $skipServiceReference, string $functionName) : \_PhpScoperf3dc21757def\PhpParser\Node\Expr
    {
        $value = \ltrim($value, '@');
        $expr = $this->stringExprResolver->resolve($value, $skipServiceReference, \false);
        if ($skipServiceReference) {
            return $expr;
        }
        $args = [new \_PhpScoperf3dc21757def\PhpParser\Node\Arg($expr)];
        return new \_PhpScoperf3dc21757def\PhpParser\Node\Expr\FuncCall(new \_PhpScoperf3dc21757def\PhpParser\Node\Name\FullyQualified($functionName), $args);
    }
}