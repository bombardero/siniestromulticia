<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Socialite;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers,HasRoles;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function redirectPath()
    {
        if (Auth::user()->hasRole('cliente') || Auth::user()->hasRole('inmobiliaria')) 
        {
            return route('panel',['user' => Auth::user()]);
        }
        elseif(Auth::user()->hasRole('operario'))
        {
             return route('panel-operario');
        } 
        elseif(Auth::user()->hasRole('productor')) 
        {
           return route('panel-productor',Auth::user());
        }
        elseif(Auth::user()->hasRole('admin')) 
        {
            return route('panel-admin');
        }
        elseif(Auth::user()->hasRole('callcenter'))
        {
            return route('panel-callcenter');   
        }
    }
    
    public function provider(Request $request, $provider)
    
    {
     
       // return Socialite::driver($provider)->redirectUrl('http://localhost:8000/login/'.$provider.'/redirect?value=' .$request->value)->redirect();
        return Socialite::driver($provider)->redirectUrl('https://finisterre.com.ar/login/'.urlencode($provider).'/redirect')->with(["access_type" => "offline", "state" => $request->state])->redirect();


    }

    public function providerRedirect(Request $request, $provider)
    {
       // dd($request->state);
        // get response from provider
        $provinces = Province::all();

        $userProvider = Socialite::driver($provider)->stateless()->user(); //Obtengo el usuario y el state que le envio por parametro en la linea 51)
        $user = User::where($this->username(),$userProvider->email)->first();
        if($user)
        {

            Auth::login($user, true);
            if(Auth::user()->hasRole('cliente') || Auth::user()->hasRole('inmobiliaria'))
                return redirect()->route('panel',['user' => Auth::user()]);
            elseif(Auth::user()->hasRole('operario'))
            {
                return redirect()->route('panel-operario');
            }
            elseif(Auth::user()->hasRole('productor'))
            {
                return redirect()->route('panel-productor');
            }
            //SI no funciona sacar el if y el elseif)

        }
        else
        {

            return redirect()->route('register',[
                'state' => 'cliente',
                'name' => $userProvider->name, 
                'email' => $userProvider->email, 
                'provinces' => $provinces
                ]);
            // ->with(['name' => $userProvider->name, 'email' => $userProvider->email, 'state' => $request->state, 'provinces' => $provinces]);
            // return view('auth.register',
            // [
            //     'name' => $userProvider->name,
            //     'email' => $userProvider->email,
            //     'state' => $request->state,
            //     'provinces' => $provinces
            // ]);
        }
    }

  
}
