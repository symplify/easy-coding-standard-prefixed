<?php

declare (strict_types=1);
namespace _PhpScoper7b319b4d8e1c;

use _PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/common/*.php');
};
