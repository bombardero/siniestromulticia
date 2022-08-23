<?php

namespace App\Listeners;

use App\Events\EstadoSolicitudCambio;
use App\Jobs\CambiarEstadoIncompleto;
use App\Jobs\MandarMailSolicitudCompleta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class EstadoSolicitudListener
{

    /**
     * Handle the event.
     *
     * @param  EstadoSolicitudCambio  $event
     * @return void
     */
    public function handle(EstadoSolicitudCambio $event)
    {

        $solicitud = $event->getSolicitud();

        
        // Estan todos los estados aprobados
        if($solicitud->estado_inquilino_uno && $solicitud->estado_propietario_dos && $solicitud->estado_contrato_tres && $solicitud->estado_inmobiliaria_cuatro)
        {

            

            switch($solicitud->status)
            {

                case "Incompleta":
                    CambiarEstadoIncompleto::dispatch($solicitud);
                    break;

                case "Completa":
                    MandarMailSolicitudCompleta::dispatch($solicitud);
                    break;
                case "Aprobada":
                    Log::debug('Solicitud aprobada');
                case "Rechazada":
                    Log::debug("Solicitud Rechazada");
                    break;
                case "Pagada":
                    Log::debug("Pagada");
                    break;    
            }
        }
    }
}
