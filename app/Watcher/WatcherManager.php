<?php
namespace App\Watcher;
use App\Watcher\Contracts\WatcherStrategyInterface;
class WatcherManager
{
    private $strategy;

    public function __construct(WatcherStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function startWatching(string $directory): void
    {
        $this->strategy->watch($directory);
    }
}
