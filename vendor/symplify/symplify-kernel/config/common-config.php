<?php

declare (strict_types=1);
namespace _PhpScoperae959d396e95;

use _PhpScoperae959d396e95\Symfony\Component\Console\Style\SymfonyStyle;
use _PhpScoperae959d396e95\Symfony\Component\DependencyInjection\ContainerInterface;
use _PhpScoperae959d396e95\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory;
use Symplify\PackageBuilder\Parameter\ParameterProvider;
use Symplify\PackageBuilder\Reflection\PrivatesAccessor;
use Symplify\SmartFileSystem\FileSystemFilter;
use Symplify\SmartFileSystem\FileSystemGuard;
use Symplify\SmartFileSystem\Finder\FinderSanitizer;
use Symplify\SmartFileSystem\Finder\SmartFinder;
use Symplify\SmartFileSystem\SmartFileSystem;
use function _PhpScoperae959d396e95\Symfony\Component\DependencyInjection\Loader\Configurator\ref;
return static function (\_PhpScoperae959d396e95\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    // symfony style
    $services->set(\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class);
    $services->set(\_PhpScoperae959d396e95\Symfony\Component\Console\Style\SymfonyStyle::class)->factory([\_PhpScoperae959d396e95\Symfony\Component\DependencyInjection\Loader\Configurator\ref(\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class), 'create']);
    // filesystem
    $services->set(\Symplify\SmartFileSystem\Finder\FinderSanitizer::class);
    $services->set(\Symplify\SmartFileSystem\SmartFileSystem::class);
    $services->set(\Symplify\SmartFileSystem\Finder\SmartFinder::class);
    $services->set(\Symplify\SmartFileSystem\FileSystemGuard::class);
    $services->set(\Symplify\SmartFileSystem\FileSystemFilter::class);
    $services->set(\Symplify\PackageBuilder\Parameter\ParameterProvider::class)->args([\_PhpScoperae959d396e95\Symfony\Component\DependencyInjection\Loader\Configurator\ref(\_PhpScoperae959d396e95\Symfony\Component\DependencyInjection\ContainerInterface::class)]);
    $services->set(\Symplify\PackageBuilder\Reflection\PrivatesAccessor::class);
};
