<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'emoji',
        'tipo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    public function extras(): HasMany
    {
        return $this->hasMany(Extra::class);
    }
}
