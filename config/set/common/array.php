<?php

declare (strict_types=1);
namespace _PhpScoper8de082cbb8c7;

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrailingCommaInMultilineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    // array spacing
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer::class);
    $services->set(\Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer::class);
    $services->set(\Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer::class);
    // commas
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\TrailingCommaInMultilineArrayFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer::class)->call('configure', [['syntax' => 'short']]);
};