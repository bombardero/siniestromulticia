<?php

namespace App\Jobs;

use App\Models\Solicitud;
use App\Models\User;
use App\Notifications\SolicitudCompletaNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\notify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
class MandarMailSolicitudCompleta implements ShouldQueue
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
        $this->solicitud = $solicitud;        //
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    
        $fromUser = $this->solicitud->user->name;
        $users = User::role('operario')->get();
    
        // $user->notify(new SolicitudCompletaNotification($fromUser));
     /*   Notification::send($users, new SolicitudCompletaNotification($fromUser));
        
        // send notification using the "user" model, when the user receives new message
       
         
        // send notification using the "Notification" facade
        // Notification::send($users, new SolicitudCompletaNotification($fromUser));     */

     Mail::send('mail.mail', ['from' => $fromUser,'solicitud' => $this->solicitud], function ($mail) {
        
         $mail->to(config('app.mail_operario'))->subject('Nueva Solicitud');
 
       });


    }
}
