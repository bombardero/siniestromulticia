<?php

namespace App\Http\Livewire\Siniestro;

use App\Mail\MailSiniestroCompania;
use App\Mail\MailTercero;
use App\Models\ReclamoTercero;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
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
    public $telefono_confirmation;
    public $email;
    public $email_confirmation;

    public $hora_siniestro;
    public $direccion_siniestro;
    public $descripcion_siniestro;
    public $reclamo_vehicular = false;
    public $reclamo_danios_materiales = false;
    public $reclamo_lesiones = false;

    protected function rules()
    {
        return [
            'terminos_condiciones' => 'accepted',
            'numero_denuncia' => 'nullable|numeric',
            'lugar_siniestro' => 'required',
            'fecha_siniestro' => 'required|date|before_or_equal:today',
            'hora_siniestro' => 'required',
            'responsable_contacto' => 'required',
            'dominio' => 'nullable|max:7',
            'dominio_asegurado' => 'required|max:7',
            'telefono' => 'required|numeric|digits_between:5,15|confirmed',
            'email' => 'required|email|max:255|confirmed',
            'descripcion_siniestro' => 'nullable|max:65535'
        ];
    }

    protected $messages = [
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
        'reclamo_vehicular.required' => 'Debe seleccionar al menos una opción',
        'reclamo_danios_materiales.required' => 'Debe seleccionar al menos una opción',
        'reclamo_lesiones.required' => 'Debe seleccionar al menos una opción'
    ];

    public function withValidator($callback)
    {
        $this->withValidatorCallback = $callback;
        return $this;
    }

    public function submit()
    {
        $this->validate();
        if (!$this->reclamo_vehicular && !$this->reclamo_danios_materiales && !$this->reclamo_lesiones) {
            $this->addError('reclamo_tipos', 'Debe seleccionar al menos una opción');
            return;
        }

        $data = [
                'numero_denuncia' => $this->numero_denuncia ? $this->numero_denuncia : 'Sin dato registrado',
                'email' => $this->email,
                'dominio' => $this->dominio != null ? strtoupper($this->dominio) : 'Sin dato registrado',
                'dominio_asegurado' => $this->dominio_asegurado,
                'lugar_siniestro' => $this->lugar_siniestro,
                'fecha_siniestro' => $this->fecha_siniestro,
                'hora_siniestro' => $this->hora_siniestro,
                'direccion_siniestro' => $this->setNoDeclarado($this->direccion_siniestro),
                'descripcion_siniestro' => $this->setNoDeclarado($this->descripcion_siniestro),
                'responsable_contacto' => $this->responsable_contacto,
                'telefono' => '549'.$this->telefono,
                ];

        ReclamoTercero::create([
            'estado_carga' => 'precarga',
            'identificador' => Str::uuid(),
            'dominio_vehiculo_asegurado' => strtoupper($this->dominio_asegurado),
            'dominio_vehiculo_tercero' => $this->dominio != null ? strtoupper($this->dominio) : null,
            'fecha' => $this->fecha_siniestro,
            'hora' => $this->hora_siniestro,
            'lugar_nombre' => $this->lugar_siniestro,
            'direccion' => $this->setNoDeclarado($this->direccion_siniestro),
            'descripcion' => $this->setNoDeclarado($this->descripcion_siniestro),
            'responsable_contacto_nombre' => $this->responsable_contacto,
            'responsable_contacto_telefono' => '549'.$this->telefono,
            'responsable_contacto_email' => $this->email,
            'reclamo_vehicular' => $this->reclamo_vehicular,
            'reclamo_danios_materiales' => $this->reclamo_danios_materiales,
            'reclamo_lesiones' => $this->reclamo_lesiones,
        ]);

        // Cliente
        Mail::to($this->email)->send(new MailTercero($data));

        // Compañía
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
