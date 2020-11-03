<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper8de082cbb8c7\Symfony\Component\Process\Tests;

use _PhpScoper8de082cbb8c7\PHPUnit\Framework\TestCase;
use _PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder;
class ProcessBuilderTest extends \_PhpScoper8de082cbb8c7\PHPUnit\Framework\TestCase
{
    /**
     * @group legacy
     */
    public function testInheritEnvironmentVars()
    {
        $proc = \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create()->add('foo')->getProcess();
        $this->assertTrue($proc->areEnvironmentVariablesInherited());
        $proc = \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create()->add('foo')->inheritEnvironmentVariables(\false)->getProcess();
        $this->assertFalse($proc->areEnvironmentVariablesInherited());
    }
    public function testAddEnvironmentVariables()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder();
        $env = array('foo' => 'bar', 'foo2' => 'bar2');
        $proc = $pb->add('command')->setEnv('foo', 'bar2')->addEnvironmentVariables($env)->getProcess();
        $this->assertSame($env, $proc->getEnv());
    }
    /**
     * @expectedException \Symfony\Component\Process\Exception\InvalidArgumentException
     */
    public function testNegativeTimeoutFromSetter()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder();
        $pb->setTimeout(-1);
    }
    public function testNullTimeout()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder();
        $pb->setTimeout(10);
        $pb->setTimeout(null);
        $r = new \ReflectionObject($pb);
        $p = $r->getProperty('timeout');
        $p->setAccessible(\true);
        $this->assertNull($p->getValue($pb));
    }
    public function testShouldSetArguments()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder(array('initial'));
        $pb->setArguments(array('second'));
        $proc = $pb->getProcess();
        $this->assertContains('second', $proc->getCommandLine());
    }
    public function testPrefixIsPrependedToAllGeneratedProcess()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder();
        $pb->setPrefix('/usr/bin/php');
        $proc = $pb->setArguments(array('-v'))->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertEquals('"/usr/bin/php" -v', $proc->getCommandLine());
        } else {
            $this->assertEquals("'/usr/bin/php' '-v'", $proc->getCommandLine());
        }
        $proc = $pb->setArguments(array('-i'))->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertEquals('"/usr/bin/php" -i', $proc->getCommandLine());
        } else {
            $this->assertEquals("'/usr/bin/php' '-i'", $proc->getCommandLine());
        }
    }
    public function testArrayPrefixesArePrependedToAllGeneratedProcess()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder();
        $pb->setPrefix(array('/usr/bin/php', 'composer.phar'));
        $proc = $pb->setArguments(array('-v'))->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertEquals('"/usr/bin/php" composer.phar -v', $proc->getCommandLine());
        } else {
            $this->assertEquals("'/usr/bin/php' 'composer.phar' '-v'", $proc->getCommandLine());
        }
        $proc = $pb->setArguments(array('-i'))->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertEquals('"/usr/bin/php" composer.phar -i', $proc->getCommandLine());
        } else {
            $this->assertEquals("'/usr/bin/php' 'composer.phar' '-i'", $proc->getCommandLine());
        }
    }
    public function testShouldEscapeArguments()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder(array('%path%', 'foo " bar', '%baz%baz'));
        $proc = $pb->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertSame('""^%"path"^%"" "foo "" bar" ""^%"baz"^%"baz"', $proc->getCommandLine());
        } else {
            $this->assertSame("'%path%' 'foo \" bar' '%baz%baz'", $proc->getCommandLine());
        }
    }
    public function testShouldEscapeArgumentsAndPrefix()
    {
        $pb = new \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder(array('arg'));
        $pb->setPrefix('%prefix%');
        $proc = $pb->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertSame('""^%"prefix"^%"" arg', $proc->getCommandLine());
        } else {
            $this->assertSame("'%prefix%' 'arg'", $proc->getCommandLine());
        }
    }
    /**
     * @expectedException \Symfony\Component\Process\Exception\LogicException
     */
    public function testShouldThrowALogicExceptionIfNoPrefixAndNoArgument()
    {
        \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create()->getProcess();
    }
    public function testShouldNotThrowALogicExceptionIfNoArgument()
    {
        $process = \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create()->setPrefix('/usr/bin/php')->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertEquals('"/usr/bin/php"', $process->getCommandLine());
        } else {
            $this->assertEquals("'/usr/bin/php'", $process->getCommandLine());
        }
    }
    public function testShouldNotThrowALogicExceptionIfNoPrefix()
    {
        $process = \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create(array('/usr/bin/php'))->getProcess();
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $this->assertEquals('"/usr/bin/php"', $process->getCommandLine());
        } else {
            $this->assertEquals("'/usr/bin/php'", $process->getCommandLine());
        }
    }
    public function testShouldReturnProcessWithDisabledOutput()
    {
        $process = \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create(array('/usr/bin/php'))->disableOutput()->getProcess();
        $this->assertTrue($process->isOutputDisabled());
    }
    public function testShouldReturnProcessWithEnabledOutput()
    {
        $process = \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create(array('/usr/bin/php'))->disableOutput()->enableOutput()->getProcess();
        $this->assertFalse($process->isOutputDisabled());
    }
    /**
     * @expectedException \Symfony\Component\Process\Exception\InvalidArgumentException
     * @expectedExceptionMessage Symfony\Component\Process\ProcessBuilder::setInput only accepts strings, Traversable objects or stream resources.
     */
    public function testInvalidInput()
    {
        $builder = \_PhpScoper8de082cbb8c7\Symfony\Component\Process\ProcessBuilder::create();
        $builder->setInput(array());
    }
}