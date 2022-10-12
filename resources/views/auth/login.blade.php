@extends('layouts.app')

@section('content')
    <section class="login" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5 mb-1 bg-gray-light">
                        <div class="card-body row">
                            <div class="col-md-6 mx-auto">
                                <a href="{{url('login/facebook'. '?state='.request()->get('state'))}}"
                                   class="text-left w-100 btn ingresar-redes-sociales-boton disabled">
                                    <img class="img-fluid pr-2" src="{{url('/images/mobile/facebook 1.svg')}}">
                                    Continuar con Facebook (Próximamente)
                                </a>
                                <a href="{{url('login/google'.'?state='.request()->get('state'))}}"
                                   class="text-left w-100 btn ingresar-redes-sociales-boton mt-3 disabled">
                                    <img class="img-fluid pr-2"src="{{url('/images/mobile/google-plus 1.svg')}}">
                                    Continuar con Google (Próximamente)
                                </a>
                                <form method="POST" action="{{ route('login') }}" class="mt-3">
                                    @csrf

                                    <div class="form-label-group">
                                        <input style="border-radius:10px" id="email"
                                               type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                                               autofocus>
                                        <label for="email">Email</label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-label-group">
                                        <input type="password" id="password"
                                                   style="border-radius:10px;"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="current-password">
                                        <label for="password">Contraseña</label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="text-center text-md-left pl-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Recordar contraseña
                                            </label>
                                        </div>
                                    </div>

                                    <div class="pt-3 text-center">
                                        @livewire('boton-azul',['name' => 'Iniciar Sesion', 'url' => '/'])
                                    </div>


                                </form>
                                @if (Route::has('password.request'))
                                    <p class="text-center">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(request()->get('state') === 'productor')
                        <p class="registrarme text-center">No tengo una cuenta.
                            <u>
                                <a class="text-center registrarme"
                                   href="{{ route('productor.alta',['state' =>request()->get('state') ]) }}">
                                    Registrarme como productor
                                </a>
                            </u>
                        </p>
                    @else
                        <p class="registrarme text-center">No tengo una cuenta.
                            <u>
                                <a class="text-center registrarme" href="{{ route('register',['state' =>request()->get('state') ]) }}">
                                    @if(request()->get('state') == 'cliente')
                                        Registrarme como cliente
                                    @elseif(request()->get('state') == 'inmobiliaria')
                                        Registrarme como inmobiliaria
                                    @else
                                        Registrarme como cliente
                                    @endif
                                </a>
                            </u>
                        </p>
                    @endif
                </div>
            </div>
        </div>

    </section>
@endsection
