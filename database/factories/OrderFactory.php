<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'order_no'    => Str::random(5),
            'customer_id' => 1,
            'order_total' => $this->faker->randomNumber(2),
            'order_status'=> $this->faker->randomElement(['pending', 'processing','completed','on-hold','refused'])
        ];
    }
}
