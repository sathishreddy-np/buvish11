<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\Timezone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = City::inRandomOrder()->first();

        $country_id = $city->country_id;
        $state_id = $city->state_id;
        $city_id = $city->id;

        return [
            'company_id' => Company::factory(),
            'name' => fake()->city(),
            'email' => fake()->safeEmail(),
            'country_code' => Country::inRandomOrder()->first()->phone_code,
            'mobile' => fake()->numerify('9#########'),
            'address' => fake()->address(),
            'city_id' => $city_id,
            'state_id' => $state_id,
            'country_id' => $country_id,
            'postcode' => fake()->postcode(),
            'timezone_id' => Timezone::inRandomOrder()->first()->id,
        ];
    }
}
