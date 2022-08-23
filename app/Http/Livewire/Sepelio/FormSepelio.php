<?php

namespace App\Http\Livewire\Sepelio;

use App\Models\Asegurable;
use App\Models\Beneficiario;
use App\Models\DatosPolizaSepelio;
use App\Models\GrupoFamiliar;
use App\Models\Productor;
use App\Models\Province;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;
use Livewire\Component;

class FormSepelio extends Component
{
	//VARIABLES ASEGURABLE:
	public $nombre_asegurable;
	public $dni_asegurable;
	public $ocupacion;
	public $cuit_asegurable;
	public $condicion_iva;
	public $province_id;
	public $city_id;
	public $provinces;
	public $lugar_nacimiento_asegurable;
	public $fecha_nacimiento_asegurable;
	public $edad_asegurable;
	public $sexo_asegurable;
	public $nacionalidad_asegurable;
	public $mano_habil;
	public $estado_civil;
	public $domicilio_asegurable;
	public $email_asegurable;

	//VARIABLES GRUPO FAMILIAR:
	public $nombre_familia;
	public $parentesco_familiar;
	public $dni_familia;
	public $fecha_nacimiento_familia;
	public $celular_familia;
	public $familia = [];
	public $i = 0;

	// VARIABLES DATOS POLIZA
	public $tipo_cobertura;
	public $inicio_vigencia;
	public $plazo_carencia;
	public $facturacion;
	public $cuotas;

	// VARIABLES BENEFICIARIO
	public $nombre_beneficiario;
	public $parentesco_beneficiario;
	public $dni_beneficiario;
	public $prioridad_beneficiario;
	public $porcentaje_beneficiario;
	public $beneficiarios = [];
	public $j = 0;
	
	// VARIABLES PRODUCTOR
	public $nombre_productor;
	public $codigo;

    // FIRMA
    public $firma;

    public $validator;

    protected $rules = [
        'fecha_nacimiento_asegurable' => 'required | min:10 | max:10',

    ];

    protected $messages = [
        'fecha_nacimiento_asegurable.min' => 'La fecha de nacimiento debe tener el formato dd.mm.yyyy',
        'fecha_nacimiento_asegurable.max' => 'La fecha de nacimiento debe tener el formato dd.mm.yyyy'
    ];
	public function mount() 
	{
		$this->provinces = Province::all();

	}
    public function setLugarNacimientoDefault() 
    {
        $this->lugar_nacimiento_asegurable="Argentina";
    }
    public function setNacionalidadDefault()
    {
        $this->nacionalidad_asegurable="Argentina";
    }

	public function addFamilia($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->familia ,$i);
    }

	public function addBeneficiario($j)
    {
        $j = $j + 1;
        $this->j = $j;
        array_push($this->beneficiarios ,$j);
    }

    public function removeBeneficiario($j)
    {
        unset($this->beneficiarios[$j]);
    }

    public function removeFamilia($i)
    {
        unset($this->familia[$i]);
    }

    public function updated($fecha_nacimiento_asegurable)
    {
        $this->validateOnly($fecha_nacimiento_asegurable);
        if($this->validateOnly($fecha_nacimiento_asegurable))
        {
            $this->calcularEdad();
        }
    }

    public function calcularEdad()
    {

        $this->edad_asegurable = Carbon::parse($this->fecha_nacimiento_asegurable)->age; //      
    }



    public function render()
    {
        return view('livewire.sepelio.form-sepelio', ['provinces' => $this->provinces]);
    }


    public function validateAsegurable()
    {
    
        return $validateAsegurable = $this->validate([
        	'nombre_asegurable' => 'required',
			'dni_asegurable' => 'required | numeric | digits_between:8,8',
			'ocupacion' => 'required',
			'cuit_asegurable' => 'required | numeric | digits_between:11,11',
			'condicion_iva' => 'required',
			'province_id' => 'required',
			'city_id' => 'required',
			'lugar_nacimiento_asegurable' => 'required',
			'fecha_nacimiento_asegurable' => 'required',
			'edad_asegurable' => 'required',
			'sexo_asegurable' => 'required',
			'nacionalidad_asegurable' => 'required',
			'mano_habil' => 'required',
			'estado_civil' => 'required',
			'domicilio_asegurable' => 'required',
			'email_asegurable' => 'required | email'

        ],
        [        
            'nombre_asegurable.required' => 'El nombre es requerido.',
            'edad_asegurable.required' => 'Ingrese la fecha para el calculo automatico de edad',
            'dni_asegurable.required' => 'DNI es requerido.',
            'ocupacion.required' => 'La ocupacion es requerida.',
            'cuit_asegurable.required' => 'EL CUIT es requerido.',
            'condicion_iva.required' => 'Condicion frente al IVA es requerido.',
            'province_id.required' => 'La provincia es requerida.',
            'city_id.required' => 'La ciudad es requerida.',
            'lugar_nacimiento_asegurable.required' => 'Lugar de nacimiento requerido.',
            'fecha_nacimiento_asegurable.required' => 'Fecha de nacimiento requerida.',
            'sexo_asegurable.required' => 'Seleccione el sexo.',
            'nacionalidad_asegurable.required' => 'La nacionalidad es requerida.',
            'mano_habil.required' => 'Seleccione su mano habil.',
            'estado_civil.required' => 'El estado civil es requerido.',
            'domicilio_asegurable.required' => 'El domicilio es requerido.',
            'email_asegurable.required' => 'El email es requerido.',
            'email_asegurable.email' => 'Por favor escriba un email correcto',
            'dni_asegurable.numeric' => 'El DNI debe ser numerico. ',
            'dni_asegurable.digits_between' => 'El DNI debe tener 8 caracteres.',
            'cuit_asegurable.numeric' => 'El CUIT debe ser numerico. ',
            'cuit_asegurable.digits_between' => 'El CUIT debe tener 11 caracteres.',            


        ]);
        
    }
    public function validateGrupoFamiliar() 
    {
    	return $validateGrupoFamiliar = $this->validate([
                'nombre_familia.0' => 'required',
                'parentesco_familiar.0' => 'required',
                'dni_familia.0' => 'required | numeric | digits_between:8,8',
                'fecha_nacimiento_familia.0' => 'required | min:10 | max:10',                
                'celular_familia.0' => 'required',
                'nombre_familia.*' => 'required',
                'parentesco_familiar.*' => 'required',
                'dni_familia.*' => 'required | numeric | digits_between:8,8',
                'fecha_nacimiento_familia.*' => 'required | min:10 | max:10',
                'celular_familia.*' => 'required',
            ],
            //MENSAJES DE ERROR PERSONALIZADOS:
            [
                'nombre_familia.0.required' => 'Nombre de familiar es requerido.',
                'parentesco_familiar.0.required' => 'Parentesco familiar es requerido.',
                'dni_familia.0.required' => 'El dni del familiar es requerido.',
                'dni_familia.0.numeric' => 'El DNI debe ser numerico. ',
                'dni_familia.0.digits_between' => 'El DNI debe tener 8 caracteres.',                         
                'fecha_nacimiento_familia.0.required' => 'Fecha nacimiento del familiar es requerido.',
                'fecha_nacimiento_familia.0.max' => 'La fecha de nacimiento debe tener el formato dd.mm.yyyy',                
                'fecha_nacimiento_familia.0.min' => 'La fecha de nacimiento debe tener el formato dd.mm.yyyy',
                'celular_familia.0.required' => 'El celular del familiar es requerido.',
                'nombre_familia.*.required' => 'Nombre de familiar es requerido.',
                'parentesco_familiar.*.required' => 'Parentesco familiar es requerido.',
                'dni_familia.*.required' => 'El dni del familiar es requerido.',
                'fecha_nacimiento_familia.*.required' => 'Fecha nacimiento del familiar es requerido.',
                'fecha_nacimiento_familia.*.max' => 'La fecha de nacimiento debe tener el formato dd.mm.yyyy',                
                'fecha_nacimiento_familia.*.min' => 'La fecha de nacimiento debe tener el formato dd.mm.yyyy',
                'celular_familia.*.required' => 'El celular del familiar es requerido.',
                'dni_familia.*.numeric' => 'El DNI debe ser numerico. ',
                'dni_familia.*.digits_between' => 'El DNI debe tener 8 caracteres.',
            ] 
        );
                 
        //COPIAR ESTO LUEGO EN EL STORE
        // foreach ($this->nombre_familia as $key => $value) {
        //     GrupoFamiliar::create(['nombre_familia' => $this->nombre_familia[$key], 'parentesco_familiar' => $this->parentesco_familiar[$key], 'dni_familia' => $this->dni_familia[$key], 'fecha_nacimiento_familia' => $this->fecha_nacimiento_familia[$key], 'celular_familia' => $this->celular_familia[$key]]);
        // }    	
    }


    public function setFirma(Request $request)
    {
        session(['firma'.Auth::id() => $request->firma]);
        
    }

    public function uploadFirma(Request $request)
    {
        $value = session('firma' . Auth::id());

        $year = Carbon::now()->format('Y');
       
        if(!$value)
        {
            throw new Exception("Error Processing Request - s3", 500);
        }

        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
        $name = 'firma'.$dateName;
        $filePath = 'firmas' . '/' . $year . '/' . $name;

        Storage::disk('s3')->put($filePath, file_get_contents($value),'public');

        $url = Storage::disk('s3')->url($filePath);
        $request->session()->forget('firma' . Auth::id());
        return $url;
    
    }       

    public function validateDatosPoliza() 
    {
    	return $validateDatosPoliza = $this->validate([
                'tipo_cobertura' => 'required',
                'inicio_vigencia' => 'required',
                'plazo_carencia' => 'required  | numeric | digits_between:1,365',
                'facturacion' => 'required',
                'cuotas' => 'required',

            ]);
    }    

    public function validateBeneficiario() 
    {
    	return $validateBeneficiario = $this->validate([
                'nombre_beneficiario.0' => 'required',
                'parentesco_beneficiario.0' => 'required',
                'dni_beneficiario.0' => 'required | numeric | digits_between:8,8',
                'prioridad_beneficiario.0' => 'required',
                'porcentaje_beneficiario.0' => 'required  | numeric | between:1,100',
                'nombre_beneficiario.*' => 'required',
                'parentesco_beneficiario.*' => 'required',
                'dni_beneficiario.*' => 'required | numeric | digits_between:8,8',
                'prioridad_beneficiario.*' => 'required',
                'porcentaje_beneficiario.*' => 'required | numeric | between:1,100' ,
            ],

            [
                'nombre_beneficiario.0.required' => 'Nombre del beneficiario es requerido.',
                'parentesco_beneficiario.0.required' => 'Parentesco del beneficiario es requerido.',
                'dni_beneficiario.0.required' => 'El dni del beneficiario es requerido.',
                'dni_beneficiario.0.numeric' => 'El DNI debe ser numerico. ',
                'dni_beneficiario.0.digits_between' => 'El DNI debe tener 8 caracteres.',            
                'prioridad_beneficiario.0.required' => 'La prioridad del beneficiario es requerida.',
                'porcentaje_beneficiario.0.required' => 'El porcentaje del beneficiario es requerido.',
                'porcentaje_beneficiario.0.numeric' => 'El porcentaje del beneficiario debe ser numerico.',                
                'porcentaje_beneficiario.0.between' => 'El porcentaje del beneficiario debe estar entre 1 y 100',                
                'nombre_beneficiario.*.required' => 'Nombre del beneficiario es requerido.',
                'parentesco_beneficiario.*.required' => 'Parentesco del beneficiario es requerido.',
                'dni_beneficiario.*.required' => 'El dni del beneficiario es requerido.',
                'prioridad_beneficiario.*.required' => 'La prioridad del beneficiario es requerida.',
                'porcentaje_beneficiario.*.required' => 'El porcentaje del beneficiario es requerido.',
                'porcentaje_beneficiario.*.numeric' => 'El porcentaje del beneficiario debe ser numerico.',                
                'porcentaje_beneficiario.*.between' => 'El porcentaje del beneficiario debe ser entre 1 y 100.',                
                'dni_beneficiario.*.numeric' => 'El DNI debe ser numerico. ',
                'dni_beneficiario.*.digits_between' => 'El DNI debe tener 8 caracteres.',                   
            ]             
        );
        //COPIAR ESTO LUEGO EN EL STORE
        // foreach ($this->nombre_familia as $key => $value) {
        //     GrupoFamiliar::create(['nombre_familia' => $this->nombre_familia[$key], 'parentesco_familiar' => $this->parentesco_familiar[$key], 'dni_familia' => $this->dni_familia[$key], 'fecha_nacimiento_familia' => $this->fecha_nacimiento_familia[$key], 'celular_familia' => $this->celular_familia[$key]]);
        // }    	
    }

    public function validateProductor() 
    {
    	return $validateProductor = $this->validate([
                'nombre_productor' => 'required',
                'codigo' => 'required | numeric | digits_between:5,5'
            ],
            [
                'codigo.required' => 'El codigo es requerido',
                'codigo.numeric' => 'El codigo debe ser numerico',
                'codigo.digits_between' => 'El codigo debe tener 5 digitos'
            ]

        );
    }

    public function store(Request $request)
    {
        $this->validateAsegurable();
        $this->validateGrupoFamiliar();
        $this->validateDatosPoliza();
        $this->validateBeneficiario();
        $this->validateProductor(); 
        if (!$request->session()->has('firma' . Auth::id())) 
        {
            Session::flash('message', 'Por favor, firme y/o confirme firma.'); 
        }
        else
        {

            
            //VERIFICACION DE SUMA DE PORCENTAJES
            foreach($this->validateBeneficiario() as $key => $value) 
            {
                $porcentaje_beneficiario_total = array_sum($value);
            }
            if($porcentaje_beneficiario_total > 100)
            {
                Session::flash('message_2', 'La suma de los porcentajes no puede ser mayor a 100%'); 
            }
            elseif($porcentaje_beneficiario_total < 100)
            {
                Session::flash('message_2', 'La suma de los porcentajes debe dar 100%'); 
            }
            else
            {
                    // CREA EL ASEGURABLE
                    $asegurable =  Asegurable::create($this->validateAsegurable());
                    // UPDATE DE FIRMA DEL ASEGURABLE
           
                    $asegurable->update(['firma' => $this->uploadFirma($request)]);
                
                    // CREA EL GRUPO FAMILIAR
                    foreach ($this->nombre_familia as $key => $value) 
                    {
                        $familiares[] = GrupoFamiliar::create(['nombre_familia' => $this->nombre_familia[$key], 'parentesco_familiar' => $this->parentesco_familiar[$key], 'dni_familia' => $this->dni_familia[$key], 'fecha_nacimiento_familia' => $this->fecha_nacimiento_familia[$key], 'celular_familia' => $this->celular_familia[$key], 'asegurable_id' => $asegurable->id]);
                    }
                    // SE CREA PRODUCTOR
                    $productor =  Productor::create($this->validateProductor());
                    // SE CREA LA POLIZA
                    $poliza =  DatosPolizaSepelio::create(array_merge($this->validateDatosPoliza(),['asegurable_id' => $asegurable->id, 'productor_id' => $productor->id]));
                    // SE CREAN LOS BENEFICIARIOS
                    foreach ($this->nombre_beneficiario as $key => $value) 
                    {
                       $beneficiarios[] = Beneficiario::create(['nombre_beneficiario' => $this->nombre_beneficiario[$key], 'parentesco_beneficiario' => $this->parentesco_beneficiario[$key], 'dni_beneficiario' => $this->dni_beneficiario[$key], 'prioridad_beneficiario' => $this->prioridad_beneficiario[$key], 'porcentaje_beneficiario' => $this->porcentaje_beneficiario[$key]]);
                    }
                    // SE ASOCIAN LOS BENEFICIARIOS CON LA POLIZA
                    foreach($beneficiarios as $beneficiario)
                    {
                        $poliza->beneficiarios()->attach($beneficiario->id,['datos_poliza_sepelio_id'=> $poliza->id]);       
                    }

      
                    //GENERACION DE PDF
                   return redirect()->route('pdf.generate',
                    [
                        'poliza' => $poliza,

                    ]);
            
            }
        }

    }   

    
}
