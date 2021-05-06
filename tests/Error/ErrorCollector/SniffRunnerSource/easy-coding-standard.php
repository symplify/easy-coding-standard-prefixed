<?php

declare (strict_types=1);
namespace _PhpScoper890197fe38f7;

use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\ArrayIndentSniff;
use _PhpScoper890197fe38f7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(ArrayIndentSniff::class);
};
