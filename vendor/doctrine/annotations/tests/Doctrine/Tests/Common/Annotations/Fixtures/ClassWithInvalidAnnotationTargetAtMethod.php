<?php

namespace _PhpScoper5c006f5f032f\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper5c006f5f032f\Doctrine\Tests\Common\Annotations\Fixtures\AnnotationTargetClass;
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
