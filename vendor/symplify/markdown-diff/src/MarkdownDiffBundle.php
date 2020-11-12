<?php

declare (strict_types=1);
namespace Symplify\MarkdownDiff;

use _PhpScoper3d6b50c3ca2f\Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use _PhpScoper3d6b50c3ca2f\Symfony\Component\HttpKernel\Bundle\Bundle;
use Symplify\MarkdownDiff\DependencyInjection\Extension\MarkdownDiffExtension;
final class MarkdownDiffBundle extends \_PhpScoper3d6b50c3ca2f\Symfony\Component\HttpKernel\Bundle\Bundle
{
    protected function createContainerExtension() : ?\_PhpScoper3d6b50c3ca2f\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
    {
        return new \Symplify\MarkdownDiff\DependencyInjection\Extension\MarkdownDiffExtension();
    }
}
