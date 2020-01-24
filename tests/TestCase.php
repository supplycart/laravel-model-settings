<?php

namespace Supplycart\Settings\Tests;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as TestBench;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Supplycart\Settings\Providers\SettingsServiceProvider;

abstract class TestCase extends TestBench
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();

        $this->withFactories(__DIR__.'/../database/factories');

        activity()->disableLogging();
    }

    protected function getPackageProviders($app)
    {
        return [
            SettingsServiceProvider::class,
            ActivitylogServiceProvider::class
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
    }
}