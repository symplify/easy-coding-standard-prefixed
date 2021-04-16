<?php

declare (strict_types=1);
namespace _PhpScopera22bb3f4d7b7;

use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use _PhpScopera22bb3f4d7b7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/simple-config.php');
    $services = $containerConfigurator->services();
    $services->set(ClassDefinitionFixer::class);
};
