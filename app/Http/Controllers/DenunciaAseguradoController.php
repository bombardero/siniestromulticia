<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DenunciaSiniestro;
use App\Models\Province;
use App\Models\City;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoCalzada;
use App\Models\TipoDocumento;
use App\Models\TipoCarnet;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
use Image;

class DenunciaAseguradoController extends Controller
{

    public function index()
    {
        $denuncia_siniestros = DenunciaSiniestro::latest()->paginate(10);
        return view('siniestro_backoffice.denuncias.index',["denuncia_siniestros"=>$denuncia_siniestros]);
    }

    public function buscar(Request $request)
    {
        $desde = $request->desde ?
            Carbon::createFromFormat('Y-m-d',$request->desde)->startOfDay()->toDateTimeString() :
            Carbon::now()->startOfDay()->subMonth()->toDateTimeString();
        $hasta = $request->hasta ?
            Carbon::createFromFormat('Y-m-d',$request->hasta)->endOfDay()->toDateTimeString() :
            Carbon::now()->endOfDay()->toDateTimeString();
        $busqueda = $request->busqueda;
        $tipo = $request->tipo;
        $estado = $request->estado;
        $cobertura = $request->cobertura;
        $nro_denuncia = $request->nro_denuncia;
        $link_enviado = $request->link_enviado;
        switch ($request->carga)
        {
            case 'precarga':
                $carga = 'precarga';
                break;
            case 'incompleto':
                $carga = ['1','2','3','4','5','6','7','8','9','10','11'];
                break;
            case 'completo':
                $carga = '12';
                break;
            default:
                $carga = null;
        }

        if($tipo == 'id' && $busqueda)
        {
            $denuncia_siniestros = DenunciaSiniestro::where('id',$busqueda);
        } else {
            $denuncia_siniestros = DenunciaSiniestro::when($busqueda, function ($query, $busqueda) {
                return $query->where('dominio_vehiculo_asegurado', 'LIKE', "%{$busqueda}%");
            })->when($carga, function ($query) use ($carga) {
                if(is_array($carga))
                {
                    return $query->whereIn('estado_carga', $carga);
                }
                return $query->where('estado_carga', $carga);
            })->when($estado && $estado != 'todos', function ($query) use ($estado) {
                return $query->where('estado', $estado);
            })->when($cobertura && $cobertura != 'todos', function ($query) use ($cobertura) {
                return $cobertura == 'ninguna' ? $query->whereNull('cobertura_activa') : $query->where('cobertura_activa', $cobertura);
            })->when($nro_denuncia && $nro_denuncia != 'todos', function ($query) use ($nro_denuncia) {
                return $nro_denuncia == 'si' ? $query->whereNotNull('nro_denuncia') : $query->whereNull('nro_denuncia');
            })->when($link_enviado != null && $link_enviado != 'todos', function ($query) use ($link_enviado) {
                return $query->where('link_enviado', $link_enviado);
            });

            $denuncia_siniestros = $denuncia_siniestros->whereBetween('created_at',[$desde,$hasta]);
        }

        /*
        if($busqueda != null)
        {
            $denuncia_siniestros = $denuncia_siniestros->whereHas('asegurado', function (Builder $query) use ($busqueda) {
                return $query->where('carga_paso_4_asegurado_nombre', 'LIKE', "%{$busqueda}%")
                        ->orWhere('carga_paso_4_asegurado_documento_numero','LIKE', "%{$busqueda}%");
            });
        }*/

        $denuncia_siniestros = $denuncia_siniestros->latest()->paginate(10);

        $data['denuncia_siniestros'] = $denuncia_siniestros;

        return view('siniestro_backoffice.denuncias.index',$data);
    }

    public function updateDenunciaNroPoliza(Request $request, DenunciaSiniestro $denuncia)
    {
        $denuncia->nro_poliza = $request->value;
        $denuncia->save();
        return response()->json([ 'status' => true]);

    }

    public function updateDenunciaNroDenuncia(Request $request, DenunciaSiniestro $denuncia)
    {
        $denuncia->nro_denuncia = $request->value;
        $denuncia->save();
        return response()->json([ 'status' => true]);
    }

    public function updateDenunciaNroSiniestro(Request $request, DenunciaSiniestro $denuncia)
    {
        $denuncia->nro_siniestro = $request->value;
        $denuncia->save();
        return response()->json([ 'status' => true]);
    }

    public function updateLinkEnviado(Request $request, DenunciaSiniestro $denuncia)
    {
        $denuncia->link_enviado = true;
        $denuncia->save();
        return response()->json([ 'status' => true]);
    }

    public function updateField(Request $request, DenunciaSiniestro $denuncia)
    {
        $rules =  [
            'field_name' => 'required',
            'field_value' => 'required',
        ];
        Validator::make($request->all(),$rules)->validate();

        $denuncia->{$request->field_name} = $request->field_value;
        $denuncia->save();
        return response()->json([ 'status' => true]);
    }

    public function show(DenunciaSiniestro $denuncia)
    {
        return view('siniestro_backoffice.denuncias.show',["denuncia"=>$denuncia]);
    }

    public function agregarObservaciones(DenunciaSiniestro $denuncia)
    {

        return view('siniestro_backoffice.denuncias.index-observaciones',['denuncia'=>$denuncia]);
    }

    public function agregarObservacionesStore(DenunciaSiniestro $denuncia)
    {
        $observaciones = request('descripcion_siniestro');
        $denuncia->observaciones()->create(['detalle'=>$observaciones,'user_id'=>auth()->user()->id]);
        return redirect()->route('panel-siniestros.denuncia.show',['denuncia'=>$denuncia]);
    }

    public function delete(DenunciaSiniestro $denuncia)
    {
        $denuncia->delete();
        return redirect()->route('panel-siniestros');
    }

    public function generarPDF(DenunciaSiniestro $denuncia){
        $data=[
            'denuncia' =>$denuncia
        ];
        PDF::setOptions(['dpi' => 150,'isPhpEnabled' => true, "isRemoteEnabled" => true]);

        $pdf = PDF::loadView('siniestros.denuncia-asegurados.newpdf', $data);
        $pdf->setPaper( 'a4' );

        //return view('siniestros.denuncia-asegurados.newpdf', $data);
        //return $pdf->stream();
        return $pdf->download('denuncia_'.$denuncia->dominio_vehiculo_asegurado.'.pdf');
    }

    public function paso1create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        if(request('noredirect')==null)
        {
            $paso = $this->checkIfRedirect();
            if($paso != "1" && $paso != "precarga"){
                $nameredirect="asegurados-denuncias-paso".$paso.".create";
                return redirect()->route($nameredirect,['id'=> $request->id]);
            }
        }
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',["denuncia_siniestro"=>$denuncia_siniestro, "paso" => 1]);
    }

    public function paso1store(Request $request)
    {
        $validated = request()->validate([
            'momento_dia'=> ['required',Rule::in(['diurno', 'nocturno'])]
        ]);
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->momento_dia = $request->momento_dia;
            $denuncia_siniestro->estado_tiempo_seco = $request->seco == 'on';
            $denuncia_siniestro->estado_tiempo_lluvia = $request->lluvia == 'on';
            $denuncia_siniestro->estado_tiempo_niebla = $request->niebla == 'on';
            $denuncia_siniestro->estado_tiempo_despejado = $request->despejado == 'on';
            $denuncia_siniestro->estado_tiempo_nieve = $request->nieve == 'on';
            $denuncia_siniestro->estado_tiempo_granizo = $request->granizo == 'on';
            $denuncia_siniestro->estado_tiempo_otros_detalles = ($request->otros == 'on' && $request->otros_detalles != '') ? $request->otros_detalles : null;

            if($denuncia_siniestro->estado_carga == 'precarga')
            {
                $denuncia_siniestro->estado_carga = "1";
            }
            $denuncia_siniestro->save();
        }

        return redirect()->route("asegurados-denuncias-paso2.create",['id'=> $request->id]);
    }

    public function paso2create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $tipoCalzadas = TipoCalzada::all();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = old('provincia_id') ? old('provincia_id') : ($denuncia_siniestro->province_id != null ? $denuncia_siniestro->province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',["denuncia_siniestro"=>$denuncia_siniestro,"paso" => 2,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas,"localidades"=>$localidades]);
    }

    public function paso2store(Request $request)
    {
        $rules =  [
            'pais' => 'required',
            'otro_pais_provincia_localidad'=>'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
            'calle'=>'required'
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules, $messages)->validate();

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null ;
            $denuncia_siniestro->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
            $denuncia_siniestro->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
            $denuncia_siniestro->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
            $denuncia_siniestro->calle = $request->calle;
            $denuncia_siniestro->tipo_calzada_id = $request->calzada_id;
            $denuncia_siniestro->calzada_detalle = $request->calzada_detalle;
            $denuncia_siniestro->interseccion = $request->interseccion;
            $denuncia_siniestro->cruce_senalizado = $request->cruce_senalizado ==  'on';
            $denuncia_siniestro->tren = $request->tren;
            $denuncia_siniestro->semaforo = $request->semaforo ==  'on';
            $denuncia_siniestro->semaforo_funciona = $request->semaforo_funciona ==  'on';
            $denuncia_siniestro->semaforo_intermitente = $request->semaforo_intermitente ==  'on';
            $denuncia_siniestro->semaforo_color = $request->semaforo_color;

            if($denuncia_siniestro->estado_carga == "1")
            {
                $denuncia_siniestro->estado_carga = "2";
            }
            $denuncia_siniestro->save();
        }

        return redirect()->route("asegurados-denuncias-paso3.create",['id'=> $identificador]);
    }

    public function paso3create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = old('provincia_id') ? old('provincia_id') : ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->province_id != null ? $denuncia_siniestro->conductor->province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',["denuncia_siniestro"=>$denuncia_siniestro,"paso" => 3,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets,"localidades"=>$localidades]);
    }

    public function paso3store(Request $request)
    {
        $rules =  [
            'nombre'=>'required',
            'telefono'=>'required',
            'domicilio'=>'required',
            'codigo_postal'=>'required',
            'pais' => 'required',
            'otro_pais_provincia_localidad'=>'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
            'fecha_nacimiento'=>'required|date',
            'documento_numero'=>'required',
            'ocupacion'=>'required',
            'numero_registro'=>'required',
            'estado_civil'=>'required',
            'carnet_categoria'=>'required',
            'carnet_vencimiento'=>'required',
            'alcoholemia'=>'required',
            'asegurado'=>'required',
            'asegurado_relacion' => 'required_if:asegurado,0'
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $identificador = $request->id;
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            if(!$denuncia_siniestro->conductor)
            {
                $denuncia_siniestro->conductor()->create([
                    "nombre" => $request->nombre,
                    "telefono" => $request->telefono,
                    "domicilio" => $request->domicilio,
                    "codigo_postal" => $request->codigo_postal,
                    "pais_id" => $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null,
                    "province_id" => $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null,
                    "city_id" => $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id,
                    "otro_pais_provincia_localidad" => $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null ),
                    "fecha_nacimiento" => $request->fecha_nacimiento,
                    "tipo_documento_id" => $request->documento_id,
                    "documento_numero" => $request->documento_numero,
                    "ocupacion" => $request->ocupacion,
                    "numero_registro" => $request->numero_registro,
                    "estado_civil" => $request->estado_civil,
                    "tipo_carnet_id" => $request->carnet_id,
                    "carnet_categoria" => $request->carnet_categoria,
                    "carnet_vencimiento" => $request->carnet_vencimiento,
                    "alcoholemia" => $request->alcoholemia,
                    "alcoholemia_se_nego" => $request->alcoholemia_nego == 'on',
                    "habitual" => $request->habitual,
                    "asegurado" => $request->asegurado,
                    "asegurado_relacion" => $request->asegurado_relacion
                ]);
            } else {
                $denuncia_siniestro->conductor->nombre = $request->nombre;
                $denuncia_siniestro->conductor->telefono = $request->telefono;
                $denuncia_siniestro->conductor->domicilio = $request->domicilio;
                $denuncia_siniestro->conductor->codigo_postal = $request->codigo_postal;
                $denuncia_siniestro->conductor->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
                $denuncia_siniestro->conductor->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
                $denuncia_siniestro->conductor->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
                $denuncia_siniestro->conductor->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
                $denuncia_siniestro->conductor->fecha_nacimiento = $request->fecha_nacimiento;
                $denuncia_siniestro->conductor->tipo_documento_id = $request->documento_id;
                $denuncia_siniestro->conductor->documento_numero = $request->documento_numero;
                $denuncia_siniestro->conductor->ocupacion = $request->ocupacion;
                $denuncia_siniestro->conductor->numero_registro = $request->numero_registro;
                $denuncia_siniestro->conductor->estado_civil = $request->estado_civil;
                $denuncia_siniestro->conductor->tipo_carnet_id = $request->carnet_id;
                $denuncia_siniestro->conductor->carnet_categoria = $request->carnet_categoria;
                $denuncia_siniestro->conductor->carnet_vencimiento = $request->carnet_vencimiento;
                $denuncia_siniestro->conductor->alcoholemia = $request->alcoholemia;
                $denuncia_siniestro->conductor->alcoholemia_se_nego = $request->alcoholemia_nego == 'on';
                $denuncia_siniestro->conductor->habitual = $request->habitual;
                $denuncia_siniestro->conductor->asegurado = $request->asegurado;
                $denuncia_siniestro->conductor->asegurado_relacion = $request->asegurado_relacion;
                $denuncia_siniestro->conductor->save();
            }
            $denuncia_siniestro->load('asegurado');
            $denuncia_siniestro->load('conductor');

            if($denuncia_siniestro->conductor->asegurado && !$denuncia_siniestro->asegurado)
            {
                $denuncia_siniestro->asegurado()->create([
                    "nombre" => $denuncia_siniestro->conductor->nombre,
                    "tipo_documento_id" => $denuncia_siniestro->conductor->tipo_documento_id,
                    "documento_numero" => $denuncia_siniestro->conductor->documento_numero,
                    "domicilio" => $denuncia_siniestro->conductor->domicilio,
                    "codigo_postal" => $denuncia_siniestro->conductor->codigo_postal,
                    "pais_id" => $denuncia_siniestro->conductor->pais_id,
                    "province_id" => $denuncia_siniestro->conductor->province_id,
                    "city_id" => $denuncia_siniestro->conductor->city_id,
                    "otro_pais_provincia_localidad" => $denuncia_siniestro->conductor->otro_pais_provincia_localidad,
                    "ocupacion" => $denuncia_siniestro->conductor->ocupacion,
                    "telefono" => $denuncia_siniestro->conductor->telefono
                ]);
            }

            if($denuncia_siniestro->estado_carga == "2")
            {
                $denuncia_siniestro->estado_carga = '3';
                $denuncia_siniestro->save();
            }
        }

        return redirect()->route("asegurados-denuncias-paso4.create",['id'=> $identificador]);
    }

    public function paso4create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $provincia_id = old('provincia_id') ? old('provincia_id') : ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->province_id != null ? $denuncia_siniestro->asegurado->province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id )->orderBy('name')->get();
        $denuncia_siniestro->load('conductor');

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',["denuncia_siniestro"=>$denuncia_siniestro,"paso" => 4,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"localidades"=>$localidades]);
    }

    public function paso4store(Request $request)
    {
        $rules = [
            'asegurado_nombre' => 'required',
            'asegurado_documento_numero' => 'required',
            'asegurado_domicilio' => 'required',
            'asegurado_codigo_postal' => 'required',
            'pais' => 'required',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
            'asegurado_ocupacion' => 'required',
            'asegurado_telefono' => 'required',
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            if(!$denuncia_siniestro->asegurado)
            {
                $denuncia_siniestro->asegurado()->create([
                    "nombre" => $request->asegurado_nombre,
                    "tipo_documento_id" => $request->asegurado_documento_id,
                    "documento_numero" => $request->asegurado_documento_numero,
                    "domicilio" => $request->asegurado_domicilio,
                    "codigo_postal" => $request->asegurado_codigo_postal,
                    "pais_id" => $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null,
                    "province_id" => $request->pais != 'otro' && is_numeric($request->pais) ? $request->asegurado_provincia_id : null,
                    "city_id" => $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id,
                    "otro_pais_provincia_localidad" => $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null ),
                    "ocupacion" => $request->asegurado_ocupacion,
                    "telefono" => $request->asegurado_telefono
                ]);
            } else {
                $denuncia_siniestro->asegurado->nombre = $request->asegurado_nombre;
                $denuncia_siniestro->asegurado->tipo_documento_id = $request->asegurado_documento_id;
                $denuncia_siniestro->asegurado->documento_numero = $request->asegurado_documento_numero;
                $denuncia_siniestro->asegurado->domicilio = $request->asegurado_domicilio;
                $denuncia_siniestro->asegurado->codigo_postal = $request->asegurado_codigo_postal;
                $denuncia_siniestro->asegurado->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
                $denuncia_siniestro->asegurado->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->asegurado_provincia_id : null;
                $denuncia_siniestro->asegurado->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
                $denuncia_siniestro->asegurado->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
                $denuncia_siniestro->asegurado->city_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->asegurado_localidad_id : null;
                $denuncia_siniestro->asegurado->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : null;
                $denuncia_siniestro->asegurado->ocupacion = $request->asegurado_ocupacion;
                $denuncia_siniestro->asegurado->telefono = $request->asegurado_telefono;
                $denuncia_siniestro->asegurado->save();
            }

            if($denuncia_siniestro->estado_carga == "3")
            {
                $denuncia_siniestro->estado_carga = '4';
                $denuncia_siniestro->save();
            }
        }

        return redirect()->route("asegurados-denuncias-paso5.create",['id'=> $request->id]);
    }

    public function paso5create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id', $denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->marca_id : 1)->get();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => 5,
            "marcas"=>$marcas,
            "modelos"=>$modelos
        ]);
    }

    public function paso5store(Request $request)
    {
        $validated = request()->validate([
            'marca'=>'required_if:marca_id,otra',
            'modelo'=>'required_if:modelo_id,otro',

            'vehiculo_tipo'=>'required',
            'vehiculo_anio'=>'required',
            'vehiculo_dominio'=>'required',
            'vehiculo_motor'=>'required',
            'vehiculo_chasis'=>'required',

            'vehiculo_particular'=>'required_without_all:vehiculo_comercial,vehiculo_taxi,vehiculo_tp,vehiculo_urgencia,vehiculo_seguridad',
            'vehiculo_comercial'=>'required_without_all:vehiculo_particular,vehiculo_taxi,vehiculo_tp,vehiculo_urgencia,vehiculo_seguridad',
            'vehiculo_taxi'=>'required_without_all:vehiculo_comercial,vehiculo_particular,vehiculo_tp,vehiculo_urgencia,vehiculo_seguridad',
            'vehiculo_tp'=>'required_without_all:vehiculo_comercial,vehiculo_taxi,vehiculo_particular,vehiculo_urgencia,vehiculo_seguridad',
            'vehiculo_urgencia'=>'required_without_all:vehiculo_comercial,vehiculo_taxi,vehiculo_tp,vehiculo_particular,vehiculo_seguridad',
            'vehiculo_seguridad'=>'required_without_all:vehiculo_comercial,vehiculo_taxi,vehiculo_tp,vehiculo_urgencia,vehiculo_particular',


            'vehiculo_siniestro_danio'=>'required_without_all:vehiculo_siniestro_robo,vehiculo_siniestro_incendio',
            'vehiculo_siniestro_robo'=>'required_without_all:vehiculo_siniestro_danio,vehiculo_siniestro_incendio',
            'vehiculo_siniestro_incendio'=>'required_without_all:vehiculo_siniestro_danio,vehiculo_siniestro_robo',
        ]);

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            if(!$denuncia_siniestro->vehiculo)
            {
                $denuncia_siniestro->vehiculo()->create([
                    "marca_id" => $request->marca_id != 'otra' ? $request->marca_id : null,
                    "modelo_id" => $request->modelo_id != 'otro' ? $request->modelo_id : null,
                    "otra_marca" => $request->marca,
                    "otro_modelo" => $request->modelo,
                    "tipo" => $request->vehiculo_tipo,
                    "anio" => $request->vehiculo_anio,
                    "dominio" => strtoupper($request->vehiculo_dominio),
                    "motor" => $request->vehiculo_motor,
                    "chasis" => $request->vehiculo_chasis,
                    "uso_particular" => $request->vehiculo_particular  == 'on',
                    "uso_comercial" => $request->vehiculo_comercial  == 'on',
                    "uso_taxi_remis" => $request->vehiculo_taxi  == 'on',
                    "uso_tpp" => $request->vehiculo_tp == 'on',
                    "uso_urgencia" => $request->vehiculo_urgencia  == 'on',
                    "uso_seguridad" => $request->vehiculo_seguridad  == 'on',
                    "siniestro_danio" => $request->vehiculo_siniestro_danio  == 'on',
                    "siniestro_robo" => $request->vehiculo_siniestro_robo  == 'on',
                    "siniestro_incendio" => $request->vehiculo_siniestro_incendio  == 'on',
                    "detalles" => $request->vehiculo_detalles
                ]);
            } else {
                $denuncia_siniestro->vehiculo->marca_id = $request->marca_id != 'otra' ? $request->marca_id : null;
                $denuncia_siniestro->vehiculo->modelo_id = $request->modelo_id != 'otro' ? $request->modelo_id : null;
                $denuncia_siniestro->vehiculo->otra_marca = $request->marca;
                $denuncia_siniestro->vehiculo->otro_modelo = $request->modelo;
                $denuncia_siniestro->vehiculo->tipo = $request->vehiculo_tipo;
                $denuncia_siniestro->vehiculo->anio = $request->vehiculo_anio;
                $denuncia_siniestro->vehiculo->dominio = strtoupper($request->vehiculo_dominio);
                $denuncia_siniestro->vehiculo->motor = $request->vehiculo_motor;
                $denuncia_siniestro->vehiculo->chasis = $request->vehiculo_chasis;
                $denuncia_siniestro->vehiculo->uso_particular = $request->vehiculo_particular == 'on';
                $denuncia_siniestro->vehiculo->uso_comercial = $request->vehiculo_comercial == 'on';
                $denuncia_siniestro->vehiculo->uso_taxi_remis = $request->vehiculo_taxi  == 'on';
                $denuncia_siniestro->vehiculo->uso_tpp = $request->vehiculo_tp == 'on';
                $denuncia_siniestro->vehiculo->uso_urgencia = $request->vehiculo_urgencia  == 'on';
                $denuncia_siniestro->vehiculo->uso_seguridad = $request->vehiculo_seguridad  == 'on';
                $denuncia_siniestro->vehiculo->siniestro_danio = $request->vehiculo_siniestro_danio  == 'on';
                $denuncia_siniestro->vehiculo->siniestro_robo = $request->vehiculo_siniestro_robo  == 'on';
                $denuncia_siniestro->vehiculo->siniestro_incendio = $request->vehiculo_siniestro_incendio  == 'on';
                $denuncia_siniestro->vehiculo->detalles = $request->vehiculo_detalles;
                $denuncia_siniestro->vehiculo->save();
            }

            $denuncia_siniestro->dominio_vehiculo_asegurado = strtoupper($request->vehiculo_dominio);

            if($denuncia_siniestro->estado_carga == "4")
            {
                $denuncia_siniestro->estado_carga = '5';
            }
            $denuncia_siniestro->save();
        }

        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $request->id]);
    }

    public function paso6create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $tipoCalzadas = TipoCalzada::all();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => 6,
            "provincias"=>$provincias,
            "tipo_calzadas"=>$tipoCalzadas
        ]);
    }

    public function paso6store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'intervino_otro_vehiculo' => 'required',
            'intervino_otro_vehiculo_datos' => 'required',
            'vehiculos' => 'nullable'
        ]);

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        $validator->after(function ($validator) use ($request, $denuncia_siniestro) {
            if ($request->intervino_otro_vehiculo && $request->intervino_otro_vehiculo_datos && $denuncia_siniestro->vehiculoTerceros()->count() == 0) {
                $validator->errors()->add('vehiculos', 'Debe agregar al menos un vehículo');
            }
        });

        if ($validator->fails()) {
            return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->intervino_otro_vehiculo = $request->intervino_otro_vehiculo;
            $denuncia_siniestro->intervino_otro_vehiculo_datos = $request->intervino_otro_vehiculo_datos;

            if($denuncia_siniestro->estado_carga == "5")
            {
                $denuncia_siniestro->estado_carga = '6';

            }
            $denuncia_siniestro->save();
        }

        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $request->id]);
    }

    public function paso6agregarcreate(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id',1)->get();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => "6-agregar",
            "tipo_documentos"=>$tipoDocumentos,
            "tipo_carnets"=>$tipoCarnets,
            "marcas"=>$marcas,
            "modelos"=>$modelos
        ]);
    }

    public function paso6agregarstore(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->vehiculoTerceros()->create([
                "propietario_nombre" => $request->propietario_nombre,
                "propietario_telefono" => $request->propietario_telefono,
                "propietario_tipo_documento_id" => $request->propietario_documento_id,
                "propietario_documento_numero" => $request->propietario_documento_numero,
                "propietario_codigo_postal" => $request->propietario_codigo_postal,
                "propietario_domicilio" => $request->propietario_domicilio,
                "marca_id" => $request->marca_id != 'otra' ? $request->marca_id : null,
                "modelo_id" => $request->modelo_id != 'otro' ? $request->modelo_id : null,
                "otra_marca" => $request->marca,
                "otro_modelo" => $request->modelo,
                "tipo" => $request->vehiculo_tipo,
                "anio" => $request->vehiculo_anio,
                "dominio" => $request->vehiculo_dominio,
                "motor" => $request->vehiculo_motor,
                "chasis" => $request->vehiculo_chasis,
                "uso_particular" => $request->vehiculo_particular == 'on',
                "uso_comercial" => $request->vehiculo_comercial == 'on',
                "uso_taxi_remis" => $request->vehiculo_taxi == 'on',
                "uso_tpp" => $request->vehiculo_tp == 'on',
                "uso_urgencia" => $request->vehiculo_urgencia == 'on',
                "uso_seguridad" => $request->vehiculo_seguridad == 'on',
                "detalles" => $request->vehiculo_detalles,
                "conductor_nombre" => $request->conductor_nombre,
                "conductor_telefono" => $request->conductor_telefono,
                "conductor_tipo_documento_id" => $request->conductor_documento_id,
                "conductor_documento_numero" => $request->conductor_documento_numero,
                "conductor_codigo_postal" => $request->conductor_codigo_postal,
                "conductor_domicilio" => $request->conductor_domicilio,
                "conductor_registro" => $request->conductor_registro,
                "conductor_tipo_carnet_id" => $request->conductor_carnet_id,
                "conductor_categoria" => $request->conductor_categoria,
                "conductor_vencimiento" => $request->conductor_vencimiento,
                "conductor_alcoholemia" => $request->conductor_alcoholemia,
                "conductor_alcoholemia_se_nego" => $request->conductor_alcoholemia_nego == 'on',
                "conductor_habitual" => $request->conductor_habitual,
            ]);
        }

        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $request->id]);
    }

    public function paso6edit(Request $request)
    {
        $vehiculo_tercero = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->vehiculoTerceros()->where('id',$request->v)->firstOrFail();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id', $vehiculo_tercero->marca_id != null ? $vehiculo_tercero->marca_id : 1 )->get();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "vehiculo_tercero"=>$vehiculo_tercero,
            "paso" => "6-editar",
            "tipo_calzadas"=>$tipoCalzadas,
            "tipo_documentos"=>$tipoDocumentos,
            "tipo_carnets"=>$tipoCarnets,
            "marcas"=>$marcas,
            "modelos"=>$modelos
        ]);
    }

    public function paso6update(Request $request)
    {
        $vehiculo_tercero = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->vehiculoTerceros()->where('id',$request->v)->firstOrFail();

        if($vehiculo_tercero->denuncia->canEdit())
        {
            $vehiculo_tercero->update([
                "propietario_nombre" => $request->propietario_nombre,
                "propietario_telefono" => $request->propietario_telefono,
                "propietario_tipo_documento_id" => $request->propietario_documento_id,
                "propietario_documento_numero" => $request->propietario_documento_numero,
                "propietario_codigo_postal" => $request->propietario_codigo_postal,
                "propietario_domicilio" => $request->propietario_domicilio,
                "marca_id" => is_numeric($request->marca_id) ? $request->marca_id : null,
                "modelo_id" => is_numeric($request->modelo_id) ? $request->modelo_id : null,
                "otra_marca" => !is_numeric($request->marca_id) ? $request->marca : null,
                "otro_modelo" => !is_numeric($request->modelo_id) ? $request->modelo : null,
                "tipo" => $request->vehiculo_tipo,
                "anio" => $request->vehiculo_anio,
                "dominio" => $request->vehiculo_dominio,
                "motor" => $request->vehiculo_motor,
                "chasis" => $request->vehiculo_chasis,
                "uso_particular" => $request->vehiculo_particular == 'on',
                "uso_comercial" => $request->vehiculo_comercial == 'on',
                "uso_taxi_remis" => $request->vehiculo_taxi == 'on',
                "uso_tpp" => $request->vehiculo_tp == 'on',
                "uso_urgencia" => $request->vehiculo_urgencia == 'on',
                "uso_seguridad" => $request->vehiculo_seguridad == 'on',
                "detalles" => $request->vehiculo_detalles,
                "conductor_nombre" => $request->conductor_nombre,
                "conductor_telefono" => $request->conductor_telefono,
                "conductor_tipo_documento_id" => $request->conductor_documento_id,
                "conductor_documento_numero" => $request->conductor_documento_numero,
                "conductor_codigo_postal" => $request->conductor_codigo_postal,
                "conductor_domicilio" => $request->conductor_domicilio,
                "conductor_registro" => $request->conductor_registro,
                "conductor_tipo_carnet_id" => $request->conductor_carnet_id,
                "conductor_categoria" => $request->conductor_categoria,
                "conductor_vencimiento" => $request->conductor_vencimiento,
                "conductor_alcoholemia" => $request->conductor_alcoholemia,
                "conductor_alcoholemia_se_nego" => $request->conductor_alcoholemia_se_nego == 'on',
                "conductor_habitual" => $request->conductor_habitual_si,
            ]);
        }

        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $request->id]);
    }

    public function paso6DeleteItem(Request $request)
    {
        $vehiculo_tercero = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->vehiculoTerceros()->where('id',$request->v)->firstOrFail();
        if($vehiculo_tercero->denuncia->canEdit())
        {
            $vehiculo_tercero->delete();
        }
        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $request->id]);
    }

    public function paso7create()
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",request('id'))->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $tipoCalzadas = TipoCalzada::all();
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => 7,
            "provincias"=>$provincias,
            "tipo_calzadas"=>$tipoCalzadas
        ]);
    }

    public function paso7store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hubo_danios_materiales' => 'required',
            'danios_materiales' => 'nullable'
        ]);

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        $validator->after(function ($validator) use ($request, $denuncia_siniestro) {
            if ($request->hubo_danios_materiales && $denuncia_siniestro->danioMateriales()->count() == 0) {
                $validator->errors()->add('danios_materiales', 'Debe agregar al menos un daño material');
            }
        });

        if ($validator->fails()) {
            return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->hubo_danios_materiales = $request->hubo_danios_materiales;

            if($denuncia_siniestro->estado_carga == "6")
            {
                $denuncia_siniestro->estado_carga = '7';
            }

            $denuncia_siniestro->save();
        }


        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $request->id]);
    }

    public function paso7agregarcreate(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $tipoDocumentos = TipoDocumento::all();
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => "7-agregar",
            "tipo_documentos"=>$tipoDocumentos
        ]);
    }

    public function paso7agregarstore(Request $request)
    {
        $rules =  [
            'detalles' => 'required|max:255'
        ];
        Validator::make($request->all(),$rules)->validate();

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->danioMateriales()->create([
                "detalles" => $request->detalles,
                "propietario_nombre" => $request->propietario_nombre,
                "propietario_tipo_documento_id" => $request->propietario_documento_id,
                "propietario_documento_numero" => $request->propietario_documento_numero,
                "propietario_codigo_postal" => $request->propietario_codigo_postal,
                "propietario_domicilio" => $request->propietario_domicilio
            ]);
        }

        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $request->id]);
    }

    public function paso7edit(Request $request)
    {
        $danio = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->danioMateriales()->where('id',$request->v)->firstOrFail();
        $tipoDocumentos = TipoDocumento::all();
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "danio"=>$danio,
            "paso" => "7-editar",
            "tipo_documentos"=>$tipoDocumentos
        ]);
    }

    public function paso7update(Request $request)
    {
        $rules =  [
            'detalles' => 'required|max:255'
        ];
        Validator::make($request->all(),$rules)->validate();

        $danio_materiales = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->danioMateriales()->where('id',$request->v)->firstOrFail();

        if($danio_materiales->denuncia->canEdit())
        {
            $danio_materiales->update([
                "detalles" => $request->detalles,
                "propietario_nombre" => $request->propietario_nombre,
                "propietario_tipo_documento_id" => $request->propietario_documento_id,
                "propietario_documento_numero" => $request->propietario_documento_numero,
                "propietario_codigo_postal" => $request->propietario_codigo_postal,
                "propietario_domicilio" => $request->propietario_domicilio
            ]);
        }

        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $request->id]);
    }

    public function paso7DeleteItem(Request $request)
    {
        $danio_materiales = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->danioMateriales()->where('id',$request->v)->firstOrFail();
        if($danio_materiales->denuncia->canEdit())
        {
            $danio_materiales->delete();
        }
        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $request->id]);
    }

    public function paso8create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $denuncia_siniestro->load('lesionados');
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',["denuncia_siniestro"=>$denuncia_siniestro, "paso" => 8]);
    }

    public function paso8store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hubo_lesionados' => 'required',
            'lesionados' => 'nullable'
        ]);

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        $validator->after(function ($validator) use ($request, $denuncia_siniestro) {
            if ($request->hubo_lesionados && $denuncia_siniestro->lesionados()->count() == 0) {
                $validator->errors()->add('lesionados', 'Debe agregar al menos un lesionado');
            }
        });

        if ($validator->fails()) {
            return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->hubo_lesionados = $request->hubo_lesionados;

            if($denuncia_siniestro->estado_carga == "7")
            {
                $denuncia_siniestro->estado_carga = '8';
            }

            $denuncia_siniestro->save();
        }

        return redirect()->route("asegurados-denuncias-paso9.create",['id'=> $request->id]);
    }


    public function paso8agregarcreate(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $tipoDocumentos = TipoDocumento::all();
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => "8-agregar",
            "tipo_documentos"=>$tipoDocumentos
        ]);
    }

    public function paso8agregarstore(Request $request)
    {
        $rules =  [
            'tipo' => 'required',
        ];
        Validator::make($request->all(),$rules)->validate();

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->lesionados()->create([
                "nombre" => $request->lesionado_nombre,
                "telefono" => $request->lesionado_telefono,
                "tipo_documento_id" => $request->lesionado_documento_id,
                "documento_numero" => $request->lesionado_documento_numero,
                "codigo_postal" => $request->lesionado_codigo_postal,
                "domicilio" => $request->lesionado_domicilio,
                "estado_civil" => $request->lesionado_estado_civil,
                "fecha_nacimiento" => $request->lesionado_fecha_nacimiento,
                "relacion" => $request->lesionado_relacion,
                "tipo" => $request->tipo,
                "gravedad_lesion" => $request->gravedad_lesion,
                "alcoholemia" => $request->alcoholemia,
                "alcoholemia_se_nego" => $request->lesionado_alcoholemia_nego == 'on',
                "centro_asistencial" => $request->lesionado_centro_asistencial
            ]);
        }

        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $request->id]);
    }

    public function paso8edit(Request $request)
    {
        $lesionado = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->lesionados()->where('id',$request->v)->firstOrFail();
        $tipoDocumentos = TipoDocumento::all();
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "lesionado"=>$lesionado,
            "paso" => "8-editar",
            "tipo_documentos"=>$tipoDocumentos
        ]);
    }

    public function paso8update(Request $request)
    {
        $lesionado = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->lesionados()->where('id',$request->v)->firstOrFail();

        if($lesionado->denuncia->canEdit())
        {
            $lesionado->update([
                "nombre" => $request->lesionado_nombre,
                "telefono" => $request->lesionado_telefono,
                "tipo_documento_id" => $request->lesionado_documento_id,
                "documento_numero" => $request->lesionado_documento_numero,
                "codigo_postal" => $request->lesionado_codigo_postal,
                "domicilio" => $request->lesionado_domicilio,
                "estado_civil" => $request->lesionado_estado_civil,
                "fecha_nacimiento" => $request->lesionado_fecha_nacimiento,
                "relacion" => $request->lesionado_relacion,
                "tipo" => $request->tipo,
                "gravedad_lesion" => $request->gravedad_lesion,
                "alcoholemia" => $request->alcoholemia,
                "alcoholemia_no" => $request->lesionado_alcoholemia_no,
                "alcoholemia_se_nego" => $request->alcoholemia_se_nego == 'on',
                "centro_asistencial" => $request->lesionado_centro_asistencial
            ]);
        }

        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $request->id]);
    }

    public function paso8DeleteItem(Request $request)
    {
        $lesionado = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail()->lesionados()->where('id',$request->v)->firstOrFail();
        if($lesionado->denuncia->canEdit())
        {
            $lesionado->delete();
        }
        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $request->id]);
    }

    public function paso9create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $tipoCalzadas = TipoCalzada::all();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => 9,
            "provincias"=>$provincias,
            "tipo_calzadas"=>$tipoCalzadas
        ]);
    }

    public function paso9store(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            $denuncia_siniestro->tipo_accidente_frontal = $request->tipo_accidente_frontal == 'on';
            $denuncia_siniestro->tipo_accidente_posterior = $request->tipo_accidente_posterior == 'on';
            $denuncia_siniestro->tipo_accidente_cadena = $request->tipo_accidente_cadena == 'on';
            $denuncia_siniestro->tipo_accidente_lateral = $request->tipo_accidente_lateral == 'on';
            $denuncia_siniestro->tipo_accidente_vuelco = $request->tipo_accidente_vuelco == 'on';
            $denuncia_siniestro->tipo_accidente_desplaza = $request->tipo_accidente_desplaza == 'on';
            $denuncia_siniestro->tipo_accidente_incendio = $request->tipo_accidente_incendio == 'on';
            $denuncia_siniestro->tipo_accidente_inmersion = $request->tipo_accidente_inmersion == 'on';
            $denuncia_siniestro->tipo_accidente_explosion = $request->tipo_accidente_explosion == 'on';
            $denuncia_siniestro->tipo_accidente_carga = $request->tipo_accidente_carga == 'on';
            $denuncia_siniestro->tipo_accidente_otros = $request->tipo_accidente_otros == 'on';
            $denuncia_siniestro->lugar_autopista = $request->lugar_autopista == 'on';
            $denuncia_siniestro->lugar_calle = $request->lugar_calle == 'on';
            $denuncia_siniestro->lugar_avenida = $request->lugar_avenida == 'on';
            $denuncia_siniestro->lugar_curva = $request->lugar_curva == 'on';
            $denuncia_siniestro->lugar_pendiente = $request->lugar_pendiente == 'on';
            $denuncia_siniestro->lugar_tunel = $request->lugar_tunel == 'on';
            $denuncia_siniestro->lugar_puente = $request->lugar_sobrepuente == 'on';
            $denuncia_siniestro->lugar_otros = $request->lugar_otros == 'on';
            $denuncia_siniestro->colision_peaton = $request->colision_peaton == 'on';
            $denuncia_siniestro->colision_vehiculo = $request->colision_vehiculo == 'on';
            $denuncia_siniestro->colision_edificio = $request->colision_edificio == 'on';
            $denuncia_siniestro->colision_columna = $request->colision_columna == 'on';
            $denuncia_siniestro->colision_animal = $request->colision_animal == 'on';
            $denuncia_siniestro->colision_transporte_publico = $request->colision_transporte == 'on';
            $denuncia_siniestro->colision_otros = $request->colision_otros == 'on';

            if($denuncia_siniestro->estado_carga == "8")
            {
                $denuncia_siniestro->estado_carga = '9';
            }
            $denuncia_siniestro->save();
        }

        return redirect()->route("asegurados-denuncias-paso10.create",['id'=> $request->id]);
    }

    public function paso10create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro" => $denuncia_siniestro,
            "paso" => 10,
        ]);
    }

    public function paso10store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'graficoManual' => 'nullable'
        ]);

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if(!$denuncia_siniestro->croquis_url && !$request->hasFile('graficoManual') )
        {
            $validator->errors()->add('graficoManual', 'Debe crear un croquis o cargar una imagen.');
            return redirect()->route("asegurados-denuncias-paso10.create",['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        if($denuncia_siniestro->canEdit())
        {
            if($request->hasFile('graficoManual'))
            {
                if($denuncia_siniestro->croquis_url)
                {
                    Storage::disk('s3')->delete($denuncia_siniestro->croquis_path);
                }

                $format = 'jpg';
                $filePath = $this->getCroquisPath($denuncia_siniestro, $format);

                $imgFile = Image::make($request->file('graficoManual'));

                if($imgFile->width() > 2100)
                {
                    $imgFile->widen(2100);
                }

                Storage::disk('s3')->put($filePath, $imgFile->stream($format), 'public');
                $url = Storage::disk('s3')->url($filePath);

                if($url)
                {
                    $denuncia_siniestro->croquis_url = $url;
                    $denuncia_siniestro->croquis_path = $filePath;
                    $denuncia_siniestro->save();
                }
            }

            $denuncia_siniestro->croquis_descripcion = $request->description;
            $denuncia_siniestro->denuncia_policial_comisaria = $request->comisaria;
            $denuncia_siniestro->denuncia_policial_acta = $request->acta;
            $denuncia_siniestro->denuncia_policial_folio = $request->folio;
            $denuncia_siniestro->denuncia_policial_sumario = $request->sumario;
            $denuncia_siniestro->denuncia_policial_juzgado = $request->juzgado;
            $denuncia_siniestro->denuncia_policial_secretaria = $request->secretaria;

            if($denuncia_siniestro->estado_carga == "9")
            {
                $denuncia_siniestro->estado_carga = '10';
            }

            $denuncia_siniestro->save();
        }


        return redirect()->route("asegurados-denuncias-paso11.create",['id'=> $request->id]);
    }

    private function checkIfRedirect()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $paso = $denuncia_siniestro->estado_carga;
        $paso = is_numeric($paso) && intval($paso) < 12  ? intval($paso) + 1 : $denuncia_siniestro->estado_carga;
        return $paso;
    }

    public function storeCroquis(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|exists:denuncia_siniestros',
            'croquis' => 'required'
        ])->validate();

        $denuncia = DenunciaSiniestro::findOrFail($request->id);

        if($denuncia->canEdit())
        {
            if($denuncia->croquis_url)
            {
                Storage::disk('s3')->delete($denuncia->croquis_path);
            }

            $filePath = $this->getCroquisPath($denuncia);
            Storage::disk('s3')->put($filePath, file_get_contents($request->croquis),'public');
            $url = Storage::disk('s3')->url($filePath);

            if($url)
            {
                $denuncia->croquis_url = $url;
                $denuncia->croquis_path = $filePath;
                $denuncia->save();
            }
        }

        return response()->json([ 'status' => true]);
    }

    private function getCroquisPath(DenunciaSiniestro $denuncia, $format = 'jpg')
    {
        return 'denuncia_siniestro/'.$denuncia->id.'/croquis_'.Carbon::now()->format('Ymd_His').'.'.$format;
    }

    public function updateCertificadoPoliza(Request $request, DenunciaSiniestro $denuncia)
    {
        Validator::make($request->all(), [
            'certificado_cobertura' => ['required', 'file', 'mimetypes:application/pdf']
        ])->validate();

        if($denuncia->certificado_cobertura_url)
        {
            Storage::disk('s3')->delete($denuncia->certificado_cobertura_url);
        }

        $fileName = 'certificado_de_cobertura_'.Carbon::now()->format('Ymd_His').'.pdf';
        $filePath = 'denuncia_siniestro/'.$denuncia->id.'/'.$fileName;

        Storage::disk('s3')->put($filePath, fopen($request->certificado_cobertura, 'r+'),'public');
        $url = Storage::disk('s3')->url($filePath);

        $denuncia->certificado_cobertura_name = $fileName;
        $denuncia->certificado_cobertura_path = $filePath;
        $denuncia->certificado_cobertura_url = $url;
        $denuncia->save();

        return redirect()->route('panel-siniestros.denuncia.show', $denuncia);
    }

    public function uploadGrafico($request)
    {

        if($request->hasFile('graficoManual')) {
            if($request->file('graficoManual')->getSize() >= 10000000) {
                // throw new Exception("El tamaño del archivo debe tener menos de 50 megas", 500);
                return "error";
            }
            $year = Carbon::now()->format('Y');
            $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
            $name = 'grafico'.$dateName;
            $filePath = 'graficos' . '/' . $year . '/' . $name;

            //Upload File to s3
            Storage::disk('s3')->put($filePath, fopen($request->file('graficoManual'), 'r+'), 'public');

            $url = Storage::disk('s3')->url($filePath);
            return $url;
            }
        elseif(session('grafico' . Auth::id())) {
            $value = session('grafico' . Auth::id());
            $year = Carbon::now()->format('Y');
            if(!$value )
            {
                throw new Exception("Error Processing Request - s3", 500);
            }

            $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
            $name = 'grafico'.$dateName;
            $filePath = 'graficos' . '/' . $year . '/' . $name;

            Storage::disk('s3')->put($filePath, file_get_contents($value),'public');

            $url = Storage::disk('s3')->url($filePath);
            $request->session()->forget('grafico' . Auth::id());
            return $url;
        }
    }

    public function paso11create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        return view('siniestros.denuncia-asegurados.form-paso11', ["denuncia_siniestro"=>$denuncia_siniestro ]);
    }

    public function paso12create(Request $request)
    {
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = old('provincia_id') ? old('provincia_id') :
            ($denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->province_id != null ? $denuncia_siniestro->denunciante->province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        return view('siniestros.denuncia-asegurados.denuncia-asegurados',[
            "denuncia_siniestro"=>$denuncia_siniestro,
            "paso" => 12,
            "provincias"=>$provincias,
            "tipo_calzadas"=>$tipoCalzadas,
            "tipo_documentos"=>$tipoDocumentos,
            "localidades"=>$localidades
        ]);
    }

    public function paso12store(Request $request)
    {
        $rules = [
            'asegurado'=>'required',
            'asegurado_relacion'=>'required_if:asegurado,0',
            'nombre'=>'required_if:asegurado,0',
            'telefono'=>'required_if:asegurado,0',
            'pais' => 'required_if:asegurado,0',
            'otro_pais_provincia_localidad'=>'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
            'domicilio'=>'required_if:asegurado,0',
            'codigo_postal'=> 'required_if:asegurado,0',
            'tipo_documento_id' => 'required_if:asegurado,0',
            'documento_numero'=>'required_if:asegurado,0'
        ];

        $messages = [
            'asegurado_relacion.required_if'=>'La relación con el asegurado es requerido en caso de no ser el asegurado.',
            'nombre.required_if'=>'El nombre es requerido en caso de no ser el asegurado.',
            'telefono.required_if'=>'El teléfono es requerido en caso de no ser el asegurado.',
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
            'domiciclio.required_if'=>'El domicilio es requerido en caso de no ser el asegurado.',
            'provincia_id.required_if'=>'La provincia es requerida en caso de no ser el asegurado.',
            'localidad_id.required_if'=>'La localidad es requerida en caso de no ser el asegurado.',
            'domicilio.required_if'=>'El domicilio es requerida en caso de no ser el asegurado.',
            'tipo_documento_id.required_if'=>'El tipo de documento es requerido en caso de no ser el asegurado.',
            'documento_numero.required_if'=>'El número de documento es requerido en caso de no ser el asegurado.',
            'codigo_postal.required_if'=>'El código postal es requerido en caso de no ser el asegurado.',
        ];

        Validator::make($request->all(),$rules,$messages)->validate();

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$request->id)->firstOrFail();

        if($denuncia_siniestro->canEdit())
        {
            if(!$denuncia_siniestro->denunciante)
            {
                $denuncia_siniestro->denunciante()->create([
                    "nombre" => !$request->asegurado ? $request->nombre : $denuncia_siniestro->asegurado->nombre,
                    "telefono" => !$request->asegurado ? $request->telefono : $denuncia_siniestro->asegurado->telefono,
                    "domicilio" => !$request->asegurado ? $request->domicilio : $denuncia_siniestro->asegurado->domicilio,
                    "codigo_postal" => !$request->asegurado ? $request->codigo_postal : $denuncia_siniestro->asegurado->codigo_postal,
                    "pais_id" => !$request->asegurado ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null) : $denuncia_siniestro->asegurado->pais_id,
                    "province_id" => !$request->asegurado ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null) : $denuncia_siniestro->asegurado->province_id,
                    "city_id" => !$request->asegurado ? ($request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id) : $denuncia_siniestro->asegurado->city_id,
                    "otro_pais_provincia_localidad" => !$request->asegurado ? ($request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null )) : $denuncia_siniestro->asegurado->otro_pais_provincia_localidad,
                    "tipo_documento_id" => !$request->asegurado ? $request->tipo_documento_id : $denuncia_siniestro->asegurado->tipo_documento_id,
                    "documento_numero" => !$request->asegurado ? $request->documento_numero : $denuncia_siniestro->asegurado->documento_numero,
                    "asegurado" => $request->asegurado,
                    "asegurado_relacion" => !$request->asegurado ? $request->asegurado_relacion : null,
                ]);
            } else {
                $denuncia_siniestro->denunciante->nombre = $request->nombre;
                $denuncia_siniestro->denunciante->telefono = $request->telefono;
                $denuncia_siniestro->denunciante->domicilio = $request->domicilio;
                $denuncia_siniestro->denunciante->codigo_postal = $request->codigo_postal;
                $denuncia_siniestro->denunciante->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
                $denuncia_siniestro->denunciante->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
                $denuncia_siniestro->denunciante->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
                $denuncia_siniestro->denunciante->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
                $denuncia_siniestro->denunciante->tipo_documento_id = $request->tipo_documento_id;
                $denuncia_siniestro->denunciante->documento_numero = $request->documento_numero;
                $denuncia_siniestro->denunciante->asegurado = $request->asegurado;
                $denuncia_siniestro->denunciante->asegurado_relacion = $request->asegurado_relacion;
                $denuncia_siniestro->denunciante->save();
            }

            if($denuncia_siniestro->estado_carga == "11")
            {
                $denuncia_siniestro->estado_carga = '12';
                $denuncia_siniestro->save();
            }
        }

        $data['link_denuncia'] = route('asegurados-denuncias.pdf', ['denuncia' =>  $denuncia_siniestro->id]);
        if($denuncia_siniestro->certificado_cobertura_url)
        {
            $data['link_certificado'] = $denuncia_siniestro->certificado_cobertura_url;
        }
        return redirect()->route('gracias-denuncia', $data);
    }


    public function cambiarEstado(Request $request, DenunciaSiniestro $denuncia)
    {
        Validator::make($request->all(), [
            'estado' => ['required',Rule::in(DenunciaSiniestro::ESTADOS)]
        ])->validate();
        $denuncia->estado = $request->estado;
        $denuncia->save();
        return response()->json(['status' => true]);
    }

    public function cambiarCoberturaActiva(Request $request, DenunciaSiniestro $denuncia)
    {
        Validator::make($request->all(), [
            'cobertura_activa' => ['nullable',Rule::in(DenunciaSiniestro::COBERTURAS_ACTIVAS)]
        ])->validate();
        $denuncia->cobertura_activa = $request->cobertura_activa;
        $denuncia->save();
        return response()->json(['status' => true]);
    }

}
