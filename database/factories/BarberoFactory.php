<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Barbero>
 */
class BarberoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'activo' => true,
        ];
    }
}
