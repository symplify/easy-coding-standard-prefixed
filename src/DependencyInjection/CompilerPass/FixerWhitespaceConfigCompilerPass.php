<?php

declare (strict_types=1);
namespace Symplify\EasyCodingStandard\DependencyInjection\CompilerPass;

use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\WhitespacesFixerConfig;
use _PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Reference;
final class FixerWhitespaceConfigCompilerPass implements \_PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    public function process(\_PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $definitions = $containerBuilder->getDefinitions();
        foreach ($definitions as $definition) {
            if ($definition->getClass() === null) {
                continue;
            }
            if (!\is_a($definition->getClass(), \PhpCsFixer\Fixer\WhitespacesAwareFixerInterface::class, \true)) {
                continue;
            }
            $definition->addMethodCall('setWhitespacesConfig', [new \_PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Reference(\PhpCsFixer\WhitespacesFixerConfig::class)]);
        }
    }
}
