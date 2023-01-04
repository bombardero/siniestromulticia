@extends('layouts.super-admin')
@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-5 pb-5">
                    <form action="{{ route('admin.siniestros.buscador') }}" method="get" class="container-fluid" id="buscador">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 col-lg-4 col-xl-2 px-0 pr-xl-1">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" id="check-fechas" {{ request()->collect()->count() == 0 || (request()->desde &&  request()->desde) ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-floating">
                                        <input type="date" name="desde" id="desde" class="form-control form-control-sm"
                                               value="{{ request()->desde ? request()->desde : (request()->tipo != 'id' ? Carbon\Carbon::now()->subMonth()->toDateString() : '') }}"
                                               onchange="buscar()"
                                                {{ request()->collect()->count() == 0 ? '' : (request()->tipo == 'id' || !request()->desde ? 'disabled' : '') }}
                                        >
                                        <label for="desde">Desde</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="date" name="hasta" id="hasta"
                                               class="form-control form-control-sm"
                                               value="{{ request()->hasta ? request()->hasta : (request()->tipo != 'id' ? Carbon\Carbon::now()->toDateString() : '') }}"
                                               onchange="buscar()"
                                            {{ request()->collect()->count() == 0 ? '' : (request()->tipo == 'id' || !request()->hasta ? 'disabled' : '') }}
                                        >
                                        <label for="hasta">Hasta</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 px-xl-1">
                                <div class="form-floating">
                                    <select class="form-select" name="estado" id="estado"
                                            onchange="buscar()"
                                            {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                    >
                                        <option
                                            value="todos" {{(request()->estado && request()->estado == 'todos') ? 'selected' : ''}}>
                                            Todos
                                        </option>
                                        <option
                                            value="ingresado" {{(request()->estado && request()->estado == 'ingresado') ? 'selected' : ''}}>
                                            Ingresado
                                        </option>
                                        <option
                                            value="aceptado" {{(request()->estado && request()->estado == 'aceptado') ? 'selected' : ''}}>
                                            Aceptado
                                        </option>
                                        <option
                                            value="rechazado" {{(request()->estado && request()->estado == 'rechazado') ? 'selected' : ''}}>
                                            Rechazado
                                        </option>
                                        <option
                                            value="cerrado" {{(request()->estado && request()->estado == 'cerrado') ? 'selected' : ''}}>
                                            Cerrado
                                        </option>
                                        <option
                                            value="legales" {{(request()->estado && request()->estado == 'legales') ? 'selected' : ''}}>
                                            Legales
                                        </option>
                                        <option
                                            value="investigacion" {{(request()->estado && request()->estado == 'investigacion') ? 'selected' : ''}}>
                                            Investigación
                                        <option
                                            value="derivado-proveedor" {{(request()->estado && request()->estado == 'derivado-proveedor') ? 'selected' : ''}}>
                                            Derivado a proveedor
                                        </option>
                                        <option
                                            value="solicitud-documentacion" {{(request()->estado && request()->estado == 'solicitud-documentacion') ? 'selected' : ''}}>
                                            Solicitud de documentación
                                        </option>
                                        <option
                                            value="informe-pericial" {{(request()->estado && request()->estado == 'informe-pericial') ? 'selected' : ''}}>
                                            Informe Pericial
                                        </option>
                                        <option
                                            value="pendiente-de-pago" {{(request()->estado && request()->estado == 'pendiente-de-pago') ? 'selected' : ''}}>
                                            Pendiente de pago
                                        </option>
                                        <option
                                            value="esperando-baja-de-unidad" {{(request()->estado && request()->estado == 'esperando-baja-de-unidad') ? 'selected' : ''}}>
                                            Esperando baja de unidad
                                        </option>
                                    </select>
                                    <label for="estado">Estado</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 pr-md-0 px-xl-1">
                                <div class="form-floating">
                                    <select class="form-select" name="cobertura" id="cobertura"
                                            onchange="buscar()"
                                            {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                    >
                                        <option
                                            value="todos" {{(request()->cobertura && request()->cobertura == 'todos') ? 'selected' : ''}}>
                                            Todas
                                        </option>
                                        <option
                                            value="RC" {{(request()->cobertura && request()->cobertura == 'RC') ? 'selected' : ''}}>
                                            RC
                                        </option>
                                        <option
                                            value="Casco" {{(request()->cobertura && request()->cobertura == 'Casco') ? 'selected' : ''}}>
                                            Casco
                                        </option>
                                        <option
                                            value="RC con Casco" {{(request()->cobertura && request()->cobertura == 'RC con Casco') ? 'selected' : ''}}>
                                            RC con Casco
                                        </option>
                                        <option
                                            value="ninguna" {{(request()->cobertura && request()->cobertura == 'ninguna') ? 'selected' : ''}}>
                                            Ninguna
                                        </option>
                                    </select>
                                    <label for="">Cobertura</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 pl-md-0 px-xl-1">
                                <div class="form-floating">
                                    <select class="form-select" name="carga" id="carga"
                                            onchange="buscar()"
                                            {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                    >
                                        <option
                                            value="todos" {{(request()->carga && request()->carga == 'todos') ? 'selected' : ''}}>
                                            Todos
                                        </option>
                                        <option
                                            value="precarga" {{(request()->carga && request()->carga == 'precarga') ? 'selected' : ''}}>
                                            Precarga
                                        </option>
                                        <option
                                            value="incompleto" {{(request()->carga && request()->carga == 'incompleto') ? 'selected' : ''}}>
                                            Incompleto
                                        </option>
                                        <option
                                            value="completo" {{(request()->carga && request()->carga == 'completo') ? 'selected' : ''}}>
                                            Completo
                                        </option>
                                    </select>
                                    <label for="carga">Paso</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 px-xl-1 pr-lg-0">
                                <div class="form-floating">
                                    <select class="form-select" name="nro_denuncia" id="nro_denuncia"
                                            onchange="buscar()"
                                            {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                    >
                                        <option
                                            value="todos" {{(request()->nro_denuncia && request()->nro_denuncia == 'todos') ? 'selected' : ''}}>
                                            Todos
                                        </option>
                                        <option
                                            value="si" {{(request()->nro_denuncia && request()->nro_denuncia == 'si') ? 'selected' : ''}}>
                                            Si
                                        </option>
                                        <option
                                            value="no" {{(request()->nro_denuncia && request()->nro_denuncia == 'no') ? 'selected' : ''}}>
                                            No
                                        </option>
                                    </select>
                                    <label for="nro_denuncia">N° Denuncia</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 pr-lg-1 pl-lg-0 px-xl-1">
                                <div class="form-floating">
                                    <select class="form-select" name="link_enviado" id="link_enviado"
                                            onchange="buscar()"
                                        {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                    >
                                        <option
                                            value="todos" {{( isset(request()->link_enviado) && request()->link_enviado == "todos") ? 'selected' : ''}}>
                                            Todos
                                        </option>
                                        <option
                                            value="1" {{( isset(request()->link_enviado) && request()->link_enviado == "1") ? 'selected' : ''}}>
                                            Si
                                        </option>
                                        <option
                                            value="0" {{( isset(request()->link_enviado) && request()->link_enviado == '0') ? 'selected' : ''}}>
                                            No
                                        </option>
                                    </select>
                                    <label for="link_enviado">Link enviado</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 pr-lg-1 pl-lg-0 px-xl-1">
                                <div class="form-floating">
                                    <select class="form-select" name="responsable" id="responsable"
                                            onchange="buscar()"
                                        {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                    >
                                        <option
                                            value="todos" {{( isset(request()->responsable) && request()->responsable == "todos") ? 'selected' : ''}}>
                                            Todos
                                        </option>
                                        <option
                                            value="nadie" {{( isset(request()->responsable) && request()->responsable == "nadie") ? 'selected' : ''}}>
                                            Sin responsable
                                        </option>
                                        @foreach($users as $user)
                                            <option
                                                value="{{ $user->id }}" {{( isset(request()->responsable) && request()->responsable == $user->id) ? 'selected' : ''}}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="link_enviado">Responsable</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-8 col-xl-4 px-0 pl-lg-0 px-xl-1">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <select class="form-select" name="tipo" id="tipo">
                                            <option value="dominio" {{ request()->tipo == 'id' ? 'selected' : '' }}>Dominio</option>
                                            <option value="id" {{ request()->tipo == 'id' ? 'selected' : '' }}>ID o N° Gestión</option>
                                        </select>
                                        <label for="tipo">Buscar por</label>
                                    </div>
                                    <input type="text" name="busqueda" class="form-control no-border-radius-left"
                                           value="{{request()->busqueda}}" onchange="buscar()">
                                    <button class="btn btn-outline-secondary" type="submit" id="">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-panel-siniestros">
                                <thead class="thead tabla-panel">
                                <tr class="tabla-cabecera ">
                                    <th class="th-padding" scope="col">ID</th>
                                    <th class="th-padding" scope="col">FECHA CREACIÓN</th>
                                    <th class="th-padding" scope="col">FECHA SINIESTRO</th>
                                    <th class="th-padding" scope="col">ASEGURADO</th>
                                    <th class="th-padding" scope="col">DOMINIO</th>
                                    <th class="th-padding" scope="col">N° POLIZA</th>
                                    <th class="th-padding" scope="col">N° DENUNCIA</th>
                                    <th class="th-padding" scope="col">N° SINIESTRO</th>
                                    <th class="th-padding" scope="col">ESTADO</th>
                                    <th class="th-padding" scope="col">COBERTURA</th>
                                    <th class="th-padding" scope="col">PASO</th>
                                    <th class="th-padding" scope="col">ÚLT. OBSERVACIÓN</th>
                                    <th class="th-padding" scope="col">LINK</th>
                                    <th class="th-padding" scope="col">OPERACIONES</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if($denuncia_siniestros)
                                    @foreach($denuncia_siniestros as $denuncia)
                                        <tr class="borde-tabla">
                                            <td>{{ $denuncia->id }}</td>
                                            <td>{{ $denuncia->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $denuncia->fecha->format('d/m/Y') }} {{ \Carbon\Carbon::createFromFormat('H:i:s',$denuncia->hora)->format('H:i') }}</td>
                                            <td>{{ $denuncia->asegurado ? $denuncia->asegurado->nombre : ''}}</td>
                                            <td>{{$denuncia->dominio_vehiculo_asegurado}}</td>
                                            <td>
                                                <form action="{{ route('admin.siniestros.denuncia.update.nropoliza',$denuncia->id) }}" class="form-update-denuncia">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="value" value="{{ $denuncia->nro_poliza }}">
                                                        <button class="btn btn-outline-secondary" type="submit">
                                                            <i class="fa-solid fa-rotate"></i>
                                                        </button>
                                                    </div>

                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.siniestros.denuncia.update.nrodenuncia',$denuncia->id) }}" class="form-update-denuncia">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="value" value="{{ $denuncia->nro_denuncia }}">
                                                        <button class="btn btn-outline-secondary" type="submit">
                                                            <i class="fa-solid fa-rotate"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.siniestros.denuncia.update.nrosiniestro',$denuncia->id) }}" class="form-update-denuncia">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="value" value="{{ $denuncia->nro_siniestro }}">
                                                        <button class="btn btn-outline-secondary" type="submit">
                                                            <i class="fa-solid fa-rotate"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <select id="estado" class="form-select form-select-sm"
                                                        onchange="cambiarEstado(this, {{ $denuncia->id  }})">
                                                    <option
                                                        value="ingresado" {{( $denuncia->estado == 'ingresado') ? 'selected' : '' }}>
                                                        INGRESADO
                                                    </option>
                                                    <option
                                                        value="aceptado" {{( $denuncia->estado == 'aceptado') ? 'selected' : '' }}>
                                                        ACEPTADO
                                                    </option>
                                                    <option
                                                        value="rechazado" {{( $denuncia->estado == 'rechazado') ? 'selected' : '' }}>
                                                        RECHAZADO
                                                    </option>
                                                    <option
                                                        value="cerrado" {{( $denuncia->estado == 'cerrado') ? 'selected' : '' }}>
                                                        CERRADO
                                                    </option>
                                                    <option
                                                        value="legales" {{( $denuncia->estado == 'legales') ? 'selected' : '' }}>
                                                        LEGALES
                                                    </option>
                                                    <option
                                                        value="investigacion" {{( $denuncia->estado == 'investigacion') ? 'selected' : '' }}>
                                                        INVESTIGACIÓN
                                                    </option>
                                                    <option
                                                        value="derivado-proveedor" {{( $denuncia->estado == 'derivado-proveedor') ? 'selected' : '' }}>
                                                        DERIVADO A PROVEEDOR
                                                    </option>
                                                    <option
                                                        value="solicitud-documentacion" {{( $denuncia->estado == 'solicitud-documentacion') ? 'selected' : '' }}>
                                                        SOLICITUD DE DOCUMENTACIÓN
                                                    </option>
                                                    <option
                                                        value="informe-pericial" {{( $denuncia->estado == 'informe-pericial') ? 'selected' : '' }}>
                                                        INFORME PERICIAL
                                                    </option>
                                                    <option
                                                        value="pendiente-de-pago" {{( $denuncia->estado == 'pendiente-de-pago') ? 'selected' : '' }}>
                                                        PENDIENTE DE PAGO
                                                    </option>
                                                    <option
                                                        value="esperando-baja-de-unidad" {{( $denuncia->estado == 'esperando-baja-de-unidad') ? 'selected' : '' }}>
                                                        ESPERANDO BAJA DE UNIDAD
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="cobertura_activa" class="form-select form-select-sm"
                                                        onchange="cambiarCoberturaActiva(this,{{ $denuncia->id  }})">
                                                    <option
                                                        value="" {{( $denuncia->cobertura_activa == null) ? 'selected' : '' }}>
                                                        Ninguna
                                                    </option>
                                                    <option
                                                        value="RC" {{( $denuncia->cobertura_activa == 'RC') ? 'selected' : '' }}>
                                                        RC
                                                    </option>
                                                    <option
                                                        value="Casco" {{( $denuncia->cobertura_activa == 'Casco') ? 'selected' : '' }}>
                                                        Casco
                                                    </option>
                                                    <option
                                                        value="RC con Casco" {{( $denuncia->cobertura_activa == 'RC con Casco') ? 'selected' : '' }}>
                                                        RC con Casco
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                @if($denuncia->estado_carga == 'precarga')
                                                    <span>PRECARGA</span>
                                                @elseif($denuncia->estado_carga == '12')
                                                    <span>COMPLETO</span>
                                                @else
                                                    <span>{{ $denuncia->estado_carga.'/12' }}</span>
                                                @endif</td>
                                            <td>
                                                {{ $denuncia->observaciones->count() > 0 ? $denuncia->observaciones()->latest()->first()->detalle : '' }}
                                            </td>
                                            <td>
                                                <a target="_blank" class="btn-link"
                                                   href="https://api.whatsapp.com/send?phone={{$denuncia->responsable_contacto_telefono}}&text=Inicia tu denuncia (dominio: {{$denuncia->dominio_vehiculo_asegurado}}) ingresando a este link: {{route('asegurados-denuncias-paso1.create',['id' => $denuncia->identificador])}}"
                                                   style="color:#3366BB; font-weight: bold; " data-toggle="tooltip" data-denuncia-id="{{ $denuncia->id }}"
                                                   data-placement="top" title="Enviar link">
                                                    <i class="fa-solid fa-link {{ $denuncia->link_enviado ? 'text-success' : '' }}"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="dropstart position-static">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gear"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#" class="dropdown-item {{ $denuncia->estado_carga == '12' && $denuncia->nro_poliza !== null && $denuncia->nro_denuncia === null ? '' : 'disabled' }}"
                                                               title="Enviar a compañia"
                                                               data-denuncia-id="{{ $denuncia->id }}"
                                                               data-toggle="modal" data-target="#modalEnviarACompania">
                                                                <i class="fa-solid fa-file-export"></i><span>Enviar a compañía</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('admin.siniestros.denuncia.show',$denuncia->id)}}"
                                                               class="dropdown-item" title="Ver">
                                                                <i class="fa-solid fa-file-lines"></i><span>Ver</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('asegurados-denuncias-paso1.create',[ 'id' => $denuncia->identificador]) }}"
                                                               class="dropdown-item" title="Editar">
                                                                <i class="fa-solid fa-file-pen"></i><span>Editar</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalObservaciones" data-denuncia-id="{{ $denuncia->id }}"
                                                               class="dropdown-item" title="Observaciones">
                                                                <i class="fa-solid fa-message"></i></i><span>Observaciones</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('asegurados-denuncias.pdf',$denuncia->id) }}"
                                                               class="dropdown-item" title="Descargar" target="_blank">
                                                                <i class="fa-solid fa-file-pdf"></i><span>Descargar</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('admin.siniestros.denuncia.delete',$denuncia->id)}}"
                                                               class="dropdown-item btn-eliminar text-danger" title="Eliminar">
                                                                <i class="fa-solid fa-trash"></i><span>Eliminar</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td> No hay denuncias cargadas todavia</td>
                                @endif
                                </tbody>
                            </table>
                            {{ $denuncia_siniestros->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Modal Observaciones-->
    <div class="modal fade" id="modalObservaciones" aria-labelledby="modalObservacionesLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalObservacionesLabel">Observaciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <table class="table m-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="th-padding" scope="col">Fecha</th>
                                <th class="th-padding" scope="col">Comentario</th>
                                <th class="th-padding" scope="col">Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer ">
                    <form action="" method="post" id="formNuevaObservacion" class="w-100">
                        @csrf
                        <div class="mb-3">
                            <label for="observacion" class="form-label">Nueva observación</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="3" required></textarea>
                        </div>
                        <div class="float-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Enviar a Compañia -->
    <div class="modal" id="modalEnviarACompania" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enviar a compañía</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formEnviarACompania" class="w-100">
                        @csrf
                        <div class="form-group">
                            <label for="tipo_vehiculo">Tipo de Vehiculo</label>
                            <select class="custom-select" name="tipo_vehiculo">
                                <option selected value="autos">Automóvil</option>
                                <option value="motos">Motocicleta</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formEnviarACompania" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    /*
    $( document ).ready(function() {
        const customBoundary = document.querySelector('#boundary');

        detectOverflow(state, {
            boundary: customBoundary,
        });
    });*/


    $('.btn-eliminar').click(function (event) {
        let result = confirm('¿Confirma desea eliminar la denuncia?');
        if (!result) {
            event.preventDefault();
            return false;
        }
        showLoading();
    })

    $('.btn-link').click(function (event) {
        event.preventDefault();
        let btn_link = $(this);
        let url = '{{ route('admin.siniestros.denuncia.link-enviado', ['denuncia' =>  ":denuncia_siniestro_id"]) }}';
        url = url.replace(':denuncia_siniestro_id', btn_link.data('denuncia-id'));
        let link = btn_link.attr('href');

        $.ajax(
            {
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (result) {
                    //console.log(result);
                    btn_link.find("i").addClass('text-success');
                    window.open(link, '_blank');
                },
                error: function (error) {
                    //console.log(error);
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                }
            })
    })

    $('#tipo').change(function (event) {
        let tipo = $(this).val();
        let fechas = $('#check-fechas');
        let desde = $('#desde');
        let hasta = $('#hasta');
        let estado = $('#estado');
        let cobertura = $('#cobertura');
        let carga = $('#carga');
        let nro_denuncia = $('#nro_denuncia');
        console.log(tipo);
        if(tipo == 'id')
        {
            fechas.attr('checked', false);
            desde.attr('disabled', true);
            desde.val('');
            hasta.attr('disabled', true);
            hasta.val('');
            estado.attr('disabled', true);
            estado.val('todos');
            cobertura.attr('disabled', true);
            cobertura.val('todos');
            carga.attr('disabled', true);
            carga.val('todos');
            nro_denuncia.attr('disabled', true);
            nro_denuncia.val('todos');
        } else {
            fechas.attr('checked', true);
            desde.attr('disabled', false);
            desde.val('{{ Carbon\Carbon::now()->subMonth()->toDateString() }}');
            hasta.attr('disabled', false);
            hasta.val('{{ Carbon\Carbon::now()->toDateString() }}');
            estado.attr('disabled', false);
            cobertura.attr('disabled', false);
            carga.attr('disabled', false);
            nro_denuncia.attr('disabled', false);
        }
    })


    $('.form-update-denuncia').submit(function (event) {
        event.preventDefault();
        let url = $(this).attr('action')
        let value = $(this).find('input[name="value"]').val() ? $(this).find('input[name="value"]').val() : null;
        showLoading();
        $.ajax(
            {
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "value": value
                },
                success: function (result) {
                    //console.log(result);
                    location.reload();
                },
                error: function (error) {
                    //console.log(error);
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                }
            })

    })

    function cambiarEstado(estado, denuncia_siniestro_id) {
        let url = '{{ route('admin.siniestros.denuncia.cambiar-estado', ['denuncia' =>  ":denuncia_siniestro_id"]) }}';
        url = url.replace(':denuncia_siniestro_id', denuncia_siniestro_id)
        showLoading();
        $.ajax(
            {
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "estado": estado.value
                },
                success: function (result) {
                    //console.log(result);
                },
                error: function (error) {
                    //console.log(error);
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                }
            })
    }

    function cambiarCoberturaActiva(cobertura, denuncia_siniestro_id) {
        let url = '{{ route('admin.siniestros.denuncia.cambiar-cobertura-activa', ['denuncia' =>  ":denuncia_siniestro_id"]) }}';
        url = url.replace(':denuncia_siniestro_id', denuncia_siniestro_id);
        showLoading();
        $.ajax(
            {
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "cobertura_activa": cobertura.value
                },
                success: function (result) {
                    //console.log(result);
                },
                error: function (error) {
                    //console.log(error);
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                }
            })
    }

    function buscar() {
        document.getElementById("buscador").submit();
    }

    $('#modalObservaciones').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget)
        let denuncia_id = button.data('denuncia-id')
        let url = '{{ route('ajax.admin.siniestros.denuncia.observaciones.index', ['denuncia' =>  ':denuncia_id']) }}'
        let url_store = '{{ route('admin.siniestros.denuncia.observaciones.store', ['denuncia' =>  ':denuncia_id']) }}'
        url = url.replace(':denuncia_id',denuncia_id)
        url_store = url_store.replace(':denuncia_id',denuncia_id)
        $(this).find('tbody').append('<tr><td colspan="3" class="text-center"><i class="fas fa-spinner fa-pulse"></i> Cargando</td></tr>')
        $(this).find('form').attr('action',url_store)
        $.ajax({
            url: url,
            type: 'get',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (result) {
                console.log(result);
                $('#modalObservaciones').find('tbody').empty()
                if(result.observaciones.length > 0)
                {
                    let rows = '';
                    result.observaciones.forEach( (observacion) => {
                        rows += '<tr><td>'+observacion.fecha_hora+'</td><td>'+observacion.detalle+'</td><td>'+observacion.user_name+'</td></tr>'
                    })
                    $('#modalObservaciones').find('tbody').append(rows)
                }
            },
            error: function (error) {
                console.log(error)
                alert('Hubo un error.');
            }
        })
    })

    $('#modalObservaciones').on('shown.bs.modal', function (event)
    {
        $("#observacion").focus()
    })

    $('#modalObservaciones').on('hidden.bs.modal', function (event)
    {
        $(this).find('tbody').empty()
        $(this).find('textarea').val('')
    })

    $("#modalObservaciones form").submit(function (e) {
        showLoading()
    });

    $('#modalEnviarACompania').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget)
        let denuncia_id = button.data('denuncia-id')
        let url = '{{ route('ajax.admin.siniestros.denuncia.enviar-compania', ['denuncia' =>  ':denuncia_id']) }}'
        url = url.replace(':denuncia_id',denuncia_id)
        console.log(url);
        $('#modalEnviarACompania').find('form').attr('action',url);
    })

    $("#modalEnviarACompania form").submit(function (e) {
        e.preventDefault();
        showLoading();
        let tipo_vehiculo = $(this).find('select').val()
        let url = $(this).attr('action')

        $.ajax(
            {
                url: url,
                type: 'post',
                data: { "_token": "{{ csrf_token() }}", 'tipo_vehiculo': tipo_vehiculo },
                timeout: 0,
                async: true,
                success: function (result) {
                    //console.log(result);
                    if(result.mensaje)
                    {
                        alert(result.mensaje);
                    } else {
                        location.reload();
                    }
                },
                error: function (error) {
                    //console.log(error);
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                    $('#modalEnviarACompania').find('button.close').click();
                }
            })
    });

    $('#check-fechas').change(function () {
        if($(this).prop('checked'))
        {
            $('#desde').attr('disabled', false)
            $('#hasta').attr('disabled', false)
        } else {
            $('#desde').attr('disabled', true)
            $('#hasta').attr('disabled', true)
        }
    })

</script>

@endsection
