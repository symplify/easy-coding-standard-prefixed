<?php

declare (strict_types=1);
namespace Symplify\EasyTesting\Finder;

use _PhpScoperf3dc21757def\Symfony\Component\Finder\Finder;
use Symplify\SmartFileSystem\Finder\FinderSanitizer;
use Symplify\SmartFileSystem\SmartFileInfo;
final class FixtureFinder
{
    /**
     * @var FinderSanitizer
     */
    private $finderSanitizer;
    public function __construct(\Symplify\SmartFileSystem\Finder\FinderSanitizer $finderSanitizer)
    {
        $this->finderSanitizer = $finderSanitizer;
    }
    /**
     * @return SmartFileInfo[]
     */
    public function find(array $sources) : array
    {
        $finder = new \_PhpScoperf3dc21757def\Symfony\Component\Finder\Finder();
        $finder->files()->in($sources)->name('*.php.inc')->path('Fixture')->sortByName();
        return $this->finderSanitizer->sanitize($finder);
    }
}