<?php

declare (strict_types=1);
namespace _PhpScoper8de082cbb8c7\PhpParser\NodeVisitor;

use _PhpScoper8de082cbb8c7\PhpParser\Node;
use _PhpScoper8de082cbb8c7\PhpParser\NodeVisitorAbstract;
/**
 * This visitor can be used to find and collect all nodes satisfying some criterion determined by
 * a filter callback.
 */
class FindingVisitor extends \_PhpScoper8de082cbb8c7\PhpParser\NodeVisitorAbstract
{
    /** @var callable Filter callback */
    protected $filterCallback;
    /** @var Node[] Found nodes */
    protected $foundNodes;
    public function __construct(callable $filterCallback)
    {
        $this->filterCallback = $filterCallback;
    }
    /**
     * Get found nodes satisfying the filter callback.
     *
     * Nodes are returned in pre-order.
     *
     * @return Node[] Found nodes
     */
    public function getFoundNodes() : array
    {
        return $this->foundNodes;
    }
    public function beforeTraverse(array $nodes)
    {
        $this->foundNodes = [];
        return null;
    }
    public function enterNode(\_PhpScoper8de082cbb8c7\PhpParser\Node $node)
    {
        $filterCallback = $this->filterCallback;
        if ($filterCallback($node)) {
            $this->foundNodes[] = $node;
        }
        return null;
    }
}