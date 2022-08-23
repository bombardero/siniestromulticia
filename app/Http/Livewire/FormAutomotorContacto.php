<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FormAutomotorContacto extends Component
{

	public $nombre;
	public $email;
	public $codigo_postal;
	public $telefono;
	public $horario_disponibilidad;

	protected $rules = [
			'nombre' => 'required | max:60',
			'email' => 'required | email | max: 50 ',
			'codigo_postal' => 'required | max:6',
			'telefono' => 'required | numeric | digits_between:5,20',
			'horario_disponibilidad' => 'required',
	];
	protected $messages = [
		'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
		'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' 
	
	];

  
	public function submit()
	{
		
		$this->validate();

		Mail::send('mail.mail-contacto-automotor', 
		[
			'nombre' => $this->nombre, 
			'email' => $this->email, 
			'codigo_postal' => $this->codigo_postal, 
			'telefono' => $this->telefono, 
			'horario_disponibilidad' => $this->horario_disponibilidad

		], 

		 function ($mail) {
		
		 $mail->to(config('app.mail_alta_automotor'))->subject('Solicitud de contacto por automotor');
 
	   });

		return redirect()->to('/gracias');
	}

	public function render()
	{
		return view('livewire.form-automotor-contacto');
	}
}
