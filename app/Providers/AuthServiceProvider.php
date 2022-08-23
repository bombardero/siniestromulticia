<?php

namespace App\Providers;

use App\Models\Inquilino;
use App\Models\Solicitud;
use App\Policies\PagadaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
   protected $policies = [
        Solicitud::class => PagadaPolicy::class,

    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
