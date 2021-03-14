<?php

declare (strict_types=1);
namespace _PhpScopere050faf861e6\Jean85\Exception;

class ProvidedPackageException extends \Exception implements \_PhpScopere050faf861e6\Jean85\Exception\VersionMissingExceptionInterface
{
    public static function create(string $packageName) : \_PhpScopere050faf861e6\Jean85\Exception\VersionMissingExceptionInterface
    {
        return new self('Cannot retrieve a version for package ' . $packageName . ' since it is provided, probably a metapackage');
    }
}
