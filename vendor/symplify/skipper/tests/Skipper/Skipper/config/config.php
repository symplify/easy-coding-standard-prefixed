<?php

declare (strict_types=1);
namespace _PhpScoper32abeec2fe5a;

use _PhpScoper32abeec2fe5a\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\Skipper\Tests\Skipper\Skipper\Fixture\Element\FifthElement;
use Symplify\Skipper\Tests\Skipper\Skipper\Fixture\Element\SixthSense;
use Symplify\Skipper\ValueObject\Option;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SKIP, [
        // windows like path
        '*\\SomeSkipped\\*',
        // elements
        FifthElement::class,
        SixthSense::class,
    ]);
};
