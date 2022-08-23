<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Models\City;
use App\Models\DocumentoInquilino;
use App\Models\Inquilino;
use App\Models\Province;
use App\Models\Solicitud;
use App\Services\FileUploadService;
use App\Services\uploadFile;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormInquilinohumano extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $currentStep = 1;
    public $city_old;
	public $nombre;
    public $dni;
    public $email;
    public $province_id;
    public $telefono;
    public $cities = [];
    public $city_id;
    public $domicilio;
    public $provinces;
    public $sueldo_uno;
    public $sueldo_dos;
    public $sueldo_tres;
    public $recibos_sueldo;
    public $solicitud;
    public $sueldos = [];
    public $archivo_sueldos = [];
    public $archivos_dni = [] ; // equivalente a archivo_sueldos
    public $fotos_dni = [] ; // equivalente a sueldos []
    public $blockMode;
    public $updateModeHum = false;
    public $tipoPersonaAlerta;
    public $formMode = "store";


    protected $rules = [
            'sueldos' => ['required', 'max:12288'],
            'fotos_dni' => ['required', 'max:12288']            
    ];
    protected $messages = [
        'dni.numeric' => 'El DNI debe ser numerico. ',
        'dni.digits_between' => 'El DNI debe tener 8 caracteres.',
        'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
        'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' 
    
    ];

    public $listeners = [
        "upload_sueldo" => 'uploadFileSueldo',
         "upload_dni" => 'uploadFileDNI',
         'staffDirectoryRefresh' => '$refresh'
    ];

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

    public function uploadFileSueldo($file)
    {   
        
        $solicitud = Solicitud::find($this->solicitud->id);

        $this->authorize('store', $solicitud);
        $this->authorize('update', $solicitud);

        $year = Carbon::now()->format('Y');
        
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $documentType = "sueldo";

        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        DocumentoInquilino::create([
                'type' => 2,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'inquilino_id' => $this->solicitud->inquilino->id,
        ]);

        $documents_number = $this->solicitud->inquilino->documentos()->where('type', 2)->count();
        if(!$documents_number >0){
            $this->validate();
        }
        

    }

    public function uploadFileDNI($file)
    {
        $solicitud = Solicitud::find($this->solicitud->id);

        $this->authorize('store', $solicitud);
        $this->authorize('update', $solicitud);

        $year = Carbon::now()->format('Y');
        
        $documentType = "dni";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);


        DocumentoInquilino::create([
                'type' => 7,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'inquilino_id' => $this->solicitud->inquilino->id,
        ]);

        $documents_number = $this->solicitud->inquilino->documentos()->where('type', 7)->count();
        if(!$documents_number >0){
            $this->validate();
        }
        

    }

    public function eliminarArchivo($id)
    {
        $archivo = DocumentoInquilino::find($id);
        $archivo->delete();
    }

    public function mount(Solicitud $solicitud, $updateModeHum) {

        $this->provinces = Province::all();
        $this->solicitud = $solicitud;
        if($updateModeHum == false)
        {
            $this->blockMode = false;
            $this->nombre = Auth::user()->name;
            $this->dni = substr(Auth::user()->cuit,2,8);
            $this->email = Auth::user()->email;
            $this->telefono = Auth::user()->telefono;
            $this->province_id = Auth::user()->province_id;
            $this->city_id = Auth::user()->city_id;
            $this->city_old = City::find(Auth::user()->city_id)->name;
            $this->domicilio = Auth::user()->direccion;
        }
        else
        {

             if($updateModeHum && $solicitud->inquilino->type == 1)
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
            $this->sueldo_uno = $inquilino->sueldo_uno;
            $this->sueldo_dos = $inquilino->sueldo_dos;
            $this->sueldo_tres =  $inquilino->sueldo_tres;
            $this->archivo_sueldos = $inquilino->documentos()->where('type', 2)->get(); // type = 2 es igual a archivos sueldos
            $this->archivos_dni = $inquilino->documentos()->where('type', 7)->get(); // type = 7 es igual a Foto DNI
            $this->formMode = "update";
            $this->cities =  City::where('province_id', $inquilino->province_id)->get();
            }

            else
            {

            $this->blockMode = true;
            $this->tipoPersonaAlerta =  "Este inquilino es una persona juridica, para editarlo cambia a pestaña 'Persona Juridica' ";

            }


        }
    }
   
    public function store()
    {
       
        $this->validateForm(); 
        $this->authorize('store', Solicitud::find($this->solicitud->id));

        if($this->updateModeHum==true){
            $this->currentStep = 2;
            $this->emit('staffDirectoryRefresh');
            return;
        }

        $inquilino =  Inquilino::create(array_merge($this->validateForm(),['type' => true]));

        $solicitud = Solicitud::find($this->solicitud->id);
        $solicitud->update([
            'estado_inquilino_uno' => true,
            'inquilino_id' => $inquilino->id,
        ]);
        
        EstadoSolicitudCambio::dispatch($solicitud);
      
        session()->flash('message', 'Cambios guardados');


        $this->updateModeHum = true;
        $this->currentStep = 2;

        $this->emit('staffDirectoryRefresh');
         
    }

    public function thisStep($step)
    {
        $this->currentStep = $step;

    }

    public function secondStep() 
    {
        return redirect()->route('estadoPoliza.show',$this->solicitud);
    }

    public function back($step)

    {
        $this->currentStep = $step;    

    }

    public function updated()
    {
       $this->emit('staffDirectoryRefresh');
    }


    public function update()
    {

        $solicitud = Solicitud::find($this->solicitud->id);
        $this->authorize('update', $solicitud);
               
        $this->validateForm();

        $inquilino = Inquilino::find($this->solicitud->inquilino->id);
        $inquilino->update(array_merge($this->validateForm(),['type' => true]));

        if($this->solicitud->status == 'Rechazada')
        {
            $this->solicitud->update(['status' => 'Completa']);
        }

        EstadoSolicitudCambio::dispatch($this->solicitud);
      
        session()->flash('mensaje','Inquilino ' . $this->solicitud->inquilino->nombre. ' editado correctamente!'); 

        $this->currentStep = 2;
    }


    public function render()
    {
        return view('livewire.form-inquilinohumano',['provinces' => $this->provinces,'cities' => $this->cities]);
    }

    public function listarCiudades($id) {
        $this->cities = City::where('province_id', $id)->get();

    }

    public function validateForm(){
        return $this->validate([
            'nombre' => 'required | max:60',
            'dni' => 'required | numeric | digits_between:8,8',
            'email' => 'required | email | max: 50 ',
            'province_id' => 'required',
            'city_id' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required | numeric | digits_between:5,20',
            'sueldo_uno' => 'required',
            'sueldo_dos' => 'required',
            'sueldo_tres' => 'required',
        ]);
    }
}
