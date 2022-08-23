<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailContacto extends Mailable
{
    use Queueable, SerializesModels;

    public $telefono;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail-contacto');
    }
}
