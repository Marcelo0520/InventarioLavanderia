<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicacion';

    protected $fillable = ['nombre', 'tipoArea', 'departamento', 'nivelPiso'];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function inventario()
    {
        return $this->hasOne(Inventario::class);
    }
    
}
