<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = ['username', 'email', 'password', 'role'];

    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
