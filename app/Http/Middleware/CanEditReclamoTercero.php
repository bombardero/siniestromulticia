<?php

namespace App\Http\Middleware;

use App\Models\ReclamoTercero;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CanEditReclamoTercero
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
        $reclamo = ReclamoTercero::where(Str::isUuid($request->id) ? 'identificador' : 'id',$request->id)->firstOrFail();
        if(!$reclamo->canEdit())
        {
            if($request->expectsJson())
            {
                return response()->json([ 'status' => false], 401);
            }
            return redirect()->route('siniestros.terceros.show', ['id' => $reclamo->identificador]);
        }
        return $next($request);
    }
}
