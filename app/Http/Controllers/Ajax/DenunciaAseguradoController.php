<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CompaniaService;
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

    public function enviarCompania(Request $request, DenunciaSiniestro $denuncia)
    {
        $result = CompaniaService::enviarDenuncia($denuncia, $request->tipo_vehiculo);

        if(array_key_exists('Den-Nro',$result))
        {
            $denuncia->nro_denuncia = trim($result['Den-Nro']);
            $denuncia->save();
        }

        if(array_key_exists('pdf-path',$result) && array_key_exists('pdf-doc',$result))
        {
            $url = $result['pdf-path'].$result['pdf-doc'];
            $denuncia->storeCertificadoCobertura($url);
        }

        $mensaje = array_key_exists('Mensaje',$result) ? $result['Mensaje'] : null;

        return response()->json(['status' => true, 'result' => $result, 'mensaje' => $mensaje]);
    }

    public function estado(DenunciaSiniestro $denuncia)
    {
        return response()->json(['status' => true, 'estado' => $denuncia->estado, 'observacion_estado' => $denuncia->observacion_estado]);
    }

}
