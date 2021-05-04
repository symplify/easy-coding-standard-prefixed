<?php

declare (strict_types=1);
namespace _PhpScoperc2b2a9bb0e13;

use SlevomatCodingStandard\Sniffs\Files\LineLengthSniff;
use _PhpScoperc2b2a9bb0e13\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(LineLengthSniff::class);
};
