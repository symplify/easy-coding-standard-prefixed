<?php

declare (strict_types=1);
namespace Symplify\EasyCodingStandard\ChangedFilesDetector;

use _PhpScoper35ec99c463ee\Symfony\Component\Config\FileLocator;
use _PhpScoper35ec99c463ee\Symfony\Component\Config\Loader\LoaderInterface;
use _PhpScoper35ec99c463ee\Symfony\Component\Config\Loader\LoaderResolver;
use _PhpScoper35ec99c463ee\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper35ec99c463ee\Symfony\Component\DependencyInjection\Loader\GlobFileLoader;
use Symplify\EasyCodingStandard\Exception\Configuration\FileNotFoundException;
use Symplify\PackageBuilder\DependencyInjection\FileLoader\ParameterMergingPhpFileLoader;
use Symplify\SymplifyKernel\Exception\ShouldNotHappenException;
/**
 * @see \Symplify\EasyCodingStandard\ChangedFilesDetector\Tests\FileHashComputer\FileHashComputerTest
 */
final class FileHashComputer
{
    public function computeConfig(string $filePath) : string
    {
        $containerBuilder = new \_PhpScoper35ec99c463ee\Symfony\Component\DependencyInjection\ContainerBuilder();
        $loader = $this->createLoader($filePath, $containerBuilder);
        $loader->load($filePath);
        $parameterBag = $containerBuilder->getParameterBag();
        return $this->arrayToHash($containerBuilder->getServiceIds()) . $this->arrayToHash($parameterBag->all());
    }
    public function compute(string $filePath) : string
    {
        $fileHash = \md5_file($filePath);
        if (!$fileHash) {
            throw new \Symplify\EasyCodingStandard\Exception\Configuration\FileNotFoundException(\sprintf('File "%s" was not found', $fileHash));
        }
        return $fileHash;
    }
    /**
     * @param mixed[] $array
     */
    private function arrayToHash(array $array) : string
    {
        $serializedArray = \serialize($array);
        return \md5($serializedArray);
    }
    private function createLoader(string $filePath, \_PhpScoper35ec99c463ee\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : \_PhpScoper35ec99c463ee\Symfony\Component\Config\Loader\LoaderInterface
    {
        $fileLocator = new \_PhpScoper35ec99c463ee\Symfony\Component\Config\FileLocator([\dirname($filePath)]);
        $loaders = [new \_PhpScoper35ec99c463ee\Symfony\Component\DependencyInjection\Loader\GlobFileLoader($containerBuilder, $fileLocator), new \Symplify\PackageBuilder\DependencyInjection\FileLoader\ParameterMergingPhpFileLoader($containerBuilder, $fileLocator)];
        $loaderResolver = new \_PhpScoper35ec99c463ee\Symfony\Component\Config\Loader\LoaderResolver($loaders);
        $loader = $loaderResolver->resolve($filePath);
        if (!$loader) {
            throw new \Symplify\SymplifyKernel\Exception\ShouldNotHappenException();
        }
        return $loader;
    }
}
