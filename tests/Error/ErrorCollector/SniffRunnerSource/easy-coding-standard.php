<?php

declare (strict_types=1);
namespace _PhpScoperdf6a0b341030;

use _PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Sniffs\Debug\CommentedOutCodeSniff;
return static function (\_PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Symplify\CodingStandard\Sniffs\Debug\CommentedOutCodeSniff::class);
};
