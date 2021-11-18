<?php

namespace Supplycart\Settings\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Supplycart\Settings\Tests\Stubs\Company;
use Supplycart\Settings\Tests\TestCase;

class ModelSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_can_have_default_settings()
    {
        /** @var Company $company */
        $company = Company::factory()->create();
        $settings = $company->getSetting();

        $this->assertIsArray($settings);
        $this->assertArrayHasKey('timezone', $settings);
        $this->assertArrayHasKey('currency', $settings);
        $this->assertArrayHasKey('currency_unit', $settings);
        $this->assertEquals(Company::getDefaultSettings(), $settings);

        $this->assertDatabaseHas('settings', [
            'model_type' => Company::class,
            'model_id' => $company->getKey(),
            'values' => json_encode($settings),
        ]);
    }

    public function test_can_get_model_setting_by_key()
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $this->assertEquals('Asia/KualaLumpur', $company->getSetting('timezone'));
        $this->assertEquals('MYR', $company->getSetting('currency'));
        $this->assertEquals('RM', $company->getSetting('currency_unit'));
    }

    public function test_can_set_model_setting_by_key()
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $company->setSetting('currency', 'USD');
        $company->setSetting('currency_unit', 'USD');

        $this->assertEquals('Asia/KualaLumpur', $company->getSetting('timezone'));
        $this->assertEquals('USD', $company->getSetting('currency'));
        $this->assertEquals('USD', $company->getSetting('currency_unit'));
    }
}
