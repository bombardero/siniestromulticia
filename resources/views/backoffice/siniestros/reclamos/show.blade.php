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
                                                @if($reclamo->responsable)
                                                    <span>{{ $reclamo->responsable->name }}</span>
                                                    @if($reclamo->user_id === auth()->user()->id)
                                                        <a href="{{ route('admin.siniestros.reclamos.desasignar', ['reclamo' => $reclamo]) }}"
                                                           type="button" class="btn btn-danger btn-sm btn-quitar"
                                                           onclick="event.preventDefault();document.getElementById('form-desasignar').submit();"
                                                        ><i class="fa-solid fa-user-xmark"></i> Quitarme</a>
                                                        <form id="form-desasignar" action="{{ route('admin.siniestros.reclamos.desasignar', ['reclamo' => $reclamo]) }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    @endif
                                                @else
                                                    <a href="{{ route('admin.siniestros.reclamos.asignar', ['reclamo' => $reclamo]) }}"
                                                       type="button" class="btn btn-primary btn-sm"
                                                       onclick="event.preventDefault();document.getElementById('form-asignar').submit();"
                                                    ><i class="fa-solid fa-user-plus"></i> Asignarme</a>
                                                    <form id="form-asignar" action="{{ route('admin.siniestros.reclamos.asignar', ['reclamo' => $reclamo]) }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                @endif
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
                                            <p>Hora del Siniestro: {{ \Carbon\Carbon::createFromFormat('H:i:s',$reclamo->hora)->format('H:i') }}</p>
                                        </div>
                                    </div>

                                    @if($reclamo->estado_carga == '10' && $reclamo->finalized_at)
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <p>Finalizado: {{ $reclamo->finalized_at->format('d/m/Y H:i:s') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <p>Tipo: {{ implode(', ',$reclamo->tipos_reclamos) }}</p>
                                        </div>
                                    </div>


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

                                        <!-- DATOS DE CONTACTO -->
                                        <!-- ------------------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <p class="mb-1"><b>Datos del Contacto</b></p>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-1">Nombre: {{ $reclamo->responsable_contacto_nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Teléfono: {{ $reclamo->responsable_contacto_telefono }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Email: {{ $reclamo->responsable_contacto_email }}</p>
                                            </div>
                                        </div>

                                        <!-- DATOS DEL ASEGURADO -->
                                        <!-- ------------------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Datos del Asegurado</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso1.create',['id' => $reclamo->identificador]) }}"
                                                class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-1">Nombre: {{ $reclamo->asegurado_nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Dominio: {{ $reclamo->vehiculo_asegurado_dominio }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Número de Póliza: {{ $reclamo->vehiculo_asegurado_nro_poliza }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Marca: {{ $reclamo->marcaVehiculoAsegurado ? $reclamo->marcaVehiculoAsegurado->nombre : $reclamo->vehiculo_asegurado_otra_marca }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Modelo: {{ $reclamo->modeloVehiculoAsegurado ? $reclamo->modeloVehiculoAsegurado->nombre : $reclamo->vehiculo_asegurado_otro_modelo }}</p>
                                            </div>
                                        </div>

                                        <!-- RECLAMANTE -->
                                        <!-- ---------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Reclamante</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso2.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-1">Nombre: {{ $reclamo->reclamante ? $reclamo->reclamante->nombre : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1">Tipo de Documento: {{ $reclamo->reclamante ? $reclamo->reclamante->tipoDocumento->nombre : '' }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">N° de Documento: {{ $reclamo->reclamante ? $reclamo->reclamante->documento_numero : '' }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">Teléfono: {{ $reclamo->reclamante ? $reclamo->reclamante->telefono : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-1">Domicilio: {{ $reclamo->reclamante ? $reclamo->reclamante->domicilio : '' }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">Código Postal: {{ $reclamo->reclamante ? $reclamo->reclamante->codigo_postal : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            @if($reclamo->reclamante && $reclamo->reclamante->pais_id && $reclamo->reclamante->province_id)
                                                <div class="col-md-4">
                                                    <p class="mb-1">País: {{ $reclamo->reclamante->pais->nombre }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Provincia: {{ $reclamo->reclamante->provincia->name }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Localidad: {{ $reclamo->reclamante->city_id != null ? $reclamo->reclamante->localidad->name : $reclamo->reclamante->otro_pais_provincia_localidad }}</p>
                                                </div>
                                            @elseif($reclamo->reclamante && $reclamo->reclamante->otro_pais_provincia_localidad)
                                                <div class="col-12">
                                                    <p class="mb-1">Localidad/Provincia/Pais: {{ $reclamo->otro_pais_provincia_localidad }}</p>
                                                </div>
                                            @else
                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">País:</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">Provincia:</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">Localidad:</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- DATOS DEL VEHÍCULO -->
                                        <!-- ------------------ -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Vehículo</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso3.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1">Marca: {{ $reclamo->vehiculo ? ($reclamo->vehiculo->marca ? $reclamo->vehiculo->marca->nombre : $reclamo->vehiculo->otra_marca) : '' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1">Modelo: {{ $reclamo->vehiculo ? ($reclamo->vehiculo->modelo ? $reclamo->vehiculo->modelo->nombre : $reclamo->vehiculo->otro_modelo) : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <p class="mb-1">Tipo: {{ $reclamo->vehiculo ? $reclamo->vehiculo->tipo : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="mb-1">Año: {{ $reclamo->vehiculo ? $reclamo->vehiculo->anio : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="mb-1">Dominio: {{ $reclamo->vehiculo_asegurado_dominio }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Compañía de Seguro: {{ $reclamo->vehiculo ? $reclamo->vehiculo->compania_seguros : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Número de Póliza: {{ $reclamo->vehiculo ? $reclamo->vehiculo->numero_poliza : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Tipo de Cobertura: {{ $reclamo->vehiculo ? $reclamo->vehiculo->tipo_cobertura : '' }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p class="mb-1">Franquicia: {{ $reclamo->vehiculo ? $reclamo->vehiculo->franquicia : '' }}</p>
                                            </div>
                                        </div>


                                        <!-- CONDUCTOR DEL VEHÍCULO -->
                                        <!-- ---------------------- -->
                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Conductor del Vehículo</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso4.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>

                                        @if($reclamo->reclamante && $reclamo->reclamante->conductor)
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="mb-1">El conductor es el reclamante</p><p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="mb-1">Nombre: {{ $reclamo->conductor ? $reclamo->conductor->nombre : '' }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="mb-1">Tipo de Documento: {{ $reclamo->conductor ? $reclamo->conductor->tipoDocumento->nombre : '' }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">N° de Documento: {{ $reclamo->conductor ? $reclamo->conductor->documento_numero : '' }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Teléfono: {{ $reclamo->conductor ? $reclamo->conductor->telefono : '' }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="mb-1">Domicilio: {{ $reclamo->conductor ? $reclamo->conductor->domicilio : '' }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1">Código Postal: {{ $reclamo->conductor ? $reclamo->conductor->codigo_postal : '' }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                @if($reclamo->vehiculo && $reclamo->conductor->pais_id && $reclamo->conductor->province_id)
                                                    <div class="col-md-4">
                                                        <p class="mb-1">País: {{ $reclamo->conductor->pais->nombre }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="mb-1">Provincia: {{ $reclamo->conductor->provincia->name }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="mb-1">Localidad: {{ $reclamo->conductor->city_id != null ? $reclamo->conductor->localidad->name : $reclamo->conductor->otro_pais_provincia_localidad }}</p>
                                                    </div>
                                                @elseif($reclamo->conductor && $reclamo->conductor->otro_pais_provincia_localidad)
                                                    <div class="col-12">
                                                        <p class="mb-1">Localidad/Provincia/Pais: {{ $denuncia->conductor->otro_pais_provincia_localidad }}</p>
                                                    </div>
                                                @else
                                                    <div class="col-12 col-md-4">
                                                        <p class="mb-1">País:</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p class="mb-1">Provincia:</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p class="mb-1">Localidad:</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>Número de Licencia: {{ $reclamo->conductor ? $reclamo->conductor->licencia_numero : '' }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Licencia Clase: {{ $reclamo->conductor ? $reclamo->conductor->licencia_clase : '' }}</p>
                                            </div>
                                        </div>

                                        <!-- LESIONADOS -->
                                        <!-- ---------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Lesionados</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso5.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>
                                        <div class="row pt-0">
                                            <div class="col">
                                                @if($reclamo->lesionados || ($reclamo->conductor && $reclamo->conductor->lesiones))
                                                    @if($reclamo->conductor && $reclamo->conductor->lesiones)
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="mb-1"><b>Tipo: Conductor</b></p>
                                                            </div>
                                                        </div>
                                                        @if($reclamo->reclamante && $reclamo->reclamante->conductor)
                                                            <div class="row">
                                                                <div class="col mb-1">
                                                                    <p class="mb-1">El conductor es el reclamante</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col col-md-4">
                                                                <p class="mb-1">Gravedad: {{ $reclamo->conductor->gravedad_lesion }}</p>
                                                            </div>
                                                            <div class="col col-md-4">
                                                                <p class="mb-1">Alcoholemia: {{ $reclamo->conductor->alcoholemia ? 'Si' : 'No' }}</p>
                                                            </div>
                                                            <div class="col col-md-4">
                                                                <p class="mb-1">Se negó: {{ $reclamo->conductor->alcoholemia_se_nego ? 'Si' : 'No' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <p class="mb-1">Centro Asistencial: {{ $reclamo->conductor->centro_asistencial }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @foreach($reclamo->lesionados as $lesionado)
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="mb-1"><b>Tipo: <span class="text-capitalize">{{ $lesionado->tipo }}</span></b></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-8 mb-1">
                                                                Nombre: {{ $lesionado->nombre }}
                                                            </div>
                                                            <div class="col col-md-4">
                                                                Teléfono: {{ $lesionado->telefono }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-4 mb-1">
                                                                Tipo Documento: {{ $lesionado->tipoDocumento->nombre }}
                                                            </div>
                                                            <div class="col col-md-4 mb-1">
                                                                Número de Documento: {{ $lesionado->documento_numero }}
                                                            </div>
                                                            <div class="col col-md-4 mb-1">
                                                                Fecha de Nacimiento: {{ $lesionado->fecha_nacimiento->toDateString() }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-8">
                                                                <p class="mb-1">Domicilio: {{ $lesionado->domicilio }}</p>
                                                            </div>
                                                            <div class="col col-md-4">
                                                                <p class="mb-1">Código Postal: {{ $lesionado->codigo_postal }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @if($lesionado->pais_id && $lesionado->province_id)
                                                                <div class="col col-md-4">
                                                                    <p class="mb-1">País: {{ $lesionado->pais->nombre }}</p>
                                                                </div>

                                                                <div class="col col-md-4">
                                                                    <p class="mb-1">Provincia: {{ $lesionado->provincia->name }}</p>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <p class="mb-1">
                                                                        Localidad:
                                                                        {{ $lesionado->city_id != null ? $lesionado->localidad->name : $lesionado->otro_pais_provincia_localidad }}
                                                                    </p>
                                                                </div>
                                                            @elseif($lesionado->otro_pais_provincia_localidad)
                                                                <div class="col">
                                                                    <p class="mb-1">Localidad/Provincia/Pais: {{ $lesionado->otro_pais_provincia_localidad }}</p>
                                                                </div>
                                                            @else
                                                                <div class="col col-md-4">
                                                                    <p class="mb-1">País:</p>
                                                                </div>

                                                                <div class="col-12 col-md-4">
                                                                    <p class="mb-1">Provincia:</p>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <p class="mb-1">Localidad:</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-4">
                                                                <p class="mb-1">Gravedad: {{ $lesionado->gravedad_lesion }}</p>
                                                            </div>
                                                            <div class="col col-md-4">
                                                                <p class="mb-1">Alcoholemia: {{ $lesionado->alcoholemia ? 'Si' : 'No' }}</p>
                                                            </div>
                                                            <div class="col col-md-4">
                                                                <p class="mb-1">Se negó: {{ $lesionado->alcoholemia_se_nego ? 'Si' : 'No' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <p class="mb-1">Centro Asistencial: {{ $lesionado->centro_asistencial }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    Sin lesionados
                                                @endif
                                            </div>
                                        </div>

                                        <!-- DAÑOS MATERIALES -->
                                        <!-- ---------------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Daños Materiales</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso6.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>
                                        <div class="row pt-0">
                                            <div class="col-12">
                                                @if($reclamo->daniosMateriales)
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-sm">
                                                            <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col">Tipo</th>
                                                                <th scope="col">Detalles</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($reclamo->daniosMateriales as $danio_material)
                                                                <tr>
                                                                    <td>{{ $danio_material->tipo }}</td>
                                                                    <td>{{ $danio_material->detalles }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    Sin daños materiales
                                                @endif
                                            </div>
                                        </div>


                                        <!-- LUGAR DEL SINIESTRO -->
                                        <!-- ------------------- -->
                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Lugar del Siniestro</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso7.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12">
                                                <p class="mb-1">Lugar: {{ $reclamo->lugar_nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            @if($reclamo->pais_id && $reclamo->province_id)
                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">País: {{ $reclamo->pais->nombre }}</p>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">Provincia: {{ $reclamo->provincia->name }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">
                                                        Localidad:
                                                        {{ $reclamo->city_id != null ? $reclamo->localidad->name : $reclamo->otro_pais_provincia_localidad }}
                                                    </p>
                                                </div>
                                            @elseif($reclamo->otro_pais_provincia_localidad)
                                                <div class="col-12">
                                                    <p class="mb-1">Localidad/Provincia/Pais: {{ $reclamo->otro_pais_provincia_localidad }}</p>
                                                </div>
                                            @else
                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">País:</p>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">Provincia:</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p class="mb-1">Localidad:</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p class="mb-1">Calle/Ruta: {{ $reclamo->calle }}</p>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <p class="mb-1">Tipo
                                                    Calzada: {{ $reclamo->tipo_calzada_id != null ? $reclamo->tipoCalzada->nombre : ''}}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p class="mb-1">Detalle Calzada: {{ $reclamo->calzada_detalle }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="mb-1">Intersección: {{ $reclamo->interseccion }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="mb-1">Cruce Señalizado: {{ $reclamo->cruce_senalizado ? 'Si' : 'No' }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12">
                                                <p class="mb-1">Barrera de tren señalizado: {{ $reclamo->tren != null ? ($reclamo->tren ? 'Si' : 'No') : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-3">
                                                <p class="mb-1">Semaforo: {{ $reclamo->semaforo ? 'Si' : 'No' }}</p>
                                            </div>
                                            @if($reclamo->semaforo)
                                                <div class="col-12 col-md-3">
                                                    <p class="mb-1">Funciona: {{ $reclamo->semaforo_funciona ? 'Si' : 'No' }}</p>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <p class="mb-1">Intermitente: {{ $reclamo->semaforo_funciona ? 'Si' : 'No' }}</p>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <p class="mb-1">Color: {{ $reclamo->semaforo_color }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- CROQUIS DEL SINIESTRO -->
                                        <!-- --------------------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Croquis del Siniestro</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso8.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>Croquis: </p>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <img class="w-100"
                                                     src="{{ $reclamo->croquis_url }}"
                                                     alt="">
                                            </div>
                                            <div class="col-12">
                                                <p>Descripción: {{ $reclamo->descripcion }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12">
                                                <p>Comisaría: {{ $reclamo->comisaria }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-2">
                                            <div class="col-12">
                                                <p>Montos que reclama</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>Daño Vehicular: $ {{ $reclamo->monto_vehicular != null ? $reclamo->monto_vehicular : '0'}}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p>Daños Materiales: $ {{ $reclamo->monto_danios_materiales != null ? $reclamo->monto_danios_materiales : '0' }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p>Lesiones: $ {{ $reclamo->monto_lesiones != null ? $reclamo->monto_lesiones : '0' }}</p>
                                            </div>
                                        </div>

                                        <!-- TESTIGOS -->
                                        <!-- -------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Testigos</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso9.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>

                                        @if(!$reclamo->testigos)
                                            <div class="row pt-0">
                                                <div class="col-12">
                                                    <p>Sin testigos</p>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="table-responsive">
                                            <table class="table table-hover table-sm">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Teléfono</th>
                                                    <th scope="col">Domicilio</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($reclamo->testigos as $testigo)
                                                    <tr>
                                                        <td>{{ $testigo->nombre }}</td>
                                                        <td>{{ $testigo->telefono }}</td>
                                                        <td>{{ $testigo->domicilio_completo }}</td>
                                                    </tr>
                                                @endforeach
                                                @if($reclamo->testigos()->count() == 0)
                                                    <tr>
                                                        <td class="text-center" colspan="3">Sin testigos</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- DOCUMENTOS -->
                                        <!-- ---------- -->

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            <b>Documentos</b>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <a href="{{ route('siniestros.terceros.paso10.create',['id' => $reclamo->identificador]) }}"
                                               class="badge text-bg-secondary float-end"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar
                                            </a>
                                            @endif
                                        </div>


                                        @if($reclamo->reclamo_vehicular)
                                        <div class="row pt-0">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-sm">
                                                        <thead class="table-dark">
                                                        <tr>
                                                            <th scope="col" colspan="2">
                                                                Vehículo
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>DNI Titular</td>
                                                            <td>
                                                                <ul class="list-group">
                                                                    @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_dni_titular')->get() as $archivo)
                                                                        <li class="list-group-item border-0 bg-transparent p-0">
                                                                            <a target="_blank" class="documento-formato-texto pt-2"
                                                                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cédula verde o Título</td>
                                                            <td>
                                                                <ul class="list-group">
                                                                    @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_cedula')->get() as $archivo)
                                                                        <li class="list-group-item border-0 bg-transparent p-0">
                                                                            <a target="_blank" class="documento-formato-texto pt-2"
                                                                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Carnet de conducir</td>
                                                            <td>
                                                                <ul class="list-group">
                                                                    @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_carnet')->get() as $archivo)
                                                                        <li class="list-group-item border-0 bg-transparent p-0">
                                                                            <a target="_blank" class="documento-formato-texto pt-2"
                                                                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @if($reclamo->vehiculo && $reclamo->vehiculo->en_transferencia)
                                                            <tr>
                                                                <td>Formulario 08</td>
                                                                <td>
                                                                    <ul class="list-group">
                                                                        @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_formulario_08')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if($reclamo->vehiculo && $reclamo->vehiculo->con_seguro)
                                                            <tr>
                                                                <td>Denuncia Administrativa</td>
                                                                <td>
                                                                    <ul class="list-group">
                                                                        @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_denuncia_administrativa')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Certificado de Cobertura</td>
                                                                <td>
                                                                    <ul class="list-group">
                                                                        @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_certificado_cobertura')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Carta de Franquicia</td>
                                                                <td>
                                                                    <ul class="list-group">
                                                                        @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_carta_franquicia')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td>Declaración Jurada de No Seguro</td>
                                                                <td>
                                                                    <ul class="list-group">
                                                                        @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_declaracion_jurada')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td>Fotos del Vehículo</td>
                                                            <td>
                                                                <ul class="list-group">
                                                                    @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_vehiculo')->get() as $archivo)
                                                                        <li class="list-group-item border-0 bg-transparent p-0">
                                                                            <a target="_blank" class="documento-formato-texto pt-2"
                                                                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Presupuesto</td>
                                                            <td>
                                                                <ul class="list-group">
                                                                    @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_presupuesto')->get() as $archivo)
                                                                        <li class="list-group-item border-0 bg-transparent p-0">
                                                                            <a target="_blank" class="documento-formato-texto pt-2"
                                                                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Descripción de repuestos</td>
                                                            <td>
                                                                <ul class="list-group">
                                                                    @foreach($reclamo->vehiculo->documentos()->where('type', 'dv_descripcion_repuestos')->get() as $archivo)
                                                                        <li class="list-group-item border-0 bg-transparent p-0">
                                                                            <a target="_blank" class="documento-formato-texto pt-2"
                                                                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if($reclamo->reclamo_danios_materiales)
                                            @foreach($reclamo->daniosMateriales as $key => $danio_material)
                                            <div class="row pt-0">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-sm">
                                                            <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col" colspan="2">
                                                                    {{ $key+1 }} - {{ $danio_material->tipo }}
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>Denuncia o Exposición Policial</td>
                                                                <td>
                                                                    <ul class="list-group">
                                                                        @foreach($danio_material->documentos()->where('type', 'dm_denuncia_policial')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>DNI del Propietario</td>
                                                                <td>
                                                                    <ul class="list-group list-group-flush">
                                                                        @foreach($danio_material->documentos()->where('type', 'dm_dni_propietario')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Escritura de la propiedad o Contrato de alquiler *
                                                                    <p class="ambos-lados text-left">Archivo PDF</p>
                                                                </td>
                                                                <td>
                                                                    <ul class="list-group list-group-flush">
                                                                        @foreach($danio_material->documentos()->where('type', 'dm_escritura_contrato_alquiler')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Fotos de los daños</td>
                                                                <td>
                                                                    <ul class="list-group list-group-flush">
                                                                        @foreach($danio_material->documentos()->where('type', 'dm_fotos_danios')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Presupuesto</td>
                                                                <td>
                                                                    <ul class="list-group list-group-flush">
                                                                        @foreach($danio_material->documentos()->where('type', 'dm_presupuesto')->get() as $archivo)
                                                                            <li class="list-group-item border-0 bg-transparent p-0">
                                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif

                                        @if($reclamo->reclamo_lesiones)
                                            @if($reclamo->conductor && $reclamo->conductor->lesiones)
                                                <div class="row pt-0">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-sm">
                                                                <thead class="table-dark">
                                                                <tr>
                                                                    <th scope="col" colspan="3">
                                                                        1 - {{ $reclamo->conductor->nombre }} [Conductor]
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>DNI</td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            @foreach($reclamo->conductor->documentos()->where('type', 'dl_dni')->get() as $archivo)
                                                                                <li class="list-group-item border-0 bg-transparent p-0">
                                                                                    <a target="_blank" class="documento-formato-texto pt-2"
                                                                                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                @if($reclamo->conductor->es_menor_en_siniestro)
                                                                    <tr>
                                                                        <td>DNI Tutor</td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                @foreach($reclamo->conductor->documentos()->where('type', 'dl_dni_tutor')->get() as $archivo)
                                                                                    <li class="list-group-item border-0 bg-transparent p-0">
                                                                                        <a target="_blank" class="documento-formato-texto pt-2"
                                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <input type="file" id="{{$orden}}_dni_tutor" name="dni_tutor" wire:model="dni_tutor" accept="image/png,image/jpeg">
                                                                            <label for="{{$orden}}_dni_tutor" class="mt-1">
                                                                                <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                                                                                <span class="subir-archivo-morado mb-0">Agregar</span>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td>Denuncia o Exposición Policial</td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            @foreach($reclamo->conductor->documentos()->where('type', 'dl_denuncia_policial')->get() as $archivo)
                                                                                <li class="list-group-item border-0 bg-transparent p-0">
                                                                                    <a target="_blank" class="documento-formato-texto pt-2"
                                                                                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Historia clínica</td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            @foreach($reclamo->conductor->documentos()->where('type', 'dl_historia_clinica')->get() as $archivo)
                                                                                <li class="list-group-item border-0 bg-transparent p-0">
                                                                                    <a target="_blank" class="documento-formato-texto pt-2"
                                                                                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Comprobantes de gastos médicos
                                                                        <p class="ambos-lados text-left">Foto o PDF</p>
                                                                    </td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            @foreach($reclamo->conductor->documentos()->where('type', 'dl_gastos_medicos')->get() as $archivo)
                                                                                <li class="list-group-item border-0 bg-transparent p-0">
                                                                                    <a target="_blank" class="documento-formato-texto pt-2"
                                                                                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @foreach($reclamo->lesionados as $key => $lesionado)
                                                    <div class="row pt-0">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-sm">
                                                                    <thead class="table-dark">
                                                                    <tr>
                                                                        <th scope="col" colspan="3">
                                                                            {{ $key + ($reclamo->conductor && $reclamo->conductor->lesiones ? 2 : 1) }} - {{ $lesionado->nombre }} [Lesionado]
                                                                        </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>DNI</td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                @foreach($lesionado->documentos()->where('type', 'dl_dni')->get() as $archivo)
                                                                                    <li class="list-group-item border-0 bg-transparent p-0">
                                                                                        <a target="_blank" class="documento-formato-texto pt-2"
                                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    @if($lesionado->es_menor_en_siniestro)
                                                                        <tr>
                                                                            <td>DNI Tutor</td>
                                                                            <td>
                                                                                <ul class="list-group">
                                                                                    @foreach($lesionado->documentos()->where('type', 'dl_dni_tutor')->get() as $archivo)
                                                                                        <li class="list-group-item border-0 bg-transparent p-0">
                                                                                            <a target="_blank" class="documento-formato-texto pt-2"
                                                                                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <input type="file" id="{{$orden}}_dni_tutor" name="dni_tutor" wire:model="dni_tutor" accept="image/png,image/jpeg">
                                                                                <label for="{{$orden}}_dni_tutor" class="mt-1">
                                                                                    <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                                                                                    <span class="subir-archivo-morado mb-0">Agregar</span>
                                                                                </label>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <td>Denuncia o Exposición Policial</td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                @foreach($lesionado->documentos()->where('type', 'dl_denuncia_policial')->get() as $archivo)
                                                                                    <li class="list-group-item border-0 bg-transparent p-0">
                                                                                        <a target="_blank" class="documento-formato-texto pt-2"
                                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Historia clínica</td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                @foreach($lesionado->documentos()->where('type', 'dl_historia_clinica')->get() as $archivo)
                                                                                    <li class="list-group-item border-0 bg-transparent p-0">
                                                                                        <a target="_blank" class="documento-formato-texto pt-2"
                                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Comprobantes de gastos médicos
                                                                            <p class="ambos-lados text-left">Foto o PDF</p>
                                                                        </td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                @foreach($lesionado->documentos()->where('type', 'dl_gastos_medicos')->get() as $archivo)
                                                                                    <li class="list-group-item border-0 bg-transparent p-0">
                                                                                        <a target="_blank" class="documento-formato-texto pt-2"
                                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach

                                        @endif

                                    @endif

                                    <!-- OBSERVACIONES -->
                                    <!-- ------------- -->

                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
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
                                            @foreach($reclamo->observaciones as $observacion )
                                                <tr class="borde-tabla">
                                                    <td>{{ $observacion->created_at->format('d-m-Y H:i:s') }}</td>
                                                    <td>{{ $observacion->detalle }}</td>
                                                    <td>{{ $observacion->user->name }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        <form action="{{ route('admin.siniestros.reclamos.observaciones.store',['reclamo' => $reclamo]) }}" method="post" class="w-100">
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
