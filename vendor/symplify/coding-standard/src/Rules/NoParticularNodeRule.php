<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\Rules;

use _PhpScoper8de082cbb8c7\Nette\Utils\Strings;
use _PhpScoper8de082cbb8c7\PhpParser\Node;
use _PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope;
use Symplify\SymplifyKernel\Exception\ShouldNotHappenException;
/**
 * @see \Symplify\CodingStandard\Tests\Rules\NoParticularNodeRule\NoParticularNodeRuleTest
 */
final class NoParticularNodeRule extends \Symplify\CodingStandard\Rules\AbstractSymplifyRule
{
    /**
     * @var string
     */
    public const ERROR_MESSAGE = 'Node "%s" is fobidden to use';
    /**
     * @var string[]
     */
    private $forbiddenNodes = [];
    /**
     * @param string[] $forbiddenNodes
     */
    public function __construct(array $forbiddenNodes = [])
    {
        foreach ($forbiddenNodes as $forbiddenNode) {
            if (\is_a($forbiddenNode, \_PhpScoper8de082cbb8c7\PhpParser\Node::class, \true)) {
                continue;
            }
            $message = \sprintf('"%s" must be child of "%s"', $forbiddenNode, \_PhpScoper8de082cbb8c7\PhpParser\Node::class);
            throw new \Symplify\SymplifyKernel\Exception\ShouldNotHappenException($message);
        }
        $this->forbiddenNodes = $forbiddenNodes;
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\_PhpScoper8de082cbb8c7\PhpParser\Node::class];
    }
    /**
     * @return string[]
     */
    public function process(\_PhpScoper8de082cbb8c7\PhpParser\Node $node, \_PhpScoper8de082cbb8c7\PHPStan\Analyser\Scope $scope) : array
    {
        foreach ($this->forbiddenNodes as $forbiddenNode) {
            if (!\is_a($node, $forbiddenNode, \true)) {
                continue;
            }
            $name = (string) \_PhpScoper8de082cbb8c7\Nette\Utils\Strings::after($forbiddenNode, '\\', -1);
            $name = \rtrim($name, '_');
            $name = \_PhpScoper8de082cbb8c7\Nette\Utils\Strings::lower($name);
            $errorMessage = \sprintf(self::ERROR_MESSAGE, $name);
            return [$errorMessage];
        }
        return [];
    }
}