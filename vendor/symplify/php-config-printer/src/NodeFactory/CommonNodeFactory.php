<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\NodeFactory;

use _PhpScoperc233426b15e0\PhpParser\BuilderHelpers;
use _PhpScoperc233426b15e0\PhpParser\Node\Expr;
use _PhpScoperc233426b15e0\PhpParser\Node\Expr\BinaryOp\Concat;
use _PhpScoperc233426b15e0\PhpParser\Node\Expr\ClassConstFetch;
use _PhpScoperc233426b15e0\PhpParser\Node\Expr\ConstFetch;
use _PhpScoperc233426b15e0\PhpParser\Node\Name;
use _PhpScoperc233426b15e0\PhpParser\Node\Name\FullyQualified;
use _PhpScoperc233426b15e0\PhpParser\Node\Scalar\MagicConst\Dir;
use _PhpScoperc233426b15e0\PhpParser\Node\Scalar\String_;
final class CommonNodeFactory
{
    public function createAbsoluteDirExpr($argument) : \_PhpScoperc233426b15e0\PhpParser\Node\Expr
    {
        if ($argument === '') {
            return new \_PhpScoperc233426b15e0\PhpParser\Node\Scalar\String_('');
        }
        if (\is_string($argument)) {
            // preslash with dir
            $argument = '/' . $argument;
        }
        $argumentValue = \_PhpScoperc233426b15e0\PhpParser\BuilderHelpers::normalizeValue($argument);
        if ($argumentValue instanceof \_PhpScoperc233426b15e0\PhpParser\Node\Scalar\String_) {
            $argumentValue = new \_PhpScoperc233426b15e0\PhpParser\Node\Expr\BinaryOp\Concat(new \_PhpScoperc233426b15e0\PhpParser\Node\Scalar\MagicConst\Dir(), $argumentValue);
        }
        return $argumentValue;
    }
    public function createClassReference(string $className) : \_PhpScoperc233426b15e0\PhpParser\Node\Expr\ClassConstFetch
    {
        return $this->createConstFetch($className, 'class');
    }
    public function createConstFetch(string $className, string $constantName) : \_PhpScoperc233426b15e0\PhpParser\Node\Expr\ClassConstFetch
    {
        return new \_PhpScoperc233426b15e0\PhpParser\Node\Expr\ClassConstFetch(new \_PhpScoperc233426b15e0\PhpParser\Node\Name\FullyQualified($className), $constantName);
    }
    public function createFalse() : \_PhpScoperc233426b15e0\PhpParser\Node\Expr\ConstFetch
    {
        return new \_PhpScoperc233426b15e0\PhpParser\Node\Expr\ConstFetch(new \_PhpScoperc233426b15e0\PhpParser\Node\Name('false'));
    }
}
