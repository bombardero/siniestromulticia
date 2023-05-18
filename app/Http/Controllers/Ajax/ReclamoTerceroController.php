<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\ReclamoTercero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReclamoTerceroController extends Controller
{

    public function updateLinkEnviado(Request $request, ReclamoTercero $reclamo)
    {
        $reclamo->link_enviado = true;
        $reclamo->save();
        return response()->json([ 'status' => true]);
    }

    public function cambiarEstado(Request $request, ReclamoTercero $reclamo)
    {

        Validator::make($request->all(), [
            'estado' => ['required',Rule::in(array_keys(ReclamoTercero::ESTADOS))]
        ])->validate();
        $reclamo->estado = $request->estado;
        $reclamo->save();
        return response()->json(['status' => true]);
    }

}
