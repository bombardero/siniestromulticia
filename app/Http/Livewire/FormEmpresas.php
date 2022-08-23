<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FormEmpresas extends Component
{

	public $razon_social;
	public $cuit;
	public $email;
	public $responsable;
	public $telefono;
	public $cobertura_interes;

	protected $rules = [
			'razon_social' => 'required | max:60',
			'cuit' => 'required | numeric | digits_between:11,11',
			'email' => 'required | email | max: 50 ',
			'responsable' => 'required | | string | max:40',
			'telefono' => 'required | numeric | digits_between:5,20',
			'cobertura_interes' => 'required',
	];
	protected $messages = [
		'cuit.numeric' => 'El CUIT debe ser numerico y sin guiones. ',
		'cuit.digits_between' => 'El CUIT debe tener 11 caracteres',
		'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
		'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' 
	
	];

  
	public function submit()
	{
		
		$this->validate();

		Mail::send('mail.mail-empresa', 
		[
			'razon_social' => $this->razon_social, 
			'cuit' => $this->cuit, 
			'email' => $this->email, 
			'responsable' => $this->responsable, 
			'telefono' => $this->telefono, 
			'cobertura_interes' => $this->cobertura_interes

		], 

		 function ($mail) {
		
		 $mail->to(config('app.mail_caucion_empresa'))->subject('Nueva Solicitud de Seguro de Caucion de Empresa');
 
	   });

		return redirect()->to('/gracias');
	}

	public function render()
	{
		return view('livewire.form-empresas');
	}
}
