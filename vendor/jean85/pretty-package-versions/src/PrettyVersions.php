<?php

namespace _PhpScoper92feab6bddf8\Jean85;

use _PhpScoper92feab6bddf8\PackageVersions\Versions;
class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;
    public static function getVersion(string $packageName) : \_PhpScoper92feab6bddf8\Jean85\Version
    {
        return new \_PhpScoper92feab6bddf8\Jean85\Version($packageName, \_PhpScoper92feab6bddf8\PackageVersions\Versions::getVersion($packageName));
    }
}
