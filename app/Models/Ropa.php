<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ropa extends Model
{
    use HasFactory;

    protected $table = 'ropa';

    protected $fillable = ['tipo', 'cantidad', 'estado', 'inventario_id'];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }

    public function scopeTotalPorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo)->sum('cantidad');
    }

}
