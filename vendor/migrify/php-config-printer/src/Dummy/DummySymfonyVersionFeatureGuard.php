<?php

declare (strict_types=1);
namespace _PhpScoperdf6a0b341030\Migrify\PhpConfigPrinter\Dummy;

use _PhpScoperdf6a0b341030\Migrify\PhpConfigPrinter\Contract\SymfonyVersionFeatureGuardInterface;
final class DummySymfonyVersionFeatureGuard implements \_PhpScoperdf6a0b341030\Migrify\PhpConfigPrinter\Contract\SymfonyVersionFeatureGuardInterface
{
    public function isAtLeastSymfonyVersion(float $symfonyVersion) : bool
    {
        return \true;
    }
}
