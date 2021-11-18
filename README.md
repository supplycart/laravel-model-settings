# Laravel Settings

Allows eloquent models to have its own settings

## Installation

To install, run this on your Laravel installation:
```shell
composer require supplycart/settings
```

Then publish the migration file:
```shell
php artisan vendor:publish --tag=migrations --provider=Supplycart\Settings\Providers\SettingsServiceProvider
```

## Usage

To use, you just need to implement the `Supplycart\Settings\Contracts\HasSettings` contract and use `Supplycart\Settings\Traits\HasSettings` trait:

```php
use Supplycart\Settings\Contracts\HasSettings as HasSettingsContract;
use Supplycart\Settings\Traits\HasSettings;

class User extends Model implements HasSettingsContract
{
    use HasSettings;
    
    public function getDefaultSettings(): array
    {
        return [];
    }
}
```

### Methods

#### getSetting($key, $default = null)
Retrieve model setting by key. You can use dot notations to get nested setting e.g
```php
$user->getSetting('timezone', 'Asia/Kuala_Lumpur');
$user->getSetting('lang', 'en_my');
$user->getSetting('subscription.newsletter', false);
```

#### setSetting($key, $value)
Set model setting using key. You can use dot notation same like `getSetting` method e.g
```php
$user->setSetting('timezone', 'UTC');
$user->setSetting('lang', 'en_us');
$user->setSetting('subscription.newsletter', true);
```

#### getSettings()
Get all settings. It will return array of settings
```php
$settings = $user->getSettings(); // ['timezone' => 'UTC', 'lang' => 'en_us', 'subscription' => ['newsletter' => true]];
```
