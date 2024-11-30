<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Movimiento;
use App\Models\Ropa;
use App\Models\Ubicacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function store(Request $request, EmailController $emailController)
{
    $request->validate([
        'tipoMov' => 'required|string',
        'cantidad' => 'required|integer|min:1',
        'tipoRopa' => 'required|string',
        'estado' => 'required|string|in:limpia,sucia', // Los estados permitidos
        'ubicacion_id' => 'required|exists:ubicacion,id', // Verificación de la ubicación
    ]);

    $inventario = Inventario::where('ubicacion_id', $request->ubicacion_id)->first();
    if (!$inventario) {
        session()->flash('error', 'Ubicación no encontrada.');
        return back();
    }

    // Si el movimiento es un **EGRESO**
    if ($request->tipoMov == 'Egreso') {
        $ropa = Ropa::where('inventario_id', $inventario->id)
            ->where('tipo', $request->tipoRopa)
            ->where('estado', $request->estado) // Usamos el estado (sucia o limpia)
            ->first();

        if (!$ropa || $ropa->cantidad < $request->cantidad) {
            session()->flash('error', 'Cantidad insuficiente en el inventario para egresar ' . $request->cantidad . ' ' . $request->tipoRopa . '(s) en estado ' . $request->estado . '.');
            return back();
        }

        $ropa->cantidad -= $request->cantidad;
        $ropa->save();
    }

    // Registrar el movimiento de egreso o ingreso
    $movimiento = new Movimiento();
    $movimiento->tipoMov = $request->tipoMov;
    $movimiento->cantidad = $request->cantidad;
    $movimiento->tipoRopa = $request->tipoRopa;
    $movimiento->estado = $request->tipoMov == 'Ingreso' ? 'limpia' : $request->estado; // Si es ingreso, la ropa es limpia
    $movimiento->ubicacion_id = $request->ubicacion_id;
    $movimiento->usuario_id = Auth::id(); // Obtener el ID del usuario que realiza el movimiento
    $movimiento->fecha = now();
    $movimiento->save();

    if ($request->tipoMov == 'Ingreso') {
        $ropaDestino = Ropa::where('inventario_id', $inventario->id)
            ->where('tipo', $request->tipoRopa)
            ->where('estado', $movimiento->estado)
            ->first();

        if ($ropaDestino) {
            $ropaDestino->cantidad += $request->cantidad;
            $ropaDestino->save();
        } else {
            Ropa::create([
                'tipo' => $request->tipoRopa,
                'cantidad' => $request->cantidad,
                'estado' => $movimiento->estado,
                'inventario_id' => $inventario->id,
            ]);
        }

        $inventario->total += $request->cantidad;
    }

    if ($request->tipoMov == 'Egreso') {
        $inventario->total -= $request->cantidad;
    }

    if ($inventario->total < 0) {
        session()->flash('error', 'No se pudo realizar el movimiento. El inventario no puede ser negativo.');
        return back();
    }

    $inventario->save();

    $emailController->enviarNotificacion($request->ubicacion_id);

    session()->flash('success', 'Movimiento de ' . strtolower($request->tipoMov) . ' registrado correctamente: ' .
        $request->cantidad . ' ' . $request->tipoRopa . '(s) en estado ' . $movimiento->estado . ' en la ubicación ' . $inventario->ubicacion->nombre . '.');

    return redirect()->route('movimiento');
}


    

    public function index(Request $request)
    {
        $ubicacionId = $request->input('ubicacion');
        $tipoRopa = $request->input('tipo_ropa');
        $fechaInicio = $request->input('fecha_inicio');
        $estado = $request->input('estado');
    
        $query = Movimiento::query();
    
        if ($ubicacionId) {
            $query->whereHas('ubicacion', function ($q) use ($ubicacionId) {
                $q->where('id', $ubicacionId); 
            });
        }
    
        // Filtro por tipo de ropa
        if ($request->filled('tipo_ropa')) {
            $query->whereHas('ropa', function ($q) use ($request) {
                $q->where('tipo', $request->input('tipo_ropa'));  
            });
        }
    
        if ($fechaInicio) {
            $startDate = Carbon::parse($fechaInicio)->startOfDay();
            $endDate = Carbon::parse($fechaInicio)->endOfDay();  
            $query->whereBetween('fecha', [$startDate, $endDate]);
        }
    
        if ($estado) {
            $query->where('estado', $estado);
        }
    
        $movimientos = $query->orderBy('fecha', 'desc')->paginate(10);
    
        $ubicaciones = Ubicacion::all();
        $tiposRopa = Ropa::select('tipo')->distinct()->get();
    
        return view('transacciones', compact('movimientos', 'ubicaciones', 'tiposRopa'));
    }
    


    public function show($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        return view('movimientos.show', compact('movimiento'));
    }

    
}