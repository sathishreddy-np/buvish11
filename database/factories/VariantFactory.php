<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Varient>
 */
class VariantFactory extends Factory
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
            'product_id' => Product::inRandomOrder()->first(),
            'name' => fake()->name(),
            'image' => fake()->imageUrl(),
            'price' => fake()->numberBetween(100, 1000),
        ];
    }
}
