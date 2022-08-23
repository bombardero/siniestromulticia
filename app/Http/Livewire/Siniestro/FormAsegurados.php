<?php

namespace App\Http\Livewire\Siniestro;

use App\Mail\MailAsegurado;
use App\Mail\MailAseguradoCompania;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\DenunciaSiniestro;
use DateTime;
use Illuminate\Support\Str;

class FormAsegurados extends Component
{
    public $terminos_condiciones = false;
    public $dominio;
	public $fecha_siniestro;
    public $codigo_postal;
    public $lugar_siniestro;
    public $responsable_contacto;
    public $domicilio;
    public $telefono;
    public $telefono_confirmation;
    public $email;
    public $email_confirmation;

    public $hora_siniestro;
    public $direccion_siniestro;
    public $conductor_siniestro;
    public $descripcion_siniestro;

    private function validateAsegurado()
    {    
        return $validateAsegurable = $this->validate([
        	'terminos_condiciones' => 'accepted',
            'dominio' => 'required | max:7',
            'lugar_siniestro' => 'required',
            'fecha_siniestro' => 'required|min:10|max:10',
            'hora_siniestro' => 'required',
            'codigo_postal' => 'required',
            'responsable_contacto' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required | numeric | digits_between:5,20',
            'telefono_confirmation' => 'required | numeric | digits_between:5,20 | same:telefono',
            'email' => 'required | email | max: 50 ',
            'email_confirmation' => 'required | same:email',
        ],
        [        
            'responsable_contacto.required' => 'Responsable de contacto requerido',
            'dominio.max' => 'La patente debe tener como máximo 7 carácteres',
            'terminos_condiciones.accepted' => 'Debe aceptar los terminos y condiciones para continuar',
            'dominio.required' => 'El dominio del vehiculo es requerido',
            'lugar_siniestro.required' => 'El lugar de siniestro es requerido',
            'fecha_siniestro.required' => 'La fecha del siniestro es requerida.',
            'hora_siniestro.required' => 'La hora del siniestro es requerida.',
            'telefono.required'=> 'El telefono es requerido',
            'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
            'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' ,
            'email.required' => 'El email es requerido.',
            'email.email' => 'Escriba un formato valido de email',
            'email_confirmation.required' => 'Por favor, confirme su email',
            'email_confirmation.same' => 'Los email no coinciden',
            'telefono_confirmation.same' => 'Los telefonos no coinciden'

        ]);
        
    }

    public function submit() {
        $this->validateAsegurado();
        $data = [
                'domicilio' => $this->domicilio,
                'email' => $this->email,
                'dominio' => $this->dominio ? $this->dominio : 'Sin dato registrado',  
                'codigo_postal' => $this->codigo_postal, 
                'lugar_siniestro' => $this->lugar_siniestro, 
                'fecha_siniestro' => $this->fecha_siniestro, 
                'hora_siniestro' => $this->hora_siniestro,
                'direccion_siniestro' => $this->setNoDeclarado($this->direccion_siniestro),
                'conductor_siniestro' => $this->setNoDeclarado($this->conductor_siniestro),
                'descripcion_siniestro' => $this->setNoDeclarado($this->descripcion_siniestro),
                'responsable_contacto' => $this->responsable_contacto, 
                'telefono' => $this->telefono
                ];
        //cliente
       Mail::to($this->email)->send(new MailAsegurado($data));
        //compania
        Mail::to(config('app.mail_siniestro_asegurado'))->send(new MailAseguradoCompania($data));        

        DenunciaSiniestro::create([
            "state" => 'precarga',
            "identificador" => Str::uuid(),
            "precarga_dominio_vehiculo_asegurado" => $this->dominio ? $this->dominio : 'Sin dato registrado',
            "precarga_fecha_siniestro" => DateTime::createFromFormat('d.m.Y', $this->fecha_siniestro)->format('Y-m-d'),
            "precarga_hora_siniestro" => $this->hora_siniestro,
            "precarga_lugar" => $this->lugar_siniestro,
            "precarga_codigo_postal" => $this->codigo_postal,
            "precarga_direccion_siniestro" => $this->setNoDeclarado($this->direccion_siniestro),
            "precarga_conductor_vehiculo_nombre" => $this->setNoDeclarado($this->conductor_siniestro),
            "precarga_descripcion" => $this->setNoDeclarado($this->descripcion_siniestro),
            "precarga_responsable_contacto_nombre" => $this->responsable_contacto,
            "precarga_responsable_contacto_domicilio" => $this->domicilio,
            "precarga_responsable_contacto_telefono" => $this->telefono,
            "precarga_responsable_contacto_email" => $this->email
        ]);

        return redirect()->to('/gracias');
    }



    public function render()
    {
        return view('livewire.siniestro.form-asegurados');
    }

    private function setNoDeclarado($valor){
        if(strcmp($valor, "") == 0){
            return "No declarado";
        }else{
            return $valor;
        }
    }
}
