<?php

declare (strict_types=1);
namespace _PhpScoper224ae0b86670\PhpParser\NodeVisitor;

use _PhpScoper224ae0b86670\PhpParser\Node;
use _PhpScoper224ae0b86670\PhpParser\NodeVisitorAbstract;
/**
 * Visitor cloning all nodes and linking to the original nodes using an attribute.
 *
 * This visitor is required to perform format-preserving pretty prints.
 */
class CloningVisitor extends \_PhpScoper224ae0b86670\PhpParser\NodeVisitorAbstract
{
    public function enterNode(\_PhpScoper224ae0b86670\PhpParser\Node $origNode)
    {
        $node = clone $origNode;
        $node->setAttribute('origNode', $origNode);
        return $node;
    }
}
