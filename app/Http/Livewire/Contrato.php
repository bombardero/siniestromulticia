<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Models\DocumentoPoliza;
use App\Models\Solicitud;
use App\Services\DocumentoService;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Contrato extends Component
{

	use WithFileUploads;
	use AuthorizesRequests;

	private $fileUploadService;
	private $documentService;

	public $contratos = [];
	public $archivos = [];
	public $updateMode = false;
	public $formMode = "store";
	public $solicitud;
	public $url = [];
	public $fileName = [];
    protected $rules = [
            'contratos' => ['required', 'max:12288']         
    ];
    public $listeners = [
        "upload_contrato" => 'uploadFileContrato'
    ];

    protected $messages = [
      
    ];

	public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
        $this->documentService = new DocumentoService();
    }
    public function uploadFileContrato($file)
    {
    		
    		

		$solicitud = Solicitud::find($this->solicitud->id);
		
		$this->authorize('store', $solicitud);
	    $this->authorize('update', $solicitud);

	    $documentType = "contrato";
		$url = $this->fileUploadService->uploadFile($file,$documentType);

		$this->documentService->createPoliza($url, $documentType, $solicitud,0);

		if(!$solicitud->documentos()->where('type', 0)->count() > 0){
			$this->validate();
		}

		$this->documentService->updateDocument($solicitud,'estado_contrato_tres');
	   	$this->documentService->dispatchSolicitudCambio($solicitud,'estado_contrato_tres');


    }

    public function eliminarArchivo($id)
    {
    	$archivo = DocumentoPoliza::find($id);

    	$archivo->delete();
    }

	public function mount(Solicitud $solicitud, $updateMode) 
	{
		//dd("asd");
		//$this->fileUploadService = new FileUploadService();

		$this->solicitud = $solicitud;
		$this->updateMode = $updateMode;
		if($updateMode)
		{
			$this->archivos = $solicitud->documentos()->where('type', 0)->get();


			/*
			foreach($contratos as $contrato)
			{
			$this->fileName = $contrato->nombre;
			$this->url = $contrato->url;

			}
			*/
			$this->formMode = "store";
		}
	}


	public function updated()
	{
		  $this->validate();
	}


	public function store()
	{
	   return redirect()->route('estadoPoliza.show',$this->solicitud);           
	}

	public function addContrato() 
	{	
		$year = Carbon::now()->format('Y');
		$this->validate();
	}


	public function render()
	{
		return view('livewire.contrato');
	}
}
