<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(2),
            'description' => fake()->sentence(),
            'image' => fake()->randomElement([
                'images/pages/eCommerce/1.png',
                'images/pages/eCommerce/2.png',
                'images/pages/eCommerce/3.png',
                'images/pages/eCommerce/4.png',
                'images/pages/eCommerce/5.png',
                'images/pages/eCommerce/6.png',
                'images/pages/eCommerce/7.png',
                'images/pages/eCommerce/8.png',
            ]),
        ];
    }
}
