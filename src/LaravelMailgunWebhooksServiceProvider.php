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
        /**
         * Make config publishment optional by merging the config from the package.
         */
        $this->mergeConfigFrom(
            __DIR__ . '/../config/mailgun-webhooks.php',
            'mailgun_webhooks'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Publish configuration file
         */
        $this->publishes([
            __DIR__ . '/../config/mailgun-webhooks.php' => config_path('mailgun-webhooks.php')
        ], 'mailgun_webhook_config');

        /**
         * Load routes
         */
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        /**
         * Load migrations
         */
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
