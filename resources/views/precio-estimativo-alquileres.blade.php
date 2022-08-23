@extends('layouts.app')
@section('content')
<section class="seccion-precio-estimativo" style="background-color:#F8F8F8;">
    <div class="container" >
        <div class="row ">
            <div class="col-12 offset-md-2 col-md-8 offset-md-2 pt-5  ">
                <div class="text-center precio-estimativo-caja" role="alert">
                   <p class="precio-estimativo-texto pt-3 pb-3">Precio sugerido: $<span class="precio">{{$precio}}</span></p>
                </div>
                <div class="pt-3 text-center">
                  @if(Auth::user())
                        @if(Auth::user()->hasRole('cliente') || Auth::user()->hasRole('inmobiliaria') )
                            @livewire('boton-azul',['name' => 'Solicitar Seguro', 'url' => '/panel/'.Auth::id()])
                        @elseif(Auth::user()->hasRole('operario'))
                            @livewire('boton-azul',['name' => 'Solicitar Seguro', 'url' => '/panel-operario/'])
                        @endif
                    @else
                    @livewire('boton-azul',['name' => 'Solicitar Seguro', 'url' => '/register?state=cliente'])
                    @endif
                </div>

            </div>
            <div class="col-12 text-center pt-5">

                <img src="{{url('/images/home graphic.svg')}}" class="img-fluid d-none d-md-inline">
                <img src="{{url('/images/mobile/cotizacion online graphic.svg')}}" class="img-fluid d-md-none">
            </div>

        </div>
    </div>
</section>
<section class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="seguro-caucion-alquileres-texto">Seguro de caución para Alquileres </h1>
                <p class="seguro-caucion-alquileres-texto-subtitulo pt-2">La mejor solución para alquilar tu próxima propiedad</p>
                <p class="formas-de-pago pt-5">Todas las formas de Pago</p>
                <img src="{{url('/images/medios-pago 1.svg')}}" class="img-fluid pt-2 pb-5 mb-5">

            </div>

        </div>
    </div>
<section>


</section>

@endsection