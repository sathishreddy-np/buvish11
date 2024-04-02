<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'invoice_id' => Invoice::inRandomOrder()->first(),
            'amount_paid' => fake()->numberBetween(100, 10000),
            'payment_gateway' => fake()->randomElement(['Razorpay', 'Stripe', 'GPay', 'PhonePe']),
            'transaction_reference' => fake()->randomNumber(),
            'transaction_mode' => fake()->creditCardType,
            'transaction_date' => fake()->date,
            'transaction_details' => [
                'detail1' => fake()->sentence,
                'detail2' => fake()->sentence,
            ],
        ];
    }
}
