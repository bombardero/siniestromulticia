<?php

namespace App\Jobs;

use App\Events\EstadoSolicitudCambio;
use App\Models\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CambiarEstadoIncompleto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $solicitud;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;     
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
      
        $this->solicitud->update(['status' => 'Completa']);

        EstadoSolicitudCambio::dispatch($this->solicitud);
    }
}
