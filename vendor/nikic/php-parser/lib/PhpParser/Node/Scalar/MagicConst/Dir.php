<?php

declare (strict_types=1);
namespace _PhpScoper6250f8d25076\PhpParser\Node\Scalar\MagicConst;

use _PhpScoper6250f8d25076\PhpParser\Node\Scalar\MagicConst;
class Dir extends \_PhpScoper6250f8d25076\PhpParser\Node\Scalar\MagicConst
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
