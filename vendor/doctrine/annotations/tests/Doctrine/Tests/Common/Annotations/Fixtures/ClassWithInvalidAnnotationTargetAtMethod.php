<?php

namespace _PhpScoper4e47e3b12394\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper4e47e3b12394\Doctrine\Tests\Common\Annotations\Fixtures\AnnotationTargetClass;
/**
 * @AnnotationTargetClass("Some data")
 */
class ClassWithInvalidAnnotationTargetAtMethod
{
    /**
     * @AnnotationTargetClass("functionName")
     */
    public function functionName($param)
    {
    }
}
