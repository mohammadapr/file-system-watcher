<?php
namespace App\Watcher\Strategies;
use App\Watcher\Contracts\WatcherStrategyInterface;
use App\Watcher\Contracts\FileEventHandlerInterface;
use App\Watcher\Contracts\LoggerInterface;
abstract class BaseWatcherStrategy implements WatcherStrategyInterface
{
    protected $handlerService;
    protected $logger;

    public function __construct(FileEventHandlerInterface $handlerService, LoggerInterface $logger)
    {
        $this->handlerService = $handlerService;
        $this->logger = $logger;
    }

    abstract public function watch(string $directory): void;

    protected function processFile(string $filePath, string $event): void
    {
        $this->handlerService->handle($filePath, $event);
    }
}
