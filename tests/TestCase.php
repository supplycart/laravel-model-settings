<?php

namespace Supplycart\Settings\Tests;

use CreateSettingsTable;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as TestBench;
use Supplycart\Settings\SettingsServiceProvider;

abstract class TestCase extends TestBench
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function getPackageProviders($app)
    {
        return [
            SettingsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUpDatabase()
    {
        $this->app->get('db')->connection()->getSchemaBuilder()->create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->timestamps();
        });

        include_once __DIR__ . '/../database/migrations/2020_01_24_073645_create_settings_table.php.stub';

        (new CreateSettingsTable())->up();
    }
}