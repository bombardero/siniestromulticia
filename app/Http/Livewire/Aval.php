<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Models\DocumentoPoliza;
use App\Models\Solicitud;
use App\Services\DocumentoService;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class Aval extends Component
{
	use WithFileUploads;
	use AuthorizesRequests;

	private $fileUploadService;
	private $documentService;
	
	public $avales = [];
	public $archivos = [];
	public $updateMode = false;
	public $formMode = "store";
	public $solicitud;
	public $url = [];
	public $fileName = [];
    protected $rules = [
            'avales' => "required||max:12000"          
    ];
   
    public $listeners = [
        "upload_aval" => 'uploadFileAval'
    ];

	public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
        $this->documentService = new DocumentoService();
    }
	public function mount(Solicitud $solicitud, $updateMode) 
	{
		$this->solicitud = $solicitud;
		$this->updateMode = $updateMode;
		if($updateMode)
		{
			$this->archivos = $solicitud->documentos()->where('type', 1)->get();

			//type 1 es AVAL type 0 ES CONTRATO
/*
			foreach($avales as $contrato)
			{

			$this->fileName = $aval->nombre;
			$this->url = $aval->url;

			}
			*/
			$this->formMode = "store";
		}
	}

	public function eliminarArchivo($id)
    {
    	$archivo = DocumentoPoliza::find($id);

    	$archivo->delete();
    }



	public function updatedAval()
	{
		  $this->validate();
	}
	public function uploadFileAval($file)
	{


		$solicitud = Solicitud::find($this->solicitud->id);
		
	    $this->authorize('update', $solicitud);

	    $documentType = "aval";
		$url = $this->fileUploadService->uploadFile($file,$documentType);

		$this->documentService->createPoliza($url, $documentType, $solicitud,1);

		if(!$solicitud->documentos()->where('type', 1)->count() > 0){
			$this->validate();
		}

		$this->documentService->updateDocument($solicitud,'estado_aval_cinco');
	   	$this->documentService->dispatchSolicitudCambio($solicitud,'estado_aval_cinco');

    }

	public function store()
	{ 
	   return redirect()->route('estadoPoliza.show',$this->solicitud);           
	}

	public function addAval() 
	{	
		$year = Carbon::now()->format('Y');
		$this->validate();

	}


	public function render()
	{
		return view('livewire.aval');
	}
}
