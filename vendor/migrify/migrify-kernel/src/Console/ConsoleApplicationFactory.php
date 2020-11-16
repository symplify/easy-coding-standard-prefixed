<?php

declare (strict_types=1);
namespace _PhpScoperdf6a0b341030\Migrify\MigrifyKernel\Console;

use _PhpScoperdf6a0b341030\Symfony\Component\Console\Command\Command;
final class ConsoleApplicationFactory
{
    /**
     * @var Command[]
     */
    private $commands = [];
    /**
     * @param Command[] $commands
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }
    public function create() : \_PhpScoperdf6a0b341030\Migrify\MigrifyKernel\Console\AutowiredConsoleApplication
    {
        return new \_PhpScoperdf6a0b341030\Migrify\MigrifyKernel\Console\AutowiredConsoleApplication($this->commands);
    }
}
