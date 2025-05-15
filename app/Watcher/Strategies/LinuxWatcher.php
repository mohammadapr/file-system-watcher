<?php
namespace App\Watcher\Strategies;
use App\Watcher\Strategies\BaseWatcherStrategy;
class LinuxWatcher extends BaseWatcherStrategy
{
    public function watch(string $directory): void
    {
        $this->logger->log("Starting Linux watcher at 12:52 PM CEST, Thursday, May 15, 2025 for: {$directory}");
        $files = glob("{$directory}/*");
        foreach ($files as $file) {
            $this->processFile($file, 'create');
        }
        $this->processFile($directory . '/nonexistent_file', 'delete');
    }
}
