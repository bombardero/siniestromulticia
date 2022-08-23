<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailProductorBienvenida extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productorNombre)
    {
        $this->productorNombre = $productorNombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Solicitud productor';
        return $this->markdown('mail.mail-productor-bienvenida')
                    ->subject($subject)
                    ->with([ 'productorNombre' => $this->productorNombre ]);
    }
}
