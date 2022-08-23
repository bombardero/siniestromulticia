<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Models\City;
use App\Models\Propietario;
use App\Models\Province;
use App\Models\Solicitud;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class FormPropietario extends Component
{
    use AuthorizesRequests;
    
    public $city_old;
	public $nombre;
    public $dni;
    public $email;
    public $province_id;
    public $telefono;
    public $city_id;
    public $domicilio;
    public $provinces;
    public $solicitud;
    public $cities = [];
    public $updateMode = false;
    public $tipoPersonaAlerta;
    public $blockMode;
    public $formMode = "store";
    protected $rules = [
            'nombre' => 'required | max:60',
            'dni' => 'required | numeric | digits_between:11,11',
            'email' => 'required | email | max: 50 ',
            'province_id' => 'required',
            'city_id' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required | numeric | digits_between:5,20',
            
    ];
    protected $messages = [
        'dni.numeric' => 'El CUIL debe ser numerico. ',
        'dni.digits_between' => 'El CUIL debe tener 11 caracteres y sin guiones.',
        'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
        'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' 
    
    ];

  
    public function mount(Solicitud $solicitud, $updateMode) {

        $this->provinces = Province::all();
        $this->solicitud = $solicitud;

          if($updateMode == false)
        {
         $this->blockMode = false;
        }
        else
        {
             if($updateMode && $solicitud->propietario->type == 0)
            {

            $propietario = Propietario::findOrFail($solicitud->propietario->id);
            $this->city_old = City::find($propietario->city_id)->name;
            $this->nombre = $propietario->nombre;
            $this->dni = $propietario->dni;
            $this->telefono = $propietario->telefono;
            $this->email = $propietario->email;
            $this->city_id = $propietario->city_id;
            $this->domicilio = $propietario->domicilio;
            $this->province_id = $propietario->province_id;
            $this->formMode = "update";
            $this->cities =  City::where('province_id', $propietario->province_id)->get();
            }
            
            else 
            {
            $this->blockMode = true;    
            $this->tipoPersonaAlerta =  "Este propietario es una persona humana, para editarlo cambia a pestaña 'Persona Humana' ";
            }

        }
    }
   
    public function store()
    {
       
        $this->validate();

        $this->authorize('store', Solicitud::find($this->solicitud->id));

        $propietario =  Propietario::create(array_merge($this->validate(),['type' => false]));

        $solicitud = Solicitud::find($this->solicitud->id);
        $solicitud->update([
            'estado_propietario_dos' => true,
            'propietario_id' => $propietario->id,
        ]);

        EstadoSolicitudCambio::dispatch($solicitud);
      
        session()->flash('message', 'Cambios guardados');

        return redirect()->route('estadoPoliza.show',$this->solicitud);
         
    }


    public function update()
    {
      $solicitud = Solicitud::find($this->solicitud->id);
      $this->authorize('update', $solicitud);

      $this->validate();

      $propietario = Propietario::find($this->solicitud->propietario->id);
      $propietario->update(array_merge($this->validate(),['type' => false]));
      
            if($this->solicitud->status == 'Rechazada')
            {
            $this->solicitud->update(['status' => 'Completa']);
            }

             EstadoSolicitudCambio::dispatch($this->solicitud);
      
             session()->flash('mensaje',' Propietario ' . $this->solicitud->propietario->nombre. ' editado correctamente!'); 

     return redirect()->route('estadoPoliza.show',$this->solicitud);
    }


    public function render()
    {
        return view('livewire.form-propietario',['provinces' => $this->provinces,'cities' => $this->cities]);
    }

    public function listarCiudades($id) {
    
        $this->cities = City::where('province_id', $id)->get();

    }
}
