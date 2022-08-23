<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductorRequest extends FormRequest
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
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'matricula' => ['required', 'numeric', 'digits_between:5,6'],
            'telefono' => ['required', 'numeric', 'digits_between:5,20'],
            'provincia' => ['required'],
            'city_id' => ['required'],
            'checkBoxRama' => ['required'],

            // 'codigo_postal' => ['required'],
            // 'direccion' => ['required'],
        ],$messages);
    }

    public function messages()
    {
        return [
            'matricula.numeric' => 'La matricula debe ser numerica, sin guiones y puntos. ',
            'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
            'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20',
        ];
    }
}

