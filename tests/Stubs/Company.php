<?php

namespace Supplycart\Settings\Tests\Stubs;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Database\Eloquent\Model;
use Supplycart\Settings\Contracts\HasSettings as SettingsContract;
use Supplycart\Settings\Traits\HasSettings;

class Company extends Model implements SettingsContract
{
    use HasSettings;

    public static function getDefaultSettings(): array
    {
        return [
            'timezone' => 'Asia/KualaLumpur',
            'currency' => 'MYR',
            'currency_unit' => 'RM',
        ];
    }
}