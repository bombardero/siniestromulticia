<?php

namespace App\Http\Middleware;

use App\Models\DenunciaSiniestro;
use Closure;
use Illuminate\Http\Request;

class CanEditDenuncia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $denuncia = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        if(!$denuncia->canEdit())
        {
            $link = route('asegurados-denuncias.pdf', ['denuncia' =>  $denuncia->id]);
            return redirect()->route('gracias-denuncia', ['link' => $link]);
        }
        return $next($request);
    }
}
