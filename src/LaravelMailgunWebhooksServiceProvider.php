<?php

namespace Biegalski\LaravelMailgunWebhooks;

use Illuminate\Support\ServiceProvider;

class LaravelMailgunWebhooksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
