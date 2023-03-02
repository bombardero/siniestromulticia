@extends('layouts.super-admin')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 pt-5">
                    <div class="container">

                        <div class="row">
                            <div class="card card-show-denuncia col-12 px-0 mb-5">
                                <div class="card-header container">
                                    <div class="row">
                                        <h5 class="col-6 col-md-2 mb-0">
                                            Notificación: {{$reclamo->id}}
                                        </h5>
                                        <h5 class="col-6 col-md-3 text-danger mb-0">
                                            Estado Carga: <span
                                                class="text-uppercase">{{$reclamo->estado_carga}}</span>
                                        </h5>
                                        <div class="col-6 col-md-5">
                                            <h5>Responsable:
                                                {{--
                                                @if($reclamo->responsable)
                                                    <span>{{ $reclamo->responsable->name }}</span>
                                                    @if($reclamo->user_id === auth()->user()->id)
                                                        <a href="{{ route('admin.siniestros.denuncia.desasignar', ['denuncia' => $denuncia]) }}"
                                                           type="button" class="btn btn-danger btn-sm btn-quitar"
                                                           onclick="event.preventDefault();document.getElementById('form-desasignar').submit();"
                                                        ><i class="fa-solid fa-user-xmark"></i> Quitarme</a>
                                                        <form id="form-desasignar" action="{{ route('admin.siniestros.denuncia.desasignar', ['denuncia' => $denuncia]) }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    @endif
                                                @else
                                                    <a href="{{ route('admin.siniestros.denuncia.asignar', ['denuncia' => $denuncia]) }}"
                                                       type="button" class="btn btn-primary btn-sm"
                                                       onclick="event.preventDefault();document.getElementById('form-asignar').submit();"
                                                    ><i class="fa-solid fa-user-plus"></i> Asignarme</a>
                                                    <form id="form-asignar" action="{{ route('admin.siniestros.denuncia.asignar', ['denuncia' => $denuncia]) }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                @endif
                                                --}}
                                            </h5>
                                        </div>
                                        <div class="col-6 col-md-2 text-right">
                                            <a href="{{route('asegurados-denuncias.pdf',$reclamo->id)}}"
                                               class="btn btn-info btn-sm disabled"
                                               title="Descargar PDF"
                                            >
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                            <a href="{{ route('admin.siniestros.denuncia.delete',$reclamo->id) }}"
                                               class="px-2 btn btn-danger btn-sm btn-eliminar disabled" title="Eliminar">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body container">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <p>Fecha del Siniestro: {{ $reclamo->fecha->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>Hora del
                                                Siniestro: {{ \Carbon\Carbon::createFromFormat('H:i:s',$reclamo->hora)->format('H:i') }}</p>
                                        </div>
                                    </div>

                                    @if($reclamo->estado_carga == '8' && $reclamo->finalized_at)
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <p>Finalizado: {{ $reclamo->finalized_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($reclamo->estado_carga == 'precarga')
                                        <div class="row">
                                            <div class="col-12">
                                                Tipo de Reclamo: {{ implode(', ',$reclamo->tipos_reclamos) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                Dominio Vehículo Asegurado: {{ $reclamo->vehiculo_asegurado_dominio }}
                                            </div>
                                            <div class="col-12 col-md-6">
                                                Dominio Vehículo Tercero: {{ $reclamo->vehiculo_tercero_dominio }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Lugar del siniestro: {{ $reclamo->lugar_nombre }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Dirección: {{ $reclamo->direccion }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Descripción del Siniestro: {{ $reclamo->descripcion }}
                                            </div>
                                        </div>
                                        <h5 class="card-title mt-3">Datos del Contacto</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                Nombre: {{ $reclamo->responsable_contacto_nombre }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                Teléfono: {{ $reclamo->responsable_contacto_telefono }}
                                            </div>
                                            <div class="col-12 col-md-6">
                                                Email: {{ $reclamo->responsable_contacto_email }}
                                            </div>
                                        </div>

                                    @else

                                        {{--

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Observaciones
                                        </div>

                                        <table class="table">
                                            <thead class="thead tabla-panel">
                                            <tr class="tabla-cabecera ">
                                                <th class="th-padding" scope="col">FECHA</th>
                                                <th class="th-padding" scope="col">COMENTARIO</th>
                                                <th class="th-padding" scope="col">USER</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($denuncia->observaciones as $observacion )
                                                <tr class="borde-tabla">
                                                    <td>{{ $observacion->created_at->format('d-m-Y H:i:s') }}</td>
                                                    <td>{{$observacion->detalle}}</td>
                                                    <td>{{$observacion->user->name}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        <form action="{{ route('admin.siniestros.denuncia.observaciones.store',['denuncia' => $denuncia]) }}" method="post" class="w-100">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Nueva observación</label>
                                                <textarea class="form-control @error('observacion') is-invalid @enderror" id="observacion" name="observacion" rows="3" required></textarea>
                                                @error('observacion') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-primary">Agregar</button>
                                            </div>
                                        </form>
                                        --}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>

        $('.btn-eliminar').click(function (event) {
            let result = confirm('¿Confirma desea eliminar la denuncia?');
            if (!result) {
                event.preventDefault();
                return false;
            }
            showLoading();
        })
    </script>
@endsection
