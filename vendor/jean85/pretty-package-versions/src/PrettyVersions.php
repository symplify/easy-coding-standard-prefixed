<?php

declare (strict_types=1);
namespace _PhpScoper3d66e802e797\Jean85;

use _PhpScoper3d66e802e797\Composer\InstalledVersions;
use _PhpScoper3d66e802e797\Jean85\Exception\ProvidedPackageException;
use _PhpScoper3d66e802e797\Jean85\Exception\ReplacedPackageException;
use _PhpScoper3d66e802e797\Jean85\Exception\VersionMissingExceptionInterface;
class PrettyVersions
{
    /**
     * @throws VersionMissingExceptionInterface When a package is provided ({@see ProvidedPackageException}) or replaced ({@see ReplacedPackageException})
     */
    public static function getVersion(string $packageName) : \_PhpScoper3d66e802e797\Jean85\Version
    {
        if (isset(\_PhpScoper3d66e802e797\Composer\InstalledVersions::getRawData()['versions'][$packageName]['provided'])) {
            throw \_PhpScoper3d66e802e797\Jean85\Exception\ProvidedPackageException::create($packageName);
        }
        if (isset(\_PhpScoper3d66e802e797\Composer\InstalledVersions::getRawData()['versions'][$packageName]['replaced'])) {
            throw \_PhpScoper3d66e802e797\Jean85\Exception\ReplacedPackageException::create($packageName);
        }
        return new \_PhpScoper3d66e802e797\Jean85\Version($packageName, \_PhpScoper3d66e802e797\Composer\InstalledVersions::getPrettyVersion($packageName), \_PhpScoper3d66e802e797\Composer\InstalledVersions::getReference($packageName));
    }
    public static function getRootPackageName() : string
    {
        return \_PhpScoper3d66e802e797\Composer\InstalledVersions::getRootPackage()['name'];
    }
    public static function getRootPackageVersion() : \_PhpScoper3d66e802e797\Jean85\Version
    {
        return new \_PhpScoper3d66e802e797\Jean85\Version(self::getRootPackageName(), \_PhpScoper3d66e802e797\Composer\InstalledVersions::getRootPackage()['pretty_version'], \_PhpScoper3d66e802e797\Composer\InstalledVersions::getRootPackage()['reference']);
    }
}
