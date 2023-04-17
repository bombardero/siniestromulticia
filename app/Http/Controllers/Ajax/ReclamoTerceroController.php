<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\ReclamoTercero;
use Illuminate\Http\Request;

class ReclamoTerceroController extends Controller
{

    public function updateLinkEnviado(Request $request, ReclamoTercero $reclamo)
    {
        $reclamo->link_enviado = true;
        $reclamo->save();
        return response()->json([ 'status' => true]);
    }

}
