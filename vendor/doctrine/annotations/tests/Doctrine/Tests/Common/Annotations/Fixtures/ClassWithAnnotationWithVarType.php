<?php

namespace _PhpScoper21fff473f90a\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper21fff473f90a\Doctrine\Tests\Common\Annotations\Fixtures\AnnotationWithVarType;
use _PhpScoper21fff473f90a\Doctrine\Tests\Common\Annotations\Fixtures\AnnotationTargetAll;
use _PhpScoper21fff473f90a\Doctrine\Tests\Common\Annotations\Fixtures\AnnotationTargetAnnotation;
class ClassWithAnnotationWithVarType
{
    /**
     * @AnnotationWithVarType(string = "String Value")
     */
    public $foo;
    /**
     * @AnnotationWithVarType(annotation = @AnnotationTargetAll)
     */
    public function bar()
    {
    }
    /**
     * @AnnotationWithVarType(string = 123)
     */
    public $invalidProperty;
    /**
     * @AnnotationWithVarType(annotation = @AnnotationTargetAnnotation)
     */
    public function invalidMethod()
    {
    }
}
