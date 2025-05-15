<?php
namespace App\Watcher\Strategies;
use Illuminate\Support\Facades\Log;

class PollingWatcher extends BaseWatcherStrategy
{
    private array $fileModificationTimes = [];

    public function watch(string $directory): void
    {
        $this->logger->log("Starting Polling",$directory,'info');

        $previousState = [];
        while (true) {
            $currentState = [];
            foreach (glob("{$directory}/*") as $file) {
                $currentState[$file] = filemtime($file);
            }
            foreach (array_diff_key($currentState, $previousState) as $file => $mtime) {
                $this->processFile($file, 'create');
            }
            foreach (array_diff_key($previousState, $currentState) as $file => $mtime) {
                $this->processFile($file, 'delete');
            }
            foreach ($currentState as $file => $mtime) {
                if (isset($previousState[$file]) && $previousState[$file] !== $mtime) {
                    $this->processFile($file, 'modify');
                }
            }
            $previousState = $currentState;
            sleep(2);
        }
    }
}
