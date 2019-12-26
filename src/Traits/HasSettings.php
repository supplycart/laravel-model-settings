<?php

namespace Supplycart\Settings\Traits;

use Supplycart\Settings\Setting;

trait HasSettings
{
    public function settings()
    {
        return $this->morphOne(Setting::class, 'model');
    }

    public function getSetting(string $key = null, $default = null)
    {
        return Setting::for($this)->get($key, $default);
    }

    /**
     * @param string|array $key
     * @param mixed $value
     *
     * @return \Supplycart\Settings\Setting
     */
    public function setSetting($key, $value = null)
    {
        return Setting::for($this)->set($key, $value);
    }

    public function getCacheKey(): string
    {
        return 'settings:' . get_class($this) . ':' . $this->getKey();
    }
}