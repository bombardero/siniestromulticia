<?php

namespace App\Providers;

use App\Events\EstadoSolicitudCambio;
use App\Listeners\EstadoSolicitudListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        EstadoSolicitudCambio::class => [
            EstadoSolicitudListener::class,
        ],
        Productor::class => [
            SendEmailProductor::class,
            // SendEmailProductorPassword::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
