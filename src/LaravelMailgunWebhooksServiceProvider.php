<?php

namespace Biegalski\LaravelMailgunWebhooks;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelMailgunWebhooksServiceProvider
 * @package Biegalski\LaravelMailgunWebhooks
 */
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
         * Publish email blade template
         */
        $this->publishes([
            __DIR__ . '/Resources/Views/emails/mailgun_alert.blade.php' => resource_path('views/emails/mailgun_alert.blade.php')
        ], 'mailgun_webhook_view');

        /**
         * Load routes
         */
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        /**
         * Load migrations
         */
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        /**
         * Load views
         */
        $this->loadViewsFrom(__DIR__ . '/Views', 'laravel-mailgun-webhooks');

        /**
         * Load translations
         */
        $this->loadTranslationsFrom(__DIR__ . '/Resources/lang', 'laravel-mailgun-webhooks');
    }
}
