<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class produitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'libelle' => fake()->word(2),
            'photo' => fake()->randomElement([
                'images/pages/eCommerce/1.png',
                'images/pages/eCommerce/2.png',
                'images/pages/eCommerce/3.png',
                'images/pages/eCommerce/4.png',
                'images/pages/eCommerce/5.png',
                'images/pages/eCommerce/6.png',
                'images/pages/eCommerce/7.png',
                'images/pages/eCommerce/8.png',
            ]),
            'description' => fake()->sentence(),
            'stock' => fake()->numberBetween(0, 100),
            'rating' => fake()->numberBetween(1, 5),
            'categorie_id' => fake()->numberBetween(1, 9),
            // 'favorie' => fake()->boolean(),
            'price' => fake()->randomNumber(5, false),
            'brand' => fake()->word(),
        ];
    }
}
