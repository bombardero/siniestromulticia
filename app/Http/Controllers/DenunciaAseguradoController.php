<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\DenunciaSiniestro;
use App\Models\Province;
use App\Models\City;
use App\Models\DetalleSiniestro;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoCalzada;
use App\Models\TipoDocumento;
use App\Models\TipoCarnet;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;

class DenunciaAseguradoController extends Controller
{

    public function index()
    {
        $denuncia_siniestros = DenunciaSiniestro::latest()->paginate(10);
        return view('siniestro_backoffice.denuncias.index',["denuncia_siniestros"=>$denuncia_siniestros]);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->busqueda;
        $estado = null;
        switch ($request->estado)
        {
            case 'predenuncia':
                $estado = 'precarga';
                break;
            case 'incompleto':
                $estado = ['1','2','3','4','5','6','7','8','9','10','11'];
                break;
            case 'completo':
                $estado = '12';
                break;
            default:
                $estado = null;
        }
        $denuncia_siniestros = DenunciaSiniestro::when($busqueda, function ($query, $busqueda) {
            return $query->where('precarga_dominio_vehiculo_asegurado', 'LIKE', "%{$busqueda}%")
                ->orWhere('precarga_conductor_vehiculo_nombre','LIKE', "%{$busqueda}%");
        })->when($estado, function ($query, $estado) {
            if(is_array($estado))
            {
                return $query->whereIn('state', $estado);
            }
            return $query->where('state', $estado);
        });
        if($busqueda != null)
        {
            $denuncia_siniestros = $denuncia_siniestros->orWhereHas('asegurado', function (Builder $query) use ($busqueda) {
                return $query->where('carga_paso_4_asegurado_nombre', 'LIKE', "%{$busqueda}%")
                        ->orWhere('carga_paso_4_asegurado_documento_numero','LIKE', "%{$busqueda}%");
            });
        }
        $denuncia_siniestros = $denuncia_siniestros->latest()->paginate(10);
        
        return view('siniestro_backoffice.denuncias.index',["denuncia_siniestros"=>$denuncia_siniestros]);
    }

    public function updateDenunciaNroPoliza(Request $request){
        dd($request->npol);
    }

    public function updateDenunciaNroDenuncia(Request $request){
        dd($request->npol);
    }

    public function updateDenunciaNroSiniestro(Request $request){
        dd($request->npol);
    }

    public function show(DenunciaSiniestro $denuncia){

        return view('siniestro_backoffice.denuncias.show',["denuncia"=>$denuncia]);
    }

    public function agregarObservaciones(DenunciaSiniestro $denuncia){

        return view('siniestro_backoffice.denuncias.index-observaciones',['denuncia'=>$denuncia]);
    }

    public function agregarObservacionesStore(DenunciaSiniestro $denuncia){
        $observaciones = request('descripcion_siniestro');
        $denuncia->observaciones()->create(['detalle'=>$observaciones,'user_id'=>auth()->user()->id]);
        return redirect()->route('panel-siniestros.denuncia.show',['denuncia'=>$denuncia]);
    }

    public function delete(DenunciaSiniestro $denuncia){
        $denuncia->delete();
        return redirect()->route('panel-siniestros');
    }

    public function generarPDF(DenunciaSiniestro $denuncia){
        $data=[
            'denuncia' =>$denuncia
        ];
        $pdf = PDF::loadView('pdf', $data);

        return $pdf->download('denuncia.pdf');
    }

    public function paso1create()
    {
        $identificador = request('id');
        if(request('noredirect')==null){
            $state = $this->checkIfRedirect();
            if($state != "1" && $state != "precarga"){
                $nameredirect="asegurados-denuncias-paso".$state.".create";
                return redirect()->route($nameredirect,['id'=> $identificador]);
            }

        }


        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        return view('siniestros.denuncia-asegurados',["denuncia_siniestro"=>$denuncia_siniestro]);
    }

    public function paso1store()
    {
        $validated = request()->validate([
            'diurno'=>'required_without:nocturno',
            'nocturno'=>'required_without:diurno'
        ]);

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $denuncia_siniestro->carga_paso_1_diurno = request('diurno');
        $denuncia_siniestro->carga_paso_1_nocturno = request('nocturno');
        $denuncia_siniestro->carga_paso_1_seco = request('seco');
        $denuncia_siniestro->carga_paso_1_lluvia = request('lluvia');
        $denuncia_siniestro->carga_paso_1_niebla = request('niebla');
        $denuncia_siniestro->carga_paso_1_despejado = request('despejado');
        $denuncia_siniestro->carga_paso_1_nieve = request('nieve');
        $denuncia_siniestro->carga_paso_1_granizo = request('granizo');
        $denuncia_siniestro->carga_paso_1_otros = request('otros');
        $denuncia_siniestro->carga_paso_1_otros_detalle = request('otros_detalle');

        if($denuncia_siniestro->state < "1" || $denuncia_siniestro->state == 'precarga'){
            $denuncia_siniestro->state="1";
        }

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso2.create",['id'=> $identificador]);
    }

    public function paso2create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $localidades = null;

        if($denuncia_siniestro->lugar != null && $denuncia_siniestro->lugar->carga_paso_2_provincia_id !=null){
            $localidades = City::where('province_id',$denuncia_siniestro->lugar->carga_paso_2_provincia_id)->get();
        }else{
            $localidades = City::where('province_id','1')->get();

        }

        return view('siniestros.denuncia-asegurados-paso2',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas,"localidades"=>$localidades]);
    }

    public function paso2store()
    {
        $validated = request()->validate([
            'calle'=>'required'
        ]);

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $denuncia_siniestro->lugar()->updateOrCreate([
            "carga_paso_2_provincia_id" => request('provincia_id'),
            "carga_paso_2_localidad_id" => request('localidad_id'),
            "carga_paso_2_calle" => request('calle'),
            "carga_paso_2_calzada_id" => request('calzada_id'),
            "carga_paso_2_calzada_detalle" => request('calzada_detalle'),
            "carga_paso_2_interseccion" => request('interseccion'),
            "carga_paso_2_cruce_senalizado" => request('cruce_senalizado'),
            "carga_paso_2_tren_si" => request('tren_si'),
            "carga_paso_2_tren_no" => request('tren_no'),
            "carga_paso_2_semaforo" => request('semaforo'),
            "carga_paso_2_semaforo_funciona" => request('semaforo_funciona'),
            "carga_paso_2_semaforo_intermitente" => request('semaforo_intermitente'),
            "carga_paso_2_semaforo_color" => request('semaforo_color')
        ]);

        if($denuncia_siniestro->state < "2"){
            $denuncia_siniestro->state="2";
        }
        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso3.create",['id'=> $identificador]);
    }

    public function paso3create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $localidades = null;

        if($denuncia_siniestro->conductor != null && $denuncia_siniestro->conductor->carga_paso_3_provincia_id !=null){
            $localidades = City::where('province_id',$denuncia_siniestro->conductor->carga_paso_3_provincia_id)->get();
        }else{
            $localidades = City::where('province_id','1')->get();

        }

        return view('siniestros.denuncia-asegurados-paso3',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets,"localidades"=>$localidades]);
    }

    public function paso3store()
    {
        $validated = request()->validate([
            'nombre'=>'required',
            'telefono'=>'required',
            'domicilio'=>'required',
            'codigo_postal'=>'required',
            'fecha_nacimiento'=>'required',
            'documento_numero'=>'required',
            'ocupacion'=>'required',
            'numero_registro'=>'required',
            'estado_civil'=>'required',
            'carnet_categoria'=>'required',
            'carnet_vencimiento'=>'required',
            'alcoholemia_si'=>'required_without_all:alcoholemia_no,alcoholemia_nego',
            'alcoholemia_no'=>'required_without_all:alcoholemia_si,alcoholemia_nego',
            'alcoholemia_nego'=>'required_without_all:alcoholemia_no,alcoholemia_si',
            'asegurado_si'=>'required_without:asegurado_no',
            'asegurado_no'=>'required_without:asegurado_si',
        ]);

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $denuncia_siniestro->conductor()->updateOrCreate([
            "carga_paso_3_nombre" => request('nombre'),
            "carga_paso_3_telefono" => request('telefono'),
            "carga_paso_3_domicilio" => request('domicilio'),
            "carga_paso_3_codigo_postal" => request('codigo_postal'),
            "carga_paso_3_pais_id" => request('pais_id'),
            "carga_paso_3_provincia_id" => request('provincia_id'),
            "carga_paso_3_localidad_id" => request('localidad_id'),
            "carga_paso_3_fecha_nacimiento" => request('fecha_nacimiento'),
            "carga_paso_3_documento_id" => request('documento_id'),
            "carga_paso_3_documento_numero" => request('documento_numero'),
            "carga_paso_3_ocupacion" => request('ocupacion'),
            "carga_paso_3_numero_registro" => request('numero_registro'),
            "carga_paso_3_estado_civil" => request('estado_civil'),
            "carga_paso_3_carnet_id" => request('carnet_id'),
            "carga_paso_3_carnet_categoria" => request('carnet_categoria'),
            "carga_paso_3_carnet_vencimiento" => request('carnet_vencimiento'),
            "carga_paso_3_alcoholemia_si" => request('alcoholemia_si'),
            "carga_paso_3_alcoholemia_no" => request('alcoholemia_no'),
            "carga_paso_3_alcoholemia_nego" => request('alcoholemia_nego'),
            "carga_paso_3_habitual_si" => request('habitual_si'),
            "carga_paso_3_habitual_no" => request('habitual_no'),
            "carga_paso_3_asegurado_si" => request('asegurado_si'),
            "carga_paso_3_asegurado_no" => request('asegurado_no'),
            "carga_paso_3_asegurado_relacion" => request('asegurado_relacion')
        ]);

        if($denuncia_siniestro->state < "3"){
            $denuncia_siniestro->state='3';
        }
        $denuncia_siniestro->save();
        return redirect()->route("asegurados-denuncias-paso4.create",['id'=> $identificador]);
    }

    public function paso4create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $localidades = null;

        if($denuncia_siniestro->asegurado != null && $denuncia_siniestro->asegurado->carga_paso_4_asegurado_provincia_id !=null){
            $localidades = City::where('province_id',$denuncia_siniestro->asegurado->carga_paso_4_asegurado_provincia_id)->get();
        }else{
            $localidades = City::where('province_id','1')->get();

        }

        return view('siniestros.denuncia-asegurados-paso4',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"localidades"=>$localidades]);
    }

    public function paso4store()
    {
        $validated = request()->validate([
            'asegurado_nombre'=>'required',
            'asegurado_documento_numero'=>'required',
            'asegurado_domicilio'=>'required',
            'asegurado_codigo_postal'=>'required',
            'asegurado_ocupacion'=>'required',
            'asegurado_telefono'=>'required',
        ]);

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $denuncia_siniestro->asegurado()->updateOrCreate([
            "carga_paso_4_asegurado_nombre" => request('asegurado_nombre'),
            "carga_paso_4_asegurado_documento_id" => request('asegurado_documento_id'),
            "carga_paso_4_asegurado_documento_numero" => request('asegurado_documento_numero'),
            "carga_paso_4_asegurado_domicilio" => request('asegurado_domicilio'),
            "carga_paso_4_asegurado_codigo_postal" => request('asegurado_codigo_postal'),
            "carga_paso_4_asegurado_pais_id" => request('asegurado_pais_id'),
            "carga_paso_4_asegurado_provincia_id" => request('asegurado_provincia_id'),
            "carga_paso_4_asegurado_localidad_id" => request('asegurado_localidad_id'),
            "carga_paso_4_asegurado_ocupacion" => request('asegurado_ocupacion'),
            "carga_paso_4_asegurado_telefono" => request('asegurado_telefono')
        ]);

        if($denuncia_siniestro->state < "4"){
            $denuncia_siniestro->state='4';
        }
        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso5.create",['id'=> $identificador]);
    }

    public function paso5create()
    {
        $marcas = Marca::all();
        $tipoCalzadas = TipoCalzada::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $modelos = null;

        if($denuncia_siniestro->vehiculo != null && $denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id !=null){
            $modelos = Modelo::where('marca_id',$denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id)->get();
        }else{
            $modelos = Modelo::where('marca_id','1')->get();

        }

        return view('siniestros.denuncia-asegurados-paso5',["denuncia_siniestro"=>$denuncia_siniestro,"marcas"=>$marcas,"tipo_calzadas"=>$tipoCalzadas,"modelos"=>$modelos]);
    }

    public function paso5store()
    {
        $validated = request()->validate([
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

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $denuncia_siniestro->vehiculo()->updateOrCreate([
            "carga_paso_5_vehiculo_marca_id" => request("vehiculo_marca_id"),
            "carga_paso_5_vehiculo_modelo_id" => request("vehiculo_modelo_id"),
            "carga_paso_5_vehiculo_tipo" => request("vehiculo_tipo"),
            "carga_paso_5_vehiculo_anio" => request("vehiculo_anio"),
            "carga_paso_5_vehiculo_dominio" => request("vehiculo_dominio"),
            "carga_paso_5_vehiculo_motor" => request("vehiculo_motor"),
            "carga_paso_5_vehiculo_chasis" => request("vehiculo_chasis"),
            "carga_paso_5_vehiculo_particular" => request("vehiculo_particular"),
            "carga_paso_5_vehiculo_comercial" => request("vehiculo_comercial"),
            "carga_paso_5_vehiculo_taxi" => request("vehiculo_taxi"),
            "carga_paso_5_vehiculo_tp" => request("vehiculo_tp"),
            "carga_paso_5_vehiculo_urgencia" => request("vehiculo_urgencia"),
            "carga_paso_5_vehiculo_seguridad" => request("vehiculo_seguridad"),
            "carga_paso_5_vehiculo_siniestro_danio" => request("vehiculo_siniestro_danio"),
            "carga_paso_5_vehiculo_siniestro_robo" => request("vehiculo_siniestro_robo"),
            "carga_paso_5_vehiculo_siniestro_incendio" => request("vehiculo_siniestro_incendio"),
            "carga_paso_5_vehiculo_detalles" => request("vehiculo_detalles")
        ]);

        if($denuncia_siniestro->state < "5"){
            $denuncia_siniestro->state='5';
        }
        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $identificador]);
    }

    public function paso6create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        return view('siniestros.denuncia-asegurados-paso6',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas]);
    }

    public function paso6store()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $denuncia_siniestro->carga_paso_6_intervino_si=request('intervino_si');
        $denuncia_siniestro->carga_paso_6_intervino_no=request('intervino_no');
        $denuncia_siniestro->carga_paso_6_datos_si=request('datos_si');
        $denuncia_siniestro->carga_paso_6_datos_no=request('datos_no');

        if($denuncia_siniestro->state < "6"){
            $denuncia_siniestro->state='6';
        }

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $identificador]);
    }

    public function paso6agregarcreate()
    {
        $marcas = Marca::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $modelos = null;
        $modelos = Modelo::where('marca_id','1')->get();

        /*if($denuncia_siniestro->vehiculo != null && $denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id !=null){
            $modelos = Modelo::where('marca_id',$denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id)->get();
        }else{

        }*/

        return view('siniestros.denuncia-asegurados-paso6-agregar',["denuncia_siniestro"=>$denuncia_siniestro,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets,"marcas"=>$marcas,"modelos"=>$modelos]);
    }

    public function paso6agregarstore()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $denuncia_siniestro->vehiculoTerceros()->updateOrCreate([
            "carga_paso_6_vehiculo_terceros_propietario_nombre" => request('propietario_nombre'),
            "carga_paso_6_vehiculo_terceros_propietario_telefono" => request('propietario_telefono'),
            "carga_paso_6_vehiculo_terceros_propietario_documento_id" => request('propietario_documento_id'),
            "carga_paso_6_vehiculo_terceros_propietario_documento_numero" => request('propietario_documento_numero'),
            "carga_paso_6_vehiculo_terceros_propietario_codigo_postal" => request('propietario_codigo_postal'),
            "carga_paso_6_vehiculo_terceros_propietario_domicilio" => request('propietario_domicilio'),
            "carga_paso_6_vehiculo_terceros_marca_id" => request('vehiculo_marca_id'),
            "carga_paso_6_vehiculo_terceros_modelo_id" => request('vehiculo_modelo_id'),
            "carga_paso_6_vehiculo_terceros_tipo" => request('vehiculo_tipo'),
            "carga_paso_6_vehiculo_terceros_anio" => request('vehiculo_anio'),
            "carga_paso_6_vehiculo_terceros_dominio" => request('vehiculo_dominio'),
            "carga_paso_6_vehiculo_terceros_motor" => request('vehiculo_motor'),
            "carga_paso_6_vehiculo_terceros_chasis" => request('vehiculo_chasis'),
            "carga_paso_6_vehiculo_terceros_particular" => request('vehiculo_particular'),
            "carga_paso_6_vehiculo_terceros_comercial" => request('vehiculo_comercial'),
            "carga_paso_6_vehiculo_terceros_taxi" => request('vehiculo_taxi'),
            "carga_paso_6_vehiculo_terceros_tp" => request('vehiculo_tp'),
            "carga_paso_6_vehiculo_terceros_urgencia" => request('vehiculo_urgencia'),
            "carga_paso_6_vehiculo_terceros_seguridad" => request('vehiculo_seguridad'),
            "carga_paso_6_vehiculo_terceros_detalles" => request('vehiculo_detalles'),
            "carga_paso_6_vehiculo_terceros_conductor_nombre" => request('conductor_nombre'),
            "carga_paso_6_vehiculo_terceros_conductor_telefono" => request('conductor_telefono'),
            "carga_paso_6_vehiculo_terceros_conductor_documento_id" => request('conductor_documento_id'),
            "carga_paso_6_vehiculo_terceros_conductor_documento_numero" => request('conductor_documento_numero'),
            "carga_paso_6_vehiculo_terceros_conductor_codigo_postal" => request('conductor_codigo_postal'),
            "carga_paso_6_vehiculo_terceros_conductor_domicilio" => request('conductor_domicilio'),
            "carga_paso_6_vehiculo_terceros_conductor_registro" => request('conductor_registro'),
            "carga_paso_6_vehiculo_terceros_conductor_carnet_id" => request('conductor_carnet_id'),
            "carga_paso_6_vehiculo_terceros_conductor_categoria" => request('conductor_categoria'),
            "carga_paso_6_vehiculo_terceros_conductor_vencimiento" => request('conductor_vencimiento'),
            "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_si" => request('conductor_alcoholemia_si'),
            "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_no" => request('conductor_alcoholemia_no'),
            "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_nego" => request('conductor_alcoholemia_nego'),
            "carga_paso_6_vehiculo_terceros_conductor_habitual_si" => request('conductor_habitual_si'),
            "carga_paso_6_vehiculo_terceros_conductor_habitual_no" => request('conductor_habitual_no')
        ]);

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $identificador]);
    }

    public function paso6edit(){
        $marcas = Marca::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();

        $identificador = request('id');
        $vehiculo_id = request('v');
        $vehiculo_tercero = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->vehiculoTerceros()->where('id',$vehiculo_id)->firstOrFail();
        $modelos = null;

        if($vehiculo_tercero != null && $vehiculo_tercero->carga_paso_6_vehiculo_terceros_marca_id !=null){
            $modelos = Modelo::where('marca_id',$vehiculo_tercero->carga_paso_6_vehiculo_terceros_marca_id)->get();
        }else{
            $modelos = Modelo::where('marca_id','1')->get();
        }

        return view('siniestros.denuncia-asegurados-paso6-editar',["vehiculo_tercero"=>$vehiculo_tercero,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets,"marcas"=>$marcas,"modelos"=>$modelos]);

    }

    public function paso6update()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $vehiculo_id = request('v');
        $vehiculo_tercero = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->vehiculoTerceros()->where('id',$vehiculo_id)->firstOrFail();

        $vehiculo_tercero->update([
            "carga_paso_6_vehiculo_terceros_propietario_nombre" => request('propietario_nombre'),
            "carga_paso_6_vehiculo_terceros_propietario_telefono" => request('propietario_telefono'),
            "carga_paso_6_vehiculo_terceros_propietario_documento_id" => request('propietario_documento_id'),
            "carga_paso_6_vehiculo_terceros_propietario_documento_numero" => request('propietario_documento_numero'),
            "carga_paso_6_vehiculo_terceros_propietario_codigo_postal" => request('propietario_codigo_postal'),
            "carga_paso_6_vehiculo_terceros_propietario_domicilio" => request('propietario_domicilio'),
            "carga_paso_6_vehiculo_terceros_marca_id" => request('vehiculo_marca_id'),
            "carga_paso_6_vehiculo_terceros_modelo_id" => request('vehiculo_modelo_id'),
            "carga_paso_6_vehiculo_terceros_tipo" => request('vehiculo_tipo'),
            "carga_paso_6_vehiculo_terceros_anio" => request('vehiculo_anio'),
            "carga_paso_6_vehiculo_terceros_dominio" => request('vehiculo_dominio'),
            "carga_paso_6_vehiculo_terceros_motor" => request('vehiculo_motor'),
            "carga_paso_6_vehiculo_terceros_chasis" => request('vehiculo_chasis'),
            "carga_paso_6_vehiculo_terceros_particular" => request('vehiculo_particular'),
            "carga_paso_6_vehiculo_terceros_comercial" => request('vehiculo_comercial'),
            "carga_paso_6_vehiculo_terceros_taxi" => request('vehiculo_taxi'),
            "carga_paso_6_vehiculo_terceros_tp" => request('vehiculo_tp'),
            "carga_paso_6_vehiculo_terceros_urgencia" => request('vehiculo_urgencia'),
            "carga_paso_6_vehiculo_terceros_seguridad" => request('vehiculo_seguridad'),
            "carga_paso_6_vehiculo_terceros_detalles" => request('vehiculo_detalles'),
            "carga_paso_6_vehiculo_terceros_conductor_nombre" => request('conductor_nombre'),
            "carga_paso_6_vehiculo_terceros_conductor_telefono" => request('conductor_telefono'),
            "carga_paso_6_vehiculo_terceros_conductor_documento_id" => request('conductor_documento_id'),
            "carga_paso_6_vehiculo_terceros_conductor_documento_numero" => request('conductor_documento_numero'),
            "carga_paso_6_vehiculo_terceros_conductor_codigo_postal" => request('conductor_codigo_postal'),
            "carga_paso_6_vehiculo_terceros_conductor_domicilio" => request('conductor_domicilio'),
            "carga_paso_6_vehiculo_terceros_conductor_registro" => request('conductor_registro'),
            "carga_paso_6_vehiculo_terceros_conductor_carnet_id" => request('conductor_carnet_id'),
            "carga_paso_6_vehiculo_terceros_conductor_categoria" => request('conductor_categoria'),
            "carga_paso_6_vehiculo_terceros_conductor_vencimiento" => request('conductor_vencimiento'),
            "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_si" => request('conductor_alcoholemia_si'),
            "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_no" => request('conductor_alcoholemia_no'),
            "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_nego" => request('conductor_alcoholemia_nego'),
            "carga_paso_6_vehiculo_terceros_conductor_habitual_si" => request('conductor_habitual_si'),
            "carga_paso_6_vehiculo_terceros_conductor_habitual_no" => request('conductor_habitual_no')
        ]);

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $identificador]);
    }

    public function paso7edit(){
        $marcas = Marca::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();

        $identificador = request('id');
        $vehiculo_id = request('v');
        $danio = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->danioMateriales()->where('id',$vehiculo_id)->firstOrFail();

        return view('siniestros.denuncia-asegurados-paso7-editar',["danio"=>$danio,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets]);
    }

    public function paso7update(){
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $danio_materiales_id = request('v');
        $danioMateriales = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->danioMateriales()->where('id',$danio_materiales_id)->firstOrFail();

        $danioMateriales->update([
            "carga_paso_7_danio_materiales_detalles" => request('danio_detalles'),
            "carga_paso_7_danio_materiales_nombre" => request('propietario_nombre'),
            "carga_paso_7_danio_materiales_documento_id" => request('propietario_documento_id'),
            "carga_paso_7_danio_materiales_documento_numero" => request('propietario_documento_numero'),
            "carga_paso_7_danio_materiales_codigo_postal" => request('propietario_codigo_postal'),
            "carga_paso_7_danio_materiales_domicilio" => request('propietario_domicilio')
        ]);

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $identificador]);
    }

    public function paso6DeleteItem()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $danio_materiales_id = request('v');
        $danio_materiales = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->danioMateriales()->where('id',$danio_materiales_id)->firstOrFail();
        $danio_materiales->delete();
        return redirect()->route("asegurados-denuncias-paso6.create",['id'=> $identificador]);
    }

    public function paso8edit(){
        $marcas = Marca::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();

        $identificador = request('id');
        $vehiculo_id = request('v');
        $lesionados = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->lesionados()->where('id',$vehiculo_id)->firstOrFail();

        return view('siniestros.denuncia-asegurados-paso8-editar',["lesionados"=>$lesionados,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets]);
    }

    public function paso8update()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $vehiculo_id = request('v');
        $lesionados = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->lesionados()->where('id',$vehiculo_id)->firstOrFail();

        $lesionados->update([
            "carga_paso_8_lesionado_nombre" => request('lesionado_nombre'),
            "carga_paso_8_lesionado_telefono" => request('lesionado_telefono'),
            "carga_paso_8_lesionado_documento_id" => request('lesionado_documento_id'),
            "carga_paso_8_lesionado_documento_numero" => request('lesionado_documento_numero'),
            "carga_paso_8_lesionado_codigo_postal" => request('lesionado_codigo_postal'),
            "carga_paso_8_lesionado_domicilio" => request('lesionado_domicilio'),
            "carga_paso_8_lesionado_estado_civil" => request('lesionado_estado_civil'),
            "carga_paso_8_lesionado_fecha_nacimiento" => request('lesionado_fecha_nacimiento'),
            "carga_paso_8_lesionado_relacion" => request('lesionado_relacion'),
            "carga_paso_8_lesionado_conductor" => request('lesionado_conductor'),
            "carga_paso_8_lesionado_pasajero_otro" => request('lesionado_pasajero_otro'),
            "carga_paso_8_lesionado_peaton" => request('lesionado_peaton'),
            "carga_paso_8_lesionado_pasajero_asegurado" => request('lesionado_pasajero_asegurado'),
            "carga_paso_8_lesionado_leve" => request('lesionado_leve'),
            "carga_paso_8_lesionado_grave" => request('lesionado_grave'),
            "carga_paso_8_lesionado_mortal" => request('lesionado_mortal'),
            "carga_paso_8_lesionado_alcoholemia_si" => request('lesionado_alcoholemia_si'),
            "carga_paso_8_lesionado_alcoholemia_no" => request('lesionado_alcoholemia_no'),
            "carga_paso_8_lesionado_alcoholemia_nego" => request('lesionado_alcoholemia_nego'),
            "carga_paso_8_lesionado_centro_asistencial" => request('lesionado_centro_asistencial')
        ]);

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $identificador]);
    }



    public function paso7create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        return view('siniestros.denuncia-asegurados-paso7',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas]);
    }

    public function paso7store()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $denuncia_siniestro->carga_paso_7_danios_si=request('danio_si');
        $denuncia_siniestro->carga_paso_7_danios_no=request('danio_no');

        if($denuncia_siniestro->state < "7"){
            $denuncia_siniestro->state='7';
        }

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $identificador]);
    }

    public function paso7agregarcreate()
    {
        $marcas = Marca::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $modelos = null;

        if($denuncia_siniestro->vehiculo != null && $denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id !=null){
            $modelos = Modelo::where('marca_id',$denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id)->get();
        }else{
            $modelos = Modelo::where('marca_id','1')->get();

        }

        return view('siniestros.denuncia-asegurados-paso7-agregar',["denuncia_siniestro"=>$denuncia_siniestro,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets,"marcas"=>$marcas,"modelos"=>$modelos]);
    }

    public function paso7agregarstore()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $denuncia_siniestro->danioMateriales()->updateOrCreate([
            "carga_paso_7_danio_materiales_detalles" => request('danio_detalles'),
            "carga_paso_7_danio_materiales_nombre" => request('propietario_nombre'),
            "carga_paso_7_danio_materiales_documento_id" => request('propietario_documento_id'),
            "carga_paso_7_danio_materiales_documento_numero" => request('propietario_documento_numero'),
            "carga_paso_7_danio_materiales_codigo_postal" => request('propietario_codigo_postal'),
            "carga_paso_7_danio_materiales_domicilio" => request('propietario_domicilio')
        ]);

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $identificador]);
    }

    public function paso7DeleteItem()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $danio_materiales_id = request('v');
        $danio_materiales = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->danioMateriales()->where('id',$danio_materiales_id)->firstOrFail();
        $danio_materiales->delete();
        return redirect()->route("asegurados-denuncias-paso7.create",['id'=> $identificador]);
    }

    public function paso8create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        return view('siniestros.denuncia-asegurados-paso8',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas]);
    }

    public function paso8store()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $denuncia_siniestro->carga_paso_8_lesionados_si=request('lesionados_si');
        $denuncia_siniestro->carga_paso_8_lesionados_no=request('lesionados_no');

        if($denuncia_siniestro->state < "8"){
            $denuncia_siniestro->state='8';
        }

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso9.create",['id'=> $identificador]);
    }

    public function paso8agregarcreate()
    {
        $marcas = Marca::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $tipoCarnets = TipoCarnet::all();

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $modelos = null;

        if($denuncia_siniestro->vehiculo != null && $denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id !=null){
            $modelos = Modelo::where('marca_id',$denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id)->get();
        }else{
            $modelos = Modelo::where('marca_id','1')->get();

        }

        return view('siniestros.denuncia-asegurados-paso8-agregar',["denuncia_siniestro"=>$denuncia_siniestro,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"tipo_carnets"=>$tipoCarnets,"marcas"=>$marcas,"modelos"=>$modelos]);
    }

    public function paso8agregarstore()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $denuncia_siniestro->lesionados()->updateOrCreate([
            "carga_paso_8_lesionado_nombre" => request('lesionado_nombre'),
            "carga_paso_8_lesionado_telefono" => request('lesionado_telefono'),
            "carga_paso_8_lesionado_documento_id" => request('lesionado_documento_id'),
            "carga_paso_8_lesionado_documento_numero" => request('lesionado_documento_numero'),
            "carga_paso_8_lesionado_codigo_postal" => request('lesionado_codigo_postal'),
            "carga_paso_8_lesionado_domicilio" => request('lesionado_domicilio'),
            "carga_paso_8_lesionado_estado_civil" => request('lesionado_estado_civil'),
            "carga_paso_8_lesionado_fecha_nacimiento" => request('lesionado_fecha_nacimiento'),
            "carga_paso_8_lesionado_relacion" => request('lesionado_relacion'),
            "carga_paso_8_lesionado_conductor" => request('lesionado_conductor'),
            "carga_paso_8_lesionado_pasajero_otro" => request('lesionado_pasajero_otro'),
            "carga_paso_8_lesionado_peaton" => request('lesionado_peaton'),
            "carga_paso_8_lesionado_pasajero_asegurado" => request('lesionado_pasajero_asegurado'),
            "carga_paso_8_lesionado_leve" => request('lesionado_leve'),
            "carga_paso_8_lesionado_grave" => request('lesionado_grave'),
            "carga_paso_8_lesionado_mortal" => request('lesionado_mortal'),
            "carga_paso_8_lesionado_alcoholemia_si" => request('lesionado_alcoholemia_si'),
            "carga_paso_8_lesionado_alcoholemia_no" => request('lesionado_alcoholemia_no'),
            "carga_paso_8_lesionado_alcoholemia_nego" => request('lesionado_alcoholemia_nego'),
            "carga_paso_8_lesionado_centro_asistencial" => request('lesionado_centro_asistencial')
        ]);

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $identificador]);
    }

    public function paso8DeleteItem()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $lesionado_id = request('v');
        $lesionado = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail()->lesionados()->where('id',$lesionado_id)->firstOrFail();
        $lesionado->delete();
        return redirect()->route("asegurados-denuncias-paso8.create",['id'=> $identificador]);
    }

    public function paso9create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        return view('siniestros.denuncia-asegurados-paso9',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas]);
    }

    public function paso9store()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $denuncia_siniestro->carga_paso_9_tipo_accidente_frontal=request('tipo_accidente_frontal');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_posterior=request('tipo_accidente_posterior');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_cadena=request('tipo_accidente_cadena');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_lateral=request('tipo_accidente_lateral');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_vuelco=request('tipo_accidente_vuelco');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_desplaza=request('tipo_accidente_desplaza');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_incendio=request('tipo_accidente_incendio');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_inmersion=request('tipo_accidente_inmersion');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_explosion=request('tipo_accidente_explosion');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_carga=request('tipo_accidente_carga');
        $denuncia_siniestro->carga_paso_9_tipo_accidente_otros=request('tipo_accidente_otros');
        $denuncia_siniestro->carga_paso_9_lugar_autopista=request('lugar_autopista');
        $denuncia_siniestro->carga_paso_9_lugar_calle=request('lugar_calle');
        $denuncia_siniestro->carga_paso_9_lugar_avenida=request('lugar_avenida');
        $denuncia_siniestro->carga_paso_9_lugar_curva=request('lugar_curva');
        $denuncia_siniestro->carga_paso_9_lugar_pendiente=request('lugar_pendiente');
        $denuncia_siniestro->carga_paso_9_lugar_tunel=request('lugar_tunel');
        $denuncia_siniestro->carga_paso_9_lugar_sobrepuente=request('lugar_sobrepuente');
        $denuncia_siniestro->carga_paso_9_lugar_otros=request('lugar_otros');
        $denuncia_siniestro->carga_paso_9_colision_peaton=request('colision_peaton');
        $denuncia_siniestro->carga_paso_9_colision_vehiculo=request('colision_vehiculo');
        $denuncia_siniestro->carga_paso_9_colision_edificio=request('colision_edificio');
        $denuncia_siniestro->carga_paso_9_colision_columna=request('colision_columna');
        $denuncia_siniestro->carga_paso_9_colision_animal=request('colision_animal');
        $denuncia_siniestro->carga_paso_9_colision_transporte=request('colision_transporte');
        $denuncia_siniestro->carga_paso_9_colision_otros=request('colision_otros');

        if($denuncia_siniestro->state < "9"){
            $denuncia_siniestro->state='9';
        }

        $denuncia_siniestro->save();


        return redirect()->route("asegurados-denuncias-paso10.create",['id'=> $identificador]);
        //return redirect()->route("asegurados-denuncias-paso9.create",['id'=> $identificador]);
    }

    public function paso10create()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();


        return view('siniestros.denuncia-asegurados-paso10',["denuncia_siniestro"=>$denuncia_siniestro]);

    }

    public function paso10store(Request $request)
    {

        $identificador = request('id');


        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        $detalle_siniestro = DetalleSiniestro::where('denuncia_siniestro_id', $denuncia_siniestro->id)->first();


        if ($detalle_siniestro !== null) {
            $url = $this->uploadGrafico($request);
            if($url == 'error') {
                return back()->withErrors(['tamaño_maximo' => 'Maximo 50 MB de archivo! ']);
            }
            $detalle_siniestro->update([
                "carga_paso_10_comisaria" => request('comisaria'),
                "carga_paso_10_acta" => request('acta'),
                "carga_paso_10_juzgado" => request('juzgado'),
                "carga_paso_10_folio" => request('folio'),
                "carga_paso_10_secretaria" => request('secretaria'),
                "carga_paso_10_sumario" => request('sumario'),
                "carga_paso_10_descripcion" => request('description'),
                'carga_paso_10_url_detalle' => $url !=  null ? $url : $detalle_siniestro->carga_paso_10_url_detalle,
            ]);
        } else {
            $url_detalle = $this->uploadGrafico($request);

            if($url_detalle == 'error') {
                return back()->withErrors(['tamaño_maximo' => 'Maximo 50 MB de archivo! ']);
            }
            DetalleSiniestro::create([
                "carga_paso_10_comisaria" => request('comisaria'),
                "carga_paso_10_acta" => request('acta'),
                "carga_paso_10_juzgado" => request('juzgado'),
                "carga_paso_10_folio" => request('folio'),
                "carga_paso_10_secretaria" => request('secretaria'),
                "carga_paso_10_sumario" => request('sumario'),
                "carga_paso_10_descripcion" => request('description'),
                'carga_paso_10_url_detalle' => $url_detalle,
                'denuncia_siniestro_id' => $denuncia_siniestro->id
            ]);
        }




        if($denuncia_siniestro->state < "10"){
            $denuncia_siniestro->state='10';
        }


        // $photo = [];

        // try {
        //     $photo = json_decode($request->graficoManual, true);
        // } catch(\Exception $e) {
        //     \Log::error($e);
        // }

        //     if(isset($photo['filename']) && isset($photo['originalName'])) {

        //        $denuncia_siniestro->detalleSiniestro->carga_paso_10_url_detalle = $photo['filename'];
        // }
        $denuncia_siniestro->save();


        return redirect()->route("asegurados-denuncias-paso11.create",['id'=> $identificador]);
    }

    private function checkIfRedirect(){
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        return $denuncia_siniestro->state;
    }

    public function setDibujo(Request $request)
    {
        session(['grafico'.Auth::id() => $request->grafico]);
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

    public function paso11create()
    {
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();
        return view('siniestros.denuncia-asegurados-paso11',["denuncia_siniestro"=>$denuncia_siniestro, 'identificador' => $identificador]);

    }

    public function paso12create()
    {
        $provincias = Province::all();
        $tipoCalzadas = TipoCalzada::all();
        $tipoDocumentos = TipoDocumento::all();
        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $localidades = null;

        if($denuncia_siniestro->conductor != null && $denuncia_siniestro->conductor->carga_paso_12_provincia_id !=null){
            $localidades = City::where('province_id',$denuncia_siniestro->conductor->carga_paso_12_provincia_id)->get();
        }else{
            $localidades = City::where('province_id','1')->get();
        }

        return view('siniestros.denuncia-asegurados-paso12',["denuncia_siniestro"=>$denuncia_siniestro,"provincias"=>$provincias,"tipo_calzadas"=>$tipoCalzadas,"tipo_documentos"=>$tipoDocumentos,"localidades"=>$localidades]);
    }

    public function paso12store()
    {
        $validated = request()->validate([
            'nombre'=>'required',
            'telefono'=>'required',
            'domicilio'=>'required',
            'codigo_postal'=>'required',
            'fecha'=>'required',
            'documento_numero'=>'required',
            'asegurado_si'=>'required_without:asegurado_no',
            'asegurado_no'=>'required_without:asegurado_si',
            'asegurado_relacion'=>'required_with:asegurado_no',
            'hora'=>'required',
            'lugar' => 'required'
        ]);

        $identificador = request('id');
        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$identificador)->firstOrFail();

        $denuncia_siniestro->denunciante()->updateOrCreate([
            "carga_paso_12_nombre" => request('nombre'),
            "carga_paso_12_telefono" => request('telefono'),
            "carga_paso_12_domicilio" => request('domicilio'),
            "carga_paso_12_codigo_postal" => request('codigo_postal'),
            "carga_paso_12_provincia_id" => request('provincia_id'),
            "carga_paso_12_localidad_id" => request('localidad_id'),
            "carga_paso_12_fecha" => request('fecha'),
            "carga_paso_12_documento_id" => request('documento_id'),
            "carga_paso_12_documento_numero" => request('documento_numero'),
            "carga_paso_12_asegurado_si" => request('asegurado_si'),
            "carga_paso_12_asegurado_no" => request('asegurado_no'),
            "carga_paso_12_asegurado_relacion" => request('asegurado_relacion'),
            "carga_paso_12_hora" => request('hora'),
            "carga_paso_12_lugar" => request('lugar')
        ]);


        if($denuncia_siniestro->state < "12"){
            $denuncia_siniestro->state='12';
        }
        $denuncia_siniestro->save();
        return redirect()->route('gracias-denuncia');
    }




}
