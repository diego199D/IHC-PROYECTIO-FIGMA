<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedInteger('duracion_minutos')->nullable();
            $table->decimal('precio', 8, 2);
            $table->string('emoji', 10);
            // Una promoción es un "servicio especial" que agrupa a otros servicios (ver promocion_servicio)
            $table->boolean('es_promocion')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
