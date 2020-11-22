<?php

declare (strict_types=1);
namespace _PhpScoper21fff473f90a\PhpParser\Node\Stmt;

use _PhpScoper21fff473f90a\PhpParser\Node\Identifier;
use _PhpScoper21fff473f90a\PhpParser\Node\Stmt;
class Label extends \_PhpScoper21fff473f90a\PhpParser\Node\Stmt
{
    /** @var Identifier Name */
    public $name;
    /**
     * Constructs a label node.
     *
     * @param string|Identifier $name       Name
     * @param array             $attributes Additional attributes
     */
    public function __construct($name, array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->name = \is_string($name) ? new \_PhpScoper21fff473f90a\PhpParser\Node\Identifier($name) : $name;
    }
    public function getSubNodeNames() : array
    {
        return ['name'];
    }
    public function getType() : string
    {
        return 'Stmt_Label';
    }
}
