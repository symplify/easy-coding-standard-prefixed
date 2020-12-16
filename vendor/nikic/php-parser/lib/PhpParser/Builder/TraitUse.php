<?php

declare (strict_types=1);
namespace _PhpScoperd35c27cd4b09\PhpParser\Builder;

use _PhpScoperd35c27cd4b09\PhpParser\Builder;
use _PhpScoperd35c27cd4b09\PhpParser\BuilderHelpers;
use _PhpScoperd35c27cd4b09\PhpParser\Node;
use _PhpScoperd35c27cd4b09\PhpParser\Node\Stmt;
class TraitUse implements \_PhpScoperd35c27cd4b09\PhpParser\Builder
{
    protected $traits = [];
    protected $adaptations = [];
    /**
     * Creates a trait use builder.
     *
     * @param Node\Name|string ...$traits Names of used traits
     */
    public function __construct(...$traits)
    {
        foreach ($traits as $trait) {
            $this->and($trait);
        }
    }
    /**
     * Adds used trait.
     *
     * @param Node\Name|string $trait Trait name
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function and($trait)
    {
        $this->traits[] = \_PhpScoperd35c27cd4b09\PhpParser\BuilderHelpers::normalizeName($trait);
        return $this;
    }
    /**
     * Adds trait adaptation.
     *
     * @param Stmt\TraitUseAdaptation|Builder\TraitUseAdaptation $adaptation Trait adaptation
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function with($adaptation)
    {
        $adaptation = \_PhpScoperd35c27cd4b09\PhpParser\BuilderHelpers::normalizeNode($adaptation);
        if (!$adaptation instanceof \_PhpScoperd35c27cd4b09\PhpParser\Node\Stmt\TraitUseAdaptation) {
            throw new \LogicException('Adaptation must have type TraitUseAdaptation');
        }
        $this->adaptations[] = $adaptation;
        return $this;
    }
    /**
     * Returns the built node.
     *
     * @return Node The built node
     */
    public function getNode() : \_PhpScoperd35c27cd4b09\PhpParser\Node
    {
        return new \_PhpScoperd35c27cd4b09\PhpParser\Node\Stmt\TraitUse($this->traits, $this->adaptations);
    }
}
