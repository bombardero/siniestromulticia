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
	public $fecha;
    public $codigo_postal;
    public $lugar_siniestro;
    public $responsable_contacto;
    public $domicilio;
    public $telefono;
    public $telefono_confirmation;
    public $email;
    public $email_confirmation;

    public $hora;
    public $direccion_siniestro;
    public $conductor_siniestro;
    public $descripcion_siniestro;

    private function validateAsegurado()
    {
        return $validateAsegurable = $this->validate([
        	'terminos_condiciones' => 'accepted',
            'dominio' => 'required|max:7',
            'fecha' => 'required|date|before_or_equal:today',
            'lugar_siniestro' => 'required',
            'hora' => 'required',
            'codigo_postal' => 'required',
            'responsable_contacto' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required|numeric|digits_between:5,20|confirmed',
            'email' => 'required|email|max:50|confirmed',
            'descripcion_siniestro' => 'nullable|max:65535',
        ],
        [
            'responsable_contacto.required' => 'Responsable de contacto requerido',
            'dominio.max' => 'La patente debe tener como máximo 7 carácteres',
            'terminos_condiciones.accepted' => 'Debe aceptar los terminos y condiciones para continuar',
            'dominio.required' => 'El dominio del vehiculo es requerido',
            'lugar_siniestro.required' => 'El lugar de siniestro es requerido',
            'fecha.required' => 'La fecha del siniestro es requerida.',
            'hora.required' => 'La hora del siniestro es requerida.',
            'telefono.required'=> 'El telefono es requerido',
            'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
            'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' ,
            'email.required' => 'El email es requerido.',
            'email.email' => 'Escriba un formato valido de email',
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
                'fecha_siniestro' => $this->fecha,
                'hora_siniestro' => $this->hora,
                'direccion_siniestro' => $this->setNoDeclarado($this->direccion_siniestro),
                'conductor_siniestro' => $this->setNoDeclarado($this->conductor_siniestro),
                'descripcion_siniestro' => $this->setNoDeclarado($this->descripcion_siniestro),
                'responsable_contacto' => $this->responsable_contacto,
                'telefono' => $this->telefono
                ];

        DenunciaSiniestro::create([
            "estado_carga" => 'precarga',
            "identificador" => Str::uuid(),
            "dominio_vehiculo_asegurado" => $this->dominio ? $this->dominio : 'Sin dato registrado',
            "fecha" => $this->fecha,
            "hora" => $this->hora,
            "lugar_nombre" => $this->lugar_siniestro,
            "codigo_postal" => $this->codigo_postal,
            "direccion" => $this->setNoDeclarado($this->direccion_siniestro),
            "nombre_conductor" => $this->setNoDeclarado($this->conductor_siniestro),
            "descripcion" => $this->setNoDeclarado($this->descripcion_siniestro),
            "responsable_contacto_nombre" => $this->responsable_contacto,
            "responsable_contacto_domicilio" => $this->domicilio,
            "responsable_contacto_telefono" => $this->telefono,
            "responsable_contacto_email" => $this->email
        ]);

        //cliente
        Mail::to($this->email)->send(new MailAsegurado($data));
        //compania
        Mail::to(config('app.mail_siniestro_asegurado'))->send(new MailAseguradoCompania($data));

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
