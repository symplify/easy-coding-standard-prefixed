<?php

declare (strict_types=1);
namespace _PhpScoper592524ba34f0\PhpParser\Node;

use _PhpScoper592524ba34f0\PhpParser\NodeAbstract;
class UnionType extends \_PhpScoper592524ba34f0\PhpParser\NodeAbstract
{
    /** @var (Identifier|Name)[] Types */
    public $types;
    /**
     * Constructs a union type.
     *
     * @param (Identifier|Name)[] $types      Types
     * @param array               $attributes Additional attributes
     */
    public function __construct(array $types, array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->types = $types;
    }
    public function getSubNodeNames() : array
    {
        return ['types'];
    }
    public function getType() : string
    {
        return 'UnionType';
    }
}
