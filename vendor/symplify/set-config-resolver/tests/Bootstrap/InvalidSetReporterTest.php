<?php

declare (strict_types=1);
namespace Symplify\SetConfigResolver\Tests\Bootstrap;

use _PhpScopera909b9d9be2e\PHPUnit\Framework\TestCase;
use Symplify\SetConfigResolver\Bootstrap\InvalidSetReporter;
use Symplify\SetConfigResolver\Exception\SetNotFoundException;
final class InvalidSetReporterTest extends \_PhpScopera909b9d9be2e\PHPUnit\Framework\TestCase
{
    /**
     * @var InvalidSetReporter
     */
    private $invalidSetReporter;
    protected function setUp() : void
    {
        $this->invalidSetReporter = new \Symplify\SetConfigResolver\Bootstrap\InvalidSetReporter();
    }
    /**
     * @doesNotPerformAssertions
     */
    public function test() : void
    {
        $setNotFoundException = new \Symplify\SetConfigResolver\Exception\SetNotFoundException('not found', 'one', ['two', 'three']);
        $this->invalidSetReporter->report($setNotFoundException);
    }
}
