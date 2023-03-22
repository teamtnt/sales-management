<?php

namespace Teamtnt\SalesManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class SalesManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->loadViewComponents();
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

    public function loadViewComponents()
    {
        Blade::component('sales-management::total-contacts', \Teamtnt\SalesManagement\View\Components\TotalContactsComponent::class);
        Blade::component('sales-management::deliveries', \Teamtnt\SalesManagement\View\Components\DeliveriesComponent::class);
        Blade::component('sales-management::opens', \Teamtnt\SalesManagement\View\Components\OpensComponent::class);
        Blade::component('sales-management::clicks', \Teamtnt\SalesManagement\View\Components\ClicksComponent::class);
    }
}
