<?php
namespace App\Watcher\Contracts;
interface WatcherStrategyInterface
{
    public function watch(string $directory): void;
}
