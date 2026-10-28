<?php

namespace Teamtnt\SalesManagement\Tests;

use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Teamtnt\SalesManagement\SalesManagementServiceProvider;
use Yajra\DataTables\ButtonsServiceProvider;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\HtmlServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Teamtnt\\SalesManagement\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DataTablesServiceProvider::class,
            HtmlServiceProvider::class,
            ButtonsServiceProvider::class,
            \Collective\Html\HtmlServiceProvider::class,
            SalesManagementServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Form' => FormFacade::class,
            'Html' => HtmlFacade::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_sales-management_table.php.stub';
        $migration->up();
        */
    }
}
