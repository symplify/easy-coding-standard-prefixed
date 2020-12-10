<?php

namespace _PhpScoper8dd2e1c340b1\Doctrine\Tests\Common\Annotations\Ticket;

use _PhpScoper8dd2e1c340b1\Doctrine\Tests\Common\Annotations\Fixtures\Controller;
use _PhpScoper8dd2e1c340b1\Doctrine\Common\Annotations\AnnotationReader;
/**
 * @group
 */
class DCOM55Test extends \_PhpScoper8dd2e1c340b1\PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Doctrine\Common\Annotations\AnnotationException
     * @expectedExceptionMessage [Semantical Error] The class "Doctrine\Tests\Common\Annotations\Fixtures\Controller" is not annotated with @Annotation. Are you sure this class can be used as annotation? If so, then you need to add @Annotation to the _class_ doc comment of "Doctrine\Tests\Common\Annotations\Fixtures\Controller". If it is indeed no annotation, then you need to add @IgnoreAnnotation("Controller") to the _class_ doc comment of class Doctrine\Tests\Common\Annotations\Ticket\Dummy.
     */
    public function testIssue()
    {
        $class = new \ReflectionClass(__NAMESPACE__ . '\\Dummy');
        $reader = new \_PhpScoper8dd2e1c340b1\Doctrine\Common\Annotations\AnnotationReader();
        $reader->getClassAnnotations($class);
    }
    public function testAnnotation()
    {
        $class = new \ReflectionClass(__NAMESPACE__ . '\\DCOM55Consumer');
        $reader = new \_PhpScoper8dd2e1c340b1\Doctrine\Common\Annotations\AnnotationReader();
        $annots = $reader->getClassAnnotations($class);
        $this->assertEquals(1, \count($annots));
        $this->assertInstanceOf(__NAMESPACE__ . '\\DCOM55Annotation', $annots[0]);
    }
    public function testParseAnnotationDocblocks()
    {
        $class = new \ReflectionClass(__NAMESPACE__ . '\\DCOM55Annotation');
        $reader = new \_PhpScoper8dd2e1c340b1\Doctrine\Common\Annotations\AnnotationReader();
        $annots = $reader->getClassAnnotations($class);
        $this->assertEquals(0, \count($annots));
    }
}
/**
 * @Controller
 */
class Dummy
{
}
/**
 * @Annotation
 */
class DCOM55Annotation
{
}
/**
 * @DCOM55Annotation
 */
class DCOM55Consumer
{
}
