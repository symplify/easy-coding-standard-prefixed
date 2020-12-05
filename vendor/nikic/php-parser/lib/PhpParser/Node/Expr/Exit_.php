<?php

declare (strict_types=1);
namespace _PhpScoper02b5d1bf8fec\PhpParser\Node\Expr;

use _PhpScoper02b5d1bf8fec\PhpParser\Node\Expr;
class Exit_ extends \_PhpScoper02b5d1bf8fec\PhpParser\Node\Expr
{
    /* For use in "kind" attribute */
    const KIND_EXIT = 1;
    const KIND_DIE = 2;
    /** @var null|Expr Expression */
    public $expr;
    /**
     * Constructs an exit() node.
     *
     * @param null|Expr $expr       Expression
     * @param array                    $attributes Additional attributes
     */
    public function __construct(\_PhpScoper02b5d1bf8fec\PhpParser\Node\Expr $expr = null, array $attributes = [])
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
        return 'Expr_Exit';
    }
}
