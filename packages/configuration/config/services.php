<?php

declare (strict_types=1);
namespace _PhpScoper75713bc3e278;

use _PhpScoper75713bc3e278\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper75713bc3e278\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->autoconfigure()->public();
    $services->load('Symplify\\EasyCodingStandard\\Configuration\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/Exception']);
};
