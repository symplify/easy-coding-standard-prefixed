<?php

namespace _PhpScoper7f41430b5328\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper7f41430b5328\Doctrine\Tests\Common\Annotations\Fixtures\Annotation\Secure;
interface TestInterface
{
    /**
     * @Secure
     */
    function foo();
}
