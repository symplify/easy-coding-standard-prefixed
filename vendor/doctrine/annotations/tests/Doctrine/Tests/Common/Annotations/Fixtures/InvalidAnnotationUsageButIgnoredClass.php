<?php

namespace _PhpScoper7cef7256eba6\Doctrine\Tests\Common\Annotations\Fixtures;

use _PhpScoper7cef7256eba6\Doctrine\Tests\Common\Annotations\Fixtures\Annotation\Route;
/**
 * @NoAnnotation
 * @IgnoreAnnotation("NoAnnotation")
 * @Route("foo")
 */
class InvalidAnnotationUsageButIgnoredClass
{
}
