<?php

namespace Teamtnt\SalesManagement;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SalesManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
    }

    public function register()
    {
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('sales-management.prefix'),
            'middleware' => config('sales-management.middleware'),
        ];
    }
}
