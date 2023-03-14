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
        if($request->noredirect == null)
        {
            $paso = $this->checkIfRedirect($reclamo);
            if($paso != '1' && $paso != 'precarga')
            {
                $routeredirect = "siniestros.terceros.paso$paso.create";
                return redirect()->route($routeredirect, ['id' => $request->id]);
            }
        }
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
        $reclamo->vehiculo_asegurado_nro_poliza = $request->numero_poliza;
        $reclamo->vehiculo_asegurado_marca_id = !$request->otra_marca ? $request->marca_id : null;
        $reclamo->vehiculo_asegurado_otra_marca = $request->otra_marca ? $request->marca : null;
        $reclamo->vehiculo_asegurado_modelo_id = !$request->otro_modelo ? $request->modelo_id : null;
        $reclamo->vehiculo_asegurado_otro_modelo = $request->otro_modelo ? $request->modelo : null;

        if($reclamo->estado_carga === 'precarga')
        {
            $reclamo->estado_carga = '1';
        }
        $reclamo->save();

        return redirect()->route('siniestros.terceros.paso2.create',['id'=> $request->id]);
    }

    public function paso2create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $tiposDocumentos = TipoDocumento::all();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = old('provincia_id') ? old('provincia_id') : ($reclamo->reclamante && $reclamo->reclamante->province_id != null ? $reclamo->reclamante->province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 2,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso2store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'documento_numero' => 'required',
            'domicilio' => 'required',
            'codigo_postal' => 'required',
            'pais' => 'required',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
            'telefono' => 'required',
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if(!$reclamo->reclamante)
        {
            $reclamo->reclamante()->create([
                'nombre' => $request->nombre,
                'tipo_documento_id' => $request->tipo_documento_id,
                'documento_numero' => $request->documento_numero,
                'domicilio' => $request->domicilio,
                'codigo_postal' => $request->codigo_postal,
                'pais_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null,
                'province_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null,
                'city_id' => $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id,
                'otro_pais_provincia_localidad' => $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null ),
                'ocupacion' => $request->ocupacion,
                'telefono' => $request->telefono
            ]);
        } else {
            $reclamo->reclamante->nombre = $request->nombre;
            $reclamo->reclamante->tipo_documento_id = $request->tipo_documento_id;
            $reclamo->reclamante->documento_numero = $request->documento_numero;
            $reclamo->reclamante->domicilio = $request->domicilio;
            $reclamo->reclamante->codigo_postal = $request->codigo_postal;
            $reclamo->reclamante->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
            $reclamo->reclamante->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
            $reclamo->reclamante->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
            $reclamo->reclamante->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );

            $reclamo->reclamante->telefono = $request->telefono;
            $reclamo->reclamante->save();
        }

        if($reclamo->estado_carga === '1')
        {
            $reclamo->estado_carga = '2';
            $reclamo->save();
        }

        return redirect()->route("siniestros.terceros.paso3.create",['id'=> $request->id]);
    }

    public function paso3create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id', $reclamo->vehiculo && $reclamo->vehiculo->marca_id ? $reclamo->vehiculo->marca_id : $marcas->first()->id)->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 3,
            'marcas' => $marcas,
            'modelos' => $modelos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso3store(Request $request)
    {
        $rules = [
            'reclamo_vehicular' => 'required',
            'marca_id' => 'required_if:reclamo_vehicular,1',
            'marca' => 'required_with:otra_marca',
            'modelo_id' => 'required_if:reclamo_vehicular,1',
            'modelo' => 'required_with:otro_modelo',
            'vehiculo_tipo' => 'required_if:reclamo_vehicular,1',
            'vehiculo_anio' => 'required_if:reclamo_vehicular,1',
            'vehiculo_dominio' => 'required_if:reclamo_vehicular,1',
            'con_seguro' => 'required_if:reclamo_vehicular,1',
            'compania_seguros' => 'required_if:con_seguro,1',
            'numero_poliza' => 'required_if:con_seguro,1',
            'tipo_cobertura' => 'required_if:con_seguro,1',
            'franquicia' => 'required_if:con_seguro,1'
        ];
        $messages = [
            'marca.required_with' => 'El campo marca es obligatorio.',
            'modelo.required_with' => 'El campo modelo es obligatorio.',
            'vehiculo_tipo.required_if' => 'El campo tipo de vehículo es obligatorio.',
            'vehiculo_anio.required_if' => 'El campo año de vehículo es obligatorio.',
            'vehiculo_dominio.required_if' => 'El campo dominio del vehículo es obligatorio.',
            'con_seguro.required_if' => 'El campo seguro con cobertura es obligatorio.',
            'compania_seguros.required_if' => 'El campo compañía de seguro es obligatorio.',
            'numero_poliza.required_if' => 'El campo número de póliza es obligatorio.',
            'tipo_cobertura.required_if' => 'El campo tipo de cobertura es obligatorio.',
            'franquicia.required_if' => 'El campo franquicia es obligatorio.'
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if($reclamo->reclamo_vehicular)
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
                    'en_transferencia' => $request->en_transferencia == 'on',
                    'con_seguro' => $request->con_seguro,
                    'compania_seguros' => $request->con_seguro ? $request->compania_seguros : null,
                    'numero_poliza' => $request->con_seguro ? $request->numero_poliza : null,
                    'tipo_cobertura' => $request->con_seguro ? $request->tipo_cobertura : null,
                    'franquicia' => $request->con_seguro ? $request->franquicia : null
                ]);
            } else {
                $reclamo->vehiculo->dominio = strtoupper($request->vehiculo_dominio);
                $reclamo->vehiculo->tipo = $request->vehiculo_tipo;
                $reclamo->vehiculo->anio = $request->vehiculo_anio;
                $reclamo->vehiculo->marca_id = !$request->otra_marca ? $request->marca_id : null;
                $reclamo->vehiculo->modelo_id = !$request->otro_modelo ? $request->modelo_id : null;
                $reclamo->vehiculo->otra_marca = $request->otra_marca ? $request->marca : null;
                $reclamo->vehiculo->otro_modelo = $request->otro_modelo ? $request->modelo : null;
                $reclamo->vehiculo->en_transferencia = $request->en_transferencia == 'on';
                $reclamo->vehiculo->con_seguro = $request->con_seguro;
                $reclamo->vehiculo->compania_seguros = $request->con_seguro ? $request->compania_seguros : null;
                $reclamo->vehiculo->numero_poliza = $request->con_seguro ? $request->numero_poliza : null;
                $reclamo->vehiculo->tipo_cobertura = $request->con_seguro ? $request->tipo_cobertura : null;
                $reclamo->vehiculo->franquicia = $request->con_seguro ? $request->franquicia : null;
                $reclamo->vehiculo->save();
            }

        }

        if($reclamo->estado_carga === '2')
        {
            $reclamo->estado_carga = '3';
        }
        $reclamo->save();

        return redirect()->route('siniestros.terceros.paso4.create', ['id'=> $request->id]);
    }


    public function paso3createOld(Request $request)
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

    public function paso4create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->vehiculo && $reclamo->vehiculo->conductor_province_id != null ? $reclamo->vehiculo->conductor_province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();
        $tiposDocumentos = TipoDocumento::all();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 4,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso4store(Request $request)
    {
        $rules = [
            'reclamante_conductor' => 'required_if:reclamo_vehicular,1',
            'nombre' => 'required_if:reclamante_conductor,0',
            'tipo_documento_id' => 'required_if:reclamante_conductor,0',
            'documento_numero' => 'required_if:reclamante_conductor,0',
            'telefono' => 'required_if:reclamante_conductor,0',
            'domicilio' => 'required_if:reclamante_conductor,0',
            'codigo_postal' => 'required_if:reclamante_conductor,0',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad' => 'required_with:check_otra_localidad',
            'licencia_numero' => 'required_if:reclamo_vehicular,1',
            'licencia_clase' => 'required_if:reclamo_vehicular,1',
        ];
        $messages = [
            'reclamante_conductor.required_if' => 'El campo es obligatorio.',
            'nombre.required_if' => 'El campo nombre completo es obligatorio.',
            'tipo_documento_id.required_if' => 'El campo tipo de documento es obligatorio.',
            'documento_numero.required_if' => 'El campo número de documento es obligatorio.',
            'telefono.required_if' => 'El campo teléfono es obligatorio.',
            'domicilio.required_if' => 'El campo domicilio es obligatorio.',
            'codigo_postal.required_if' => 'El campo código postal es obligatorio.',
            'otro_pais_provincia_localidad.required_if' => 'El campo otro país, provincia y localidad es obligatorio.',
            'otra_localidad.required_with' => 'El campo otra localidad es obligatorio.',
            'licencia_numero.required_if' => 'El campo número de licencia es obligatorio.',
            'licencia_clase.required_if' => 'El campo clase de licencia es obligatorio.',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if($reclamo->reclamo_vehicular)
        {
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
        }

        if($reclamo->estado_carga === '3')
        {
            $reclamo->estado_carga = '4';
            $reclamo->save();
        }

        return redirect()->route('siniestros.terceros.paso5.create', ['id'=> $request->id]);
    }

    public function paso4storeOld(Request $request)
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
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->province_id != null ? $reclamo->province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();
        $tipoCalzadas = TipoCalzada::all();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 5,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_calzadas' => $tipoCalzadas
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso5store(Request $request)
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

        if($reclamo->estado_carga == "4")
        {
            $reclamo->estado_carga = "5";
        }
        $reclamo->save();

        return redirect()->route('siniestros.terceros.paso6.create', ['id'=> $request->id]);
    }

    public function paso6create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 6
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso6store(Request $request)
    {
        $rules = [
            'descripcion' => 'nullable',
            'graficoManual' => 'nullable',
            'monto_vehicular' => 'required_if:reclamo_vehicular,1',
            'monto_danios_materiales' => 'required_if:reclamo_danios_materiales,1',
            'monto_lesiones' => 'required_if:reclamo_lesiones,1'
        ];
        $messages = [
            'graficoManual.required_if' => 'Debe crear un croquis o cargar una imagen.',
            'monto_vehicular.required_if' => 'El campo monto por daño vehicular es requerido',
            'monto_danios_materiales.required_if' => 'El campo monto por daños materiales es requerido',
            'monto_lesiones.required_if' => 'El campo monto por lesiones es requerido',
        ];
        $validator = Validator::make($request->all(),$rules, $messages);
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        if(!$reclamo->croquis_url && !$request->hasFile('graficoManual') )
        {
            $validator->errors()->add('graficoManual', 'Debe crear un croquis o cargar una imagen.');
            return redirect()->route("siniestros.terceros.paso6.create",['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }
        $validator->validate();

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
        $reclamo->monto_vehicular = $request->monto_vehicular;
        $reclamo->monto_danios_materiales = $request->monto_danios_materiales;
        $reclamo->monto_lesiones = $request->monto_lesiones;

        if($reclamo->estado_carga == '5')
        {
            $reclamo->estado_carga = '6';
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
        $reclamo->load('testigos');
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso7store(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        if($reclamo->estado_carga == '6')
        {
            $reclamo->estado_carga = '7';
        }
        $reclamo->save();

        return redirect()->route('siniestros.terceros.paso8.create', ['id'=> $request->id]);
    }

    public function paso7testigoCreate(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $localidades = City::where('province_id', $provincias->first()->id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => '7-agregar',
            'provincias' => $provincias,
            'localidades' => $localidades,
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso7testigoStore(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'telefono' => 'required',
            'domicilio' => 'required',
            'pais' => 'required',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        $reclamo->testigos()->create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'domicilio' => $request->domicilio,
            'pais_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null,
            'province_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null,
            'city_id' => $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id,
            'otro_pais_provincia_localidad' => $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null )
        ]);

        return redirect()->route('siniestros.terceros.paso7.create', ['id'=> $request->id]);
    }

    public function paso7testigoEdit(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $testigo = $reclamo->testigos()->where('id',$request->testigo)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $testigo->province_id != null ? $testigo->province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => '7-editar',
            'testigo' => $testigo,
            'provincias' => $provincias,
            'localidades' => $localidades,
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso7testigoUpdate(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'telefono' => 'required',
            'domicilio' => 'required',
            'pais' => 'required',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $testigo = $reclamo->testigos()->where('id',$request->testigo)->firstOrFail();

        $testigo->nombre = $request->nombre;
        $testigo->telefono = $request->telefono;
        $testigo->domicilio = $request->domicilio;
        $testigo->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
        $testigo->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
        $testigo->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
        $testigo->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
        $testigo->save();

        return redirect()->route('siniestros.terceros.paso7.create', ['id'=> $request->id]);
    }

    public function paso7testigoDelete(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $testigo = $reclamo->testigos()->where('id',$request->testigo)->firstOrFail();

        $testigo->delete();

        return redirect()->route('siniestros.terceros.paso7.create', ['id'=> $request->id]);
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

    public function paso8create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $data = [
            'reclamo' => $reclamo,
            'paso' => 8
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    private function checkIfRedirect(ReclamoTercero $reclamo)
    {
        $paso = $reclamo->estado_carga;
        $paso = is_numeric($paso) && intval($paso) < 8  ? intval($paso) + 1 : $reclamo->estado_carga;
        return $paso;
    }

    public function show(Request $request, $id)
    {
        $reclamo = ReclamoTercero::where('identificador',$id)->firstOrFail();
        return view('siniestros.reclamo-terceros.show',['reclamo' => $reclamo]);
    }
}
