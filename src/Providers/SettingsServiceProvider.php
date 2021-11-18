<?php

namespace Supplycart\Settings\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/settings.php', 'settings');

        if ($this->app->runningInConsole()) {
            if (!class_exists('CreateSnapshotsTable')) {
                $path = __DIR__ . '/../database/migrations/2020_01_24_073645_create_settings_table.php.stub';

                $this->publishes([
                    $path => database_path('migrations/2020_01_24_073645_create_settings_table.php'),
                ], 'migrations');
            }
        }
    }
}