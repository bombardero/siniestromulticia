<?php

namespace App\Http\Livewire\Siniestro\Reclamo;

use App\Models\DenunciaSiniestro;
use App\Models\DocumentosDenuncia;
use App\Models\DocumentosReclamo;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Paso8 extends Component
{
    use WithFileUploads;

    public $reclamo;
    protected $fileUploadService;


    public $listeners = [
        'upload_dni' => 'uploadFileDNI',
        'upload_cedula' => 'uploadFileCedula',
        'upload_carnet' => 'uploadFileCarnet',
        'upload_formulario_08' => 'uploadFileFormulario08',
        'upload_denuncia_administrativa' => 'uploadFileDenunciaAdministrativa',
        'upload_certificado_cobertura' => 'uploadFileCertificadoCobertura',
        'upload_carta_franquicia' => 'uploadFileCartaFranquicia',
        'upload_vehiculo' => 'uploadFileVehiculo',
        'upload_presupuesto' => 'uploadFilePresupuesto',
        'upload_descripcion_repuestos' => 'uploadFileDescripcionRepuestos',
        'staffDirectoryRefresh' => '$refresh'
    ];

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

    public function mount($reclamo)
    {
        $this->reclamo = $reclamo;
    }


    public function render()
    {
        return view('livewire.siniestro.reclamo.paso8');
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
        return ['path' => 'reclamo_tercero/'.$this->reclamo->id.'/documentos/'.$name, 'name' => $name];
    }

    private function getFormatoFile($file)
    {
        $typemime = explode(':', explode(';', $file)[0])[1];
        switch ($typemime)
        {
            case 'image/png':
            case 'image/jpeg':
                $format = 'imagen';
                break;
            case 'application/pdf':
                $format = 'pdf';
                break;
            default:
                $format = null;
        }
        return $format;
    }

    private function getExtensionFile($file)
    {
        $typemime = explode(':', explode(';', $file)[0])[1];
        switch ($typemime)
        {
            case 'image/png':
            case 'image/jpeg':
                $format = 'jpg';
                break;
            case 'application/pdf':
                $format = 'pdf';
                break;
            default:
                $format = '';
        }
        return $format;
    }

    public function uploadFile($file,$type, $max = 1)
    {
        $extension = $this->getExtensionFile($file);
        $formato = $this->getFormatoFile($file);

        if($this->reclamo->documentos()->where('type', $type)->count() >= $max)
        {
            $this->addError($type, "No puede cargar más de $max archivos.");
            return ;
        }

        if($formato !== 'imagen' && $formato !== 'pdf')
        {
            $this->addError($type, "El archivo no es válido.");
            return ;
        }

        // TODO: if($this->denuncia_siniestro->canEdit())

        $data = $this->getDocumentoPathAndName($type, $extension);


        if($formato == 'imagen')
        {
            $file = Image::make($file);

            if($file->width() > 2100)
            {
                $file->widen(2100);
            }
            $url = FileUploadService::upload($file->stream($extension),$data['path']);
        } else {
            $url = FileUploadService::upload(file_get_contents($file),$data['path']);
        }

        $this->reclamo->documentos()->create([
            'nombre' => $data['name'],
            'type' => $type,
            'formato' => $formato,
            'url' => $url,
            'path' => $data['path'],
        ]);

        $documents_number = $this->reclamo->documentos()->where('type', $type)->count();
        if(!$documents_number > 0)
        {
            $this->validate();
        }
    }

    public function uploadFileDNI($file)
    {
        $this->uploadFile($file,'dni',2);
    }

    // Controlar

    public function uploadFileCedula($file)
    {
        $this->uploadFile($file,'cedula', 2);
    }

    public function uploadFileCarnet($file)
    {
        $this->uploadFile($file,'carnet', 2);
    }

    public function uploadFileFormulario08($file)
    {
        $this->uploadFile($file,'formulario_08', 2);
    }

    public function uploadFileDenunciaAdministrativa($file)
    {
        $this->uploadFile($file,'denuncia_administrativa', 1);
    }

    public function uploadFileCertificadoCobertura($file)
    {
        $this->uploadFile($file,'certificado_cobertura', 1);
    }

    public function uploadFileCartaFranquicia($file)
    {
        $this->uploadFile($file,'carta_franquicia', 1);
    }

    public function uploadFileVehiculo($file)
    {
        $this->uploadFile($file,'vehiculo', 4);
    }

    public function uploadFilePresupuesto($file)
    {
        $this->uploadFile($file,'presupuesto', 2);
    }

    public function uploadFileDescripcionRepuestos($file)
    {
        $this->uploadFile($file,'descripcion_repuestos', 1);
    }

    public function eliminarArchivo($id)
    {
        // TODO: if($this->reclamo->canEdit())

        $archivo = DocumentosReclamo::find($id);
        if($archivo && $archivo->reclamo_tercero_id == $this->reclamo->id)
        {
            FileUploadService::delete($archivo->path);
            $archivo->delete();
        }

        return redirect()->route('siniestros.terceros.paso8.create', ['id'=> $this->reclamo->identificador]);
    }
}
