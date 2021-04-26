<?php

declare (strict_types=1);
namespace _PhpScoper0261263ca84f;

use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use _PhpScoper0261263ca84f\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(DeclareStrictTypesFixer::class);
};
