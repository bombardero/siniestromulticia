@extends('layouts.app')

@section('content')
<section class="fondo-uno-productor" style="height: 650px;">
<div class="container">
    <div class="row">
{{--
        <div class="col-12">
            <div class="form-group row mb-0">
                <div class="mx-auto text-center text-md-left">    
                         @if(!Auth::check())                    
                        <a id="productor" class="mt-5 mb-5 imagen-boton-chateamos btn btn-success" href="{{ route('login', ['state' => 'productor']) }}">
                            Iniciar Sesión Productor
                        </a>
                        @endif
                </div>
             </div>
        </div>
--}}
        <div class="col-12 ">
            <center>

            <div class="card card-alta-productor text-center">
              <div class="card-body">
                @if(Auth::check() && Auth::user()->hasRole('productor'))
                {{--

                <h5 class="card-productor-title text-center pt-4">Ya estás logueado!</h5>
                        <a id="productor" class="mt-3 boton-contacto-automotor btn btn-warning" href="{{ route('panel-productor',Auth::user()) }}">
                            Ir al panel de productor
                        </a>
                --}}
                @else

                <h5 class="card-productor-title text-center pt-4">Formá parte de nuestro equipo</h5>
                <h6 class="mb-2 card-productor-subtitle pt-4">Somos una compañia jóven formada por un equipo con más de 40 años de experiencia.</h6>
                <p class="card-productor-llegamos">Llegamos para acompañarte</p>                
              </div>

                    <form class="" method="POST" action="{{ route('register',['state' => request()->get('state') ]) }}">

                        @csrf
                        <div class="form-group row">
                            <div class="offset-md-1 col-md-5">
                                <input value='{{old('name')}}' placeholder="Nombre y Apellido*" id="name" type="text" class="form-control form-estilo @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="pt-3 pt-md-0 col-md-5  ">
                                <select class="custom-select form-estilo w-100" required id="provincia" name="provincia">
                             <option value="" selected disable> Provincia<span class="campo-obligatorios-asterico">*</span></option>
                             @foreach($provinces as $province)
                                <option value={{$province->id }} {{ old('provincia') == $province->id ? 'selected' : '' }}>{{$province->name}}</option>
                             @endforeach
                        </select>
                                @error('provincia') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>                            

                        </div>

                        <div class="form-group row">

                                <div class="offset-md-1 col-md-5 pt-3 pt-md-0 ">
                                    <input value='{{old('telefono')}}' placeholder="Teléfono" id="telefono" type="text" class="form-control form-estilo @error('telefono') is-invalid @enderror" name="telefono" autocomplete="telefono" autofocus>

                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="pt-3 pt-md-0 col-md-5">
                                    <input value='{{old('email')}}' placeholder="Correo Electrónico* "  id="email" type="email" class="form-control form-estilo @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                

                        </div>

                        <div class="text-center col-12">
                                <button type="submit" class=" mt-3 boton-contacto-automotor btn btn-warning">Quiero que me contacte un gerente regional</button>        
                        </div>

                    </form>              
                    @endif
            </div>
            </center>
        </div>
    </div>
</section>
<section class="fondo-dos-productor">
    <div class="container">
        

    <div class="row">
        <div class="offset-md-2">
             
        </div>
        <div class="col-1 text-md-right">
            <img src="{{url('/images/productor/herr_im.png')}}" class="img-fluid"> 
        </div>
        <div class="col-9 text-left">
            <div class="texto-herramientas" >                
                <p class="herramientas">Tenemos herramientas que marcan la diferencia</p>
                <p class="herramientas-subtitle">Acompañamiento y asesoría de nuestros gerentes regionales</p> 
                <p class="herramientas-subtitle">Oficina virtual de gestión para P.A.S.</p>    
                <p class="herramientas-subtitle">Herramientas tecnológicas exclusivas</p>    
                <p class="herramientas-subtitle">Capacitación y crecimiento constante</p>                       
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="offset-md-2 col-md-4 col-12">
                <div class="card card-general card-autogestion card-width">
                  <div class="card-body">
                    <h5 class="cards-autogestion-title">Sistema de Autogestión </h5>
                    <ul>
                        <li class="cards-autogestion-list text-left">Emisión online.</li>
                        <li class="cards-autogestion-list text-left">Gestión de siniestros online. </li>
                        <li class="cards-autogestion-list text-left">Mesa de ayuda 24 hs.</li>
                        <li class="cards-autogestion-list text-left">Asistencia de Grúa 24 hs.</li>
                        <li class="cards-autogestion-list text-left">Gestión desde cualquier dispositivo.</li>
                    </ul>
                  </div>
                </div>
        </div>
        <div class="col-md-5 col-12 mt-3 mt-md-0 ">
   
                <div class="card card-general  card-mediopago card-width">
                  <div class="card-body">
                    <h5 class="cards-autogestion-title">Medios de pago</h5>
                        <p class="cards-autogestion-list text-left">Todas las plataformas de pagos habilitadas.  Débito automático con tarjeta de débito y crédito. Débito en cuenta, Rapipago, Pago Fácil, Mercado Pago, PagoMisCuentas y efectivo por Pronto Pago</p>
                  </div>
                </div>

        </div>       

        <div class="offset-md-2 col-md-4 col-12 mt-3">
                <div class="card card-general card-beneficio card-width">
                  <div class="card-body">
                    <h5 class="cards-autogestion-title">Beneficios </h5>
                    <ul>
                        <li class="cards-autogestion-list text-left">Acompañamos a nuestros productores en la capacitación de temas vinculados al seguro.</li>
                        <li class="cards-autogestion-list text-left"><strong>Incentivos y premios por cumplimiento de objetivos.</strong></li>
                        <li class="cards-autogestion-list text-left">Bonificaciones especiales por cancelaciones anticipadas</li>
                    </ul>
                  </div>
                </div>
        </div>      

        <div class="mb-5 col-md-5 col-12 mt-3 mt-md-0 ">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-general  card-material card-width">
                          <div class="card-body">
                            <h5 class="cards-autogestion-title">Material gráfico de apoyo</h5>
                            <ul>
                                <li class="cards-autogestion-list text-left">Baner promocional para local o stand.</li>
                                <li class="cards-autogestion-list text-left">Contenido gráfico para tus redes sociales</li>
                            </ul>
                          </div>
                        </div>                    
                    </div>
                    <div class="mt-3 col-12">
                        <div class="card card-general  card-material card-width">
                          <div class="card-body">
                            <h5 class="cards-autogestion-title">Nuestros comerciales son PAS</h5>
                            <p class="cards-autogestion-list text-left">Contamos con un equipo para acompañar tu proceso de crecimiento</p>

                          </div>
                        </div>                    
                    </div>                    
                </div>

        </div>              



    </div>


        <div class="row">
            <div class="col-12 text-center pt-3 pb-3">
                 <img src="{{url('/images/productor/pas_im1.png')}}" class="img-fluid ">    
            </div>
        </div>
            </div>
</div>
</section>
@endsection

@section('scripts')

@endsection