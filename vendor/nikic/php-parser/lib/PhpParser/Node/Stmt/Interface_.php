<?php

declare (strict_types=1);
namespace _PhpScoper3d6b50c3ca2f\PhpParser\Node\Stmt;

use _PhpScoper3d6b50c3ca2f\PhpParser\Node;
class Interface_ extends \_PhpScoper3d6b50c3ca2f\PhpParser\Node\Stmt\ClassLike
{
    /** @var Node\Name[] Extended interfaces */
    public $extends;
    /**
     * Constructs a class node.
     *
     * @param string|Node\Identifier $name Name
     * @param array  $subNodes   Array of the following optional subnodes:
     *                           'extends' => array(): Name of extended interfaces
     *                           'stmts'   => array(): Statements
     * @param array  $attributes Additional attributes
     */
    public function __construct($name, array $subNodes = [], array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->name = \is_string($name) ? new \_PhpScoper3d6b50c3ca2f\PhpParser\Node\Identifier($name) : $name;
        $this->extends = $subNodes['extends'] ?? [];
        $this->stmts = $subNodes['stmts'] ?? [];
    }
    public function getSubNodeNames() : array
    {
        return ['name', 'extends', 'stmts'];
    }
    public function getType() : string
    {
        return 'Stmt_Interface';
    }
}
