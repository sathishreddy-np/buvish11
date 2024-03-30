<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'customer_id' => Customer::inRandomOrder()->first(),
            'invoice_id' => fake()->numerify('######'),
            'invoice_date' => fake()->date,
            'currency' => fake()->currencyCode,
            'total_amount' => fake()->numberBetween(1000, 10000),
            'tax_amount' => fake()->numberBetween(100, 1000),
        ];
    }
}
