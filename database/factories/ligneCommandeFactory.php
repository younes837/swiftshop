<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ligneCommande>
 */
class ligneCommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'produit_id' => fake()->numberBetween(1, 40),
            'commande_id' => fake()->numberBetween(1, 40),     
            'quantite' => fake()->numberBetween(1, 15),
        ];
    }
}
