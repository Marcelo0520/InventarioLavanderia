<?php

namespace App\Http\Controllers;

use App\Models\Ropa;



class ReporteController extends Controller
{
    public function mostrarReportePorTipo()
    {
        $reportes = Ropa::with('inventario.ubicacion')
                        ->orderBy('tipo')
                        ->get()
                        ->groupBy('tipo');

        return view('reporte_tipo', compact('reportes'));
    }
    public function mostrarReportePorUbicacion()
    {
        $reportesPorUbicacion = Ropa::join('inventario', 'ropa.inventario_id', '=', 'inventario.id')
                                ->join('ubicacion', 'inventario.ubicacion_id', '=', 'ubicacion.id')
                                ->select('ropa.*', 'ubicacion.nombre as ubicacion_nombre')
                                ->orderBy('ubicacion.nombre') 
                                ->get()
                                ->groupBy('ubicacion_nombre');

        return view('reporte_ubicacion', compact('reportesPorUbicacion'));
    }


}
