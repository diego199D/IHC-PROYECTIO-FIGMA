<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $corteClasico = Servicio::create([
            'nombre' => 'Corte Clasico',
            'duracion_minutos' => 30,
            'precio' => 40,
            'emoji' => '✂️',
            'es_promocion' => false,
        ]);

        $barba = Servicio::create([
            'nombre' => 'Barba',
            'duracion_minutos' => 30,
            'precio' => 40,
            'emoji' => '✂️',
            'es_promocion' => false,
        ]);

        Servicio::create([
            'nombre' => 'Afeitado',
            'duracion_minutos' => 30,
            'precio' => 30,
            'emoji' => '✂️',
            'es_promocion' => false,
        ]);

        Servicio::create([
            'nombre' => 'Corte Premium',
            'duracion_minutos' => 45,
            'precio' => 60,
            'emoji' => '✂️',
            'es_promocion' => false,
        ]);

        // Promocion: un "servicio especial" que agrupa a otros dos servicios.
        $combo = Servicio::create([
            'nombre' => 'Combo Corte y Barba',
            'duracion_minutos' => null,
            'precio' => 70,
            'emoji' => '💈',
            'es_promocion' => true,
        ]);

        $combo->serviciosIncluidos()->attach([$corteClasico->id, $barba->id]);
    }
}
