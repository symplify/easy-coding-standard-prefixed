<?php

namespace _PhpScoper6250f8d25076\Doctrine\Tests\Common\Annotations\Fixtures;

/**
 * @Annotation
 * @Target("ALL")
 */
final class AnnotationWithConstants
{
    const INTEGER = 1;
    const FLOAT = 1.2;
    const STRING = '1.2.3';
    /**
     * @var mixed
     */
    public $value;
}
