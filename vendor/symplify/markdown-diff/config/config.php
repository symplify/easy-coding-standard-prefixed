<?php

declare (strict_types=1);
namespace _PhpScoper59558822d8c7;

use _PhpScoper59558822d8c7\SebastianBergmann\Diff\Differ;
use _PhpScoper59558822d8c7\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;
use _PhpScoper59558822d8c7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\MarkdownDiff\Diff\Output\CompleteUnifiedDiffOutputBuilderFactory;
use Symplify\MarkdownDiff\Differ\MarkdownDiffer;
use function _PhpScoper59558822d8c7\Symfony\Component\DependencyInjection\Loader\Configurator\ref;
return static function (\_PhpScoper59558822d8c7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('Symplify\\MarkdownDiff\\', __DIR__ . '/../src');
    $services->set(\_PhpScoper59558822d8c7\SebastianBergmann\Diff\Differ::class);
    // markdown
    $services->set('markdownDiffOutputBuilder', \_PhpScoper59558822d8c7\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder::class)->factory([\_PhpScoper59558822d8c7\Symfony\Component\DependencyInjection\Loader\Configurator\ref(\Symplify\MarkdownDiff\Diff\Output\CompleteUnifiedDiffOutputBuilderFactory::class), 'create']);
    $services->set('markdownDiffer', \_PhpScoper59558822d8c7\SebastianBergmann\Diff\Differ::class)->arg('$outputBuilder', \_PhpScoper59558822d8c7\Symfony\Component\DependencyInjection\Loader\Configurator\ref('markdownDiffOutputBuilder'));
    $services->set(\Symplify\MarkdownDiff\Differ\MarkdownDiffer::class)->arg('$markdownDiffer', \_PhpScoper59558822d8c7\Symfony\Component\DependencyInjection\Loader\Configurator\ref('markdownDiffer'));
};
