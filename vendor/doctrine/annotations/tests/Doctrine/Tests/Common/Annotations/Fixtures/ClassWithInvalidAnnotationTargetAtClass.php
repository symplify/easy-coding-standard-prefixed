<?php

namespace _PhpScoper6250f8d25076\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper6250f8d25076\Doctrine\Tests\Common\Annotations\Fixtures\AnnotationTargetPropertyMethod;
/**
 * @AnnotationTargetPropertyMethod("Some data")
 */
class ClassWithInvalidAnnotationTargetAtClass
{
    /**
     * @AnnotationTargetPropertyMethod("Bar")
     */
    public $foo;
}
