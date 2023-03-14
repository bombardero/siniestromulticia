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
                        @if($reclamo->estado_carga == '8')
                            @switch($reclamo->estado)
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
                                @case('esperando-baja-de-unidad')
                                    Esperando baja de unidad
                                    @break

                            @endswitch
                        @else
                            Carga Incompleta
                        @endif
                    </h5>
                    {{--
                    <div class="mt-3">
                        @if($reclamo->estado_carga == '8')
                            <div class="px-3 pt-4">
                                <button type="button" class="btn btn-primary boton-azul-full" onclick="descargarFile('{{ route('asegurados-denuncias.pdf', ['denuncia' =>  $reclamo->id]) }}')">Descargar Reclamo</button>
                            </div>
                        @else
                            <a href="{{ route('asegurados-denuncias-paso1.create', ['id' =>  $denuncia->identificador]) }}" class="btn btn-primary boton-azul-full" >Completar Denuncia</a>
                        @endif
                    </div>
                    --}}
                </div>
                <div class="col-12 text-center pt-5">
                    @livewire('boton-azul',['name' => 'Volver', 'url' => '/'])
                </div>
            </div>
        </div>
    </section>



@endsection

@section('scripts')
<script>
    function descargarFile(url)
    {
        window.open(url, '_blank').focus();
    }

    $(".btn-delete-baja-unidad").click(function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        const file_id = $(this).data('file-id');
        console.log(url);
        console.log(file_id);

        showLoading();
        $.ajax(
            {
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "file_id": file_id
                },
                success: function (result) {
                    console.log(result);
                    hideLoading();
                    location.reload();
                },
                error: function (error) {
                    //console.log(error);
                    hideLoading();
                    alert('Hubo un error.');
                }
            })
    })

    $("#btn-enviar").click(function (event) {
        showLoading();
    })


</script>
@endsection
