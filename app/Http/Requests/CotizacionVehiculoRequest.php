<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Province;
use App\Models\City;

class CotizacionVehiculoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inlineRadioOptions' => 'required',
            'tipos' => 'required',
            'marcas' => 'required',
            'telefono' => 'required | numeric | digits_between:5,20',
            'email' => 'required | email | max: 50 ',
            'usos' => 'required',
            'modelos' => 'required',
            'codigo_postal' => ['required', 'numeric', function ($attribute, $value, $fail) {

                $provincia = Province::where('cod',request('provincia'))->first();
                $ciudad = City::where('codigo_postal',$value)->first();

                if($ciudad == null ){
                    $fail('Asegurate que el codigo postal '.$value.' existe.');
                }else if($ciudad->province_id != $provincia->id ){
                    $fail('Asegurate que el codigo postal '.$value.' pertenezca a la provincia seleccionada.');
                }

        },],
            'año' => 'required | numeric',
            'provincia' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tipo.required' => 'El tipo de vehiculo es requerido',
            'marcas.required' => 'La marca del vehiculo es requerida',
            'modelos.required' => 'El modelo es requerido.',
            'telefono.required'=> 'El telefono es requerido',
            'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
            'codigo_postal.numeric' => 'Codigo postal invalido. Asegurate de que solo sean numeros',
            'año.numeric' => 'Año invalido. Asegurate de que solo sean numeros',
            'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20' ,
            'email.required' => 'El email es requerido.',
            'email.email' => 'Escriba un formato valido de email',
            'inlineRadioOptions.required' => 'Por favor, elija una opcion'            
        ];
    } 
}
