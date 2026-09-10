<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'duracion_minutos',
        'precio',
        'emoji',
        'es_promocion',
    ];

    protected $casts = [
        'es_promocion' => 'boolean',
        'precio' => 'decimal:2',
    ];

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    // Cuando este servicio ES una promoción (es_promocion=true), estos son los
    // servicios normales que la componen (ej. Combo Corte y Barba -> Corte Clasico + Barba).
    public function serviciosIncluidos(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'promocion_servicio', 'promocion_id', 'servicio_id');
    }
}
