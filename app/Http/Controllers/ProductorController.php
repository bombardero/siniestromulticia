<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProductorController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('productores.index', ['provincias' => $provinces]);
    }

    public function mail(Request $request)
    {
        $rules =  [
            'nombre_apellido' => 'required',
            'provincia' => 'required',
            'email' => 'required',
            'telefono' => 'nullable',
        ];
        Validator::make($request->all(),$rules)->validate();
        $data = $request->all();

        $data['provincia'] = Province::find($request->provincia);
        Mail::send('mail.alta-productor', $data, function ($mail) {
            $mail->to(config('app.mail_alta_productor'))->subject('Solicitud de alta de Productor');
        });

        $email = $request->email;
        $email = explode('@',$email);
        $email[0] = substr($email[0], 0,3).'****';
        $email = implode('@',$email);

        return view('productores.gracias', ['email' => $email]);
    }
}
