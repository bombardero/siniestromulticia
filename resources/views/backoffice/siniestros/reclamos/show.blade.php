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

                                        <div class="alert alert-secondary mt-3 " role="alert"><b>Datos del Contacto</b></div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>Nombre: {{ $reclamo->responsable_contacto_nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Teléfono: {{ $reclamo->responsable_contacto_telefono }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Email: {{ $reclamo->responsable_contacto_email }}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Datos del Asegurado</b>
                                            <a href="{{ route('siniestros.terceros.paso1.create',['id' => $reclamo->identificador]) }}"
                                                class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>Nombre: {{ $reclamo->asegurado_nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Dominio: {{ $reclamo->vehiculo_asegurado_dominio }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Número de Póliza: {{ $reclamo->vehiculo_asegurado_nro_poliza }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Marca: {{ $reclamo->marcaVehiculoAsegurado ? $reclamo->marcaVehiculoAsegurado->nombre : $reclamo->vehiculo_asegurado_otra_marca }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Modelo: {{ $reclamo->modeloVehiculoAsegurado ? $reclamo->modeloVehiculoAsegurado->nombre : $reclamo->vehiculo_asegurado_otro_modelo }}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Reclamante</b>
                                            <a href="{{ route('siniestros.terceros.paso2.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>Nombre: {{ $reclamo->reclamante ? $reclamo->reclamante->nombre : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Tipo de Documento: {{ $reclamo->reclamante ? $reclamo->reclamante->tipoDocumento->nombre : '' }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>N° de Documento: {{ $reclamo->reclamante ? $reclamo->reclamante->documento_numero : '' }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Teléfono: {{ $reclamo->reclamante ? $reclamo->reclamante->telefono : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>Domicilio: {{ $reclamo->reclamante ? $reclamo->reclamante->domicilio : '' }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Código Postal: {{ $reclamo->reclamante ? $reclamo->reclamante->codigo_postal : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            @if($reclamo->reclamante && $reclamo->reclamante->pais_id && $reclamo->reclamante->province_id)
                                                <div class="col-md-4">
                                                    <p>País: {{ $reclamo->reclamante->pais->nombre }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Provincia: {{ $reclamo->reclamante->provincia->name }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Localidad: {{ $reclamo->reclamante->city_id != null ? $reclamo->reclamante->localidad->name : $reclamo->reclamante->otro_pais_provincia_localidad }}</p>
                                                </div>
                                            @elseif($denuncia->otro_pais_provincia_localidad)
                                                <div class="col-12">
                                                    <p>Localidad/Provincia/Pais: {{ $denuncia->otro_pais_provincia_localidad }}</p>
                                                </div>
                                            @else
                                                <div class="col-12 col-md-4">
                                                    <p>País:</p>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <p>Provincia:</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Localidad:</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Vehículo</b>
                                            <a href="{{ route('siniestros.terceros.paso3.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Marca: {{ $reclamo->vehiculo ? ($reclamo->vehiculo->marca ? $reclamo->vehiculo->marca->nombre : $reclamo->vehiculo->otra_marca) : '' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Modelo: {{ $reclamo->vehiculo ? ($reclamo->vehiculo->modelo ? $reclamo->vehiculo->modelo->nombre : $reclamo->vehiculo->otro_modelo) : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <p>Tipo: {{ $reclamo->vehiculo ? $reclamo->vehiculo->tipo : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p>Año: {{ $reclamo->vehiculo ? $reclamo->vehiculo->anio : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p>Dominio: {{ $reclamo->vehiculo_asegurado_dominio }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Compañía de Seguro: {{ $reclamo->vehiculo ? $reclamo->vehiculo->compania_seguros : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Número de Póliza: {{ $reclamo->vehiculo ? $reclamo->vehiculo->compania_seguros : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Tipo de Cobertura: {{ $reclamo->vehiculo ? $reclamo->vehiculo->tipo_cobertura : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Franquicia: {{ $reclamo->vehiculo ? $reclamo->vehiculo->franquicia : '' }}</p>
                                            </div>
                                        </div>


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
