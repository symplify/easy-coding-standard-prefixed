<?php

declare (strict_types=1);
namespace _PhpScoper83b3b9a317c0;

use _PhpScoper83b3b9a317c0\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper83b3b9a317c0\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/common/*.php');
};
