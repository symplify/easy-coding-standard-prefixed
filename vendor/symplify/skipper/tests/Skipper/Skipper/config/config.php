<?php

declare (strict_types=1);
namespace _PhpScoper1e80a2e03314;

use _PhpScoper1e80a2e03314\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\Skipper\Tests\Skipper\Skipper\Fixture\Element\FifthElement;
use Symplify\Skipper\Tests\Skipper\Skipper\Fixture\Element\SixthSense;
use Symplify\Skipper\ValueObject\Option;
return static function (\_PhpScoper1e80a2e03314\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(\Symplify\Skipper\ValueObject\Option::SKIP, [
        // windows like path
        '*\\SomeSkipped\\*',
        // elements
        \Symplify\Skipper\Tests\Skipper\Skipper\Fixture\Element\FifthElement::class,
        \Symplify\Skipper\Tests\Skipper\Skipper\Fixture\Element\SixthSense::class,
    ]);
};
