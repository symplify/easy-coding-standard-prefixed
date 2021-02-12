<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\ServiceOptionAnalyzer;

use _PhpScoper4fc0030e9d22\Nette\Utils\Strings;
final class ServiceOptionAnalyzer
{
    public function hasNamedArguments(array $data) : bool
    {
        if ($data === []) {
            return \false;
        }
        foreach (\array_keys($data) as $key) {
            if (!\_PhpScoper4fc0030e9d22\Nette\Utils\Strings::startsWith((string) $key, '$')) {
                return \false;
            }
        }
        return \true;
    }
}
