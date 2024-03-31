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
            'variant_id' => Variant::inRandomOrder()->first(),
            'subtotal_amount' => fake()->numberBetween(1000, 10000),
            'subtax_amount' => fake()->numberBetween(100, 1000),
        ];
    }
}
