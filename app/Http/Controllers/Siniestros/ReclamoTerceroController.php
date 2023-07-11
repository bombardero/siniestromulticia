<?php

namespace App\Http\Controllers\Siniestros;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\City;
use App\Models\DenunciaSiniestro;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Province;
use App\Models\ReclamoTercero;
use App\Models\TipoCalzada;
use App\Models\TipoDocumento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ReclamoTerceroController extends Controller
{

    public function index(Request $request)
    {

        if(count($request->all()) == 0)
        {
            $desde = Carbon::now()->startOfDay()->subMonth()->toDateTimeString();
            $hasta = Carbon::now()->endOfDay()->toDateTimeString();
        } else {
            $desde = $request->desde ? Carbon::createFromFormat('Y-m-d',$request->desde)->startOfDay()->toDateTimeString() : null;
            $hasta = $request->hasta ? Carbon::createFromFormat('Y-m-d',$request->hasta)->endOfDay()->toDateTimeString() : null;
        }

        $busqueda = $request->busqueda;
        $tipo = $request->tipo;
        $estado = $request->estado;
        $link_enviado = $request->link_enviado;
        $responsable = $request->responsable;

        switch ($request->carga)
        {
            case 'precarga':
                $carga = 'precarga';
                break;
            case 'incompleto':
                $carga = ['1','2','3','4','5','6','7','8','9'];
                break;
            case 'completo':
                $carga = '10';
                break;
            default:
                $carga = null;
        }

        if($tipo == 'id' && $busqueda)
        {
            $reclamos = ReclamoTercero::where('id',$busqueda);
        } else {
            $reclamos = ReclamoTercero::when($busqueda, function ($query, $busqueda) {
                return $query->where('vehiculo_asegurado_dominio', 'LIKE', "%{$busqueda}%")
                    ->orWhere('vehiculo_tercero_dominio', 'LIKE', "%{$busqueda}%");
            })->when($carga, function ($query) use ($carga) {
                if(is_array($carga))
                {
                    return $query->whereIn('estado_carga', $carga);
                }
                return $query->where('estado_carga', $carga);
            })->when($estado && $estado != 'todos', function ($query) use ($estado) {
                if(Str::contains($estado,':'))
                {
                    $estados = explode(':',$estado);
                    $estado = $estados[0];
                    $subestado = $estados[1];
                    return $query->where('estado', $estado)->where('subestado', $subestado);
                } else {
                    return $query->where('estado', $estado);
                }
            })->when($link_enviado != null && $link_enviado != 'todos', function ($query) use ($link_enviado) {
                return $query->where('link_enviado', $link_enviado);
            })->when($responsable !== null && $responsable !== 'todos', function ($query) use ($responsable) {
                return $responsable === 'nadie' ? $query->whereNull('user_id') : $query->where('user_id', $responsable);
            });

            if($desde &&  $hasta)
            {
                $reclamos = $reclamos->whereBetween('created_at',[$desde,$hasta]);
            }
        }

        $data['reclamos'] = $reclamos->latest()->paginate(10);
        $data['users'] = User::role('siniestros')->orderBy('name')->get();
        $data['estados'] = ReclamoTercero::ESTADOS;

        return view('backoffice.siniestros.reclamos.index', $data);
    }

    public function show(ReclamoTercero $reclamo)
    {
        return view('backoffice.siniestros.reclamos.show', ['reclamo' => $reclamo, 'estados' => ReclamoTercero::ESTADOS]);
    }

    public function observacionesStore(Request $request, ReclamoTercero $reclamo)
    {
        $rules =  [
            'observacion' => 'required'
        ];
        Validator::make($request->all(),$rules)->validate();
        $reclamo->observaciones()->create(['detalle' => $request->observacion, 'user_id' => Auth::user()->id ]);
        return back();
    }

    public function delete(Request $request, ReclamoTercero $reclamo)
    {
        Log::info("ReclamoTerceroController::delete() reclamo ". json_encode($reclamo));
        Log::info("ReclamoTerceroController::delete() user ".json_encode(Auth::user()));
        $reclamo->delete();
        return back();
    }

}
