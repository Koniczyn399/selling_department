<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Manufacturer;
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

            'product_name' => fake()->unique()->word(),
            
    
            'price' => $this->faker->numberBetween(1,3000),
            'unit'=> 'szt.',
            'amount' => $this->faker->numberBetween(1,50),

            'description' => $this->faker->unique()->word(),

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
