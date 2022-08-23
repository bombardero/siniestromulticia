<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class Inmobiliaria extends Component 
{
	
	public $updateMode;
	public $inmobiliarias;
	public $inmobiliaria;
	public $selected;
	public $solicitud;
	public $formMode = "store";

	protected $rules = [
        'inmobiliaria' => 'required',
    ];
    protected $messages = [
        'inmobiliaria' => 'Por favor, selecciona una inmobiliaria. ',
    ];

	public function mount(Solicitud $solicitud, $updateMode) 
	{


		$this->solicitud = $solicitud;
		$this->updateMode = $updateMode;
		$this->inmobiliarias = User::role('inmobiliaria')->get();
		if($updateMode)
		{
			$this->formMode = "update";
		}
	}
	public function store()
	{
	
		$this->validate();
		$solicitud = Solicitud::find($this->solicitud->id);
		$solicitud->update([
            'estado_inmobiliaria_cuatro' => true,
            'inmobiliaria_id' => $this->inmobiliaria,
        ]);

        EstadoSolicitudCambio::dispatch($solicitud);
        session()->flash('mensaje','Inmobiliaria agregada correctamente'); 
        return redirect()->route('estadoPoliza.show',$this->solicitud);


	}

	public function update()
	{
		$this->validate();
		Solicitud::find($this->solicitud->id)
        ->update([
            'estado_inmobiliaria_cuatro' => true,
            'inmobiliaria_id' => $this->inmobiliaria,
        ]);
        
        if($this->solicitud->status == 'Rechazada')
	  		{
	  		$this->solicitud->update(['status' => 'Completa']);
	  		}

	  		 EstadoSolicitudCambio::dispatch($this->solicitud);
         session()->flash('mensaje','Inmobiliaria editada correctamente'); 
        return redirect()->route('estadoPoliza.show',$this->solicitud);


	}	

    public function render()
    {
        return view('livewire.inmobiliaria');
    }
}
