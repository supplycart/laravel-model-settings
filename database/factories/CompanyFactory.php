<?php

namespace Supplycart\Settings\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Supplycart\Settings\Tests\Stubs\Company;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[\Override]
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
        ];
    }
}
