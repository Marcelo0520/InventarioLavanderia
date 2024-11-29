<?php

namespace App\Http\Controllers;

use App\Models\Ropa;
use Barryvdh\DomPDF\Facade\Pdf;



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

    public function generarPdfPorTipo($tipo)
    {
        $reportes = Ropa::with('inventario.ubicacion')
            ->where('tipo', $tipo)
            ->get();

        $pdf = Pdf::loadView('reporte_por_tipo', compact('reportes', 'tipo'));

        return $pdf->download("reporte_{$tipo}.pdf");
    }

    public function generarPdfGeneral()
{
    $reportes = Ropa::with('inventario.ubicacion')
                    ->orderBy('tipo')
                    ->get()
                    ->groupBy('tipo'); // Agrupar por tipo de ropa

    $pdf = Pdf::loadView('reporte_general_tipo', compact('reportes'));

    return $pdf->download("reporte_general_ropas.pdf");
}


    public function generarPdfPorUbicacion($ubicacion)
    {
        $reportes = Ropa::join('inventario', 'ropa.inventario_id', '=', 'inventario.id')
            ->join('ubicacion', 'inventario.ubicacion_id', '=', 'ubicacion.id')
            ->where('ubicacion.nombre', $ubicacion)
            ->select('ropa.*', 'ubicacion.nombre as ubicacion_nombre', 'ropa.tipo')
            ->orderBy('ropa.tipo')
            ->get()
            ->groupBy('tipo');

        $pdf = Pdf::loadView('reporte_por_ubicacion', compact('reportes', 'ubicacion'));

        return $pdf->download("reporte_{$ubicacion}.pdf");
    }

    public function reporteGeneral()
    {
        $reportesPorUbicacion = Ropa::join('inventario', 'ropa.inventario_id', '=', 'inventario.id')
            ->join('ubicacion', 'inventario.ubicacion_id', '=', 'ubicacion.id')
            ->select('ropa.*', 'ubicacion.nombre as ubicacion_nombre', 'ropa.tipo')
            ->orderBy('ubicacion.nombre')
            ->get()
            ->groupBy('ubicacion_nombre');

        // Cargar vista para el PDF
        $pdf = Pdf::loadView('reporte_general', compact('reportesPorUbicacion'));

        // Retornar el PDF descargable
        return $pdf->download('reporte_general_todos_los_tipos_de_ropa.pdf');
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
