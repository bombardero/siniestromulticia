<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Models\City;
use App\Models\DocumentoInquilino;
use App\Models\Inquilino;
use App\Models\Province;
use App\Models\Solicitud;
use App\Services\DocumentoService;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
class FormInquilino extends Component
{
	use WithFileUploads;
	use AuthorizesRequests;

	public $currentStep = 1;
	public $solicitud;
	public $city_old;
	public $nombre;
	public $dni;
	public $email;
	public $province_id;
	public $telefono;
	public $city_id;
	public $domicilio;
	public $provinces;
	public $highlightIndex = 0;
	public $query = '';
	public $cities = [];
	public $constancias = []; //TYPE 0 = CONSTANCIAS, TYPE 1 = Balance, TYPE 2 = Recibos Sueldo
	public $archivo_constancias= []; 
	public $balances = []; //TYPE 0 = CONSTANCIAS, TYPE 1 = Balance, TYPE 2 = Recibos Sueldo
	public $archivo_balances= []; 
	public $blockMode;
	public $updateModeJur = false;
	public $tipoPersonaAlerta;

	public $formMode = "store";
	protected $rules = [
			'nombre' => 'required | max:60',
			'dni' => 'required | numeric | digits_between:11,11',
			'email' => 'required | email | max: 50 ',
			'province_id' => 'required',
			'city_id' => 'required',
			'domicilio' => 'required',
			'telefono' => 'required | numeric | digits_between:5,20',
		  	#'constancias'=>'required',

	];


	 public $listeners = [
        "upload_constancia" => 'uploadFileConstancia',
         "upload_balance" => 'uploadFileBalance',
         'staffDirectoryRefresh' => '$refresh'
    ];

	protected $messages = [
		'dni.required' => 'El CUIT es requerido',
		'dni.numeric' => 'El CUIT debe ser numerico y sin guiones. ',
		'dni.digits_between' => 'El CUIT debe tener 11 caracteres',
		'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
		'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20',
	
	];

	public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

  	public function uploadFileConstancia($file)
    {   
        
        $solicitud = Solicitud::find($this->solicitud->id);
        $this->authorize('store', $solicitud);
        $this->authorize('update', $solicitud);

        $documentType = "constancia";

     	$url = $this->fileUploadService->uploadFile($file,$documentType);

        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
    
        DocumentoInquilino::create([
                'type' => 0,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'inquilino_id' => $this->solicitud->inquilino->id,
        ]);

        $documents_number = $this->solicitud->inquilino->documentos()->where('type', 0)->count();
        if(!$documents_number >0){
            $this->validate();
        }
        

    }

    public function uploadFileBalance($file)
    {

        $solicitud = Solicitud::find($this->solicitud->id);
        $this->authorize('store', $solicitud);
        $this->authorize('update', $solicitud);
       	
       	$documentType = "balance";
       	
       	$dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
       	
       	$url = $this->fileUploadService->uploadFile($file,$documentType);

        DocumentoInquilino::create([
                'type' => 1,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'inquilino_id' => $this->solicitud->inquilino->id,
        ]);

        $documents_number = $this->solicitud->inquilino->documentos()->where('type', 1)->count();
        if(!$documents_number >0){
            $this->validate();
        }
        

    }



    public function eliminarArchivo($id)
    {
        $archivo = DocumentoInquilino::find($id);

        $archivo->delete();
    }

    public function back($step)

    {

        $this->currentStep = $step;    

    }
	public function mount(Solicitud $solicitud, $updateModeJur) 
	{



		$this->provinces = Province::all();

		$this->solicitud = $solicitud;
		$this->updateModeJur = $updateModeJur;
		$this->updateMode($this->updateModeJur,$this->solicitud);

	}

	private function updateMode($updateModeJur,$solicitud)
	{
		//Si el modo UPDATE juridico es falso asigno los datos del usuario a los inputs
		  if($updateModeJur == false)
		{
		 	$this->blockMode = false;
		    $this->nombre = Auth::user()->name;
            $this->dni = Auth::user()->cuit;
            $this->email = Auth::user()->email;
            $this->telefono = Auth::user()->telefono;
            $this->province_id = Auth::user()->province_id;
            $this->city_id = Auth::user()->city_id;
            $this->city_old = City::find(Auth::user()->city_id)->name;
            $this->domicilio = Auth::user()->direccion;
            return;
		}
		else 
		{
			//SI el modo de update es verdadero y el inquilino es de tipo juridico , asigno los valores de la BD a los campos
			if($updateModeJur && $solicitud->inquilino->type == 0)
			{

			$inquilino = Inquilino::findOrFail($solicitud->inquilino->id);
			
			$this->city_old = City::find($inquilino->city_id)->name;
			$this->nombre = $inquilino->nombre;
			$this->dni = $inquilino->dni;
			$this->telefono = $inquilino->telefono;
			$this->email = $inquilino->email;
			$this->city_id = $inquilino->city_id;
			$this->domicilio = $inquilino->domicilio;
			$this->province_id = $inquilino->province_id;
			$this->archivo_constancias = $inquilino->documentos()->where('type', 0)->get(); // type 0 es constancias
			$this->archivo_balances = $inquilino->documentos()->where('type', 1)->get(); // type 1 es balances
			$this->formMode = "update";
			$this->cities =  City::where('province_id', $inquilino->province_id)->get();
			return;
			}
			else
				//No dejo al usuario editar un inquilino que tenga un tipo de persona distinto
			{
			 $this->blockMode = true;
			 $this->tipoPersonaAlerta =  "Este inquilino es una persona humana, para editarlo cambia a pestaña 'Persona Humana' ";
			 return;
			}

		}		
	}

	public function secondStep() 
    {

        return redirect()->route('estadoPoliza.show',$this->solicitud);

    }

	public function store()
	{


	  $this->validateForm();

	  $this->authorize('store', Solicitud::find($this->solicitud->id));

	   if($this->updateModeJur==true){
            $this->currentStep = 2;
            $this->emit('staffDirectoryRefresh');
            return;
        }
	  //$this->middleware('check.solicitud');

	  $inquilino =  Inquilino::create(array_merge($this->validateForm(),['type' => false]));

		 $solicitud = Solicitud::find($this->solicitud->id);
		 $solicitud->update([
			'estado_inquilino_uno' => true,
			'inquilino_id' => $inquilino->id,
		]);


		//dd(serialize($solicitud));
		EstadoSolicitudCambio::dispatch($solicitud);
		//event(new EstadoSolicitudCambio($solicitud));


		session()->flash('mensaje', 'Cambios guardados');

		$this->updateModeJur = true;
 		$this->currentStep = 2;
   		$this->emit('staffDirectoryRefresh');
	}

	public function thisStep($step)
    {
        $this->currentStep = $step;

    }




	public function update()
	{	

		//dd($this->solicitud->status == 'Aprobada' || $this->solicitud->status == "Pagada" );

	  	$solicitud = Solicitud::find($this->solicitud->id);

	  	$this->authorize('update', $solicitud);

	  
	   	$this->validateForm();


      	$inquilino = Inquilino::find($this->solicitud->inquilino->id);
   	 	$inquilino->update(array_merge($this->validateForm(),['type' => false]));

	  	if($this->solicitud->status == 'Rechazada')
	  	{
	  		$this->solicitud->update(['status' => 'Completa']);
	  	}

		 EstadoSolicitudCambio::dispatch($this->solicitud);

		session()->flash('mensaje','Inquilino ' . $this->solicitud->inquilino->nombre. ' editado correctamente!'); 

		$this->currentStep = 2;
	}



	public function listarCiudades($id) {
	
		$this->cities = City::where('province_id', $id)->get();

	}


	public function render()
	{


		return view('livewire.form-inquilino',['provinces' => $this->provinces, 'cities' => $this->cities]);
	}


    public function validateForm()
    {
        return $this->validate([
           	'nombre' => 'required | max:60',
			'dni' => 'required | numeric | digits_between:11,11',
			'email' => 'required | email | max: 50 ',
			'province_id' => 'required',
			'city_id' => 'required',
			'domicilio' => 'required',
			'telefono' => 'required | numeric | digits_between:5,20',
        ]);
    }
}
