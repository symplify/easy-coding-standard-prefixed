<?php

declare (strict_types=1);
namespace Symplify\PackageBuilder\Console\Command;

use ECSPrefix20210507\Symfony\Component\Console\Command\Command;
use ECSPrefix20210507\Symfony\Component\Console\Input\InputOption;
use ECSPrefix20210507\Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\PackageBuilder\ValueObject\Option;
use Symplify\SmartFileSystem\FileSystemGuard;
use Symplify\SmartFileSystem\Finder\SmartFinder;
use Symplify\SmartFileSystem\SmartFileSystem;
abstract class AbstractSymplifyCommand extends Command
{
    /**
     * @var SymfonyStyle
     */
    protected $symfonyStyle;
    /**
     * @var SmartFileSystem
     */
    protected $smartFileSystem;
    /**
     * @var SmartFinder
     */
    protected $smartFinder;
    /**
     * @var FileSystemGuard
     */
    protected $fileSystemGuard;
    public function __construct()
    {
        parent::__construct();
        $this->addOption(Option::CONFIG, 'c', InputOption::VALUE_REQUIRED, 'Path to config file');
    }
    /**
     * @required
     */
    public function autowireAbstractSymplifyCommand(SymfonyStyle $symfonyStyle, SmartFileSystem $smartFileSystem, SmartFinder $smartFinder, FileSystemGuard $fileSystemGuard) : void
    {
        $this->symfonyStyle = $symfonyStyle;
        $this->smartFileSystem = $smartFileSystem;
        $this->smartFinder = $smartFinder;
        $this->fileSystemGuard = $fileSystemGuard;
    }
}
