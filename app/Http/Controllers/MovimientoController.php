<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'tipoMov' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'tipoRopa' => 'required|string',
            'ubicacion_id' => 'required|exists:ubicacion,id',
        ]);
    
        // Crear el movimiento
        $movimiento = new Movimiento();
        $movimiento->tipoMov = $request->tipoMov;
        $movimiento->cantidad = $request->cantidad;
        $movimiento->tipoRopa = $request->tipoRopa;
        $movimiento->ubicacion_id = $request->ubicacion_id;
        $movimiento->usuario_id = Auth::id(); 
        $movimiento->fecha = now(); 
        $movimiento->save();
    
        return redirect()->route('movimiento')->with('success', 'Movimiento registrado correctamente.');
    }

    
}
