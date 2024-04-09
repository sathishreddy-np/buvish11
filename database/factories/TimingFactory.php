<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timing>
 */
class TimingFactory extends Factory
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
            'availability_id' => Availability::inRandomOrder()->first(),
            'starts_at' => fake()->time(),
            'ends_at' => fake()->time(),
            'availability' => fake()->randomNumber(),
        ];
    }
}
