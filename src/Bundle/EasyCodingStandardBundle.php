<?php

declare (strict_types=1);
namespace Symplify\EasyCodingStandard\Bundle;

use PHP_CodeSniffer\Sniffs\Sniff;
use PhpCsFixer\Fixer\FixerInterface;
use _PhpScoper8de082cbb8c7\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper8de082cbb8c7\Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use _PhpScoper8de082cbb8c7\Symfony\Component\HttpKernel\Bundle\Bundle;
use Symplify\EasyCodingStandard\Contract\Console\Output\OutputFormatterInterface;
use Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\ConflictingCheckersCompilerPass;
use Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\FixerWhitespaceConfigCompilerPass;
use Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\RemoveExcludedCheckersCompilerPass;
use Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\RemoveMutualCheckersCompilerPass;
use Symplify\EasyCodingStandard\DependencyInjection\Extension\EasyCodingStandardExtension;
use Symplify\PackageBuilder\DependencyInjection\CompilerPass\AutowireInterfacesCompilerPass;
final class EasyCodingStandardBundle extends \_PhpScoper8de082cbb8c7\Symfony\Component\HttpKernel\Bundle\Bundle
{
    /**
     * Order of compiler passes matters!
     */
    public function build(\_PhpScoper8de082cbb8c7\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        // cleanup
        $containerBuilder->addCompilerPass(new \Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\RemoveExcludedCheckersCompilerPass());
        $containerBuilder->addCompilerPass(new \Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\RemoveMutualCheckersCompilerPass());
        // autowire
        $containerBuilder->addCompilerPass(new \Symplify\PackageBuilder\DependencyInjection\CompilerPass\AutowireInterfacesCompilerPass([\PhpCsFixer\Fixer\FixerInterface::class, \PHP_CodeSniffer\Sniffs\Sniff::class, \Symplify\EasyCodingStandard\Contract\Console\Output\OutputFormatterInterface::class]));
        // exceptions
        $containerBuilder->addCompilerPass(new \Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\ConflictingCheckersCompilerPass());
        // method calls
        $containerBuilder->addCompilerPass(new \Symplify\EasyCodingStandard\DependencyInjection\CompilerPass\FixerWhitespaceConfigCompilerPass());
    }
    protected function createContainerExtension() : ?\_PhpScoper8de082cbb8c7\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
    {
        return new \Symplify\EasyCodingStandard\DependencyInjection\Extension\EasyCodingStandardExtension();
    }
}