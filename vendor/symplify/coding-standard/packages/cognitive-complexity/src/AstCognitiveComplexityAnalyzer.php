<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\CognitiveComplexity;

use _PhpScoper8de082cbb8c7\PhpParser\Node\FunctionLike;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\ClassMethod;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Stmt\Function_;
use _PhpScoper8de082cbb8c7\PhpParser\NodeTraverser;
use Symplify\CodingStandard\CognitiveComplexity\DataCollector\CognitiveComplexityDataCollector;
use Symplify\CodingStandard\CognitiveComplexity\NodeVisitor\ComplexityNodeVisitor;
use Symplify\CodingStandard\CognitiveComplexity\NodeVisitor\NestingNodeVisitor;
/**
 * @see \Symplify\CodingStandard\CognitiveComplexity\Tests\AstCognitiveComplexityAnalyzer\AstCognitiveComplexityAnalyzerTest
 */
final class AstCognitiveComplexityAnalyzer
{
    /**
     * @var CognitiveComplexityDataCollector
     */
    private $cognitiveComplexityDataCollector;
    /**
     * @var NestingNodeVisitor
     */
    private $nestingNodeVisitor;
    /**
     * @var ComplexityNodeVisitor
     */
    private $complexityNodeVisitor;
    public function __construct(\Symplify\CodingStandard\CognitiveComplexity\DataCollector\CognitiveComplexityDataCollector $cognitiveComplexityDataCollector, \Symplify\CodingStandard\CognitiveComplexity\NodeVisitor\NestingNodeVisitor $nestingNodeVisitor, \Symplify\CodingStandard\CognitiveComplexity\NodeVisitor\ComplexityNodeVisitor $complexityNodeVisitor)
    {
        $this->cognitiveComplexityDataCollector = $cognitiveComplexityDataCollector;
        $this->nestingNodeVisitor = $nestingNodeVisitor;
        $this->complexityNodeVisitor = $complexityNodeVisitor;
    }
    /**
     * @param Function_|ClassMethod $functionLike
     */
    public function analyzeFunctionLike(\_PhpScoper8de082cbb8c7\PhpParser\Node\FunctionLike $functionLike) : int
    {
        $this->cognitiveComplexityDataCollector->reset();
        $this->nestingNodeVisitor->reset();
        $nodeTraverser = new \_PhpScoper8de082cbb8c7\PhpParser\NodeTraverser();
        $nodeTraverser->addVisitor($this->nestingNodeVisitor);
        $nodeTraverser->addVisitor($this->complexityNodeVisitor);
        $nodeTraverser->traverse([$functionLike]);
        return $this->cognitiveComplexityDataCollector->getCognitiveComplexity();
    }
}