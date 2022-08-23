<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Province;
use App\Providers\Productor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Requests\StoreProductorRequest;
use App\Mail\MailProductorBienvenida;

class SendEmailProductor
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

		$event->data['provincia'] = Province::find($event->data['provincia']);
		$event->data['city_id'] = City::find($event->data['city_id']);
		
		Mail::send('mail.mail-alta-productor', $event->data, function ($mail)
		{
			$mail->to(config('app.mail_alta_productor'))->subject('Solicitud de alta de productor');
        });

        Mail::to($event->data['email'])->send(new MailProductorBienvenida($event->data['name']));


                   
    }
}
