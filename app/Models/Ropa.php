<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ropa extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'cantidad', 'estado'];

    // Relación con Movimiento (Una prenda puede estar asociada a muchos Movimientos)
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
