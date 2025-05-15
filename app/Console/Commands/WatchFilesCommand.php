<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Watcher\WatcherManager;

class WatchFilesCommand extends Command
{
    protected $signature = 'watch:files {directory}';
    protected $description = 'Watch a directory for file changes';

    public function __construct(private readonly WatcherManager $watcherManager)
    {
        parent::__construct();
    }

    public function handle()
    {
        $directory = $this->argument('directory');

        if (!is_dir($directory)) {
            $this->error("Directory {$directory} does not exist.");
            return 1;
        }

        $this->info("Starting to watch directory: {$directory}");
        $this->watcherManager->startWatching($directory);

        return 0;
    }
}
