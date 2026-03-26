<?php

namespace LaravelWaha\WahaMessages;

use Illuminate\Support\ServiceProvider;

class WahaServiceProvider extends ServiceProvider
{
    /**
     * Register package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/waha.php', 'waha');

        $this->app->singleton(WahaClient::class, function ($app): WahaClient {
            /** @var array{url: string, api_key: ?string, session: string, timeout: int, connect_timeout: int, retry: array{times: int, sleep: int}} $config */
            $config = $app['config']->get('waha');

            return new WahaClient($config);
        });

        $this->app->alias(WahaClient::class, 'waha');
    }

    /**
     * Bootstrap package services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/waha.php' => config_path('waha.php'),
            ], 'waha-config');
        }
    }
}
