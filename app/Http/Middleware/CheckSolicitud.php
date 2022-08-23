<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSolicitud
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next) 
    {  
     
        
    
        if ($request->solicitud->user_id == Auth::id() && !Auth::user()->hasRole('operario') || $request->solicitud->inmobiliaria_id == Auth::id()) {

              return $next($request);
        }

        abort(403);
       
        
        
    }
}
