<?php

namespace _PhpScoperb6d4bd368bd9\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoperb6d4bd368bd9\Doctrine\Tests\Common\Annotations\Fixtures\Annotation\Secure;
interface TestInterface
{
    /**
     * @Secure
     */
    function foo();
}
