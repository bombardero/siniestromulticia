<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\DanioMaterialReclamo;
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
use Image;

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

        if($reclamo->canEdit())
        {
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
        }

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
            'fecha_nacimiento' => 'required',
            'conductor' => 'required_if:reclamo_vehicular,1'
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
            'conductor.required_if' => 'El campo conductor es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if($reclamo->canEdit())
        {
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
                    'telefono' => $request->telefono,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'conductor' => $reclamo->reclamo_vehicular ? $request->conductor : false,
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
                $reclamo->reclamante->fecha_nacimiento = $request->fecha_nacimiento;
                $reclamo->reclamante->conductor = $reclamo->reclamo_vehicular ? $request->conductor : false;
                $reclamo->reclamante->save();
            }

            if($reclamo->estado_carga === '1')
            {
                $reclamo->estado_carga = '2';
                $reclamo->save();
            }
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

        if($reclamo->canEdit())
        {
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
        }


        return redirect()->route('siniestros.terceros.paso4.create', ['id'=> $request->id]);
    }

    public function paso4create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->conductor && $reclamo->conductor->province_id != null ? $reclamo->conductor->province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();
        $tiposDocumentos = TipoDocumento::all();
        $conductor =  $reclamo->reclamo_vehicular && $reclamo->reclamante && !$reclamo->reclamante->conductor;

        $data = [
            'reclamo' => $reclamo,
            'paso' => 4,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos,
            'conductor' => $conductor
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso4store(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();
        $rules = [
            'nombre' => 'required_if:conductor,1',
            'tipo_documento_id' => 'required_if:conductor,1',
            'documento_numero' => 'required_if:conductor,1',
            'telefono' => 'required_if:conductor,1',
            'domicilio' => 'required_if:conductor,1',
            'codigo_postal' => 'required_if:conductor,1',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad' => 'required_with:check_otra_localidad',
            'licencia_numero' => 'required_if:reclamo_vehicular,1',
            'licencia_clase' => 'required_if:reclamo_vehicular,1',
            'alcoholemia' => 'required_if:reclamo_vehicular,1',
            'lesiones' => Rule::requiredIf($reclamo->reclamo_vehicular && $reclamo->reclamo_lesiones),
            'gravedad_lesion' => 'required_if:lesiones,1',
        ];
        $messages = [
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
            'alcoholemia.required_if' => 'El campo alcoholemia es obligatorio.',
            'lesiones.required_if' => 'El campo lesiones es obligatorio.',
            'gravedad_lesion.required_if' => 'El campo gravedad de lesiones es obligatorio.',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        if($reclamo->canEdit())
        {
            if($reclamo->reclamo_vehicular)
            {
                if(!$reclamo->conductor)
                {
                    $reclamo->conductor()->create([
                        'nombre' => $request->conductor == '1' ? $request->nombre : null,
                        'telefono' => $request->conductor == '1' ? $request->telefono : null,
                        'fecha_nacimiento' => $request->conductor == '1' ? $request->fecha_nacimiento : null,
                        'tipo_documento_id' => $request->conductor == '1' ? $request->tipo_documento_id : null,
                        'documento_numero' => $request->conductor == '1' ? $request->documento_numero : null,
                        'domicilio' => $request->conductor == '1' ? $request->domicilio : null,
                        'codigo_postal' => $request->conductor == '1' ? $request->codigo_postal : null,
                        'pais_id' => $request->conductor == '1' ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null) : null,
                        'province_id' => $request->conductor == '1' ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null) : null,
                        'city_id' => $request->conductor == '1' ? ($request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id) : null,
                        'otro_pais_provincia_localidad' => $request->conductor == '1' ? ($request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null )) : null,
                        'licencia_numero' => $request->licencia_numero,
                        'licencia_clase' => $request->licencia_clase,
                        'alcoholemia' => $request->alcoholemia,
                        'alcoholemia_se_nego' => $request->alcoholemia_nego == 'on',
                        'lesiones' => $request->reclamo_lesiones == '1' ? $request->lesiones : false,
                        'gravedad_lesion' => $request->lesiones == '1' ? $request->gravedad_lesion : null,
                        'centro_asistencial' => $request->lesiones == '1' ? $request->centro_asistencial : null,
                    ]);
                } else {
                    $reclamo->conductor->nombre = $request->conductor == '1' ? $request->nombre : null;
                    $reclamo->conductor->telefono = $request->conductor == '1' ? $request->telefono : null;
                    $reclamo->conductor->fecha_nacimiento = $request->conductor == '1' ? $request->fecha_nacimiento : null;
                    $reclamo->conductor->tipo_documento_id = $request->conductor == '1' ? $request->tipo_documento_id : null;
                    $reclamo->conductor->documento_numero = $request->conductor == '1' ? $request->documento_numero : null;
                    $reclamo->conductor->domicilio = $request->conductor == '1' ? $request->domicilio : null;
                    $reclamo->conductor->codigo_postal = $request->conductor == '1' ? $request->codigo_postal : null;
                    $reclamo->conductor->pais_id = $request->conductor == '1' ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null) : null;
                    $reclamo->conductor->province_id = $request->conductor == '1' ? ($request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null) : null;
                    $reclamo->conductor->city_id = $request->conductor == '1' ? ($request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id) : null;
                    $reclamo->conductor->otro_pais_provincia_localidad = $request->conductor == '1' ? ($request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null )) : null;
                    $reclamo->conductor->licencia_numero = $request->licencia_numero;
                    $reclamo->conductor->licencia_clase = $request->licencia_clase;
                    $reclamo->conductor->alcoholemia = $request->alcoholemia;
                    $reclamo->conductor->alcoholemia_se_nego = $request->alcoholemia_nego == 'on';
                    $reclamo->conductor->lesiones = $request->reclamo_lesiones == '1' ? $request->lesiones : false;
                    $reclamo->conductor->gravedad_lesion = $request->lesiones == '1' ? $request->gravedad_lesion : null;
                    $reclamo->conductor->centro_asistencial = $request->lesiones == '1' ? $request->centro_asistencial : null;
                    $reclamo->conductor->save();
                }
            }

            if($reclamo->estado_carga === '3')
            {
                $reclamo->estado_carga = '4';
                $reclamo->save();
            }
        }

        return redirect()->route('siniestros.terceros.paso5.create', ['id'=> $request->id]);
    }

    public function paso5create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 5
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso5store(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $validator = Validator::make($request->all(),[]);

        $validator->after(function ($validator) use ($request, $reclamo) {
            if ($reclamo->reclamo_lesiones && !$reclamo->conductor && $reclamo->lesionados()->count() == 0) {
                $validator->errors()->add('lesionados', 'Debe agregar al menos un lesionado');
            }
            if ($reclamo->reclamo_lesiones && $reclamo->conductor && !$reclamo->conductor->lesiones && $reclamo->lesionados()->count() == 0) {
                $validator->errors()->add('lesionados', 'Debe agregar al menos un lesionado');
            }
        });

        if ($validator->fails())
        {
            return redirect()->route('siniestros.terceros.paso5.create',['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        if($reclamo->canEdit())
        {
            if($reclamo->estado_carga === '4')
            {
                $reclamo->estado_carga = '5';
                $reclamo->save();
            }
        }

        return redirect()->route('siniestros.terceros.paso6.create', ['id'=> $request->id]);
    }

    public function paso5lesionadoCreate(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $tiposDocumentos = TipoDocumento::all();
        $provincias = Province::orderBy('name')->get();
        $localidades = City::where('province_id', $provincias->first()->id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => '5-agregar',
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos,
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso5lesionadoStore(Request $request)
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
            'fecha_nacimiento' => 'required',
            'tipo' => 'required',
            'gravedad_lesion' => 'required',
            'alcoholemia' => 'required'
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
            'gravedad_lesion' => 'El campo tio de lesiones es requerido.'
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if($reclamo->canEdit())
        {
            $reclamo->lesionados()->create([
                'nombre' => $request->nombre,
                'tipo_documento_id' => $request->tipo_documento_id,
                'documento_numero' => $request->documento_numero,
                'domicilio' => $request->domicilio,
                'codigo_postal' => $request->codigo_postal,
                'pais_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null,
                'province_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null,
                'city_id' => $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id,
                'otro_pais_provincia_localidad' => $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null ),
                'tipo' => $request->tipo,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'gravedad_lesion' => $request->gravedad_lesion,
                'alcoholemia' => $request->alcoholemia,
                'alcoholemia_se_nego' => $request->alcoholemia_se_nego == 'on',
                'centro_asistencial' => $request->centro_asistencial
            ]);
        }

        return redirect()->route("siniestros.terceros.paso5.create",['id'=> $request->id]);
    }

    public function paso5lesionadoEdit(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $lesionado = $reclamo->lesionados()->where('id',$request->lesionado)->firstOrFail();
        $tiposDocumentos = TipoDocumento::all();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $lesionado->province_id != null ? $lesionado->province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => '5-editar',
            'lesionado' => $lesionado,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_documentos' => $tiposDocumentos,
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso5lesionadoUpdate(Request $request)
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
            'fecha_nacimiento' => 'required',
            'tipo' => 'required',
            'gravedad_lesion' => 'required',
            'alcoholemia' => 'required'
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
            'gravedad_lesion' => 'El campo tio de lesiones es requerido.'
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $lesionado = $reclamo->lesionados()->where('id',$request->lesionado)->firstOrFail();

        if($reclamo->canEdit())
        {
            $lesionado->nombre = $request->nombre;
            $lesionado->tipo_documento_id = $request->tipo_documento_id;
            $lesionado->documento_numero = $request->documento_numero;
            $lesionado->domicilio = $request->domicilio;
            $lesionado->codigo_postal = $request->codigo_postal;
            $lesionado->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
            $lesionado->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
            $lesionado->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
            $lesionado->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
            $lesionado->telefono = $request->telefono;
            $lesionado->fecha_nacimiento = $request->fecha_nacimiento;
            $lesionado->gravedad_lesion = $request->gravedad_lesion;
            $lesionado->alcoholemia = $request->alcoholemia;
            $lesionado->alcoholemia_se_nego = $request->alcoholemia_se_nego == 'on';
            $lesionado->centro_asistencial = $request->centro_asistencia;
            $lesionado->save();
        }


        return redirect()->route('siniestros.terceros.paso5.create', ['id'=> $request->id]);
    }

    public function paso5lesionadoDelete(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $lesionado = $reclamo->lesionados()->where('id',$request->lesionado)->firstOrFail();

        if($reclamo->canEdit())
        {
            $lesionado->delete();
        }

        return redirect()->route('siniestros.terceros.paso5.create', ['id'=> $request->id]);
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
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $validator = Validator::make($request->all(),[]);

        $validator->after(function ($validator) use ($request, $reclamo) {
            if ($reclamo->reclamo_danios_materiales && $reclamo->daniosMateriales()->count() == 0) {
                $validator->errors()->add('danios_materiales', 'Debe agregar al menos un daño material');
            }
        });

        if ($validator->fails())
        {
            return redirect()->route('siniestros.terceros.paso6.create',['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }

        if($reclamo->canEdit())
        {
            if($reclamo->estado_carga === '5')
            {
                $reclamo->estado_carga = '6';
                $reclamo->save();
            }
        }

        return redirect()->route('siniestros.terceros.paso7.create', ['id'=> $request->id]);
    }

    public function paso6daniomaterialCreate(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $tipos = DanioMaterialReclamo::TIPOS;

        $data = [
            'reclamo' => $reclamo,
            'paso' => '6-agregar',
            'tipos' => $tipos
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso6daniomaterialStore(Request $request)
    {
        $rules = [
            'tipo' => 'required_unless:check_otro_tipo,on',
            'otro_tipo' => 'required_if:check_otro_tipo,on',
            'check_otro_tipo' => 'nullable',
            'detalles' => 'required',
        ];
        $messages = [
            'otro_tipo.required_if' => 'El campo tipo es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador",$request->id)->firstOrFail();

        if($reclamo->canEdit())
        {
            $reclamo->daniosMateriales()->create([
                'tipo' => $request->check_otro_tipo ? $request->otro_tipo : $request->tipo,
                'detalles' => $request->detalles
            ]);
        }
        return redirect()->route("siniestros.terceros.paso6.create",['id'=> $request->id]);
    }

    public function paso6daniomaterialEdit(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $danioMaterial = $reclamo->daniosMateriales()->where('id',$request->dm)->firstOrFail();
        $tipos = DanioMaterialReclamo::TIPOS;

        $data = [
            'reclamo' => $reclamo,
            'paso' => '6-editar',
            'danioMaterial' => $danioMaterial,
            'tipos' => $tipos,
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso6daniomaterialUpdate(Request $request)
    {
        $rules = [
            'tipo' => 'required_unless:check_otro_tipo,on',
            'otro_tipo' => 'required_if:check_otro_tipo,on',
            'check_otro_tipo' => 'nullable',
            'detalles' => 'required',
        ];
        $messages = [
            'otro_tipo.required_if' => 'El campo tipo es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $danioMaterial = $reclamo->daniosMateriales()->where('id',$request->daniomaterial)->firstOrFail();

        if($reclamo->canEdit())
        {
            $danioMaterial->tipo = $request->check_otro_tipo ? $request->otro_tipo : $request->tipo;
            $danioMaterial->detalles = $request->detalles;
            $danioMaterial->save();
        }


        return redirect()->route('siniestros.terceros.paso6.create', ['id'=> $request->id]);
    }

    public function paso6daniomaterialDelete(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $danio = $reclamo->daniosMateriales()->where('id',$request->dm)->firstOrFail();

        if($reclamo->canEdit())
        {
            $danio->delete();
        }

        return redirect()->route('siniestros.terceros.paso6.create', ['id'=> $request->id]);
    }

    public function paso7create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $reclamo->province_id != null ? $reclamo->province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();
        $tipoCalzadas = TipoCalzada::all();

        $data = [
            'reclamo' => $reclamo,
            'paso' => 7,
            'provincias' => $provincias,
            'localidades' => $localidades,
            'tipo_calzadas' => $tipoCalzadas
        ];

        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso7store(Request $request)
    {
        $rules = [
            'pais' => 'required',
            'otro_pais_provincia_localidad' => 'required_if:pais,otro',
            'otra_localidad'=>'required_with:check_otra_localidad',
            'direccion'=>'required',
        ];
        $messages = [
            'otro_pais_provincia_localidad.required_if' => 'El campo localidad/provincia/pais es requerido',
            'otra_localidad.required_with' => 'El campo localidad es requerido',
        ];
        Validator::make($request->all(),$rules,$messages)->validate();

        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        if($reclamo->canEdit())
        {
            $reclamo->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null ;
            $reclamo->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
            $reclamo->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
            $reclamo->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
            $reclamo->direccion = $request->direccion;
            $reclamo->tipo_calzada_id = $request->calzada_id;
            $reclamo->calzada_detalle = $request->calzada_detalle;
            $reclamo->interseccion = $request->interseccion;
            $reclamo->cruce_senalizado = $request->cruce_senalizado ==  'on';
            $reclamo->tren = $request->tren;
            $reclamo->semaforo = $request->semaforo ==  'on';
            $reclamo->semaforo_funciona = $request->semaforo_funciona ==  'on';
            $reclamo->semaforo_intermitente = $request->semaforo_intermitente ==  'on';
            $reclamo->semaforo_color = $request->semaforo_color;

            if($reclamo->estado_carga == '6')
            {
                $reclamo->estado_carga = '7';
            }
            $reclamo->save();
        }


        return redirect()->route('siniestros.terceros.paso8.create', ['id'=> $request->id]);
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

    public function paso8store(Request $request)
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
            return redirect()->route("siniestros.terceros.paso8.create",['id'=> $request->id])
                ->withErrors($validator)
                ->withInput();
        }
        $validator->validate();

        if($reclamo->canEdit())
        {
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

            if($reclamo->estado_carga == '7')
            {
                $reclamo->estado_carga = '8';
            }
            $reclamo->save();
        }

        return redirect()->route('siniestros.terceros.paso9.create', ['id'=> $request->id]);
    }

    public function paso9create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $data = [
            'reclamo' => $reclamo,
            'paso' => 9
        ];
        $reclamo->load('testigos');
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso9store(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        if($reclamo->canEdit())
        {
            if($reclamo->estado_carga == '8')
            {
                $reclamo->estado_carga = '9';
            }
            $reclamo->save();
        }

        return redirect()->route('siniestros.terceros.paso10.create', ['id'=> $request->id]);
    }

    public function paso9testigoCreate(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $localidades = City::where('province_id', $provincias->first()->id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => '9-agregar',
            'provincias' => $provincias,
            'localidades' => $localidades,
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso9testigoStore(Request $request)
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

        if($reclamo->canEdit())
        {
            $reclamo->testigos()->create([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'domicilio' => $request->domicilio,
                'pais_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null,
                'province_id' => $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null,
                'city_id' => $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id,
                'otro_pais_provincia_localidad' => $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null )
            ]);
        }

        return redirect()->route('siniestros.terceros.paso9.create', ['id'=> $request->id]);
    }

    public function paso9testigoEdit(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $testigo = $reclamo->testigos()->where('id',$request->testigo)->firstOrFail();
        $provincias = Province::orderBy('name')->get();
        $provincia_id = $testigo->province_id != null ? $testigo->province_id : $provincias->first()->id;
        $localidades = City::where('province_id', $provincia_id)->orderBy('name')->get();

        $data = [
            'reclamo' => $reclamo,
            'paso' => '9-editar',
            'testigo' => $testigo,
            'provincias' => $provincias,
            'localidades' => $localidades,
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso9testigoUpdate(Request $request)
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

        if($reclamo->canEdit())
        {
            $testigo->nombre = $request->nombre;
            $testigo->telefono = $request->telefono;
            $testigo->domicilio = $request->domicilio;
            $testigo->pais_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->pais : null;
            $testigo->province_id = $request->pais != 'otro' && is_numeric($request->pais) ? $request->provincia_id : null;
            $testigo->city_id = $request->pais == 'otro' || $request->check_otra_localidad ? null : $request->localidad_id;
            $testigo->otro_pais_provincia_localidad = $request->pais == 'otro' ? $request->otro_pais_provincia_localidad : ($request->check_otra_localidad == 'on' ? $request->otra_localidad : null );
            $testigo->save();
        }

        return redirect()->route('siniestros.terceros.paso9.create', ['id'=> $request->id]);
    }

    public function paso9testigoDelete(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $testigo = $reclamo->testigos()->where('id',$request->testigo)->firstOrFail();

        if($reclamo->canEdit())
        {
            $testigo->delete();
        }

        return redirect()->route('siniestros.terceros.paso9.create', ['id'=> $request->id]);
    }

    public function storeCroquis(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|exists:reclamo_terceros',
            'croquis' => 'required'
        ])->validate();

        $reclamo = ReclamoTercero::findOrFail($request->id);

        if($reclamo->canEdit())
        {
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
        }

        return response()->json([ 'status' => true]);
    }

    private function getCroquisPath(ReclamoTercero $reclamo, $format = 'jpg')
    {
        return 'reclamo_tercero/'.$reclamo->id.'/croquis_'.Carbon::now()->format('Ymd_His').'.'.$format;
    }

    public function paso10create(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $vehicular_completo = $reclamo->reclamo_vehicular ? $reclamo->documentosVehicularCompleto() : true;
        $danios_materiales_completo = $reclamo->reclamo_danios_materiales ? $reclamo->documentosDaniosMaterialesCompleto() : true;
        $lesionados_completo = $reclamo->reclamo_lesiones ? $reclamo->documentosLesionadosCompleto() : true;

        $data = [
            'reclamo' => $reclamo,
            'paso' => 10,
            'vehicular_completo' => $vehicular_completo,
            'danios_materiales_completo' => $danios_materiales_completo,
            'lesionados_completo' => $lesionados_completo
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso10vehicularCreate(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $data = [
            'reclamo' => $reclamo,
            'paso' => '10-vehicular'
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso10daniosMaterialesCreate(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $data = [
            'reclamo' => $reclamo,
            'paso' => '10-daniosmateriales'
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso10daniosMaterialesStore(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $validator = Validator::make($request->all(),[]);

        if($reclamo->reclamo_danios_materiales)
        {
            $validator->after(function ($validator) use ($request, $reclamo) {

                foreach ($reclamo->daniosMateriales as $key => $danio_material)
                {
                    $orden = $key+1;
                    if($danio_material->documentos()->where('type', 'dm_denuncia_policial')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_denuncia_policial', 'Debe cargar la Denuncia o Exposición Policial.');
                    }
                    if($danio_material->documentos()->where('type', 'dm_dni_propietario')->count() < 2)
                    {
                        $validator->errors()->add($orden.'_dni_propietario', 'Debe cargar el Documento del Propietario.');
                    }
                    if($danio_material->documentos()->where('type', 'dm_escritura_contrato_alquiler')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_escritura_contrato_alquiler', 'Debe cargar la Escritura de la propiedad o Contrato de alquiler.');
                    }
                    if($danio_material->documentos()->where('type', 'dm_fotos_danios')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_fotos_danios', 'Debe cargar al menos una foto de los daños.');
                    }
                    if($danio_material->documentos()->where('type', 'dm_presupuesto')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_presupuesto', 'Debe cargar el presupuesto.');
                    }
                }

            });

            if ($validator->fails())
            {
                return redirect()->route('siniestros.terceros.paso10.daniosmateriales.create',['id'=> $request->id])
                    ->withErrors($validator)->withInput();
            }
        }

        return redirect()->route('siniestros.terceros.paso10.create', ['id'=> $request->id]);
    }

    public function paso10lesionadosCreate(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $data = [
            'reclamo' => $reclamo,
            'paso' => '10-lesionados'
        ];
        return view('siniestros.reclamo-terceros.reclamo-terceros', $data);
    }

    public function paso10lesionadosStore(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();
        $validator = Validator::make($request->all(),[]);

        if($reclamo->reclamo_lesiones)
        {
            $validator->after(function ($validator) use ($request, $reclamo) {

                $orden = 1;
                $step = 1;
                if($reclamo->conductor && $reclamo->conductor->lesiones)
                {
                    if($reclamo->conductor->documentos()->where('type', 'dl_dni')->count() < 2)
                    {
                        $validator->errors()->add($orden.'_dni', 'Debe cargar el documento.');
                    }
                    if($reclamo->conductor->es_menor_en_siniestro && $reclamo->conductor->documentos()->where('type', 'dl_dni_tutor')->count() < 2)
                    {
                        $validator->errors()->add($orden.'_dni_tutor', 'Debe cargar el Documento del Tutor.');
                    }
                    if($reclamo->conductor->documentos()->where('type', 'dl_denuncia_policial')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_denuncia_policial', 'Debe cargar la Denuncia o Exposición Policial.');
                    }
                    if($reclamo->conductor->documentos()->where('type', 'dl_historia_clinica')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_historia_clinica', 'Debe cargar la historia clínica.');
                    }
                    if($reclamo->conductor->documentos()->where('type', 'dl_gastos_medicos')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_gastos_medicos', 'Debe cargar gastos médicos.');
                    }
                    $step = 2;
                }

                foreach ($reclamo->lesionados as $key => $lesionado)
                {
                    $orden = $key + $step;
                    if($lesionado->documentos()->where('type', 'dl_dni')->count() < 2)
                    {
                        $validator->errors()->add($orden.'_dni', 'Debe cargar el documento.');
                    }
                    if($lesionado->es_menor_en_siniestro && $lesionado->documentos()->where('type', 'dl_dni_tutor')->count() < 2)
                    {
                        $validator->errors()->add($orden.'_dni_tutor', 'Debe cargar el Documento del Tutor.');
                    }
                    if($lesionado->documentos()->where('type', 'dl_denuncia_policial')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_denuncia_policial', 'Debe cargar la Denuncia o Exposición Policial.');
                    }
                    if($lesionado->documentos()->where('type', 'dl_historia_clinica')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_historia_clinica', 'Debe cargar la historia clínica.');
                    }
                    if($lesionado->documentos()->where('type', 'dl_gastos_medicos')->count() < 1)
                    {
                        $validator->errors()->add($orden.'_gastos_medicos', 'Debe cargar gastos médicos.');
                    }
                }
            });

            if ($validator->fails())
            {
                return redirect()->route('siniestros.terceros.paso10.lesionados.create',['id'=> $request->id])
                    ->withErrors($validator)->withInput();
            }
        }

        return redirect()->route('siniestros.terceros.paso10.create', ['id'=> $request->id]);
    }

    public function paso10store(Request $request)
    {
        $reclamo = ReclamoTercero::where("identificador", $request->id)->firstOrFail();

        $validator = Validator::make($request->all(),[]);

        $validator->after(function ($validator) use ($request, $reclamo) {
            if (!$reclamo->documentosVehicularCompleto())
            {
                $validator->errors()->add('reclamo_vehicular', 'Debe completar la documentación.');
            }
            if(!$reclamo->documentosDaniosMaterialesCompleto())
            {
                $validator->errors()->add('reclamo_danios_materiales', 'Debe completar la documentación.');
            }
            if(!$reclamo->documentosLesionadosCompleto())
            {
                $validator->errors()->add('reclamo_lesiones', 'Debe completar la documentación.');
            }
        });

        if ($validator->fails())
        {
            return redirect()->route('siniestros.terceros.paso10.create',['id'=> $request->id])->withErrors($validator)->withInput();
        }

        if($reclamo->canEdit())
        {
            if($reclamo->estado_carga == '9')
            {
                $reclamo->estado_carga = '10';
                $reclamo->finalized_at = Carbon::now()->toDateTimeString();
                $reclamo->save();
            }
        }

        return redirect()->route('siniestros.terceros.gracias', ['id' => $reclamo->identificador]);
    }

    private function checkIfRedirect(ReclamoTercero $reclamo)
    {
        $paso = $reclamo->estado_carga;
        $paso = is_numeric($paso) && intval($paso) < 10  ? intval($paso) + 1 : $reclamo->estado_carga;
        return $paso;
    }

    public function show(Request $request, $id)
    {
        $reclamo = ReclamoTercero::where('identificador',$id)->firstOrFail();
        return view('siniestros.reclamo-terceros.show',['reclamo' => $reclamo, 'estados' => ReclamoTercero::ESTADOS]);
    }
}
