<?php

namespace Database\Factories;

use App\Models\Barbero;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'barbero_id' => Barbero::factory(),
            'servicio_id' => Servicio::factory(),
            'cliente_nombre' => fake()->name(),
            'fecha' => now()->toDateString(),
            'hora' => fake()->time('H:i'),
            'estado' => 'pendiente',
        ];
    }
}
