<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';

    protected $fillable = ['total', 'ubicacion_id'];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function ropas()
    {
        return $this->hasMany(Ropa::class);
    }

    public function calcularTotalPorTipo($tipo)
    {
        return $this->ropas()->totalPorTipo($tipo);
    }

    public function calcularTotalGeneral()
    {
        return $this->ropas()->sum('cantidad');
    }

}
