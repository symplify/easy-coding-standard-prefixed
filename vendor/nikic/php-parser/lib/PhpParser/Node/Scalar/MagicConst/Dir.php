<?php

declare (strict_types=1);
namespace _PhpScoper1e80a2e03314\PhpParser\Node\Scalar\MagicConst;

use _PhpScoper1e80a2e03314\PhpParser\Node\Scalar\MagicConst;
class Dir extends \_PhpScoper1e80a2e03314\PhpParser\Node\Scalar\MagicConst
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
