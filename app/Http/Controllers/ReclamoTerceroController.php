<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\DenunciaSiniestro;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Province;
use App\Models\ReclamoTercero;
use App\Models\TipoCalzada;
use App\Models\TipoDocumento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReclamoTerceroController extends Controller
{

    public function paso1create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id', $reclamo->vehiculo_asegurado_marca_id != null ? $reclamo->vehiculo_asegurado_marca_id : $marcas->first()->id)->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 1,
            'marcas' => $marcas,
            'modelos' => $modelos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso1store(Request $request)
    {
        $rules = [
            'nombre' => 'nullable',
            'vehiculo_dominio' => 'required',
            'marca_id' => 'nullable',
            'marca' => 'nullable',
            'modelo_id' => 'nullable',
            'modelo' => 'nullable'
        ];
        Validator::make($request->all(),$rules)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        $reclamo->asegurado_nombre = $request->nombre;
        $reclamo->vehiculo_asegurado_marca_id = !$request->otra_marca ? $request->marca_id : null;
        $reclamo->vehiculo_asegurado_otra_marca = $request->otra_marca ? $request->marca : null;
        $reclamo->vehiculo_asegurado_modelo_id = !$request->otro_modelo ? $request->modelo_id : null;
        $reclamo->vehiculo_asegurado_otro_modelo = $request->otro_modelo ? $request->modelo : null;

        if($reclamo->estado_carga === 'precarga')
        {
            $reclamo->estado_carga = '1';
        }
        $reclamo->save();

        return redirect()->route("siniestros.terceros.paso2.create",['id'=> $request->id]);
    }

    public function paso2create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id', $reclamo->vehiculo && $reclamo->vehiculo->marca_id ? $reclamo->vehiculo->marca_id : $marcas->first()->id)->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 2,
            'marcas' => $marcas,
            'modelos' => $modelos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso2store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'vehiculo' => 'required',
            'marca_id' => 'required_if:vehiculo,1',
            'marca' => 'required_with:otra_marca',
            'modelo_id' => 'required_if:vehiculo,1',
            'modelo' => 'required_with:otro_modelo',
            'vehiculo_tipo' => 'required_if:vehiculo,1',
            'vehiculo_anio' => 'required_if:vehiculo,1',
            'vehiculo_dominio' => 'required_if:vehiculo,1',
            'compania_seguros' => 'required_if:vehiculo,1',
            'numero_poliza' => 'required_if:vehiculo,1',
            'tipo_cobertura' => 'required_if:vehiculo,1',
            'franquicia' => 'required_if:vehiculo,1'
        ];
        $messages = [
            'marca.required_with' => 'El campo marca es obligatorio.',
            'modelo.required_with' => 'El campo modelo es obligatorio.',
            'vehiculo_tipo.required_if' => 'El campo tipo de vehículo es obligatorio.',
            'vehiculo_anio.required_if' => 'El campo año de vehículo es obligatorio.',
            'vehiculo_dominio.required_if' => 'El campo dominio del vehículo es obligatorio.',
            'compania_seguro.required_if' => 'El campo compañía de seguro es obligatorio.',
            'numero_poliza.required_if' => 'El campo número de póliza es obligatorio.',
            'tipo_cobertura.required_if' => 'El campo tipo de cobertura es obligatorio.',
            'franquicia.required_if' => 'El campo franquicia es obligatorio.'
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if($request->vehiculo === '1')
        {
            if(!$reclamo->vehiculo)
            {
                $reclamo->vehiculo()->create([
                    'dominio' => strtoupper($request->vehiculo_dominio),
                    'tipo' => $request->vehiculo_tipo,
                    'anio' => $request->vehiculo_anio,
                    'marca_id' => !$request->otra_marca ? $request->marca_id : null,
                    'modelo_id' => !$request->otro_modelo ? $request->modelo_id : null,
                    'otra_marca' => $request->otra_marca ? $request->marca : null,
                    'otro_modelo' => $request->otro_modelo ? $request->modelo : null,
                    'compania_seguros' => $request->compania_seguros,
                    'numero_poliza' => $request->numero_poliza,
                    'tipo_cobertura' => $request->tipo_cobertura,
                    'franquicia' => $request->franquicia,
                ]);
            } else {
                $reclamo->vehiculo->dominio = strtoupper($request->vehiculo_dominio);
                $reclamo->vehiculo->tipo = $request->vehiculo_tipo;
                $reclamo->vehiculo->anio = $request->vehiculo_anio;
                $reclamo->vehiculo->marca_id = !$request->otra_marca ? $request->marca_id : null;
                $reclamo->vehiculo->modelo_id = !$request->otro_modelo ? $request->modelo_id : null;
                $reclamo->vehiculo->otra_marca = $request->otra_marca ? $request->marca : null;
                $reclamo->vehiculo->otro_modelo = $request->otro_modelo ? $request->modelo : null;
                $reclamo->vehiculo->compania_seguros = $request->compania_seguros;
                $reclamo->vehiculo->numero_poliza = $request->numero_poliza;
                $reclamo->vehiculo->tipo_cobertura = $request->tipo_cobertura;
                $reclamo->vehiculo->franquicia = $request->franquicia;
                $reclamo->vehiculo->save();
            }
            $reclamo->dominio_vehiculo_tercero = strtoupper($request->vehiculo_dominio);
            $reclamo->reclamo_vehicular = true;

        } else {
            $reclamo->dominio_vehiculo_tercero = null;
            $reclamo->reclamo_vehicular = false;

            if($reclamo->vehiculo)
            {
                $reclamo->vehiculo->delete();
            }
        }

        if($reclamo->estado_carga === '1')
        {
            $reclamo->estado_carga = $request->vehiculo ? '2' : '3';
        }
        $reclamo->save();

        $nextroute =  $request->vehiculo ? 'siniestros.terceros.paso3.create' : 'siniestros.terceros.paso4.create';
        return redirect()->route($nextroute, ['id'=> $request->id]);
    }


    public function paso3create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $tiposDocumentos = TipoDocumento::all();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->vehiculo->conductor_province_id != null ? $reclamo->vehiculo->conductor_province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 3,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso3store(Request $request)
    {
        $rules = [
            'reclamante_conductor' => 'required',
            'nombre' => 'required_if:reclamante_conductor,0',
            'tipo_documento_id' => 'required_if:reclamante_conductor,0',
            'documento_numero' => 'required_if:reclamante_conductor,0',
            'telefono' => 'required_if:reclamante_conductor,0',
            'domicilio' => 'required_if:reclamante_conductor,0',
            'codigo_postal' => 'required_if:reclamante_conductor,0',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad' => 'required_with:check_otra_localidad',
            'licencia_numero' => 'required',
            'licencia_clase' => 'required',
        ];
        $messages = [
            'nombre.required_if' => 'El campo nombre completo es obligatorio.',
            'tipo_documento_id.required_if' => 'El campo tipo de documento es obligatorio.',
            'documento_numero.required_if' => 'El campo número de documento es obligatorio.',
            'telefono.required_if' => 'El campo teléfono es obligatorio.',
            'domicilio.required_if' => 'El campo domicilio es obligatorio.',
            'codigo_postal.required_if' => 'El campo código postal es obligatorio.',
            'otro_pais_provincia_localidad.required_if' => 'El campo otro país, provincia y localidad es obligatorio.',
            'otra_localidad.required_with' => 'El campo otra localidad es obligatorio.'
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        $reclamo->vehiculo->reclamante_conductor = $request->reclamante_conductor;
        $reclamo->vehiculo->conductor_nombre = $request->reclamante_conductor == '0' ? $request->nombre : null;
        $reclamo->vehiculo->conductor_telefono = $request->reclamante_conductor == '0' ? $request->telefono : null;
        $reclamo->vehiculo->conductor_tipo_documento_id = $request->reclamante_conductor == '0' ? $request->tipo_documento_id : null;
        $reclamo->vehiculo->conductor_documento_numero = $request->reclamante_conductor == '0' ? $request->documento_numero : null;
        $reclamo->vehiculo->conductor_domicilio = $request->reclamante_conductor == '0' ? $request->domicilio : null;
        $reclamo->vehiculo->conductor_codigo_postal = $request->reclamante_conductor == '0' ? $request->codigo_postal : null;
        $reclamo->vehiculo->conductor_pais_id = $request->reclamante_conductor == '0' ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null) : null;
        $reclamo->vehiculo->conductor_province_id = $request->reclamante_conductor == '0' ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null) : null;
        $reclamo->vehiculo->conductor_city_id = $request->reclamante_conductor == '0' ? ($request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id) : null;
        $reclamo->vehiculo->conductor_otro_pais_provincia_localidad = $request->reclamante_conductor == '0' ? ($request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null )) : null;
        $reclamo->vehiculo->licencia_numero = $request->licencia_numero;
        $reclamo->vehiculo->licencia_clase = $request->licencia_clase;
        $reclamo->vehiculo->save();

        if($reclamo->estado_carga === '2')
        {
            $reclamo->estado_carga = '3';
            $reclamo->save();
        }

        return redirect()->route('siniestros.terceros.paso4.create', ['id'=> $request->id]);
    }

    public function paso4create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id', $reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->marca_id ? $reclamo->vehiculoAsegurado->marca_id : $marcas->first()->id)->get();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_province_id != null ? $reclamo->vehiculoAsegurado->conductor_province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();
        $tiposDocumentos = TipoDocumento::all();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 4,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso4store(Request $request)
    {
        $rules = [
            'marca_id' => 'required',
            'marca' => 'required_with:otra_marca',
            'modelo_id' => 'required',
            'modelo' => 'required_with:otro_modelo',
            'vehiculo_tipo' => 'required',
            'vehiculo_anio' => 'required',
            'vehiculo_dominio' => 'required',
        ];
        $messages = [
            'marca.required_with' => 'El campo marca es obligatorio.',
            'modelo.required_with' => 'El campo modelo es obligatorio.',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if(!$reclamo->vehiculoAsegurado)
        {
            $reclamo->vehiculoAsegurado()->create([
                'dominio' => $reclamo->dominio_vehiculo_asegurado,
                'tipo' => $request->vehiculo_tipo,
                'anio' => $request->vehiculo_anio,
                'marca_id' => !$request->otra_marca ? $request->marca_id : null,
                'modelo_id' => !$request->otro_modelo ? $request->modelo_id : null,
                'otra_marca' => $request->otra_marca ? $request->marca : null,
                'otro_modelo' => $request->otro_modelo ? $request->modelo : null,
                'conductor_nombre' => $request->nombre ? $request->nombre : null,
                'conductor_telefono' => $request->telefono ? $request->telefono : null,
                'conductor_tipo_documento_id' => $request->documento_numero ? $request->tipo_documento_id : null,
                'conductor_documento_numero' => $request->documento_numero ? $request->documento_numero : null,
                'conductor_domicilio' => $request->domicilio ? $request->domicilio : null,
                'conductor_codigo_postal' => $request->codigo_postal ? $request->codigo_postal : null,
                'conductor_pais_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null,
                'conductor_province_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null,
                'conductor_city_id' => $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id,
                'conductor_otro_pais_provincia_localidad' => $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null ),
                'propietario_conductor' => $request->propietario_conductor
            ]);
        } else {
            $reclamo->vehiculoAsegurado->dominio = $reclamo->dominio_vehiculo_asegurado;
            $reclamo->vehiculoAsegurado->tipo = $request->vehiculo_tipo;
            $reclamo->vehiculoAsegurado->anio = $request->vehiculo_anio;
            $reclamo->vehiculoAsegurado->marca_id = !$request->otra_marca ? $request->marca_id : null;
            $reclamo->vehiculoAsegurado->modelo_id = !$request->otro_modelo ? $request->modelo_id : null;
            $reclamo->vehiculoAsegurado->otra_marca = $request->otra_marca ? $request->marca : null;
            $reclamo->vehiculoAsegurado->otro_modelo = $request->otro_modelo ? $request->modelo : null;
            $reclamo->vehiculoAsegurado->conductor_nombre = $request->nombre ? $request->nombre : null;
            $reclamo->vehiculoAsegurado->conductor_telefono = $request->telefono ? $request->telefono : null;
            $reclamo->vehiculoAsegurado->conductor_tipo_documento_id = $request->documento_numero ? $request->tipo_documento_id : null;
            $reclamo->vehiculoAsegurado->conductor_documento_numero = $request->documento_numero ? $request->documento_numero : null;
            $reclamo->vehiculoAsegurado->conductor_domicilio = $request->domicilio ? $request->domicilio : null;
            $reclamo->vehiculoAsegurado->conductor_codigo_postal = $request->codigo_postal ? $request->codigo_postal : null;
            $reclamo->vehiculoAsegurado->conductor_pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
            $reclamo->vehiculoAsegurado->conductor_province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
            $reclamo->vehiculoAsegurado->conductor_city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
            $reclamo->vehiculoAsegurado->conductor_otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
            $reclamo->vehiculoAsegurado->propietario_conductor = $request->propietario_conductor;
            $reclamo->vehiculoAsegurado->save();
        }

        if($request->propietario_conductor === '1')
        {
            $reclamo->load('vehiculoAsegurado');
            $reclamo->vehiculoAsegurado->propietario_nombre = $reclamo->vehiculoAsegurado->conductor_nombre;
            $reclamo->vehiculoAsegurado->propietario_telefono = $reclamo->vehiculoAsegurado->conductor_telefono;
            $reclamo->vehiculoAsegurado->propietario_tipo_documento_id = $reclamo->vehiculoAsegurado->conductor_tipo_documento_id;
            $reclamo->vehiculoAsegurado->propietario_documento_numero = $reclamo->vehiculoAsegurado->conductor_documento_numero;
            $reclamo->vehiculoAsegurado->propietario_domicilio = $reclamo->vehiculoAsegurado->conductor_domicilio;
            $reclamo->vehiculoAsegurado->propietario_codigo_postal = $reclamo->vehiculoAsegurado->conductor_codigo_postal;
            $reclamo->vehiculoAsegurado->propietario_pais_id = $reclamo->vehiculoAsegurado->conductor_pais_id;
            $reclamo->vehiculoAsegurado->propietario_province_id = $reclamo->vehiculoAsegurado->conductor_province_id;
            $reclamo->vehiculoAsegurado->propietario_city_id = $reclamo->vehiculoAsegurado->conductor_city_id;
            $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad = $reclamo->vehiculoAsegurado->conductor_otro_pais_provincia_localidad;
            $reclamo->vehiculoAsegurado->save();
        }

        if($reclamo->estado_carga === '3')
        {
            $reclamo->estado_carga = '4';
            $reclamo->save();
        }

        return redirect()->route('siniestros.terceros.paso5.create', ['id'=> $request->id]);
    }

    public function paso5create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_province_id != null ? $reclamo->vehiculoAsegurado->propietario_province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();
        $tiposDocumentos = TipoDocumento::all();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 5,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso5store(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        $reclamo->vehiculoAsegurado->propietario_nombre = $request->nombre ? $request->nombre : null;
        $reclamo->vehiculoAsegurado->propietario_telefono = $request->telefono ? $request->telefono : null;
        $reclamo->vehiculoAsegurado->propietario_tipo_documento_id = $request->documento_numero ? $request->tipo_documento_id : null;
        $reclamo->vehiculoAsegurado->propietario_documento_numero = $request->documento_numero ? $request->documento_numero : null;
        $reclamo->vehiculoAsegurado->propietario_domicilio = $request->domicilio ? $request->domicilio : null;
        $reclamo->vehiculoAsegurado->propietario_codigo_postal = $request->codigo_postal ? $request->codigo_postal : null;
        $reclamo->vehiculoAsegurado->propietario_pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
        $reclamo->vehiculoAsegurado->propietario_province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
        $reclamo->vehiculoAsegurado->propietario_city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
        $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
        $reclamo->vehiculoAsegurado->save();

        if($reclamo->estado_carga === '4')
        {
            $reclamo->estado_carga = '5';
            $reclamo->save();
        }

        return redirect()->route('siniestros.terceros.paso6.create', ['id'=> $request->id]);
    }

    public function paso6create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->province_id != null ? $reclamo->province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();
        $tipoCalzadas = TipoCalzada::all();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 6,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_calzadas' => $tipoCalzadas
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso6store(Request $request)
    {

        $rules = [
            'pais' => 'required',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
            'calle'=>'required',
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        $reclamo->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null ;
        $reclamo->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
        $reclamo->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
        $reclamo->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
        $reclamo->calle = $request->calle;
        $reclamo->tipo_calzada_id = $request->calzada_id;
        $reclamo->calzada_detalle = $request->calzada_detalle;
        $reclamo->interseccion = $request->interseccion;
        $reclamo->cruce_senalizado = $request->cruce_senalizado ==  'on';
        $reclamo->tren = $request->tren;
        $reclamo->semaforo = $request->semaforo ==  'on';
        $reclamo->semaforo_funciona = $request->semaforo_funciona ==  'on';
        $reclamo->semaforo_intermitente = $request->semaforo_intermitente ==  'on';
        $reclamo->semaforo_color = $request->semaforo_color;

        if($reclamo->estado_carga == "5")
        {
            $reclamo->estado_carga = "6";
        }
        $reclamo->save();

        return redirect()->route('siniestros.terceros.paso7.create', ['id'=> $request->id]);
    }

    public function paso7create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 7
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso7store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'graficoManual' => 'nullable',
            'descripcion' => 'required'
        ]);
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        if(!$reclamo->croquis_url && !$request->hasFile('graficoManual') )
        {
            $validator->errors()->add('graficoManual', 'Debe crear un croquis o cargar una imagen.');
            return redirect()->route("siniestros.terceros.paso5.create",['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('graficoManual'))
        {
            if($reclamo->croquis_url)
            {
                Storage::disk('s3')->delete($reclamo->croquis_path);
            }

            $format = 'jpg';
            $filePath = $this->getCroquisPath($reclamo, $format);

            $imgFile = Image::make($request->file('graficoManual'));

            if($imgFile->width() > 2100)
            {
                $imgFile->widen(2100);
            }

            Storage::disk('s3')->put($filePath, $imgFile->stream($format), 'public');
            $url = Storage::disk('s3')->url($filePath);

            if($url)
            {
                $reclamo->croquis_url = $url;
                $reclamo->croquis_path = $filePath;
                $reclamo->save();
            }
        }

        $reclamo->descripcion = $reclamo->descripcion."\n".$request->descripcion;
        $reclamo->comisaria = $request->comisaria;
        $reclamo->testigos = $request->testigos;
        $reclamo->monto_vehicular = $request->monto_vehicular;
        $reclamo->monto_danios_materiales = $request->monto_danios_materiales;
        $reclamo->monto_lesiones = $request->monto_lesiones;

        if($reclamo->estado_carga == '6')
        {
            $reclamo->estado_carga = '7';
        }
        $reclamo->save();

        return redirect()->route('siniestros.terceros.paso8.create', ['id'=> $request->id]);
    }

    public function paso8create(Request $request)
    {
        dd('Paso 8 Create');
    }

    public function pasoostore(Request $request)
    {
        dd('Paso 8 Store');
    }

    public function storeCroquis(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|exists:reclamo_terceros',
            'croquis' => 'required'
        ])->validate();

        $reclamo = ReclamoTercero::findOrFail($request->id);

        if($reclamo->croquis_url)
        {
            Storage::disk('s3')->delete($reclamo->croquis_path);
        }

        $filePath = $this->getCroquisPath($reclamo);
        Storage::disk('s3')->put($filePath, file_get_contents($request->croquis),'public');
        $url = Storage::disk('s3')->url($filePath);

        if($url)
        {
            $reclamo->croquis_url = $url;
            $reclamo->croquis_path = $filePath;
            $reclamo->save();
        }

        return response()->json([ 'status' => true]);
    }

    private function getCroquisPath(ReclamoTercero $reclamo, $format = 'jpg')
    {
        return 'reclamo_tercero/'.$reclamo->id.'/croquis_'.Carbon::now()->format('Ymd_His').'.'.$format;
    }
}
