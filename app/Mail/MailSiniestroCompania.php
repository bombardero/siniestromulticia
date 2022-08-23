<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSiniestroCompania extends Mailable
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
        $subject = 'WEB - RECLAMO  '. $this->data['dominio_asegurado'];
        return $this->markdown('mail.mail-siniestro-compania')
                    ->subject($subject)
                    ->with([ 'data' => $this->data ]);
    }
}
