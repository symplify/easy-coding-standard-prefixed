<?php

declare (strict_types=1);
namespace _PhpScoper53db80252f28;

use _PhpScoper53db80252f28\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/another-one.php');
};
