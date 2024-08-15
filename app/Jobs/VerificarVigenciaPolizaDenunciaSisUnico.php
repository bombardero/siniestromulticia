<?php

namespace App\Jobs;

use App\Mail\Siniestros\DenunciaAsegurado\LinkDenuncia;
use App\Models\DenunciaSiniestroSisUnico;
use App\Services\CompaniaService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerificarVigenciaPolizaDenunciaSisUnico implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The podcast instance.
     *
     * @var \App\Models\DenunciaSiniestroSisUnico
     */
    protected $denuncia;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DenunciaSiniestroSisUnico $denuncia)
    {
        $this->denuncia = $denuncia;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = CompaniaService::consultarCobertura($this->denuncia);

        if($result !== [])
        {
            $nro_poliza = $result['Pol-Nro'];
            $vigencia_desde = Carbon::createFromFormat('d/m/Y', $result['Endosos']['Frente']['Vig-Des']);
            $vigencia_hasta = Carbon::createFromFormat('d/m/Y', $result['Endosos']['Frente']['Vig-Has']);

            if($this->denuncia->fecha->greaterThanOrEqualTo($vigencia_desde) && $this->denuncia->fecha->lessThanOrEqualTo($vigencia_hasta))
            {
                $data = [
                    'dominio' => $this->denuncia->dominio_vehiculo_asegurado,
                    'nombre' => $this->denuncia->responsable_contacto_nombre,
                    'link_denuncia' => route('asegurados-denuncias-paso1.create',[ 'id' => $this->denuncia->identificador]),
                ];
                Mail::to($this->denuncia->responsable_contacto_email)->send(new LinkDenuncia($data));

                $this->denuncia->nro_poliza = $nro_poliza;
                $this->denuncia->link_enviado = true;
                $this->denuncia->link_enviado_modo = 'automatico';
                $this->denuncia->save();

            }
        }
    }
}
