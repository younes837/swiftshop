<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => fake()->date(),
            'total' => fake()->randomNumber(5, false),
            'etat_id' => fake()->numberBetween(1, 3),
            'user_id' => fake()->numberBetween(1, 40),
            'ville' => "qshqsjkdfqsjkd",
            'adress' => "qshgqsdjkgdjkfdjhs",
        ];
    }
}
