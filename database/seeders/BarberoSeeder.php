<?php

namespace Database\Seeders;

use App\Models\Barbero;
use Illuminate\Database\Seeder;

class BarberoSeeder extends Seeder
{
    public function run(): void
    {
        $barberos = [
            'Diego Toledo',
            'Mario Perez',
            'Andres Rojas',
            'Luis Fernandez',
        ];

        foreach ($barberos as $nombre) {
            Barbero::create([
                'nombre' => $nombre,
                'activo' => true,
            ]);
        }
    }
}
