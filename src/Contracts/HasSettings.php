<?php

namespace Supplycart\Settings\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Interface HasSettings
 * @package Supplycart\Settings\Contracts
 *
 * @property $settings
 */
interface HasSettings
{
    public function settings(): MorphOne;

    public function getSetting($key, $default = null);

    public function setSetting($key, $value = null);

    public function getDefaultSettings(): array;

    public function getCacheKey(): string;
}