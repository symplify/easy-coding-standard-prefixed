<?php

declare (strict_types=1);
namespace _PhpScoper16399a42e87c;

use _PhpScoper16399a42e87c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper16399a42e87c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/common/*.php');
};
