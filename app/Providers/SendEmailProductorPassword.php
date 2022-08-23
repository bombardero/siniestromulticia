<?php

namespace App\Providers;

use App\Providers\Productor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailProductorPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Productor  $event
     * @return void
     */
    public function handle(Productor $event)
    {               
		Mail::send('mail.mail-contraseña-productor', $event->data, function ($mail) use($event)
		{
			$mail->to($event->user->email)->subject('Bienvenido '. $event->user->name);
        });        
    }
}
