<?php

namespace _PhpScoper5c006f5f032f\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper5c006f5f032f\Doctrine\Tests\Common\Annotations\Fixtures\Annotation\Secure;
interface TestInterface
{
    /**
     * @Secure
     */
    function foo();
}
