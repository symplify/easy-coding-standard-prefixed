<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\NodeFactory;

use _PhpScoperb730595bc9f4\PhpParser\BuilderHelpers;
use _PhpScoperb730595bc9f4\PhpParser\Node\Expr;
use _PhpScoperb730595bc9f4\PhpParser\Node\Expr\BinaryOp\Concat;
use _PhpScoperb730595bc9f4\PhpParser\Node\Expr\ClassConstFetch;
use _PhpScoperb730595bc9f4\PhpParser\Node\Expr\ConstFetch;
use _PhpScoperb730595bc9f4\PhpParser\Node\Name;
use _PhpScoperb730595bc9f4\PhpParser\Node\Name\FullyQualified;
use _PhpScoperb730595bc9f4\PhpParser\Node\Scalar\MagicConst\Dir;
use _PhpScoperb730595bc9f4\PhpParser\Node\Scalar\String_;
final class CommonNodeFactory
{
    public function createAbsoluteDirExpr($argument) : \_PhpScoperb730595bc9f4\PhpParser\Node\Expr
    {
        if ($argument === '') {
            return new \_PhpScoperb730595bc9f4\PhpParser\Node\Scalar\String_('');
        }
        if (\is_string($argument)) {
            // preslash with dir
            $argument = '/' . $argument;
        }
        $argumentValue = \_PhpScoperb730595bc9f4\PhpParser\BuilderHelpers::normalizeValue($argument);
        if ($argumentValue instanceof \_PhpScoperb730595bc9f4\PhpParser\Node\Scalar\String_) {
            $argumentValue = new \_PhpScoperb730595bc9f4\PhpParser\Node\Expr\BinaryOp\Concat(new \_PhpScoperb730595bc9f4\PhpParser\Node\Scalar\MagicConst\Dir(), $argumentValue);
        }
        return $argumentValue;
    }
    public function createClassReference(string $className) : \_PhpScoperb730595bc9f4\PhpParser\Node\Expr\ClassConstFetch
    {
        return $this->createConstFetch($className, 'class');
    }
    public function createConstFetch(string $className, string $constantName) : \_PhpScoperb730595bc9f4\PhpParser\Node\Expr\ClassConstFetch
    {
        return new \_PhpScoperb730595bc9f4\PhpParser\Node\Expr\ClassConstFetch(new \_PhpScoperb730595bc9f4\PhpParser\Node\Name\FullyQualified($className), $constantName);
    }
    public function createFalse() : \_PhpScoperb730595bc9f4\PhpParser\Node\Expr\ConstFetch
    {
        return new \_PhpScoperb730595bc9f4\PhpParser\Node\Expr\ConstFetch(new \_PhpScoperb730595bc9f4\PhpParser\Node\Name('false'));
    }
}
