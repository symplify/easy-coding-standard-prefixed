<?php

declare (strict_types=1);
namespace _PhpScoper3d66e802e797\PhpParser\Node\Expr\BinaryOp;

use _PhpScoper3d66e802e797\PhpParser\Node\Expr\BinaryOp;
class Mod extends \_PhpScoper3d66e802e797\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '%';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Mod';
    }
}
