<?php

declare (strict_types=1);
namespace _PhpScopera909b9d9be2e;

use _PhpScopera909b9d9be2e\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScopera909b9d9be2e\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/another-one.php');
};
