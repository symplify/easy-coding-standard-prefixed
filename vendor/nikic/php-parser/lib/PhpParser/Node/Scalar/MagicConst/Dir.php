<?php

declare (strict_types=1);
namespace _PhpScopere205696a9dd6\PhpParser\Node\Scalar\MagicConst;

use _PhpScopere205696a9dd6\PhpParser\Node\Scalar\MagicConst;
class Dir extends \_PhpScopere205696a9dd6\PhpParser\Node\Scalar\MagicConst
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
