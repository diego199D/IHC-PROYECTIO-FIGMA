<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = [
        'cita_id',
        'producto_id',
        'precio',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
