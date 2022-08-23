<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Http\Livewire\RechazoLivewire;
use App\Models\Rechazo;
use App\Models\Solicitud;
use Livewire\Component;

class RechazoLivewire extends Component
{
	public $solicitud;
	public $type;
	public $motivo;

	protected $rules = [
            'motivo' => 'required | max:256',
            'type' => 'required',
    ];

    protected $messages = [
        'motivo.max' => 'El motivo no tiene que ser tan largo (hasta 256 caracteres)',
    ];

	public function mount(Solicitud $solicitud)

	{
		$this->solicitud = $solicitud;
	}

	public function submit()
	{
		$this->validate();

		$rechazo =  Rechazo::create([
			'type' => $this->type,
			'motivo' => $this->motivo,
			'solicitud_id' => $this->solicitud->id
		]);

		$solicitud = Solicitud::find($this->solicitud->id);
        $solicitud->update([

            'status' => 'Rechazada'
        ]);
        EstadoSolicitudCambio::dispatch($solicitud);
      	
        session()->flash('message', 'Cambios guardados');

        return redirect()->route('panel-operario');

       
	}
    public function render()
    {
        return view('livewire.rechazo-livewire');
    }
}
