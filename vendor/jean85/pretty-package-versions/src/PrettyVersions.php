<?php

namespace _PhpScoper4298f97f3cb3\Jean85;

use _PhpScoper4298f97f3cb3\PackageVersions\Versions;
class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;
    public static function getVersion(string $packageName) : \_PhpScoper4298f97f3cb3\Jean85\Version
    {
        return new \_PhpScoper4298f97f3cb3\Jean85\Version($packageName, \_PhpScoper4298f97f3cb3\PackageVersions\Versions::getVersion($packageName));
    }
    public static function getRootPackageName() : string
    {
        return \_PhpScoper4298f97f3cb3\PackageVersions\Versions::ROOT_PACKAGE_NAME;
    }
    public static function getRootPackageVersion() : \_PhpScoper4298f97f3cb3\Jean85\Version
    {
        return self::getVersion(\_PhpScoper4298f97f3cb3\PackageVersions\Versions::ROOT_PACKAGE_NAME);
    }
}
