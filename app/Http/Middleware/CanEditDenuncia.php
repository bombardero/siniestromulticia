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

            $data['link_denuncia'] = route('asegurados-denuncias.pdf', ['denuncia' =>  $denuncia->id]);
            if($denuncia->certificado_cobertura_url)
            {
                $data['link_certificado'] = $denuncia->certificado_cobertura_url;
            }
            return redirect()->route('gracias-denuncia', $data);
        }
        return $next($request);
    }
}
