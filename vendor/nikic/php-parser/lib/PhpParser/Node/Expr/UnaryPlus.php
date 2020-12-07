<?php

declare (strict_types=1);
namespace _PhpScopereb8678af2407\PhpParser\Node\Expr;

use _PhpScopereb8678af2407\PhpParser\Node\Expr;
class UnaryPlus extends \_PhpScopereb8678af2407\PhpParser\Node\Expr
{
    /** @var Expr Expression */
    public $expr;
    /**
     * Constructs a unary plus node.
     *
     * @param Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(\_PhpScopereb8678af2407\PhpParser\Node\Expr $expr, array $attributes = [])
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
        return 'Expr_UnaryPlus';
    }
}
