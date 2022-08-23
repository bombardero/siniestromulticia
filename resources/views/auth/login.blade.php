@extends('layouts.app')

@section('content')
<section class="login" style="background-color: white;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-card card mt-5 mb-1 mx-auto" style="background-color: #F8F8F8;">
         

                <div class="card-body">
                    <div class="form-group row">
                            <div class="mt-5 col-md-6 mx-auto">
                               <a href="{{url('login/facebook'. '?state='.request()->get('state'))}}" class="text-left w-100 btn ingresar-redes-sociales-boton "><span><img class="img-fluid pr-2" src="{{url('/images/mobile/facebook 1.svg')}}">Continuar con Facebook</span></a>
                            </div>
                    </div>
                     <div class="form-group row">
                           

                            <div class="col-md-6 mx-auto">
                                <a href="{{url('login/google'.'?state='.request()->get('state'))}}" class="text-left w-100 btn ingresar-redes-sociales-boton"><span> <img class="img-fluid pr-2" src="{{url('/images/mobile/google-plus 1.svg')}}">Continuar con Google</span></a>
                            </div>

                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                           

                            <div class="col-md-6 mx-auto">
                               
                                    
                                     <input style="border-radius:10px" placeholder="@ Correo Electronico" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                               
                               

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-6 mx-auto">
                                
                                
                                   
                                <input style="border-radius:10px;" placeholder="Contraseña" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 text-center text-md-left " >
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recordar contraseña

                                    </label>
                                    <div class="pt-4 mx-auto text-center text-md-left">
                                        @livewire('boton-azul',['name' => 'Iniciar Sesion', 'url' => '/'])
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                       
                    </form>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                          

                            @if (Route::has('password.request'))
                                <p class="text-center text-md-left"><a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                    
                                </a></p>
                            @endif
                          
                        </div>
                       
                    </div>

                    
                </div>
            </div>
            @if(request()->get('state') === 'productor')
                <p class="registrarme text-center">No tengo una cuenta. 
                    <u>
                        <a class="text-center registrarme" href="{{ route('productor.alta',['state' =>request()->get('state') ]) }}">
                        Registrarme como productor
                        </a>
                    </u>
                </p>
            @else
              <p class="registrarme text-center">No tengo una cuenta. <u><a class="text-center registrarme" href="{{ route('register',['state' =>request()->get('state') ]) }}">
                 @if(request()->get('state') == 'cliente')
                 Registrarme como cliente
                 @elseif(request()->get('state') == 'inmobiliaria')
                 Registrarme como inmobiliaria
                 @else
                 Registrarme como cliente
                 @endif


              </a></u></a></p>
            @endif
        </div>
    </div>
</div>

</section>
@endsection
