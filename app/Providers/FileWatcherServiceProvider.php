<?php
namespace App\Providers;
use App\Watcher\Contracts\LoggerInterface;
use App\Watcher\FileHandlerService;
use App\Watcher\Handlers\AppendTextHandler;
use App\Watcher\Handlers\ExtractZipHandler;
use App\Watcher\Handlers\OptimizeImageHandler;
use App\Watcher\Handlers\PostJsonHandler;
use App\Watcher\Handlers\ReplaceDeletedWithMemeHandler;
use App\Watcher\Log\ChangeLogger;
use App\Watcher\Strategies\PollingWatcher;
use App\Watcher\WatcherManager;
use Illuminate\Support\ServiceProvider;

class FileWatcherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(LoggerInterface::class, ChangeLogger::class);

        $this->app->singleton(FileHandlerService::class, function ($app) {
            return new FileHandlerService([
                $app->make(OptimizeImageHandler::class),
                $app->make(PostJsonHandler::class),
                $app->make(AppendTextHandler::class),
                $app->make(ExtractZipHandler::class),
                $app->make(ReplaceDeletedWithMemeHandler::class),
            ]);
        });

        $this->app->singleton(WatcherManager::class, function ($app) {
            $strategy = new PollingWatcher($app->make(FileHandlerService::class), $app->make(ChangeLogger::class));
            return new WatcherManager($strategy);
        });
    }
}
