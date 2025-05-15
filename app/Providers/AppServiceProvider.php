<?php

namespace App\Providers;

use App\Watcher\Contracts\WatcherStrategyInterface;
use App\Watcher\Strategies\BaseWatcherStrategy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(FileWatcherServiceProvider::class);
        $this->app->bind(WatcherStrategyInterface::class, BaseWatcherStrategy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
