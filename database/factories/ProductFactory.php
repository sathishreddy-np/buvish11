<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'brand_id' => Brand::inRandomOrder()->first(),
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'meta_title' => fake()->word(),
            'meta_description' => fake()->paragraph(),
            'hsn_code' => fake()->word(),
            'sku_code' => fake()->word(),
            'barcode' => fake()->word(),
            'is_taxable' => fake()->randomElement([true, false]),
            'is_vat_applied' => fake()->randomElement([true, false]),
            'is_coupon_applicable' => fake()->randomElement([true, false]),
            'is_digital' => fake()->randomElement([true, false]),
            'digital_product_file' => fake()->randomElement([true, false]),
        ];
    }
}
