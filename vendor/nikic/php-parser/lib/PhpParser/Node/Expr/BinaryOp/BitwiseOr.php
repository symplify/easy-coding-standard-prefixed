<?php

declare (strict_types=1);
namespace _PhpScoper5c006f5f032f\PhpParser\Node\Expr\BinaryOp;

use _PhpScoper5c006f5f032f\PhpParser\Node\Expr\BinaryOp;
class BitwiseOr extends \_PhpScoper5c006f5f032f\PhpParser\Node\Expr\BinaryOp
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
