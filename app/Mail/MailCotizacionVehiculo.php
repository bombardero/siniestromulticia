<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCotizacionVehiculo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $cotizacionCuotas, $coberturaNombres,$coberturaSumaAsegurada,$marcaNombre,$modeloNombre, $textosCoberturas,$gestion)
    {
        $this->data = $data;
        $this->cotizacionCuotas = $cotizacionCuotas;
        $this->coberturaNombres = $coberturaNombres;
        $this->coberturaSumaAsegurada = $coberturaSumaAsegurada;
        $this->marcaNombre = $marcaNombre;
        $this->modeloNombre = $modeloNombre;
        $this->textosCoberturas = $textosCoberturas;
        $this->gestion = $gestion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Pedido de cotizacion';
        return $this->markdown('mail.mail-cotizacion-vehiculo')
                    ->subject($subject)
                    ->with([ 'data' => $this->data, 'cotizacion' => $this->cotizacionCuotas, 'coberturaNombres' => $this->coberturaNombres, 'coberturaSumaAsegurada' => $this->coberturaSumaAsegurada, 'marcaNombre' => $this->marcaNombre, 'modeloNombre' => $this->modeloNombre, 'textos' => $this->textosCoberturas, 'gestion' => $this->gestion ]);
    }
}
