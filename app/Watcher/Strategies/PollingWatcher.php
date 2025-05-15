<?php
namespace App\Watcher\Strategies;
use App\Watcher\Strategies\BaseWatcherStrategy;
class PollingWatcher extends BaseWatcherStrategy
{
    public function watch(string $directory): void
    {
        $this->logger->log("Starting Polling watcher at 12:52 PM CEST, Thursday, May 15, 2025 for: {$directory}");
        while (true) {
            $files = glob("{$directory}/*");
            foreach ($files as $file) {
                $this->processFile($file, 'create');
            }
            $this->processFile($directory . '/nonexistent_file', 'delete');
            sleep(5);
        }
    }
}
