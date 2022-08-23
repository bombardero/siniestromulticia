<?php

namespace App\Http\Livewire\Siniestro;

use App\Mail\MailSiniestroCompania;
use App\Mail\MailTercero;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FormTerceros extends Component
{
    public $terminos_condiciones = false;
    public $numero_denuncia;
    public $lugar_siniestro;
	public $fecha_siniestro;
    public $dominio;
    public $dominio_asegurado;
    public $responsable_contacto;
    public $telefono;
    public $email;
    public $email_confirmation;

    public $hora_siniestro;
    public $direccion_siniestro;
    public $descripcion_siniestro;

    private function validateAsegurado()
    {    
        return $validateAsegurable = $this->validate([
            'numero_denuncia' => 'nullable|numeric',
        	'terminos_condiciones' => 'accepted',
            'lugar_siniestro' => 'required',
            'fecha_siniestro' => 'required',
            'hora_siniestro' => 'required',
            'responsable_contacto' => 'required',
            'dominio' => 'sometimes|max:7',            
            'dominio_asegurado' => 'required | max:7',
            'telefono' => 'required | numeric | digits_between:5,20',
            'email' => 'required | email | max: 50 ',
            'email_confirmation' => 'required | same:email',
        ],
        [        
            'numero_denuncia.numeric' => 'La denuncia solo debe contener numeros',
            'responsable_contacto.required' => 'Responsable de contacto requerido',
            'dominio.max' => 'La patente debe tener como máximo 7 carácteres',
            'dominio_asegurado.max' => 'La patente debe tener como máximo 7 carácteres',            
            'terminos_condiciones.accepted' => 'Debe aceptar los terminos y condiciones para continuar',
            'dominio_asegurado.required' => 'El dominio del vehiculo es requerido',
            'lugar_siniestro.required' => 'El lugar de siniestro es requerido',
            'fecha_siniestro.required' => 'La fecha del siniestro es requerida.',
            'hora_siniestro.required' => 'La hora del siniestro es requerida.',
            'telefono.required'=> 'El telefono es requerido',
            'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
            'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' ,
            'email.required' => 'El email es requerido.',
            'email.email' => 'Escriba un formato valido de email',
            'email_confirmation.required' => 'Por favor, confirme su email',
            'email_confirmation.same' => 'Los email no coinciden'

        ]);
        
    }

    public function submit() {
        $this->validateAsegurado();

        $data = [
                'numero_denuncia' => $this->numero_denuncia ? $this->numero_denuncia : 'Sin dato registrado',
                'email' => $this->email,
                'dominio' => $this->dominio ? $this->dominio : 'Sin dato registrado', 
                'dominio_asegurado' => $this->dominio_asegurado,
                'lugar_siniestro' => $this->lugar_siniestro, 
                'fecha_siniestro' => $this->fecha_siniestro, 
                'hora_siniestro' => $this->hora_siniestro,
                'direccion_siniestro' => $this->setNoDeclarado($this->direccion_siniestro),
                'descripcion_siniestro' => $this->setNoDeclarado($this->descripcion_siniestro),
                'responsable_contacto' => $this->responsable_contacto,
                'telefono' => $this->telefono, 
                ];
        //cliente
        Mail::to($this->email)->send(new MailTercero($data));
        
        //compania

        Mail::to(config('app.mail_siniestro_tercero'))->send(new MailSiniestroCompania($data));

        return redirect()->to('/gracias');
    }

    public function render()
    {
        return view('livewire.siniestro.form-terceros');
    }

    private function setNoDeclarado($valor){
        if(strcmp($valor, "") == 0){
            return "No declarado";
        }else{
            return $valor;
        }
    }
}
