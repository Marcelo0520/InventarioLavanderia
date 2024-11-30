<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Ropa;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class RopaController extends Controller
{
    public function showChangeStateForm()
    {
        $ubicaciones = Ubicacion::all();
        $tiposRopa = Ropa::distinct('tipo')->pluck('tipo');
        return view('cambiarestado', compact('ubicaciones', 'tiposRopa'));
    }

    public function changeState(Request $request)
    {
        $request->validate([
            'ubicacion_id' => 'required|exists:ubicacion,id',
            'tipoRopa' => 'required|string',
            'estado_actual' => 'required|string|in:limpia,sucia',
            'nuevo_estado' => 'required|string|in:limpia,sucia|different:estado_actual',
            'cantidad' => 'required|integer|min:1',
        ]);

        $inventario = Inventario::where('ubicacion_id', $request->ubicacion_id)->first();
        if (!$inventario) {
            return back()->with('error', 'Ubicación no encontrada.');
        }

        $ropa = Ropa::where('inventario_id', $inventario->id)
            ->where('tipo', $request->tipoRopa)
            ->where('estado', $request->estado_actual)
            ->first();

        if (!$ropa || $ropa->cantidad < $request->cantidad) {
            return back()->with('error', 'Cantidad insuficiente para cambiar el estado.');
        }

        // Reducir la cantidad en el estado actual
        $ropa->cantidad -= $request->cantidad;
        $ropa->save();

        // Actualizar o crear la entrada en el nuevo estado
        $ropaNueva = Ropa::where('inventario_id', $inventario->id)
            ->where('tipo', $request->tipoRopa)
            ->where('estado', $request->nuevo_estado)
            ->first();

        if ($ropaNueva) {
            $ropaNueva->cantidad += $request->cantidad;
            $ropaNueva->save();
        } else {
            Ropa::create([
                'tipo' => $request->tipoRopa,
                'cantidad' => $request->cantidad,
                'estado' => $request->nuevo_estado,
                'inventario_id' => $inventario->id,
            ]);
        }

        return redirect()->route('ropa.cambiarEstado')->with('success', 'Estado de la ropa actualizado correctamente.');
    }
}
