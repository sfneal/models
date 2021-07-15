<?php

namespace Sfneal\Models\Tests\Assets\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sfneal\Models\Tests\Assets\Models\CompanyPeople;

class CompanyPeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyPeople::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_person_id' => $this->faker->uuid,
            'name_first' => $this->faker->firstName,
            'name_last' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'age' => $this->faker->numberBetween(21, 70),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ];
    }
}
