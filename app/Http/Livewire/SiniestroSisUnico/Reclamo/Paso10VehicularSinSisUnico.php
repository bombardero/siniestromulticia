<?php

namespace App\Http\Livewire\SiniestroSisUnico\Reclamo;

use App\Models\DocumentosReclamo;
use App\Models\ReclamoTercero;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Paso10Vehicular extends Component
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
        'upload_declaracion_jurada' => 'uploadFileDeclaracionJurada',
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

    public function mount(ReclamoTercero $reclamo)
    {
        $this->reclamo = $reclamo;
    }


    public function render()
    {
        return view('livewire.siniestrosisunico.reclamo.paso10-vehicular');
    }

    public function submit()
    {
        $error = false;

        if($this->reclamo->vehiculo->documentos->where('type', 'dv_dni_titular')->count() < 2 )
        {
            $error = true;
            $this->addError('dni', 'Debe cargar 2 fotos del DNI, frente y reverso.');
        }

        if($this->reclamo->vehiculo->documentos->where('type','dv_cedula')->count() < 2 )
        {
            $error = true;
            $this->addError('cedula', 'Debe cargar 2 fotos de la cédula, frente y reverso.');
        }

        if($this->reclamo->vehiculo->documentos->where('type','dv_carnet')->count() < 2 )
        {
            $error = true;
            $this->addError('carnet', 'Debe cargar 2 fotos del carnet, frente y reverso.');
        }

        if($this->reclamo->vehiculo->en_transferencia && $this->reclamo->vehiculo->documentos->where('type','dv_formulario_08')->count() < 1 )
        {
            $error = true;
            $this->addError('formulario_08', 'Debe cargar el formulario 08.');
        }

        if($this->reclamo->vehiculo->con_seguro && $this->reclamo->vehiculo->documentos->where('type','dv_denuncia_administrativa')->count() < 1 )
        {
            $error = true;
            $this->addError('denuncia_administrativa', 'Debe cargar la denuncia administrativa.');
        }

        if($this->reclamo->vehiculo->con_seguro && $this->reclamo->vehiculo->documentos->where('type','dv_certificado_cobertura')->count() < 1 )
        {
            $error = true;
            $this->addError('certificado_cobertura', 'Debe cargar el certificado de cobertura.');
        }

        if(!$this->reclamo->vehiculo->con_seguro && $this->reclamo->vehiculo->documentos->where('type','dv_declaracion_jurada')->count() < 1 )
        {
            $error = true;
            $this->addError('declaracion_jurada', 'Debe cargar la declaración jurada de no seguro.');
        }

        if($this->reclamo->vehiculo->documentos->where('type','dv_vehiculo')->count() < 4 )
        {
            $error = true;
            $this->addError('vehiculo', 'Debe que cargar 4 fotos del vehículo');
        }

        if($this->reclamo->vehiculo->documentos->where('type','dv_presupuesto')->count() < 1)
        {
            $error = true;
            $this->addError('presupuesto', 'Debe cargar el presupuesto.');
        }

        if($error)
        {
            return $error;
        }

        return redirect()->route('siniestros.terceros.paso10.create', ['id' => $this->reclamo->identificador]);
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

        if($this->reclamo->vehiculo->documentos()->where('type', $type)->count() >= $max)
        {
            $this->addError($type, "No puede cargar más de $max archivos.");
            return ;
        }

        if($formato !== 'imagen' && $formato !== 'pdf')
        {
            $this->addError($type, "El archivo no es válido.");
            return ;
        }

        if($this->reclamo->canEdit())
        {
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

            $this->reclamo->vehiculo->documentos()->create([
                'nombre' => $data['name'],
                'type' => $type,
                'formato' => $formato,
                'url' => $url,
                'path' => $data['path'],
                'reclamo_tercero_id' => $this->reclamo->id
            ]);
        }
    }

    public function uploadFileDNI($file)
    {
        $this->uploadFile($file,'dv_dni_titular',2);
    }

    public function uploadFileCedula($file)
    {
        $this->uploadFile($file,'dv_cedula', 2);
    }

    public function uploadFileCarnet($file)
    {
        $this->uploadFile($file,'dv_carnet', 2);
    }

    public function uploadFileFormulario08($file)
    {
        $this->uploadFile($file,'dv_formulario_08', 2);
    }

    public function uploadFileDenunciaAdministrativa($file)
    {
        $this->uploadFile($file,'dv_denuncia_administrativa', 1);
    }

    public function uploadFileCertificadoCobertura($file)
    {
        $this->uploadFile($file,'dv_certificado_cobertura', 1);
    }

    public function uploadFileDeclaracionJurada($file)
    {
        $this->uploadFile($file,'dv_declaracion_jurada', 1);
    }

    public function uploadFileCartaFranquicia($file)
    {
        $this->uploadFile($file,'dv_carta_franquicia', 1);
    }

    public function uploadFileVehiculo($file)
    {
        $this->uploadFile($file,'dv_vehiculo', 4);
    }

    public function uploadFilePresupuesto($file)
    {
        $this->uploadFile($file,'dv_presupuesto', 2);
    }

    public function uploadFileDescripcionRepuestos($file)
    {
        $this->uploadFile($file,'dv_descripcion_repuestos', 1);
    }

    public function eliminarArchivo($id)
    {
        if($this->reclamo->canEdit())
        {
            $archivo = DocumentosReclamo::find($id);
            if($archivo && $archivo->reclamo_tercero_id == $this->reclamo->id)
            {
                FileUploadService::delete($archivo->path);
                $archivo->delete();
            }
        }

        return redirect()->route('siniestros.terceros.paso10.vehicular.create', ['id'=> $this->reclamo->identificador]);
    }
}
