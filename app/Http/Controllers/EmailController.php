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
        // Obtener la información de la ubicación (nombre, tipo de área, piso)
        $ubicacion = Ubicacion::find($ubicacionId);

        if (!$ubicacion) {
            // Si no se encuentra la ubicación, no enviamos el correo
            return;
        }

        // Obtener los inventarios para la ubicación específica
        $inventarios = Inventario::where('ubicacion_id', $ubicacionId)->get();
        
        // Lista para almacenar todos los tipos de ropa con escasez
        $ropasConEscasez = [];

        foreach ($inventarios as $inventario) {
            // Obtener todas las ropas de este inventario
            $ropas = Ropa::where('inventario_id', $inventario->id)->get();

            foreach ($ropas as $ropa) {
                // Nivel crítico fijo de 25 unidades
                $nivelCritico = 25;

                // Verificar si la cantidad de ropa está por debajo del nivel crítico
                if ($ropa->cantidad < $nivelCritico) {
                    // Si hay escasez, añadir a la lista
                    $ropasConEscasez[] = [
                        'tipo' => $ropa->tipo,
                        'cantidad' => $ropa->cantidad
                    ];
                }
            }
        }

        // Si hay ropa con escasez, enviar el correo
        if (count($ropasConEscasez) > 0) {
            $this->notificarUsuarios($ropasConEscasez, $ubicacion, $nivelCritico);
        }
    }

    private function notificarUsuarios($ropasConEscasez, $ubicacion, $nivelCritico)
    {
        // Obtener los destinatarios (supervisores de inventario y personal de lavandería)
        $destinatarios = Usuario::whereIn('role', ['supervisor_inventario', 'personal_lavanderia'])
                             ->pluck('email')
                             ->toArray();

        if (count($destinatarios) > 0) {
            // Preparar los datos que serán enviados a la plantilla del correo
            $datos = [
                'ubicacion_nombre' => $ubicacion->nombre,
                'ubicacion_tipo_area' => $ubicacion->tipoArea,
                'ubicacion_piso' => $ubicacion->nivelPiso,
                'ropas_con_escasez' => $ropasConEscasez, // Pasamos el array completo de ropa con escasez
                'nivel_critico' => $nivelCritico,
            ];

            // Enviar el correo a los destinatarios
            Mail::send('notificacion', $datos, function ($message) use ($destinatarios) {
                $message->from('mar.valladares@duocuc.cl', 'Inventario') 
                        ->to($destinatarios)
                        ->subject('⚠️ Alerta de Nivel Crítico de Inventario');
            });
        }
    }
}
