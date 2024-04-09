<?php

namespace Database\Factories;

use App\Enums\DayEnum;
use App\Models\Activity;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionType>
 */
class SubscriptionTypeFactory extends Factory
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
            'name' => fake()->randomElement(['Daily','Weekend','Monthly','Yearly']),
            'days_allowed' => fake()->randomElement(DayEnum::class),
            'no_of_days_valid' => fake()->numberBetween(1,365),
        ];
    }
}
