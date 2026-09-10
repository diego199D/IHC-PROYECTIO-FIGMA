<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->words(2, true),
            'duracion_minutos' => fake()->randomElement([30, 45, 60]),
            'precio' => fake()->randomFloat(2, 20, 100),
            'emoji' => '✂️',
            'es_promocion' => false,
        ];
    }
}
