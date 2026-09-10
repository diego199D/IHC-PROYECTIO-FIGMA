<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'barbero_id',
        'servicio_id',
        'cliente_nombre',
        'fecha',
        'hora',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class);
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }

    public function extras(): HasMany
    {
        return $this->hasMany(Extra::class);
    }

    // Total a cobrar: precio del servicio + todos los extras (bebidas/productos) agregados.
    public function getTotalAttribute(): float
    {
        return (float) $this->servicio->precio + (float) $this->extras->sum('precio');
    }
}
