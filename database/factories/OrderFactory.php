<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Device;
use App\Models\OrderState;
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
            'worker_id' => User::select('id')->orderByRaw('RAND()')->first()->id,
            'order_state_id' => OrderState::select('id')->orderByRaw('RAND()')->first()->id,
            
            'date_of_completion' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 week',
            ),
            'deadline_of_completion' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 week',
            ),

     
            'price' => $this->faker->numberBetween( 40,5000),
        
            'description' => $this->faker->word(),

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
}
