<?php

declare (strict_types=1);
namespace _PhpScoper16399a42e87c;

use PhpCsFixer\Fixer\Alias\BacktickToShellExecFixer;
use PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer;
use _PhpScoper16399a42e87c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper16399a42e87c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Alias\BacktickToShellExecFixer::class);
};
