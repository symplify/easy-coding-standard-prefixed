<?php

declare (strict_types=1);
namespace Symplify\EasyCodingStandard\DependencyInjection\CompilerPass;

use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\WhitespacesFixerConfig;
use _PhpScoperc8fea59b0cb1\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoperc8fea59b0cb1\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperc8fea59b0cb1\Symfony\Component\DependencyInjection\Reference;
final class FixerWhitespaceConfigCompilerPass implements \_PhpScoperc8fea59b0cb1\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    public function process(\_PhpScoperc8fea59b0cb1\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $definitions = $containerBuilder->getDefinitions();
        foreach ($definitions as $definition) {
            if ($definition->getClass() === null) {
                continue;
            }
            if (!\is_a($definition->getClass(), \PhpCsFixer\Fixer\WhitespacesAwareFixerInterface::class, \true)) {
                continue;
            }
            $definition->addMethodCall('setWhitespacesConfig', [new \_PhpScoperc8fea59b0cb1\Symfony\Component\DependencyInjection\Reference(\PhpCsFixer\WhitespacesFixerConfig::class)]);
        }
    }
}
