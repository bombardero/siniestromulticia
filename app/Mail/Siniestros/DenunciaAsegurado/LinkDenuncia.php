<?php

namespace App\Mail\Siniestros\DenunciaAsegurado;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkDenuncia extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Link de Denuncia de Siniestro: '. $this->data['dominio'];
        return $this->markdown('mail.siniestros.denuncias.enviar-link')
                    ->subject($subject)
                    ->with([ 'data' => $this->data ]);
    }

}
