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
                                @case('esperando-baja-de-unidad')
                                    Esperando baja de unidad
                                    @break

                            @endswitch
                        @else
                            Carga Incompleta
                        @endif
                    </h5>

                    <div class="mt-3">
                        @if($denuncia->estado == 'esperando-baja-de-unidad')
                            <div class="mb-2 p-2 mx-auto border bg-gray-light" style="width: fit-content; border-radius: 20px;">
                            <form action="{{ route('denuncia-siniestros.asegurado.store-baja-unidad', ['id' => $denuncia->identificador]) }}" method="post" enctype="multipart/form-data">
                                <h5 class="">Subir baja de unidad</h5>
                                @csrf
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input d-inline-block" id="baja_unidad" name="baja_unidad[]" accept="image/png,image/jpeg" multiple>
                                    <label class="custom-file-label" for="baja_unidad" data-browse="Elegir">Seleccionar archivos</label>
                                    @error('baja_unidad') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" id="btn-enviar" class="btn btn-primary boton-azul mt-2 mb-0">Enviar</button>
                            </form>
                            <h6 class="mt-3">Archivos subidos (máximo 5)</h6>
                            <ul class="list-group">
                                @if($denuncia->documentosDenuncia()->where('type', 'baja_unidad')->count() == 0)
                                    Ninguno
                                @endif
                                @foreach($denuncia->documentosDenuncia()->where('type', 'baja_unidad')->get() as $file)
                                    <li class="list-group-item">
                                        <a target="_blank" class="text-dark text-decoration-none" href={{$file->url}}>{{$file->nombre}}</a>
                                        <a class="text-danger text-decoration-none btn-delete-baja-unidad"
                                           href="{{ route('denuncia-siniestros.asegurado.delete-baja-unidad',['id' => $denuncia->identificador]) }}"
                                            data-file-id="{{ $file->id }}"
                                        ><i class="fa-solid fa-trash-can ml-1"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                            </div>
                        @endif
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
