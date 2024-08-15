<?php

namespace App\Http\Livewire\SiniestroSisUnico;

use App\Models\DenunciaSiniestro;
use App\Models\DocumentosDenuncia;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class DenunciaAseguradoPaso11 extends Component
{
    use WithFileUploads;

    public $denuncia_siniestro;
    public $archivos_dni = [] ; // equivalente a archivo_sueldos
    public $fotos_dni = [] ; // equivalente a sueldos []
    public $identificador;
    protected $fileUploadService;


    public $listeners = [
        "upload_cedula" => 'uploadFileCedula',
         "upload_dni" => 'uploadFileDNI',
         "upload_carnet" => 'uploadFileCarnet',
         "upload_vehiculo" => 'uploadFileVehiculo',
         "upload_recibo" => 'uploadFileRecibo',
         "upload_policial" => 'uploadFilePolicial',
         "upload_habilitacion" => 'uploadFileHabilitacion',
         'staffDirectoryRefresh' => '$refresh'
    ];

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

    public function mount($denuncia_siniestro, $identificador)
    {
        $this->denuncia_siniestro = $denuncia_siniestro;
        $this->archivos_dni = $denuncia_siniestro->documentosDenuncia()->where('type', 'dni')->get();
        $this->identificador = $identificador;
    }


    public function render()
    {
        return view('livewire.siniestrosisunico.denuncia-asegurado-paso11');
    }

    public function submit()
    {
        if($this->denuncia_siniestro->documentosDenuncia->where('type', 'dni')->count() < 2 )
        {
            return $this->addError('dni', 'Tienes que cargar 2 fotos del dni (frente y reverso)');

        }

        if($this->denuncia_siniestro->documentosDenuncia->where('type','cedula')->count() < 2 )
        {
            return $this->addError('cedula', 'Tienes que cargar 2 fotos de tu cedula (frente y reverso)');
        }


        if($this->denuncia_siniestro->documentosDenuncia->where('type','carnet')->count() < 2 )
        {
            return $this->addError('carnet', 'Tienes que cargar 2 fotos de tu carnet (frente y reverso)');
        }

        if($this->denuncia_siniestro->documentosDenuncia->where('type','vehiculo')->count() < 4 )
        {
            return $this->addError('vehiculo', 'Tienes que cargar 4 fotos (uno de cada lateral, frente y atrás)');
        }

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$this->identificador)->firstOrFail();

        if($denuncia_siniestro->canEdit() && $denuncia_siniestro->estado_carga == "10")
        {
            $denuncia_siniestro->estado_carga = '11';
            $denuncia_siniestro->save();
        }

        return redirect()->route("asegurados-denuncias-paso12.create",['id'=> $this->identificador]);
    }

    private function getDocumentoPathAndName($type, $format = 'jpg')
    {
        $name = $type.'_'.Carbon::now()->format('Ymd_His').'.'.$format;
        return ['path' => 'denuncia_siniestro/'.$this->denuncia_siniestro->id.'/documentos/'.$name, 'name' => $name];
    }

    public function uploadFile($file,$type, $max = 1)
    {
        if($this->denuncia_siniestro->documentosDenuncia->where('type', $type)->count() >= $max)
        {
            $this->addError($type, "No puedes cargar más de $max fotos");
            return ;
        }

        if($this->denuncia_siniestro->canEdit())
        {
            $format = 'jpg';
            $data = $this->getDocumentoPathAndName($type, $format);

            $imgFile = Image::make($file);

            if($imgFile->width() > 2100)
            {
                $imgFile->widen(2100);
            }

            $url = FileUploadService::upload($imgFile->stream($format),$data['path']);

            $this->denuncia_siniestro->documentosDenuncia()->create([
                'nombre' => $data['name'],
                'type' => $type,
                'url' => $url,
                'path' => $data['path'],
            ]);

            $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', $type)->count();
            if(!$documents_number > 0)
            {
                $this->validate();
            }
        }
    }

    public function uploadFileDNI($file)
    {
        $this->uploadFile($file,'dni', 2);
    }

    public function uploadFileCedula($file)
    {
        $this->uploadFile($file,'cedula', 2);
    }

    public function uploadFileCarnet($file)
    {
        $this->uploadFile($file,'carnet', 2);
    }

    public function uploadFileVehiculo($file)
    {
        $this->uploadFile($file,'vehiculo', 4);
    }

    public function uploadFileRecibo($file)
    {
        $this->uploadFile($file,'recibo');
    }

    public function uploadFilePolicial($file)
    {
        $this->uploadFile($file,'exposicion_policial',5);
    }

    public function uploadFileHabilitacion($file)
    {
        $this->uploadFile($file,'habilitacion');
    }

    public function eliminarArchivo($id)
    {
        if($this->denuncia_siniestro->canEdit())
        {
            $archivo = DocumentosDenuncia::find($id);
            if($archivo)
            {
                FileUploadService::delete($archivo->path);
                $archivo->delete();
            }
        }

        return redirect()->route("asegurados-denuncias-paso11.create",['id'=> $this->identificador]);
    }
}
