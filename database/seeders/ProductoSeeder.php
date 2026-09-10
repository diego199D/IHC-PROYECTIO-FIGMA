<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $bebidas = [
            ['nombre' => 'Soda coca cola peque', 'precio' => 40, 'emoji' => '🥤'],
            ['nombre' => 'Jugo de naranja', 'precio' => 35, 'emoji' => '🧃'],
            ['nombre' => 'Agua mineral', 'precio' => 15, 'emoji' => '💧'],
        ];

        foreach ($bebidas as $bebida) {
            Producto::create([...$bebida, 'tipo' => 'bebida']);
        }

        $productos = [
            ['nombre' => 'Cera Fixer efecto mate', 'precio' => 40, 'emoji' => '✨'],
            ['nombre' => 'Gel texturizador fixer', 'precio' => 90, 'emoji' => '✨'],
            ['nombre' => 'Shampoo anticaspa', 'precio' => 50, 'emoji' => '✨'],
        ];

        foreach ($productos as $producto) {
            Producto::create([...$producto, 'tipo' => 'producto']);
        }
    }
}
