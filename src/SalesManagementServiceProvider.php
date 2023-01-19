<?php

namespace Teamtnt\SalesManagement;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Teamtnt\SalesManagement\Commands\SalesManagementCommand;

class SalesManagementServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('sales-management')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_sales-management_table')
            ->hasCommand(SalesManagementCommand::class);
    }
}
