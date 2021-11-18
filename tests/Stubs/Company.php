<?php

namespace Supplycart\Settings\Tests\Stubs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Supplycart\Settings\Contracts\HasSettings as SettingsContract;
use Supplycart\Settings\Database\Factories\CompanyFactory;
use Supplycart\Settings\Traits\HasSettings;

class Company extends Model implements SettingsContract
{
    use HasFactory;
    use HasSettings;

    public static function getDefaultSettings(): array
    {
        return [
            'timezone' => 'Asia/KualaLumpur',
            'currency' => 'MYR',
            'currency_unit' => 'RM',
        ];
    }

    protected static function newFactory(): CompanyFactory
    {
        return CompanyFactory::new();
    }
}