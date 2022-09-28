<?php

namespace App\Http\Middleware;

use App\Models\DenunciaSiniestro;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $denuncia = DenunciaSiniestro::where(Str::isUuid($request->id) ? 'identificador' : 'id',$request->id)->firstOrFail();
        if(!$denuncia->canEdit())
        {
            if($request->expectsJson())
            {
                return response()->json([ 'status' => false], 401);
            }
            $link = route('asegurados-denuncias.pdf', ['denuncia' =>  $denuncia->id]);
            return redirect()->route('gracias-denuncia', ['link' => $link]);
        }
        return $next($request);
    }
}
