<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimiento';

    protected $fillable = ['fecha', 'tipoMov', 'cantidad', 'tipoRopa', 'ubicacion_id', 'usuario_id', 'estado','ropa_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function ropa()
{
    return $this->hasOne(Ropa::class, 'tipo', 'tipoRopa');  // 'tipo' es el campo en Ropa y 'tipoRopa' es el campo en Movimiento
}
}
