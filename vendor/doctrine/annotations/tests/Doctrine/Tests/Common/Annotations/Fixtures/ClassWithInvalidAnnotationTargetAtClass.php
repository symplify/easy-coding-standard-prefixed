<?php

namespace _PhpScoperb730595bc9f4\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoperb730595bc9f4\Doctrine\Tests\Common\Annotations\Fixtures\AnnotationTargetPropertyMethod;
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
