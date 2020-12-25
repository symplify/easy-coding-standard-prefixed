<?php

declare (strict_types=1);
namespace Symplify\SmartFileSystem\Tests\Normalizer;

use Iterator;
use _PhpScoperc8fea59b0cb1\PHPUnit\Framework\TestCase;
use Symplify\SmartFileSystem\Normalizer\PathNormalizer;
final class PathNormalizerTest extends \_PhpScoperc8fea59b0cb1\PHPUnit\Framework\TestCase
{
    /**
     * @var PathNormalizer
     */
    private $pathNormalizer;
    protected function setUp() : void
    {
        $this->pathNormalizer = new \Symplify\SmartFileSystem\Normalizer\PathNormalizer();
    }
    /**
     * @dataProvider provideData()
     */
    public function test(string $inputPath, string $expectedNormalizedPath) : void
    {
        $normalizedPath = $this->pathNormalizer->normalizePath($inputPath);
        $this->assertSame($expectedNormalizedPath, $normalizedPath);
    }
    public function provideData() : \Iterator
    {
        // based on Linux
        (yield ['/any/path', '/any/path']);
        (yield ['_PhpScoperc8fea59b0cb1\\any\\path', '/any/path']);
    }
}
