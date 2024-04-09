<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Models\Activity;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restriction>
 */
class RestrictionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::inRandomOrder()->first(),
            'activity_id' => Activity::inRandomOrder()->first(),
            'gender' => fake()->randomElement(GenderEnum::class),
            'minimum_age' => fake()->randomNumber(),
            'maximum_age' => fake()->randomNumber(),
            'price' => fake()->randomNumber(),
        ];

    }
}
