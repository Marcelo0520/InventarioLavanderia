<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Movimiento;
use App\Models\Ropa;
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
            'estado' => 'required|string|in:limpia,sucia',
            'ubicacion_id' => 'required|exists:ubicacion,id',
        ]);
    
        $inventario = Inventario::where('ubicacion_id', $request->ubicacion_id)->first();
    
        // Buscar ropa específica en el inventario
        $ropa = Ropa::where('inventario_id', $inventario->id)
            ->where('tipo', $request->tipoRopa)
            ->where('estado', $request->estado)
            ->first();
    
        // Validar egreso
        if ($request->tipoMov == 'Egreso') {
            if (!$ropa || $ropa->cantidad < $request->cantidad) {
                session()->flash('error', 'Cantidad insuficiente en el inventario para egresar ' . $request->cantidad . ' ' . $request->tipoRopa . '(s) en estado ' . $request->estado . '.');
                return back();
            }
        }
    
        // Crear el movimiento
        $movimiento = new Movimiento();
        $movimiento->tipoMov = $request->tipoMov;
        $movimiento->cantidad = $request->cantidad;
        $movimiento->tipoRopa = $request->tipoRopa;
        $movimiento->estado = $request->estado;
        $movimiento->ubicacion_id = $request->ubicacion_id;
        $movimiento->usuario_id = Auth::id();
        $movimiento->fecha = now();
        $movimiento->save();
    
        // Actualizar inventario
        if ($ropa) {
            $ropa->cantidad += $request->tipoMov == 'Ingreso' ? $request->cantidad : -$request->cantidad;
            $ropa->save();
        } else {
            Ropa::create([
                'tipo' => $request->tipoRopa,
                'cantidad' => $request->tipoMov == 'Ingreso' ? $request->cantidad : 0,
                'estado' => $request->estado,
                'inventario_id' => $inventario->id,
            ]);
        }
    
        $inventario->total += $request->tipoMov === 'Ingreso' ? $request->cantidad : -$request->cantidad;
        if ($inventario->total < 0) {
            session()->flash('error', 'No se pudo realizar el movimiento. El inventario no puede ser negativo.');
            return back();
        }
        $inventario->save();
    
        // Mensaje descriptivo de éxito
        $message = 'Movimiento de ' . strtolower($request->tipoMov) . ' registrado correctamente: ' .
            $request->cantidad . ' ' . $request->tipoRopa . '(s) en estado ' . $request->estado . ' en la ubicación ' . $inventario->ubicacion->nombre . '.';
    
        session()->flash('success', $message);
    
        return redirect()->route('movimiento');
    }
    
}