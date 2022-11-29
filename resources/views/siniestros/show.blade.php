@extends('layouts.app')
@section('content')
    <section style="background-color: #F8F8F8;">
        <div class="container">
            <div class="row pt-5 mb-5">
                <div class="offset-1 col-10 offset-1 text-center"
                     style="border-radius: 20px;background-color: rgba(229, 83, 28, 1);">
                    <img src="{{url('/images/recived 1.svg')}}" class="img-fluid ">
                    <h4 class="px-3 pt-4 text-white">
                        Denuncia de Siniestro - Número de Gestión: {{ $denuncia->id }}
                    </h4>
                    <h5 class="px-3 pt-2 text-white">
                        Estado:
                        @if($denuncia->estado_carga == '12')
                            @switch($denuncia->estado)
                                @case('ingresado')
                                    Ingresado
                                    @break
                                @case('aceptado')
                                    Aceptado
                                    @break
                                @case('rechazado')
                                    Rechazado
                                    @break
                                @case('cerrado')
                                    Cerrado
                                    @break
                                @case('legales')
                                    Legales
                                    @break
                                @case('investigacion')
                                    Investigación
                                    @break
                                @case('derivado-proveedor')
                                    Derivado a proveedor
                                    @break
                                @case('solicitud-documentacion')
                                    Solicitud de documentación
                                    @break
                                @case('informe-pericial')
                                    Informe Pericial
                                    @break
                                @case('pendiente-de-pago')
                                    Pendiente de pago
                                    @break
                            @endswitch
                        @else
                            Carga Incompleta
                        @endif
                    </h5>
                    <div class="mt-3">
                        @if($denuncia->estado_carga == '12')
                            <div class="px-3 pt-4">
                                <button type="button" class="btn btn-primary boton-azul-full" onclick="descargarFile('{{ route('asegurados-denuncias.pdf', ['denuncia' =>  $denuncia->id]) }}')">Descargar Denuncia</button>
                            </div>
                            @if($denuncia->certificado_cobertura_url)
                                <div class="px-3 solicitud-enviada">
                                    <button type="button" class="btn btn-primary boton-azul-full" onclick="descargarFile('{{ $denuncia->certificado_cobertura_url }}')">Descargar Cerificado de Cobertura</button>
                                </div>
                            @else
                                <p class="pr-md-5 pl-md-5 text-white">
                                    En los próximos días tendrá aquí disponible el certificado de cobertura.<br>
                                </p>
                            @endif
                        @else
                            <a href="{{ route('asegurados-denuncias-paso1.create', ['id' =>  $denuncia->identificador]) }}" class="btn btn-primary boton-azul-full" >Completar Denuncia</a>
                        @endif
                    </div>

                </div>
                <div class="col-12 text-center pt-5">
                    @livewire('boton-azul',['name' => 'Volver', 'url' => '/'])
                </div>
            </div>
        </div>
    </section>

    <script>
        function descargarFile(url)
        {
            window.open(url, '_blank').focus();
        }
    </script>

@endsection
