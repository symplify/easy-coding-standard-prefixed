<?php

declare (strict_types=1);
namespace _PhpScoper02b5d1bf8fec;

use PhpCsFixer\Fixer\Alias\PowToExponentiationFixer;
use _PhpScoper02b5d1bf8fec\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper02b5d1bf8fec\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\PhpCsFixer\Fixer\Alias\PowToExponentiationFixer::class);
};
