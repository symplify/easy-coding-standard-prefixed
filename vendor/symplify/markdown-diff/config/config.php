<?php

declare (strict_types=1);
namespace _PhpScopera9d6b451df71;

use _PhpScopera9d6b451df71\SebastianBergmann\Diff\Differ;
use _PhpScopera9d6b451df71\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;
use _PhpScopera9d6b451df71\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\MarkdownDiff\Diff\Output\CompleteUnifiedDiffOutputBuilderFactory;
use Symplify\MarkdownDiff\Differ\MarkdownDiffer;
use function _PhpScopera9d6b451df71\Symfony\Component\DependencyInjection\Loader\Configurator\ref;
return static function (\_PhpScopera9d6b451df71\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('Symplify\\MarkdownDiff\\', __DIR__ . '/../src');
    $services->set(\_PhpScopera9d6b451df71\SebastianBergmann\Diff\Differ::class);
    // markdown
    $services->set('markdownDiffOutputBuilder', \_PhpScopera9d6b451df71\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder::class)->factory([\_PhpScopera9d6b451df71\Symfony\Component\DependencyInjection\Loader\Configurator\ref(\Symplify\MarkdownDiff\Diff\Output\CompleteUnifiedDiffOutputBuilderFactory::class), 'create']);
    $services->set('markdownDiffer', \_PhpScopera9d6b451df71\SebastianBergmann\Diff\Differ::class)->arg('$outputBuilder', \_PhpScopera9d6b451df71\Symfony\Component\DependencyInjection\Loader\Configurator\ref('markdownDiffOutputBuilder'));
    $services->set(\Symplify\MarkdownDiff\Differ\MarkdownDiffer::class)->arg('$markdownDiffer', \_PhpScopera9d6b451df71\Symfony\Component\DependencyInjection\Loader\Configurator\ref('markdownDiffer'));
};
