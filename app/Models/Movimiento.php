<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimiento';

    protected $fillable = ['fecha', 'tipoMov', 'cantidad', 'tipoRopa', 'ubicacion_id', 'usuario_id'];

    // Relación con Usuario (Un Movimiento pertenece a un Usuario)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Relación con Ubicación (Un Movimiento pertenece a una Ubicación)
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }
}
