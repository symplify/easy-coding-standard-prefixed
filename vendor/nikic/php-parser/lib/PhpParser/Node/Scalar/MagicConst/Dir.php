<?php

declare (strict_types=1);
namespace _PhpScoperc5bee3a837bb\PhpParser\Node\Scalar\MagicConst;

use _PhpScoperc5bee3a837bb\PhpParser\Node\Scalar\MagicConst;
class Dir extends \_PhpScoperc5bee3a837bb\PhpParser\Node\Scalar\MagicConst
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
