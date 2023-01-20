<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Province;
use App\Models\ReclamoTercero;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReclamoTerceroController extends Controller
{

    public function paso1create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $tiposDocumentos = TipoDocumento::all();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = old('provincia_id') ? old('provincia_id') : ($reclamo->reclamante && $reclamo->reclamante->province_id != null ? $reclamo->reclamante->province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 1,
            'tipo_documentos' => $tiposDocumentos,
            'provincias' => $provincias,
            'localidades' => $localidades
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso1store(Request $request)
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

        //dd($request->all());

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

        if($reclamo->estado_carga === 'precarga')
        {
            $reclamo->estado_carga = '1';
            $reclamo->save();
        }

        return redirect()->route("siniestros.terceros.paso2.create",['id'=> $request->id]);
    }

    public function paso2create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $marcas = Marca::all();
        $modelos = Modelo::where('marca_id', $reclamo->vehiculo && $reclamo->vehiculo->marca_id ? $reclamo->vehiculo->marca_id : $marcas->first()->id)->get();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = old('provincia_id') ? old('provincia_id') : ($reclamo->vehiculo && $reclamo->vehiculo->conductor_province_id != null ? $reclamo->reclamante->conductor_province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 2,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'provincias' => $provincias,
            'localidades' => $localidades
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
        // Tipos Documentos
        $provincias = Province::orderBy('name')->get();
        $provincia_id = old('provincia_id') ? old('provincia_id') : ($reclamo->vehiculo && $reclamo->vehiculo->conductor_province_id != null ? $reclamo->reclamante->conductor_province_id : $provincias->first()->id);
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 3,
            'provincias' => $provincias,
            'localidades' => $localidades
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso3store(Request $request)
    {
        $rules = [
            'reclamante_conductor' => 'required',
            'conductor_nombre' => 'required_if:reclamante_conductor,0',
            'conductor_telefono' => 'required_if:reclamante_conductor,0',
            'conductor_domicilio' => 'required_if:reclamante_conductor,0',
            'conductor_codigo_postal' => 'required_if:reclamante_conductor,0',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad' => 'required_with:check_otra_localidad',
            'licencia_numero' => 'required',
            'licencia_clase' => 'required',
        ];
        $messages = [
            'conductor_nombre.required_if' => 'El campo nombre completo es obligatorio.',
            'conductor_telefono.required_if' => 'El campo teléfono es obligatorio.',
            'conductor_domicilio.required_if' => 'El campo domicilio es obligatorio.',
            'conductor_codigo_postal.required_if' => 'El campo código postal es obligatorio.',
            'otro_pais_provincia_localidad.required_if' => 'El campo otro país, provincia y localidad es obligatorio.',
            'otra_localidad.required_with' => 'El campo otra localidad es obligatorio.'
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        $reclamo->vehiculo->reclamante_conductor = $reclamo->reclamante_conductor;
        // IF Reclmante Conductor


        // IF Not Reclamante Conductor
        $reclamo->vehiculo->conductor_nombre = $request->conductor_nombre;
        $reclamo->vehiculo->conductor_telefono = $request->conductor_telefono;
        $reclamo->vehiculo->conductor_tipo_documento_id = $request->conductor_tipo_documento_id;
        $reclamo->vehiculo->conductor_documento_numero = $request->conductor_documento_numero;
        $reclamo->vehiculo->conductor_domicilio = $request->conductor_domicilio;
        $reclamo->vehiculo->conductor_codigo_postal = $request->conductor_codigo_postal;
        $reclamo->vehiculo->conductor_pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
        $reclamo->vehiculo->conductor_province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
        $reclamo->vehiculo->conductor_city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
        $reclamo->vehiculo->conductor_otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
        $reclamo->vehiculo->licencia_numero = $request->licencia_numero;
        $reclamo->vehiculo->licencia_clase = $request->licencia_clase;
        $reclamo->vehiculo->save();

        dd($request->all());
    }

    public function paso4create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 4,
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso4store(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        dd($request->all());
    }
}
