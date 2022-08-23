@extends('layouts.app')
@section('content')
@if($errors->any())
<section style="background-color: #F8F8F8;">
    <div class="container">
        <div class="row pt-5 mb-5">
            <div class="col-12 text-center">
                <p style="color:#ff0033 !important;" class="pt-5 solicitud-enviada-muchas-gracias-title">
                   ¡Hubo un error al realizar la cotización!
                </p>
                <p class="pt-5 solicitud-enviada-muchas-gracias-subtitle">
                    Tu solicitud NO fue enviada
                </p>
            </div>
                <a class="volver text-center mx-auto" href="{{route('cotiza-vehiculo')}}">Volver a Cotizar Vehiculo</a>
        </div>
    </div>
</section>
@else
<section style="background-color: #F8F8F8;">
    <div class="container">
        <div class="row pt-5 mb-5">
            <div class="col-12 text-center">
                <p class="pt-5 solicitud-enviada-muchas-gracias-title">
                   ¡Muchas Gracias!
                </p>
                <p class="pt-5 solicitud-enviada-muchas-gracias-subtitle">
                    Tu solicitud fue enviada
                </p>
                <p CLASS="pt-3 solicitud-enviada-muchas-gracias-email">
                    Te enviaremos la cotización solicitada  al correo {{$email}}
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
@endif

@endsection