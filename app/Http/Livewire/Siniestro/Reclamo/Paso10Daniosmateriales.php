<?php

namespace App\Http\Livewire\Siniestro\Reclamo;

use App\Models\DocumentosReclamo;
use App\Models\ReclamoTercero;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Paso10Daniosmateriales extends Component
{
    use WithFileUploads;

    public $reclamo;
    protected $fileUploadService;

    public $listeners = [
        'upload_denuncia_policial' => 'uploadFileDenunciaPolicial',
        'upload_dni_propietario' => 'uploadFileDniPropietario',
        'upload_escritura_contrato_alquiler' => 'uploadFileEscrituraContratoAlquiler',
        'upload_fotos_danios' => 'uploadFileFotosDanios',
        'upload_presupuesto' => 'uploadFilePresupuesto',
    ];

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

    public function mount(ReclamoTercero $reclamo)
    {
        $this->reclamo = $reclamo;
    }


    public function render()
    {
        return view('livewire.siniestro.reclamo.paso10-daniosmateriales');
    }

    public function submit()
    {
        dd('submit');
    }

    private function getDocumentoPathAndName($type, $format = 'jpg')
    {
        $name = $type.'_'.Carbon::now()->format('Ymd_His').'.'.$format;
        return ['path' => 'reclamo_tercero/'.$this->reclamo->id.'/documentos/danios_materiales/'.$name, 'name' => $name];
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

    public function uploadFileDenunciaPolicial($file)
    {
        $this->uploadFile($file,'dm_denuncia_policial', 1);
    }

    public function uploadFileDniPropietario($file)
    {
        $this->uploadFile($file,'dm_dni_propietario', 2);
    }

    public function uploadFileEscrituraContratoAlquiler($file)
    {
        $this->uploadFile($file,'dm_escritura_contrato_alquiler', 1);
    }

    public function uploadFileFotosDanios($file)
    {
        $this->uploadFile($file,'dm_fotos_danios', 4);
    }

    public function uploadFilePresupuesto($file)
    {
        $this->uploadFile($file,'dm_presupuesto', 1);
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

        return redirect()->route('siniestros.terceros.paso10.daniosmateriales.create', ['id'=> $this->reclamo->identificador]);
    }





}
