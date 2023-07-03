@extends('layouts.app')
@section('content')
    <section style="background-color: #F8F8F8;">
        <div class="container">
            <div class="row pt-5 mb-5">
                <div class="offset-1 col-10 offset-1 text-center"
                     style="border-radius: 20px;background-color: rgba(229, 83, 28, 1);">
                    <img src="{{url('/images/recived 1.svg')}}" class="img-fluid ">
                    <h4 class="px-3 pt-4 text-white">
                        Reclamo de Siniestro - Número de Gestión: {{ $reclamo->id }}
                    </h4>
                    <h5 class="px-3 pt-2 text-white">
                        Estado:
                        @if($reclamo->estado_carga == '10')
                            @foreach($estados as $value => $estado)
                                @if($reclamo->estado == $value )
                                    {{ $estado }}
                                @endif
                            @endforeach
                        @else
                            Carga Incompleta
                        @endif
                    </h5>
                </div>
                <div class="col-12 text-center pt-5">
                    @livewire('boton-azul',['name' => 'Volver', 'url' => '/'])
                </div>
            </div>
        </div>
    </section>
@endsection

