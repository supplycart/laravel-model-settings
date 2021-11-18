<?php

namespace Supplycart\Settings\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Supplycart\Settings\Models\Setting;

trait HasSettings
{
    public function settings(): MorphOne
    {
        return $this->morphOne($this->getSettingModel(), 'model');
    }

    public function getSetting(string $key = null, $default = null)
    {
        $model = $this->getSettingModel();

        return $model::for($this)->get($key, $default);
    }

    /**
     * @param string|array $key
     * @param mixed $value
     *
     * @return \Supplycart\Settings\Models\Setting
     */
    public function setSetting($key, $value = null)
    {
        $model = $this->getSettingModel();

        return $model::for($this)->set($key, $value);
    }

    public function getCacheKey(): string
    {
        return 'settings:' . get_class($this) . ':' . $this->getKey();
    }

    public function getSettingModel(): string
    {
        return config('settings.model', Setting::class);
    }
}