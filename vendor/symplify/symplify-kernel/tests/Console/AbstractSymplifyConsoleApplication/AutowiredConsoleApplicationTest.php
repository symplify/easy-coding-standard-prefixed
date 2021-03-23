<?php

declare (strict_types=1);
namespace Symplify\SymplifyKernel\Tests\Console\AbstractSymplifyConsoleApplication;

use _PhpScoper35ec99c463ee\Symfony\Component\Console\Application;
use Symplify\PackageBuilder\Testing\AbstractKernelTestCase;
use Symplify\SymplifyKernel\Tests\HttpKernel\OnlyForTestsKernel;
final class AutowiredConsoleApplicationTest extends \Symplify\PackageBuilder\Testing\AbstractKernelTestCase
{
    protected function setUp() : void
    {
        $this->bootKernel(\Symplify\SymplifyKernel\Tests\HttpKernel\OnlyForTestsKernel::class);
    }
    public function test() : void
    {
        $application = $this->getService(\_PhpScoper35ec99c463ee\Symfony\Component\Console\Application::class);
        $this->assertInstanceOf(\_PhpScoper35ec99c463ee\Symfony\Component\Console\Application::class, $application);
    }
}
