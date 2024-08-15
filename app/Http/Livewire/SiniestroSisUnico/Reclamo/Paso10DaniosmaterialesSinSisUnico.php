<?php

namespace App\Http\Livewire\SiniestroSisUnico\Reclamo;

use App\Models\DanioMaterialReclamo;
use App\Models\DocumentosReclamo;
use App\Models\ReclamoTercero;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Paso10Daniosmateriales extends Component
{
    use WithFileUploads;

    public $reclamo;
    public $danio_material;
    public $orden;

    public $denuncia_policial;
    public $dni_propietario;
    public $escritura_contrato_alquiler;
    public $fotos_danios;
    public $presupuesto;

    protected $fileUploadService;

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

    public function mount(ReclamoTercero $reclamo, DanioMaterialReclamo $daniomaterial, string $orden)
    {
        $this->reclamo = $reclamo;
        $this->danio_material = $daniomaterial;
        $this->orden = $orden;
    }


    public function render()
    {
        return view('livewire.siniestrosisunico.reclamo.paso10-daniosmateriales');
    }

    private function getDocumentoPathAndName($type, $format = 'jpg')
    {
        $name = $type.'_'.Carbon::now()->format('Ymd_His').'.'.$format;
        return ['path' => 'reclamo_tercero/'.$this->reclamo->id.'/documentos/danios_materiales', 'name' => $name];
    }

    private function getDataFile($file)
    {
        $data = [];
        switch ($file->getMimeType())
        {
            case 'image/png':
                $data['extension'] = 'png';
                $data['formato'] = 'imagen';
            case 'image/jpeg':
                $data['extension'] = 'jpg';
                $data['formato'] = 'imagen';
                break;
            case 'application/pdf':
                $data['extension'] = 'pdf';
                $data['formato'] = 'pdf';
                break;
            default:
                $data['extension'] = '';
        }
        return $data;
    }

    public function updatedDenunciaPolicial()
    {
        $this->uploadFile($this->denuncia_policial, 'dm_denuncia_policial', 1);
        $this->reset('denuncia_policial');
    }

    public function updatedDniPropietario()
    {
        $this->uploadFile($this->dni_propietario, 'dm_dni_propietario', 2);
        $this->reset('dni_propietario');
    }

    public function updatedEscrituraContratoAlquiler()
    {
        $this->uploadFile($this->escritura_contrato_alquiler, 'dm_escritura_contrato_alquiler', 1);
        $this->reset('escritura_contrato_alquiler');
    }

    public function updatedFotosDanios()
    {
        $this->uploadFile($this->fotos_danios, 'dm_fotos_danios', 4);
        $this->reset('fotos_danios');
    }

    public function updatedPresupuesto()
    {
        $this->uploadFile($this->presupuesto, 'dm_presupuesto', 1);
        $this->reset('presupuesto');
    }


    public function uploadFile($file,$type, $max = 1)
    {
        $data = $this->getDataFile($file);
        $formato = $data['formato'];
        $extension = $data['extension'];

        if($this->danio_material->documentos()->where('type', $type)->count() >= $max)
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
            $name = $data['name'];
            $path = $data['path'];

            if($formato == 'imagen')
            {
                $file = Image::make($file->getRealPath());
                if($file->width() > 2100 || $file->height() > 2100)
                {
                    if($file->width() > $file->height())
                    {
                        $file->widen(2100);
                    } else {
                        $file->heighten(2100);
                    }
                }
                $url = FileUploadService::upload($file->stream($extension),$data['path'].'/'.$name);
            } else {
                $path = $file->storePubliclyAs($path, $name, 's3');
                $url = Storage::disk('s3')->url($path);
            }

            $this->danio_material->documentos()->create([
                'nombre' => $name,
                'type' => $type,
                'formato' => $formato,
                'url' => $url,
                'path' => $path,
                'reclamo_tercero_id' => $this->reclamo->id
            ]);
        }

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

        return redirect()->route('siniestros.terceros.paso10.daniosmateriales.create', ['id'=> $this->reclamo->identificador]);
    }





}
