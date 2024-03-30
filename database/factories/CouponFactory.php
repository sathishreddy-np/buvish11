<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['fixed_amount', 'percentage']);

        if ($type == 'fixed_amount') {
            $value = fake()->randomNumber();
        }

        if ($type == 'percentage') {
            $value = fake()->randomNumber();
        }

        return [
            'team_id' => Team::factory(),
            'code' => fake()->word(),
            'type' => $type,
            'value' => $value,
            'limit' => fake()->randomNumber(),
            'usage_count' => fake()->randomNumber(),
            'starts_at' => fake()->dateTime(),
            'expires_at' => fake()->dateTime(),
        ];
    }
}
