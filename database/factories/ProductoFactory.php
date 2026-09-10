<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true),
            'precio' => fake()->randomFloat(2, 10, 100),
            'emoji' => '✨',
            'tipo' => fake()->randomElement(['bebida', 'producto']),
        ];
    }
}
