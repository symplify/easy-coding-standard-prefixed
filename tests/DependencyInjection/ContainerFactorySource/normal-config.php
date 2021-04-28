<?php

declare (strict_types=1);
namespace _PhpScoper1b2f8b9c0339;

use SlevomatCodingStandard\Sniffs\Files\LineLengthSniff;
use _PhpScoper1b2f8b9c0339\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(LineLengthSniff::class);
};
