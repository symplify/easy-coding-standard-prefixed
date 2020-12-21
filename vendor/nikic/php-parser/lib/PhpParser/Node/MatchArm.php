<?php

declare (strict_types=1);
namespace _PhpScoperb730595bc9f4\PhpParser\Node;

use _PhpScoperb730595bc9f4\PhpParser\Node;
use _PhpScoperb730595bc9f4\PhpParser\NodeAbstract;
class MatchArm extends \_PhpScoperb730595bc9f4\PhpParser\NodeAbstract
{
    /** @var null|Node\Expr[] */
    public $conds;
    /** @var Node\Expr */
    public $body;
    /**
     * @param null|Node\Expr[] $conds
     */
    public function __construct($conds, \_PhpScoperb730595bc9f4\PhpParser\Node\Expr $body, array $attributes = [])
    {
        $this->conds = $conds;
        $this->body = $body;
        $this->attributes = $attributes;
    }
    public function getSubNodeNames() : array
    {
        return ['conds', 'body'];
    }
    public function getType() : string
    {
        return 'MatchArm';
    }
}
