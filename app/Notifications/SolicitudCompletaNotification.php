<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SolicitudCompletaNotification extends Notification
{
    use Queueable;

    public $fromUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fromUser)

    {
        $this->fromUser = $fromUser;    //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = "Tienes una solicitud pendiente de aprobación de " .$this->fromUser;
        $message = "Hola " . $notifiable->name. "Tienes una nueva solicitud para aprobar";


        return (new MailMessage)
                    ->subject($subject)
                    ->message($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
