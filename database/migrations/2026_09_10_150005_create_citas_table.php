<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barbero_id')->constrained('barberos');
            $table->foreignId('servicio_id')->constrained('servicios');
            // No existe pantalla para registrar clientes, por eso es un texto simple y no una tabla aparte.
            $table->string('cliente_nombre', 100)->default('Cliente');
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado', ['pendiente', 'atendiendo', 'cobrada', 'cancelada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
