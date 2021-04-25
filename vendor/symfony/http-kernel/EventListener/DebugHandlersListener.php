<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper2737ffe13a7b\Symfony\Component\HttpKernel\EventListener;

use _PhpScoper2737ffe13a7b\Psr\Log\LoggerInterface;
use _PhpScoper2737ffe13a7b\Symfony\Component\Console\ConsoleEvents;
use _PhpScoper2737ffe13a7b\Symfony\Component\Console\Event\ConsoleEvent;
use _PhpScoper2737ffe13a7b\Symfony\Component\Console\Output\ConsoleOutputInterface;
use _PhpScoper2737ffe13a7b\Symfony\Component\ErrorHandler\ErrorHandler;
use _PhpScoper2737ffe13a7b\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use _PhpScoper2737ffe13a7b\Symfony\Component\HttpKernel\Debug\FileLinkFormatter;
use _PhpScoper2737ffe13a7b\Symfony\Component\HttpKernel\Event\KernelEvent;
use _PhpScoper2737ffe13a7b\Symfony\Component\HttpKernel\KernelEvents;
/**
 * Configures errors and exceptions handlers.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final
 */
class DebugHandlersListener implements EventSubscriberInterface
{
    private $earlyHandler;
    private $exceptionHandler;
    private $logger;
    private $deprecationLogger;
    private $levels;
    private $throwAt;
    private $scream;
    private $fileLinkFormat;
    private $scope;
    private $firstCall = \true;
    private $hasTerminatedWithException;
    /**
     * @param callable|null                 $exceptionHandler A handler that must support \Throwable instances that will be called on Exception
     * @param array|int                     $levels           An array map of E_* to LogLevel::* or an integer bit field of E_* constants
     * @param int|null                      $throwAt          Thrown errors in a bit field of E_* constants, or null to keep the current value
     * @param bool                          $scream           Enables/disables screaming mode, where even silenced errors are logged
     * @param string|FileLinkFormatter|null $fileLinkFormat   The format for links to source files
     * @param bool                          $scope            Enables/disables scoping mode
     */
    public function __construct(callable $exceptionHandler = null, LoggerInterface $logger = null, $levels = \E_ALL, ?int $throwAt = \E_ALL, bool $scream = \true, $fileLinkFormat = null, bool $scope = \true, LoggerInterface $deprecationLogger = null)
    {
        $handler = \set_exception_handler('var_dump');
        $this->earlyHandler = \is_array($handler) ? $handler[0] : null;
        \restore_exception_handler();
        $this->exceptionHandler = $exceptionHandler;
        $this->logger = $logger;
        $this->levels = null === $levels ? \E_ALL : $levels;
        $this->throwAt = \is_int($throwAt) ? $throwAt : (null === $throwAt ? null : ($throwAt ? \E_ALL : null));
        $this->scream = $scream;
        $this->fileLinkFormat = $fileLinkFormat;
        $this->scope = $scope;
        $this->deprecationLogger = $deprecationLogger;
    }
    /**
     * Configures the error handler.
     */
    public function configure(object $event = null)
    {
        if ($event instanceof ConsoleEvent && !\in_array(\PHP_SAPI, ['cli', 'phpdbg'], \true)) {
            return;
        }
        if (!$event instanceof KernelEvent ? !$this->firstCall : !$event->isMasterRequest()) {
            return;
        }
        $this->firstCall = $this->hasTerminatedWithException = \false;
        $handler = \set_exception_handler('var_dump');
        $handler = \is_array($handler) ? $handler[0] : null;
        \restore_exception_handler();
        if (!$handler instanceof ErrorHandler) {
            $handler = $this->earlyHandler;
        }
        if ($handler instanceof ErrorHandler) {
            if ($this->logger || $this->deprecationLogger) {
                $this->setDefaultLoggers($handler);
                if (\is_array($this->levels)) {
                    $levels = 0;
                    foreach ($this->levels as $type => $log) {
                        $levels |= $type;
                    }
                } else {
                    $levels = $this->levels;
                }
                if ($this->scream) {
                    $handler->screamAt($levels);
                }
                if ($this->scope) {
                    $handler->scopeAt($levels & ~\E_USER_DEPRECATED & ~\E_DEPRECATED);
                } else {
                    $handler->scopeAt(0, \true);
                }
                $this->logger = $this->deprecationLogger = $this->levels = null;
            }
            if (null !== $this->throwAt) {
                $handler->throwAt($this->throwAt, \true);
            }
        }
        if (!$this->exceptionHandler) {
            if ($event instanceof KernelEvent) {
                if (\method_exists($kernel = $event->getKernel(), 'terminateWithException')) {
                    $request = $event->getRequest();
                    $hasRun =& $this->hasTerminatedWithException;
                    $this->exceptionHandler = static function (\Throwable $e) use($kernel, $request, &$hasRun) {
                        if ($hasRun) {
                            throw $e;
                        }
                        $hasRun = \true;
                        $kernel->terminateWithException($e, $request);
                    };
                }
            } elseif ($event instanceof ConsoleEvent && ($app = $event->getCommand()->getApplication())) {
                $output = $event->getOutput();
                if ($output instanceof ConsoleOutputInterface) {
                    $output = $output->getErrorOutput();
                }
                $this->exceptionHandler = static function (\Throwable $e) use($app, $output) {
                    $app->renderThrowable($e, $output);
                };
            }
        }
        if ($this->exceptionHandler) {
            if ($handler instanceof ErrorHandler) {
                $handler->setExceptionHandler($this->exceptionHandler);
            }
            $this->exceptionHandler = null;
        }
    }
    private function setDefaultLoggers(ErrorHandler $handler) : void
    {
        if (\is_array($this->levels)) {
            $levelsDeprecatedOnly = [];
            $levelsWithoutDeprecated = [];
            foreach ($this->levels as $type => $log) {
                if (\E_DEPRECATED == $type || \E_USER_DEPRECATED == $type) {
                    $levelsDeprecatedOnly[$type] = $log;
                } else {
                    $levelsWithoutDeprecated[$type] = $log;
                }
            }
        } else {
            $levelsDeprecatedOnly = $this->levels & (\E_DEPRECATED | \E_USER_DEPRECATED);
            $levelsWithoutDeprecated = $this->levels & ~\E_DEPRECATED & ~\E_USER_DEPRECATED;
        }
        $defaultLoggerLevels = $this->levels;
        if ($this->deprecationLogger && $levelsDeprecatedOnly) {
            $handler->setDefaultLogger($this->deprecationLogger, $levelsDeprecatedOnly);
            $defaultLoggerLevels = $levelsWithoutDeprecated;
        }
        if ($this->logger && $defaultLoggerLevels) {
            $handler->setDefaultLogger($this->logger, $defaultLoggerLevels);
        }
    }
    public static function getSubscribedEvents() : array
    {
        $events = [KernelEvents::REQUEST => ['configure', 2048]];
        if (\defined('Symfony\\Component\\Console\\ConsoleEvents::COMMAND')) {
            $events[ConsoleEvents::COMMAND] = ['configure', 2048];
        }
        return $events;
    }
}
