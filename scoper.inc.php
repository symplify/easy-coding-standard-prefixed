<?php

declare (strict_types=1);
namespace _PhpScoper5e5ebcdbebdf;

use _PhpScoper5e5ebcdbebdf\Nette\Utils\Strings;
use _PhpScoper5e5ebcdbebdf\Isolated\Symfony\Component\Finder\Finder;
$finder = new \_PhpScoper5e5ebcdbebdf\Isolated\Symfony\Component\Finder\Finder();
$polyfillFileInfos = $finder->files()->in(__DIR__ . '/vendor/symfony/polyfill-*')->name('*.php')->getIterator();
$polyfillFilePaths = [];
foreach ($polyfillFileInfos as $polyfillFileInfo) {
    $polyfillFilePaths[] = $polyfillFileInfo->getPathname();
}
return ['files-whitelist' => [
    // do not prefix "trigger_deprecation" from symfony - https://github.com/symfony/symfony/commit/0032b2a2893d3be592d4312b7b098fb9d71aca03
    // these paths are relative to this file location, so it should be in the root directory
    'vendor/symfony/deprecation-contracts/function.php',
] + $polyfillFilePaths, 'whitelist' => [
    // needed for autoload, that is not prefixed, since it's in bin/* file
    'Symplify\\*',
    'PhpCsFixer\\*',
    'PHP_CodeSniffer\\*',
    'SlevomatCodingStandard\\*',
    '_PhpScoper5e5ebcdbebdf\\Symfony\\Component\\DependencyInjection\\Loader\\Configurator\\ContainerConfigurator',
    '_PhpScoper5e5ebcdbebdf\\Symfony\\Component\\DependencyInjection\\Extension\\ExtensionInterface',
    '_PhpScoper5e5ebcdbebdf\\Composer\\InstalledVersions',
    'Symfony\\Polyfill\\*',
], 'patchers' => [
    function (string $filePath, string $prefix, string $content) : string {
        if (!\_PhpScoper5e5ebcdbebdf\Nette\Utils\Strings::endsWith($filePath, 'vendor/jean85/pretty-package-versions/src/PrettyVersions.php')) {
            return $content;
        }
        // see https://regex101.com/r/v8zRMm/1
        return \_PhpScoper5e5ebcdbebdf\Nette\Utils\Strings::replace($content, '#' . $prefix . '\\\\Composer\\\\InstalledVersions#', '_PhpScoper5e5ebcdbebdf\\Composer\\InstalledVersions');
    },
    // fixes https://github.com/symplify/symplify/issues/3102
    function (string $filePath, string $prefix, string $content) : string {
        if (!\_PhpScoper5e5ebcdbebdf\Nette\Utils\Strings::contains($filePath, 'vendor/')) {
            return $content;
        }
        // @see https://regex101.com/r/lBV8IO/2
        $fqcnReservedPattern = \sprintf('#(\\\\)?%s\\\\(parent|self|static)#m', $prefix);
        $matches = \_PhpScoper5e5ebcdbebdf\Nette\Utils\Strings::matchAll($content, $fqcnReservedPattern);
        if (!$matches) {
            return $content;
        }
        foreach ($matches as $match) {
            $content = \str_replace($match[0], $match[2], $content);
        }
        return $content;
    },
]];
