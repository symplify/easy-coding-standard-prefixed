<?php

namespace _PhpScoper14cb6de5473d\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper14cb6de5473d\Doctrine\Tests\Common\Annotations\Fixtures\Annotation\Secure;
interface TestInterface
{
    /**
     * @Secure
     */
    function foo();
}
