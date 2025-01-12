<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => User::select('id')->orderByRaw('RAND()')->first()->id,
            'seller_id' => User::select('id')->orderByRaw('RAND()')->first()->id,
          
            'date_of_order' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 week',
            ),
            
            'created_at' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 week',
            ),
            'updated_at' => $this->faker->dateTimeBetween(
                '- 4 weeks',
                '- 1 week',
            ),
            'deleted_at' => rand(0, 10) === 0
                ? $this->faker->dateTimeBetween(
                    '- 1 week',
                    '+ 2 weeks',
                )
                : null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $order->products()->attach(
                Product::select('id')->orderByRaw('RAND()')->limit(rand(1, 3))->get()
            );
        });
    }
}
