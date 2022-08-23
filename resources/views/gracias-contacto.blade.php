@extends('layouts.app')
@section('content')

<section style="background-color: #F8F8F8;">
    <div class="container">
        <div class="row pt-5 mb-5">
            <div class="col-12 text-center">
                <p class="pt-5 solicitud-enviada-muchas-gracias-title">
                   ¡Muchas Gracias!
                </p>
                <p class="pt-5 solicitud-enviada-muchas-gracias-subtitle">
                    Tu solicitud de contacto fue enviada
                </p>
                <p CLASS="pt-3 solicitud-enviada-muchas-gracias-email">
                    Un asesor se comunicará al telefono que nos brindaste
                </p>
               
            </div>
                <a class="volver text-center mx-auto" href="{{route('home')}}">Volver al Home</a>
        </div>
        <div class="row">
            <div class="col-12 text-center pt-3">
                 <img src="{{url('/images/mail/muchasgracias.svg')}}" class="img-fluid ">    
            </div>
        </div>
    </div>
</section>

@endsection