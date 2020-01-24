<?php

namespace Supplycart\Settings\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/settings.php', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}