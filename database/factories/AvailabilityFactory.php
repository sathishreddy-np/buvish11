<?php

namespace Database\Factories;

use App\Enums\DayEnum;
use App\Models\Activity;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Availability>
 */
class AvailabilityFactory extends Factory
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
            'day' => fake()->randomElement(DayEnum::class),
            'starts_at' => fake()->dateTime(),
            'ends_at' => fake()->dateTime(),
            'availability' => fake()->randomNumber(),
        ];
    }
}
