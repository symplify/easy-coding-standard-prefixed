<?php

declare (strict_types=1);
namespace _PhpScoperb6d4bd368bd9\PhpParser\Node\Expr;

use _PhpScoperb6d4bd368bd9\PhpParser\Node\Expr;
class UnaryMinus extends \_PhpScoperb6d4bd368bd9\PhpParser\Node\Expr
{
    /** @var Expr Expression */
    public $expr;
    /**
     * Constructs a unary minus node.
     *
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(\_PhpScoperb6d4bd368bd9\PhpParser\Node\Expr $expr, array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->expr = $expr;
    }
    public function getSubNodeNames() : array
    {
        return ['expr'];
    }
    public function getType() : string
    {
        return 'Expr_UnaryMinus';
    }
}
