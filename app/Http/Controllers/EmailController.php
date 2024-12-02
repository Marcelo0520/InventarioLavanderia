<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Usuario;
use App\Models\Ubicacion;
use App\Models\Ropa;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function enviarNotificacion($ubicacionId)
    {
        $ubicacion = Ubicacion::find($ubicacionId);

        if (!$ubicacion) {
            return;
        }

        // Obtiene el id del inventario de donde se hizo el movimiento
        $inventarios = Inventario::where('ubicacion_id', $ubicacionId)->get();
        
        $ropasConEscasez = [];

        foreach ($inventarios as $inventario) {
            $ropas = Ropa::where('inventario_id', $inventario->id)->where('estado', 'limpia')->get();

            foreach ($ropas as $ropa) {
                $nivelCritico = 25;

                if ($ropa->cantidad < $nivelCritico) {
                    $ropasConEscasez[] = [
                        'tipo' => $ropa->tipo,
                        'cantidad' => $ropa->cantidad
                    ];
                }
            }
        }

        if (count($ropasConEscasez) > 0) {
            $this->notificarUsuarios($ropasConEscasez, $ubicacion, $nivelCritico);
        }
    }

    private function notificarUsuarios($ropasConEscasez, $ubicacion, $nivelCritico)
    {
        $destinatarios = Usuario::whereIn('role', ['supervisor_inventario', 'personal_lavanderia'])
                             ->pluck('email')
                             ->toArray();

        if (count($destinatarios) > 0) {
            $datos = [
                'ubicacion_nombre' => $ubicacion->nombre,
                'ubicacion_tipo_area' => $ubicacion->tipoArea,
                'ubicacion_piso' => $ubicacion->nivelPiso,
                'ropas_con_escasez' => $ropasConEscasez,
                'nivel_critico' => $nivelCritico,
            ];

            Mail::send('notificacion', $datos, function ($message) use ($destinatarios) {
                $message->from('mar.valladares@duocuc.cl', 'Inventario') 
                        ->to($destinatarios)
                        ->subject('⚠️ Alerta de Nivel Crítico de Inventario');
            });
        }
    }
}
