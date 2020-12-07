<?php

declare (strict_types=1);
namespace Symplify\PhpConfigPrinter\Naming;

use _PhpScoperb83706991c7f\Nette\Utils\Strings;
final class ClassNaming
{
    public function getShortName(string $class) : string
    {
        if (\_PhpScoperb83706991c7f\Nette\Utils\Strings::contains($class, '\\')) {
            return (string) \_PhpScoperb83706991c7f\Nette\Utils\Strings::after($class, '\\', -1);
        }
        return $class;
    }
}
