<?php

namespace Database\Seeders;

use App\Models\Barbero;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $diego = Barbero::where('nombre', 'Diego Toledo')->first();
        $afeitado = Servicio::where('nombre', 'Afeitado')->first();

        $horas = ['09:00', '09:30', '10:00'];

        foreach ($horas as $hora) {
            Cita::create([
                'barbero_id' => $diego->id,
                'servicio_id' => $afeitado->id,
                'cliente_nombre' => 'Mario Perez',
                'fecha' => now()->toDateString(),
                'hora' => $hora,
                'estado' => 'pendiente',
            ]);
        }
    }
}
