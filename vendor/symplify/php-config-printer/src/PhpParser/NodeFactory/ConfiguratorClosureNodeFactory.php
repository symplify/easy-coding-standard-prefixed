<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\PhpParser\NodeFactory;

use _PhpScoperbaf90856897c\PhpParser\Node;
use _PhpScoperbaf90856897c\PhpParser\Node\Expr\Closure;
use _PhpScoperbaf90856897c\PhpParser\Node\Expr\Variable;
use _PhpScoperbaf90856897c\PhpParser\Node\Identifier;
use _PhpScoperbaf90856897c\PhpParser\Node\Name\FullyQualified;
use _PhpScoperbaf90856897c\PhpParser\Node\Param;
use _PhpScoperbaf90856897c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use _PhpScoperbaf90856897c\Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symplify\PhpConfigPrinter\ValueObject\VariableName;
final class ConfiguratorClosureNodeFactory
{
    /**
     * @param Node[] $stmts
     */
    public function createContainerClosureFromStmts(array $stmts) : \_PhpScoperbaf90856897c\PhpParser\Node\Expr\Closure
    {
        $param = $this->createContainerConfiguratorParam();
        return $this->createClosureFromParamAndStmts($param, $stmts);
    }
    /**
     * @param Node[] $stmts
     */
    public function createRoutingClosureFromStmts(array $stmts) : \_PhpScoperbaf90856897c\PhpParser\Node\Expr\Closure
    {
        $param = $this->createRoutingConfiguratorParam();
        return $this->createClosureFromParamAndStmts($param, $stmts);
    }
    private function createContainerConfiguratorParam() : \_PhpScoperbaf90856897c\PhpParser\Node\Param
    {
        $containerConfiguratorVariable = new \_PhpScoperbaf90856897c\PhpParser\Node\Expr\Variable(\Symplify\PhpConfigPrinter\ValueObject\VariableName::CONTAINER_CONFIGURATOR);
        return new \_PhpScoperbaf90856897c\PhpParser\Node\Param($containerConfiguratorVariable, null, new \_PhpScoperbaf90856897c\PhpParser\Node\Name\FullyQualified(\_PhpScoperbaf90856897c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator::class));
    }
    private function createRoutingConfiguratorParam() : \_PhpScoperbaf90856897c\PhpParser\Node\Param
    {
        $containerConfiguratorVariable = new \_PhpScoperbaf90856897c\PhpParser\Node\Expr\Variable(\Symplify\PhpConfigPrinter\ValueObject\VariableName::ROUTING_CONFIGURATOR);
        return new \_PhpScoperbaf90856897c\PhpParser\Node\Param($containerConfiguratorVariable, null, new \_PhpScoperbaf90856897c\PhpParser\Node\Name\FullyQualified(\_PhpScoperbaf90856897c\Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator::class));
    }
    private function createClosureFromParamAndStmts(\_PhpScoperbaf90856897c\PhpParser\Node\Param $param, array $stmts) : \_PhpScoperbaf90856897c\PhpParser\Node\Expr\Closure
    {
        $closure = new \_PhpScoperbaf90856897c\PhpParser\Node\Expr\Closure(['params' => [$param], 'stmts' => $stmts, 'static' => \true]);
        // is PHP 7.1? → add "void" return type
        if (\version_compare(\PHP_VERSION, '7.1.0') >= 0) {
            $closure->returnType = new \_PhpScoperbaf90856897c\PhpParser\Node\Identifier('void');
        }
        return $closure;
    }
}
