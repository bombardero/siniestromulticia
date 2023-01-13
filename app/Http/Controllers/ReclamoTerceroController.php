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
        $modelos = Modelo::where('marca_id', $reclamo->vehiculo ? $reclamo->vehiculo->marca_id : 1)->get();
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
        dd($request->all());
    }
}
