<?php

declare (strict_types=1);
namespace _PhpScoper14cb6de5473d;

use _PhpScoper14cb6de5473d\SebastianBergmann\Diff\Differ;
use _PhpScoper14cb6de5473d\Symfony\Component\Console\Style\SymfonyStyle;
use _PhpScoper14cb6de5473d\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory;
use Symplify\PackageBuilder\Reflection\PrivatesAccessor;
use function _PhpScoper14cb6de5473d\Symfony\Component\DependencyInjection\Loader\Configurator\service;
return static function (\_PhpScoper14cb6de5473d\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('Symplify\\ConsoleColorDiff\\', __DIR__ . '/../src');
    $services->set(\_PhpScoper14cb6de5473d\SebastianBergmann\Diff\Differ::class);
    $services->set(\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class);
    $services->set(\_PhpScoper14cb6de5473d\Symfony\Component\Console\Style\SymfonyStyle::class)->factory([\_PhpScoper14cb6de5473d\Symfony\Component\DependencyInjection\Loader\Configurator\service(\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class), 'create']);
    $services->set(\Symplify\PackageBuilder\Reflection\PrivatesAccessor::class);
};
