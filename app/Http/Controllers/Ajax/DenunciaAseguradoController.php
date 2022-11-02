<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DenunciaSiniestro;

class DenunciaAseguradoController extends Controller
{

    public function observaciones(DenunciaSiniestro $denuncia)
    {
        //return view('siniestro_backoffice.denuncias.index-observaciones',['denuncia'=>$denuncia]);
        $observaciones = [];
        foreach ($denuncia->observaciones()->oldest()->get() as $obs)
        {
            $observaciones[] = [
                'id' => $obs->id,
                'fecha_hora' => $obs->created_at->format('d-m-Y H:i:s'),
                'detalle' => $obs->detalle,
                'user_name' => $obs->user->name,
            ];
        }
        return response()->json(['status' => true, 'observaciones' => $observaciones]);
    }

}
