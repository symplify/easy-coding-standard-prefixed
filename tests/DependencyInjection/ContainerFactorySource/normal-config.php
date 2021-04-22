<?php

declare (strict_types=1);
namespace _PhpScoper22e359cd1ab0;

use SlevomatCodingStandard\Sniffs\Files\LineLengthSniff;
use _PhpScoper22e359cd1ab0\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(LineLengthSniff::class);
};
