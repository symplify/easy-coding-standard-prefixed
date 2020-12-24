<?php

declare (strict_types=1);
namespace _PhpScoper5ca2d8bcb02c\PhpParser\Node\Expr;

use _PhpScoper5ca2d8bcb02c\PhpParser\Node;
use _PhpScoper5ca2d8bcb02c\PhpParser\Node\MatchArm;
class Match_ extends \_PhpScoper5ca2d8bcb02c\PhpParser\Node\Expr
{
    /** @var Node\Expr */
    public $cond;
    /** @var MatchArm[] */
    public $arms;
    /**
     * @param MatchArm[] $arms
     */
    public function __construct(\_PhpScoper5ca2d8bcb02c\PhpParser\Node\Expr $cond, array $arms = [], array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->arms = $arms;
    }
    public function getSubNodeNames() : array
    {
        return ['cond', 'arms'];
    }
    public function getType() : string
    {
        return 'Expr_Match';
    }
}
