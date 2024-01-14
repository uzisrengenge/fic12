<?php

namespace Database\Factories;

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
            'name' => $this->faker->name(),
            'descriptions' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomNumber(4),
            'stock' => $this->faker->randomNumber(2),
            'category_id' => $this->faker->numberBetween(1, 4),

        ];
    }
}
