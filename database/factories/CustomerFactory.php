<?php

namespace Database\Factories;

use App\Enums\CommunicationMediumEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'team_id' => Team::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'country_code' => Country::inRandomOrder()->first()->phone_code,
            'mobile' => fake()->numerify('9#########'),
            'communication_medium' => fake()->randomElements(CommunicationMediumEnum::class, 2),
            'address' => fake()->address(),
            'city_id' => $city_id,
            'state_id' => $state_id,
            'country_id' => $country_id,
            'postcode' => fake()->postcode(),
        ];
    }
}
