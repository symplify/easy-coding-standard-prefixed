<?php

declare (strict_types=1);
namespace _PhpScoper069ebd53a518;

use PhpCsFixer\Fixer\Alias\PowToExponentiationFixer;
use _PhpScoper069ebd53a518\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper069ebd53a518\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\PhpCsFixer\Fixer\Alias\PowToExponentiationFixer::class);
};
