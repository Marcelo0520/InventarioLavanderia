<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'ubicacion_id'];

    // Relación con Ubicación (Un Inventario pertenece a una Ubicación)
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }
}
