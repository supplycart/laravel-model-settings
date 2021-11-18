<?php

namespace Supplycart\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Supplycart\Settings\Contracts\HasSettings;
use Supplycart\Settings\Events\SettingSaved;

class Setting extends Model
{
    protected $fillable = [
        'values',
    ];

    protected $dispatchesEvents = [
        'saved' => SettingSaved::class,
    ];

    protected $casts = [
        'values' => 'array',
    ];

    protected static $cacheTag = 'settings';

    public function model()
    {
        return $this->morphTo();
    }

    public static function for(HasSettings $model): Setting
    {
        /** @var \Supplycart\Settings\Contracts\HasSettings $model */
        $setting = Cache::tags(static::$cacheTag)->rememberForever(
            $model->getCacheKey(),
            function () use ($model) {
                if ($model->settings()->exists()) {
                    return $model->settings;
                }

                return $model->settings()->create([
                    'values' => $model::getDefaultSettings(),
                ]);
            }
        );

        return $setting;
    }

    public function get(string $key = null, $default = null)
    {
        return $key ? data_get($this->values, $key, $default) : $this->values;
    }

    /**
     * @param array|string $key
     * @param null $value
     *
     * @return Setting
     */
    public function set($key, $value = null)
    {
        $values = $this->values;

        if (is_array($key)) {
            $values = array_merge($this->values, $key);
        } else {
            $values = data_set($values, $key, $value);
        }

        $this->values = $values;

        $this->save();

        Cache::tags(static::$cacheTag)->forget($this->model->getCacheKey());

        return $this;
    }

    public function attributesToArray()
    {
        return $this->values;
    }
}
