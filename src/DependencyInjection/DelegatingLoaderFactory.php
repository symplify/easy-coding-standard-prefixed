<?php

declare (strict_types=1);
namespace Symplify\EasyCodingStandard\DependencyInjection;

use _PhpScopere205696a9dd6\Symfony\Component\Config\FileLocator as SimpleFileLocator;
use _PhpScopere205696a9dd6\Symfony\Component\Config\Loader\DelegatingLoader;
use _PhpScopere205696a9dd6\Symfony\Component\Config\Loader\GlobFileLoader;
use _PhpScopere205696a9dd6\Symfony\Component\Config\Loader\LoaderResolver;
use _PhpScopere205696a9dd6\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScopere205696a9dd6\Symfony\Component\HttpKernel\Config\FileLocator;
use _PhpScopere205696a9dd6\Symfony\Component\HttpKernel\KernelInterface;
use Symplify\PackageBuilder\DependencyInjection\FileLoader\ParameterMergingPhpFileLoader;
final class DelegatingLoaderFactory
{
    public function createFromContainerBuilderAndKernel(\_PhpScopere205696a9dd6\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, \_PhpScopere205696a9dd6\Symfony\Component\HttpKernel\KernelInterface $kernel) : \_PhpScopere205696a9dd6\Symfony\Component\Config\Loader\DelegatingLoader
    {
        $kernelFileLocator = new \_PhpScopere205696a9dd6\Symfony\Component\HttpKernel\Config\FileLocator($kernel);
        return $this->createFromContainerBuilderAndFileLocator($containerBuilder, $kernelFileLocator);
    }
    /**
     * For tests
     */
    public function createContainerBuilderAndConfig(\_PhpScopere205696a9dd6\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, string $config) : \_PhpScopere205696a9dd6\Symfony\Component\Config\Loader\DelegatingLoader
    {
        $directory = \dirname($config);
        $fileLocator = new \_PhpScopere205696a9dd6\Symfony\Component\Config\FileLocator($directory);
        return $this->createFromContainerBuilderAndFileLocator($containerBuilder, $fileLocator);
    }
    private function createFromContainerBuilderAndFileLocator(\_PhpScopere205696a9dd6\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, \_PhpScopere205696a9dd6\Symfony\Component\Config\FileLocator $simpleFileLocator) : \_PhpScopere205696a9dd6\Symfony\Component\Config\Loader\DelegatingLoader
    {
        $loaders = [new \_PhpScopere205696a9dd6\Symfony\Component\Config\Loader\GlobFileLoader($simpleFileLocator), new \Symplify\PackageBuilder\DependencyInjection\FileLoader\ParameterMergingPhpFileLoader($containerBuilder, $simpleFileLocator)];
        $loaderResolver = new \_PhpScopere205696a9dd6\Symfony\Component\Config\Loader\LoaderResolver($loaders);
        return new \_PhpScopere205696a9dd6\Symfony\Component\Config\Loader\DelegatingLoader($loaderResolver);
    }
}
