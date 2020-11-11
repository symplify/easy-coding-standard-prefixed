<?php

declare (strict_types=1);
namespace _PhpScoper4f985154d5a0;

use SlevomatCodingStandard\Sniffs\Files\LineLengthSniff;
use _PhpScoper4f985154d5a0\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper4f985154d5a0\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\SlevomatCodingStandard\Sniffs\Files\LineLengthSniff::class);
};
