<?php

declare (strict_types=1);
namespace _PhpScoper0c575b5c37d7;

use PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\Basic\EncodingFixer;
use PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer;
use _PhpScoper0c575b5c37d7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    // priority 0 - lower last
    $services->set(NoTrailingCommaInSinglelineArrayFixer::class);
    $services->set(ArrayDeclarationSniff::class);
    // priority 100 - higher first
    $services->set(EncodingFixer::class);
    // priority 98
    $services->set(FullOpeningTagFixer::class);
};
