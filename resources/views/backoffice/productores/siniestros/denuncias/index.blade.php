@extends('layouts.super-admin')
@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-12 mt-5 pb-5">
                <form action="{{ route('admin.productores.siniestros.denuncias.index') }}" method="get" class="container-fluid" id="buscador">
                    <div class="row mb-3">
                        <div class="col-12 col-md-12 col-lg-8 col-xl-4 px-0 pl-lg-0 px-xl-1">
                            <div class="input-group">
                                <div class="form-floating">
                                    <select class="form-select" name="tipo" id="tipo">
                                        <option value="dominio" {{ request()->tipo == 'id' ? 'selected' : '' }}>
                                            Dominio
                                        </option>
                                        <option value="id" {{ request()->tipo == 'id' ? 'selected' : '' }}>ID o N°
                                            Gestión
                                        </option>
                                    </select>
                                    <label for="tipo">Buscar por</label>
                                </div>
                                <input type="text" name="busqueda" class="form-control no-border-radius-left"
                                       value="{{request()->busqueda}}" onchange="buscar()" required>
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-border-external">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">FECHA CREACIÓN</th>
                                <th scope="col">FECHA SINIESTRO</th>
                                <th scope="col">ASEGURADO</th>
                                <th scope="col">DOMINIO</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">OBSERVACIÓN</th>
                                <th scope="col">PASO</th>
                                <th scope="col">LINK ENVIADO</th>
                                <th scope="col">OPERACIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($denuncias as $denuncia)
                                <tr>
                                    <td>{{ $denuncia->id }}</td>
                                    <td>{{ $denuncia->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $denuncia->fecha->format('d/m/Y') }} {{ \Carbon\Carbon::createFromFormat('H:i:s',$denuncia->hora)->format('H:i') }}</td>
                                    <td>{{ $denuncia->asegurado ? $denuncia->asegurado->nombre : ''}}</td>
                                    <td>{{ $denuncia->dominio_vehiculo_asegurado }}</td>
                                    <td>
                                        @if($denuncia->estado == 'ingresado') INGRESADO @endif
                                        @if($denuncia->estado == 'aceptado') ACEPTADO @endif
                                        @if($denuncia->estado == 'rechazado') RECHAZADO @endif
                                        @if($denuncia->estado == 'cerrado') CERRADO @endif
                                        @if($denuncia->estado == 'legales') LEGALES @endif
                                        @if($denuncia->estado == 'investigacion') INVESTIGACIÓN @endif
                                        @if($denuncia->estado == 'derivado-proveedor') DERIVADO A PROVEEDOR @endif
                                        @if($denuncia->estado == 'solicitud-documentacion') SOLICITUD DE DOCUMENTACIÓN @endif
                                        @if($denuncia->estado == 'informe-pericial') INFORME PERICIAL @endif
                                        @if($denuncia->estado == 'pendiente-de-pago') PENDIENTE DE PAGO @endif
                                        @if($denuncia->estado == 'esperando-baja-de-unidad') ESPERANDO BAJA DE UNIDAD @endif
                                    </td>
                                    <td>
                                        {{ $denuncia->estado_observacion != null ? $denuncia->estado_observacion : 'Sin observación.' }}
                                        {{ $denuncia->estado_fecha ? '[Actualizado el '.$denuncia->estado_fecha->format('d/m/y').']' : '' }}
                                    </td>
                                    <td>
                                        @if($denuncia->estado_carga == 'precarga')
                                            <span>PRECARGA</span>
                                        @elseif($denuncia->estado_carga == '12')
                                            <span>COMPLETO</span>
                                        @else
                                            <span>{{ $denuncia->estado_carga.'/12' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $denuncia->link_enviado ? 'Si' : 'No' }}
                                    </td>
                                    <td>
                                        <div class="dropstart position-static">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-gear"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('admin.productores.siniestros.denuncias.show', ['denuncia' => $denuncia]) }}"
                                                       class="dropdown-item" title="Ver">
                                                        <i class="fa-solid fa-file-lines"></i><span>Ver</span>
                                                    </a>
                                                </li>
                                                @if($denuncia->link_enviado || $denuncia->estado_carga == '12')
                                                    <li>
                                                        <a href="{{ route('asegurados-denuncias-paso1.create',[ 'id' => $denuncia->identificador]) }}"
                                                           class="dropdown-item" title="Link" target="_blank">
                                                            <i class="fa-solid fa-link"></i><span>Link</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if($denuncia->estado_carga == '12')
                                                    <li>
                                                        <a href="{{ route('asegurados-denuncias.pdf',$denuncia->id) }}"
                                                           class="dropdown-item" title="Descargar" target="_blank">
                                                            <i class="fa-solid fa-file-pdf"></i><span>Descargar Denuncia</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if($denuncia->certificado_cobertura_url)
                                                    <li>
                                                        <a href="{{ $denuncia->certificado_cobertura_url }}"
                                                           class="dropdown-item" title="Descargar" target="_blank">
                                                            <i class="fa-solid fa-file-pdf"></i><span>Certificado de Cobertura</span>
                                                        </a>
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if($denuncias->count() == 0)
                                <tr>
                                    <td colspan="14" class="text-center">{{ request()->busqueda ? 'No se encontró denuncia.' : '' }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
