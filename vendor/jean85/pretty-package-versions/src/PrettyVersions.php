<?php

declare (strict_types=1);
namespace _PhpScoperc2b2a9bb0e13\Jean85;

use Composer\InstalledVersions;
use _PhpScoperc2b2a9bb0e13\Jean85\Exception\ProvidedPackageException;
use _PhpScoperc2b2a9bb0e13\Jean85\Exception\ReplacedPackageException;
use _PhpScoperc2b2a9bb0e13\Jean85\Exception\VersionMissingExceptionInterface;
class PrettyVersions
{
    /**
     * @throws VersionMissingExceptionInterface When a package is provided ({@see ProvidedPackageException}) or replaced ({@see ReplacedPackageException})
     */
    public static function getVersion(string $packageName) : \_PhpScoperc2b2a9bb0e13\Jean85\Version
    {
        if (isset(InstalledVersions::getRawData()['versions'][$packageName]['provided'])) {
            throw ProvidedPackageException::create($packageName);
        }
        if (isset(InstalledVersions::getRawData()['versions'][$packageName]['replaced'])) {
            throw ReplacedPackageException::create($packageName);
        }
        return new \_PhpScoperc2b2a9bb0e13\Jean85\Version($packageName, InstalledVersions::getPrettyVersion($packageName), InstalledVersions::getReference($packageName));
    }
    public static function getRootPackageName() : string
    {
        return InstalledVersions::getRootPackage()['name'];
    }
    public static function getRootPackageVersion() : \_PhpScoperc2b2a9bb0e13\Jean85\Version
    {
        return new \_PhpScoperc2b2a9bb0e13\Jean85\Version(self::getRootPackageName(), InstalledVersions::getRootPackage()['pretty_version'], InstalledVersions::getRootPackage()['reference']);
    }
}
