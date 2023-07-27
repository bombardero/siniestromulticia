<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\DenunciaSiniestro;
use App\Models\ReclamoTercero;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ReclamoTerceroController extends Controller
{

    public function show(ReclamoTercero $reclamo)
    {
        $data = [];
        $data['id'] =  $reclamo->id;
        $data['fecha_hora'] =  $reclamo->fecha->format('d/m/Y').' '.Carbon::createFromFormat('H:i:s',$reclamo->hora)->format('H:i');
        $data['fecha_hora_alta'] =  $reclamo->created_at->format('d/m/Y H:i');
        $data['dominio'] =  $reclamo->vehiculo_tercero_dominio;
        $data['dominio_asegurado'] =  $reclamo->vehiculo_asegurado_dominio;
        $data['lugar'] =  $reclamo->lugar_nombre;

        if($reclamo->pais_id && $reclamo->province_id)
        {
            $data['pais'] =  $reclamo->pais->nombre;
            $data['provincia'] =  $reclamo->provincia->name;
            $data['localidad'] =  $reclamo->city_id != null ? $reclamo->localidad->name : $reclamo->otro_pais_provincia_localidad;
        } elseif ($reclamo->otro_pais_provincia_localidad) {
            $data['pais'] =  null;
            $data['provincia'] =  null;
            $data['localidad'] = $reclamo->otro_pais_provincia_localidad;
        } else {
            $data['pais'] =  null;
            $data['provincia'] =  null;
            $data['localidad'] = null;
        }

        return response()->json([ 'status' => true, 'reclamo' => $data]);
    }
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

        if(Str::contains($request->estado,':'))
        {
            $estados = explode(':', $request->estado);
            $reclamo->estado = $estados[0];
            $reclamo->subestado = $estados[1];
        } else {
            $reclamo->estado = $request->estado;
            $reclamo->subestado = null;
        }

        $reclamo->save();
        return response()->json(['status' => true]);
    }

    public function observaciones(Request $request, ReclamoTercero $reclamo)
    {
        $observaciones = [];
        foreach ($reclamo->observaciones()->oldest()->get() as $obs)
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

    public function vincularSearch(Request $request, ReclamoTercero $reclamo)
    {
        $busqueda = $request->busqueda !== null ? $request->busqueda : $reclamo->vehiculo_asegurado_dominio;
        $tipo = $request->tipo !== null ? $request->tipo : 'dominio';
        if($tipo === 'dominio')
        {
            $denuncia_siniestros = DenunciaSiniestro::where('dominio_vehiculo_asegurado','LIKE', '%'.$busqueda.'%')->latest()->get();
        } else {
            $denuncia_siniestros = DenunciaSiniestro::where('id', $busqueda)->get();
        }

        $denuncias = [];

        foreach ($denuncia_siniestros as $denuncia) {
            $row['id'] = $denuncia->id;
            $row['fecha_creacion'] = $denuncia->created_at->format('d/m/Y H:i');
            $row['fecha_siniestro'] = $denuncia->fecha->format('d/m/Y').' '.Carbon::createFromFormat('H:i:s',$denuncia->hora)->format('H:i');
            $row['asegurado'] = $denuncia->asegurado ? $denuncia->asegurado->nombre : '';
            $row['dominio'] = $denuncia->dominio_vehiculo_asegurado;
            $row['nro_poliza'] = $denuncia->nro_poliza != null ? $denuncia->nro_poliza : '';
            $row['nro_denuncia'] = $denuncia->nro_denuncia != null ? $denuncia->nro_denuncia : '';
            $row['nro_siniestro'] = $denuncia->nro_siniestro != null ? $denuncia->nro_siniestro : '';
            $row['cobertura'] = $denuncia->cobertura_activa != null ? $denuncia->cobertura_activa : '';
            $row['paso'] = $denuncia->estado_carga == 'precarga' ? 'PRECARGA' : ($denuncia->estado_carga == '12' ? 'COMPLETO' : $denuncia->estado_carga.'/12');
            $row['estado'] = DenunciaSiniestro::ESTADOS[$denuncia->full_estado];
            $row['estado_observacion'] = $denuncia->estado_observacion != null ? $denuncia->estado_observacion : '' ;
            $denuncias[] = $row;
        }

        return response()->json(['status' => true, 'denuncias' => $denuncias]);
    }

}
