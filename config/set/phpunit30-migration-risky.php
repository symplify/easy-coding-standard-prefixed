<?php

declare (strict_types=1);
namespace _PhpScoper592524ba34f0;

use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertFixer;
use _PhpScoper592524ba34f0\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper592524ba34f0\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertFixer::class)->call('configure', [['target' => '3.0']]);
};
