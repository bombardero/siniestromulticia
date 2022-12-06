<?php

namespace App\Http\Controllers\DenunciaSiniestro;

use App\Http\Controllers\Controller;
use App\Models\DocumentosDenuncia;
use App\Services\FileUploadService;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
use Image;

class DenunciaSiniestroAseguradoController extends Controller
{

    public function show(string $id)
    {
        $denuncia = DenunciaSiniestro::where('identificador',$id)->firstOrFail();
        return view('siniestros.show',["denuncia" => $denuncia]);
    }

    public function storeBajaUnidad(Request $request,string $id)
    {
        $denuncia = DenunciaSiniestro::where('identificador',$id)->firstOrFail();
        $type = 'baja_unidad';
        $cant = $denuncia->documentosDenuncia->where('type',$type)->count();
        $max = 5 - $cant;
        $rules =  [
            'baja_unidad' => ['required','array',"max:$max"],
            'baja_unidad.*' => 'required|file',
        ];
        $messages = [
            'baja_unidad.required' => 'Debe seleccionar al menos un archivo.',
            'baja_unidad.max' => "Puede seleccionar hasta $max archivos.",
        ];
        Validator::make($request->all(),$rules, $messages)->validate();

        $files = $request->baja_unidad;


        foreach ($files as $file)
        {
            $format = 'jpg';
            $data = $this->getDocumentoPathAndName($denuncia, $type, $format);

            $imgFile = Image::make($file);

            if($imgFile->width() > 2100)
            {
                $imgFile->widen(2100);
            }

            $url = FileUploadService::upload($imgFile->stream($format),$data['path']);

            $denuncia->documentosDenuncia()->create([
                'nombre' => $data['name'],
                'type' => $type,
                'url' => $url,
                'path' => $data['path']
            ]);
        }

        return redirect()->route('denuncia-siniestros.asegurado.show',["id" => $denuncia->identificador]);
    }

    public function deleteBajaUnidad(Request $request, string $id)
    {
        $denuncia = DenunciaSiniestro::where('identificador',$id)->firstOrFail();
        $rules =  [
            'file_id' => 'required'
        ];
        Validator::make($request->all(),$rules)->validate();

        $archivo = $denuncia->documentosDenuncia()->where('id',$request->file_id)->first();
        if($archivo)
        {
            FileUploadService::delete($archivo->path);
            $archivo->delete();
            return response()->json([ 'status' => true]);
        }
        return response()->json([ 'status' => false]);
    }

    private function getDocumentoPathAndName(DenunciaSiniestro $denuncia,string $type,string $format = 'jpg')
    {
        $name = $type.'_'.Carbon::now()->format('Ymd_His').'.'.$format;
        return ['path' => 'denuncia_siniestro/'.$denuncia->id.'/documentos/'.$name, 'name' => $name];
    }



}
