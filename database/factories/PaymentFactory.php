<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentFactory extends Factory
{
    protected $model = \App\Models\Payment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'order_id'       => 9,
            'transaction_id' => Str::random(20),
            'status_payment' => $this->faker->randomElement(['paid', 'no-paid','failed']),
            'getaway'        => $this->faker->randomElement(['thawani']),
            'total_payment'  => $this->faker->randomNumber(2)
        ];
    }
}
