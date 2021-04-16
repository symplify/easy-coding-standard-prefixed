<?php

declare (strict_types=1);
namespace _PhpScoper0752b31150a1\Jean85\Exception;

interface VersionMissingExceptionInterface extends \Throwable
{
    public static function create(string $packageName) : self;
}
