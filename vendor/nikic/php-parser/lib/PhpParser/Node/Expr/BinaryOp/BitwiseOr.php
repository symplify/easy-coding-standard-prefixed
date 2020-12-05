<?php

declare (strict_types=1);
namespace _PhpScoperbaf90856897c\PhpParser\Node\Expr\BinaryOp;

use _PhpScoperbaf90856897c\PhpParser\Node\Expr\BinaryOp;
class BitwiseOr extends \_PhpScoperbaf90856897c\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '|';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_BitwiseOr';
    }
}
