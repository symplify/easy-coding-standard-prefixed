<?php

declare (strict_types=1);
namespace _PhpScoperc5bee3a837bb\PhpParser\Node\Expr;

use _PhpScoperc5bee3a837bb\PhpParser\Node;
use _PhpScoperc5bee3a837bb\PhpParser\Node\MatchArm;
class Match_ extends \_PhpScoperc5bee3a837bb\PhpParser\Node\Expr
{
    /** @var Node\Expr */
    public $cond;
    /** @var MatchArm[] */
    public $arms;
    /**
     * @param MatchArm[] $arms
     */
    public function __construct(\_PhpScoperc5bee3a837bb\PhpParser\Node\Expr $cond, array $arms = [], array $attributes = [])
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
