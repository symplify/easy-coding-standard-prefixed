<?php

namespace _PhpScoperb83706991c7f\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoperb83706991c7f\Doctrine\Tests\Common\Annotations\Fixtures\Annotation\Secure;
interface TestInterface
{
    /**
     * @Secure
     */
    function foo();
}
