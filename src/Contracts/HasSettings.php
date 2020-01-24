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

    public function getSetting(string $key, $default = null);

    public function setSetting(string $key, $value = null);

    public static function getDefaultSettings(): array;

    public function getCacheKey(): string;
}