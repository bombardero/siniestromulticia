<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\User;
use App\Models\Province;
use App\Providers\Productor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Traits\HasRoles;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, HasRoles;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function isClient(Request $request)
    {
        return $request['state'] == 'cliente';
    }
    
    protected function isInmobiliaria(Request $request)
    {
        return $request['state'] == 'inmobiliaria';
    }

    protected function isProductor(Request $request)
    {
        return $request['state'] == 'productor';
    }

    protected function validator(array $data)
    {

        $messages = [
            'cuit.numeric' => 'El CUIT debe ser numerico, sin guiones y puntos. ',
            'cuit.digits_between' => 'El CUIT debe tener 11 caracteres',
            'cuit.unique' => 'Este CUIT ya está registrado',
            'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
            'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20',
            'email.unique' => 'Ese :attribute ya existe en nuestra base de datos ',
            'matricula.numeric' => 'La matricula debe ser numerica, sin guiones y puntos. ',
            'telefono.numeric' => 'Telefono invalido. Asegurate de que solo sean numeros',
            'telefono.digits_between' => 'El telefono debe tener por lo menos 5 caracteres y como máximo 20',
            'checkBoxRama.required' => 'Seleccione por lo menos una rama por favor'
        ];
        if($data['state'] === 'productor') 
        {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],                
                'telefono' => ['nullable', 'numeric', 'digits_between:5,20'],
                'provincia' => ['required'],
            ],$messages);            
        }
        else 
        {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cuit' => ['required', 'numeric', 'digits_between:11,11', 'unique:users'],
            'telefono' => ['required', 'numeric', 'digits_between:5,20'],
            'provincia' => ['required'],
            'city_id' => ['required'],
            'codigo_postal' => ['required'],
            'direccion' => ['required'],        
        ],$messages);
        }
    }
    




    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {    

        $data['state'] === 'productor' ? $data['password'] = base64_encode(random_bytes(10)) : $data['password'];
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cuit' => $data['state'] === 'productor' ? $data['cuit'] = null : $data['cuit'],
            'telefono' => $data['telefono'] ,
            'province_id' => $data['provincia'],
            'city_id' => $data['state'] === 'productor' ? $data['city_id'] = null : $data['city_id'],
            'codigo_postal' => $data['state'] === 'productor' ? $data['codigo_postal'] = null : $data['codigo_postal'],
            'direccion' => $data['state'] === 'productor' ? $data['direccion'] = null : $data['direccion'],
            'matricula_pas' => null
            
        ]);
        if(isset($data['state'])) //chequeo si existe la variable state
        {

            if($data['state'] == 'cliente') 
            { 
                $user->assignRole('cliente'); //si existe y es igual a cliente asigno rol cliente
            }
            elseif($data['state'] == 'inmobiliaria') 
            {
                $user->assignRole('inmobiliaria'); // si existe y es igual a inmobiliaria asigno rol inmobiliaria
              
            }
            elseif($data['state'] == 'productor') 
            {
                $user->assignRole('productor');
                event(new Productor($user, $data));
            }
        }
        else 
        {
            $user->assignRole('cliente'); // si no existe asigno rol cliente
        }
            
        return $user; //retorno el usuario
    }

    public function showRegistrationForm()
    {
        $provinces = Province::all();
        $cities = City::all();
        
        return view('auth.register',
        [
            'name' => null,
            'email' => null,
            'provinces' => $provinces,
            'cities' => $cities
        ]);
    }

    protected function redirectTo()
    {
        if(Auth::user()->hasRole('operario'))
        {
            return route('panel-operario');
        }
        elseif(Auth::user()->hasRole('cliente'))
        {
             return route('panel',['user' => Auth::user()]);
        }
        elseif(Auth::user()->hasRole('productor'))
        {
            return route('gracias');
        }

    }   
}
