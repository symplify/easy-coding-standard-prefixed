<?php

declare (strict_types=1);
namespace _PhpScoper8de082cbb8c7;

use PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\Basic\EncodingFixer;
use PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    // priority 0 - lower last
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer::class);
    $services->set(\PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff::class);
    // priority 100 - higher first
    $services->set(\PhpCsFixer\Fixer\Basic\EncodingFixer::class);
    // priority 98
    $services->set(\PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer::class);
};