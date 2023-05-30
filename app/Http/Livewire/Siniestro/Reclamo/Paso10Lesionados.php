<?php

namespace App\Http\Livewire\Siniestro\Reclamo;

use App\Models\ConductorReclamo;
use App\Models\DocumentosReclamo;
use App\Models\LesionadoReclamo;
use App\Models\ReclamoTercero;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Paso10Lesionados extends Component
{
    use WithFileUploads;

    public $reclamo;
    public $lesionado;
    public $tipo;
    public $orden;

    public $dni;
    public $dni_tutor;
    public $denuncia_policial;
    public $historia_clinica;
    public $gastos_medicos;
    protected $fileUploadService;

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

    public function mount(ReclamoTercero $reclamo, string $orden,  $lesionado)
    {
        $this->reclamo = $reclamo;
        $this->orden = $orden;
        $this->lesionado = $lesionado;
        $this->tipo = get_class($lesionado) == 'App\Models\ConductorReclamo' ? 'Conductor' : 'Lesionado';
    }

    public function render()
    {
        return view('livewire.siniestro.reclamo.paso10-lesionados');
    }

    private function getDocumentoPathAndName($type, $format = 'jpg')
    {
        $name = $type.'_'.Carbon::now()->format('Ymd_His').'.'.$format;
        return ['path' => 'reclamo_tercero/'.$this->reclamo->id.'/documentos/lesionados', 'name' => $name];
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

    public function updatedDni()
    {
        $this->uploadFile($this->dni, 'dl_dni', 2);
        $this->reset('dni');
    }

    public function updatedDniTutor()
    {
        $this->uploadFile($this->dni_tutor, 'dl_dni_tutor', 2);
        $this->reset('dni_tutor');
    }

    public function updatedDenunciaPolicial()
    {
        $this->uploadFile($this->denuncia_policial, 'dl_denuncia_policial', 1);
        $this->reset('denuncia_policial');
    }

    public function updatedHistoriaClinica()
    {
        $this->uploadFile($this->historia_clinica, 'dl_historia_clinica', 4);
        $this->reset('historia_clinica');
    }

    public function updatedGastosMedicos()
    {
        $this->uploadFile($this->gastos_medicos, 'dl_gastos_medicos', 4);
        $this->reset('gastos_medicos');
    }

    public function uploadFile($file,$type, $max = 1)
    {
        $data = $this->getDataFile($file);
        $formato = $data['formato'];
        $extension = $data['extension'];

        if($this->lesionado->documentos()->where('type', $type)->count() >= $max)
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

            $this->lesionado->documentos()->create([
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

        return redirect()->route('siniestros.terceros.paso10.lesionados.create', ['id'=> $this->reclamo->identificador]);
    }

}
