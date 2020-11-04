<?php

declare (strict_types=1);
namespace _PhpScoper75713bc3e278;

use SlevomatCodingStandard\Sniffs\Files\LineLengthSniff;
use _PhpScoper75713bc3e278\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper75713bc3e278\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\SlevomatCodingStandard\Sniffs\Files\LineLengthSniff::class)->property('lineLimit', 15)->property('absoluteLineLimit', [
        // just test array of annotations
        '@author',
    ]);
};
