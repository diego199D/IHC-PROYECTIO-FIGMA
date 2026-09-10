<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // "Extras": bebidas o productos agregados a una cita mientras se atiende al cliente.
        Schema::create('extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('citas')->cascadeOnDelete();
            $table->foreignId('producto_id')->constrained('productos');
            // Precio "congelado" al momento de agregarlo, para que un cambio futuro de precio
            // en el producto no altere cobros ya realizados.
            $table->decimal('precio', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extras');
    }
};
