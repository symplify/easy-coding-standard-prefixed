<?php

declare (strict_types=1);
namespace _PhpScopere106f9fd4493;

use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;
use _PhpScopere106f9fd4493\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScopere106f9fd4493\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff::class);
};
