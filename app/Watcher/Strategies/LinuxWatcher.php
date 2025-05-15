<?php
namespace App\Watcher\Strategies;
class LinuxWatcher extends BaseWatcherStrategy
{
    public function watch(string $directory): void
    {
        $this->logger->log("Starting Linux watcher",$directory,'info');
        $files = glob("{$directory}/*");
        foreach ($files as $file) {
            $this->processFile($file, 'create');
        }
        $this->processFile($directory . '/nonexistent_file', 'delete');
    }
}
