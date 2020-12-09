<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\NodeFactory;

use _PhpScoperf65af7a6d9a0\PhpParser\BuilderHelpers;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Expr;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\BinaryOp\Concat;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\ClassConstFetch;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\ConstFetch;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Name;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Name\FullyQualified;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Scalar\MagicConst\Dir;
use _PhpScoperf65af7a6d9a0\PhpParser\Node\Scalar\String_;
final class CommonNodeFactory
{
    public function createAbsoluteDirExpr($argument) : \_PhpScoperf65af7a6d9a0\PhpParser\Node\Expr
    {
        if ($argument === '') {
            return new \_PhpScoperf65af7a6d9a0\PhpParser\Node\Scalar\String_('');
        }
        if (\is_string($argument)) {
            // preslash with dir
            $argument = '/' . $argument;
        }
        $argumentValue = \_PhpScoperf65af7a6d9a0\PhpParser\BuilderHelpers::normalizeValue($argument);
        if ($argumentValue instanceof \_PhpScoperf65af7a6d9a0\PhpParser\Node\Scalar\String_) {
            $argumentValue = new \_PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\BinaryOp\Concat(new \_PhpScoperf65af7a6d9a0\PhpParser\Node\Scalar\MagicConst\Dir(), $argumentValue);
        }
        return $argumentValue;
    }
    public function createClassReference(string $className) : \_PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\ClassConstFetch
    {
        return $this->createConstFetch($className, 'class');
    }
    public function createConstFetch(string $className, string $constantName) : \_PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\ClassConstFetch
    {
        return new \_PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\ClassConstFetch(new \_PhpScoperf65af7a6d9a0\PhpParser\Node\Name\FullyQualified($className), $constantName);
    }
    public function createFalse() : \_PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\ConstFetch
    {
        return new \_PhpScoperf65af7a6d9a0\PhpParser\Node\Expr\ConstFetch(new \_PhpScoperf65af7a6d9a0\PhpParser\Node\Name('false'));
    }
}
