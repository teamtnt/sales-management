<?php

namespace Teamtnt\SalesManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SalesManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'sales-management');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/sales-management.php' => config_path('sales-management.php'),
            ], 'sales-management-config');

            // Publish assets
            $this->publishes([
                __DIR__.'/../public/sales-management' => public_path('/sales-management'),
            ], 'sales-management-assets');
        }

    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sales-management.php', 'sales-management');
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        });
        Route::group($this->routeConfigurationForWebhook(), function () {
            $this->loadRoutesFrom(__DIR__.'/routes/webhook.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('sales-management.prefix'),
            'middleware' => config('sales-management.middleware'),
        ];
    }

    protected function routeConfigurationForWebhook()
    {
        return [
            'prefix' => config('sales-management.prefix'),
        ];
    }
}
