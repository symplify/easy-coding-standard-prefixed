<?php

declare (strict_types=1);
namespace _PhpScoperdf6a0b341030\PhpParser\Node\Scalar\MagicConst;

use _PhpScoperdf6a0b341030\PhpParser\Node\Scalar\MagicConst;
class Dir extends \_PhpScoperdf6a0b341030\PhpParser\Node\Scalar\MagicConst
{
    public function getName() : string
    {
        return '__DIR__';
    }
    public function getType() : string
    {
        return 'Scalar_MagicConst_Dir';
    }
}
