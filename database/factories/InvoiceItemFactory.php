<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Team;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
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
            'invoice_id' => Invoice::inRandomOrder()->first(),
            'customer_id' => Customer::inRandomOrder()->first(),
            'product_id' => Product::inRandomOrder()->first(),
            'variant_name' => fake()->name(),
            'variant_price' => fake()->randomNumber(),
            'is_tax' => fake()->randomElement([true,false]),
            'hsn_code' => fake()->word()
        ];
    }
}
