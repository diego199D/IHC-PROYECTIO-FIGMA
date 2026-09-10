<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla pivote autorreferenciada sobre "servicios": una promoción (servicio con
        // es_promocion=true) agrupa a los servicios normales que la componen.
        Schema::create('promocion_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promocion_id')->constrained('servicios')->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promocion_servicio');
    }
};
