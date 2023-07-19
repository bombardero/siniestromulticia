@extends('layouts.super-admin')
@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-12 mt-5 pb-5">
                <form action="{{ route('admin.siniestros.index') }}" method="get" class="container-fluid" id="buscador">
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-2 px-0">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="checkbox"
                                           id="check-fechas" {{ request()->collect()->count() == 0 || (request()->desde &&  request()->desde) ? 'checked' : '' }}>
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
                        <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 ps-lg-1">
                            <div class="form-floating">
                                <select class="form-select" name="tipo_siniestro" id="tipo_siniestro"
                                        onchange="buscar()"
                                    {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                >
                                    <option value="todos" {{ (request()->tipo_siniestro && request()->tipo_siniestro == 'Todos') ? 'selected' : ''}}>Todos</option>
                                    <option value="sin especificar" {{ (request()->tipo_siniestro && request()->tipo_siniestro == 'sin especificar') ? 'selected' : ''}}>Sin especificar</option>
                                    @foreach($tipos_siniestros as $tipo_siniestro)
                                        <option value="{{ $tipo_siniestro }}" {{ (request()->tipo_siniestro && request()->tipo_siniestro == $tipo_siniestro) ? 'selected' : '' }}>{{ $tipo_siniestro }}</option>
                                    @endforeach
                                </select>
                                <label for="tipo_siniestro">Tipo</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 ps-lg-1">
                            <div class="form-floating">
                                <select class="form-select" name="estado" id="estado"
                                        onchange="buscar()"
                                    {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                >
                                    <option value="todos" {{(request()->estado && request()->estado == 'todos') ? 'selected' : ''}}>Todos</option>
                                    <option value="ingresado" {{(request()->estado && request()->estado == 'ingresado') ? 'selected' : ''}}>Ingresado</option>
                                    <option value="aceptado" {{(request()->estado && request()->estado == 'aceptado') ? 'selected' : ''}}>Aceptado</option>
                                    <option value="rechazado" {{(request()->estado && request()->estado == 'rechazado') ? 'selected' : ''}}>Rechazado</option>
                                    <option value="cerrado" {{(request()->estado && request()->estado == 'cerrado') ? 'selected' : ''}}>Cerrado</option>
                                    <option value="legales" {{(request()->estado && request()->estado == 'legales') ? 'selected' : ''}}>Legales</option>
                                    <option value="investigacion" {{(request()->estado && request()->estado == 'investigacion') ? 'selected' : ''}}>Investigación</option>
                                    <option value="derivado-proveedor" {{(request()->estado && request()->estado == 'derivado-proveedor') ? 'selected' : ''}}>Derivado a proveedor</option>
                                    <option value="solicitud-documentacion" {{(request()->estado && request()->estado == 'solicitud-documentacion') ? 'selected' : ''}}>Solicitud de documentación</option>
                                    <option value="informe-pericial" {{(request()->estado && request()->estado == 'informe-pericial') ? 'selected' : ''}}>Informe Pericial
                                    </option>
                                    <option value="pendiente-de-pago" {{(request()->estado && request()->estado == 'pendiente-de-pago') ? 'selected' : ''}}>Pendiente de pago</option>
                                    <option value="esperando-baja-de-unidad" {{(request()->estado && request()->estado == 'esperando-baja-de-unidad') ? 'selected' : ''}}>Esperando baja de unidad</option>
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                        </div>

                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                        <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 ps-lg-1">
                            <div class="form-floating">
                                <select class="form-select" name="cobertura" id="cobertura"
                                        onchange="buscar()"
                                    {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                >
                                    <option value="todos" {{(request()->cobertura && request()->cobertura == 'todos') ? 'selected' : ''}}>Todas</option>
                                    <option value="RC" {{(request()->cobertura && request()->cobertura == 'RC') ? 'selected' : ''}}>RC</option>
                                    <option value="Casco" {{(request()->cobertura && request()->cobertura == 'Casco') ? 'selected' : ''}}>Casco</option>
                                    <option value="RC con Casco" {{(request()->cobertura && request()->cobertura == 'RC con Casco') ? 'selected' : ''}}>RC con Casco</option>
                                    <option value="ninguna" {{(request()->cobertura && request()->cobertura == 'ninguna') ? 'selected' : ''}}>Ninguna</option>
                                </select>
                                <label for="">Cobertura</label>
                            </div>
                        </div>
                        @endif

                        <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 ps-lg-1">
                            <div class="form-floating">
                                <select class="form-select" name="carga" id="carga"
                                        onchange="buscar()"
                                    {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                >
                                    <option value="todos" {{(request()->carga && request()->carga == 'todos') ? 'selected' : ''}}>Todos</option>
                                    <option value="precarga" {{(request()->carga && request()->carga == 'precarga') ? 'selected' : ''}}>Precarga</option>
                                    <option value="incompleto" {{(request()->carga && request()->carga == 'incompleto') ? 'selected' : ''}}>Incompleto</option>
                                    <option value="completo" {{(request()->carga && request()->carga == 'completo') ? 'selected' : ''}}>Completo</option>
                                </select>
                                <label for="carga">Paso</label>
                            </div>
                        </div>

                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                        <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 ps-xl-1">
                            <div class="form-floating">
                                <select class="form-select" name="nro_denuncia" id="nro_denuncia"
                                        onchange="buscar()"
                                    {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                >
                                    <option value="todos" {{(request()->nro_denuncia && request()->nro_denuncia == 'todos') ? 'selected' : ''}}>Todos</option>
                                    <option value="si" {{(request()->nro_denuncia && request()->nro_denuncia == 'si') ? 'selected' : ''}}>Si</option>
                                    <option value="no" {{(request()->nro_denuncia && request()->nro_denuncia == 'no') ? 'selected' : ''}}>No</option>
                                </select>
                                <label for="nro_denuncia">N° Denuncia</label>
                            </div>
                        </div>
                        @endif

                        <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 ps-lg-1">
                            <div class="form-floating">
                                <select class="form-select" name="link_enviado" id="link_enviado"
                                        onchange="buscar()"
                                    {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                >
                                    <option value="todos" {{( isset(request()->link_enviado) && request()->link_enviado == "todos") ? 'selected' : ''}}>Todos</option>
                                    <option value="1" {{( isset(request()->link_enviado) && request()->link_enviado == "1") ? 'selected' : ''}}>Si</option>
                                    <option value="0" {{( isset(request()->link_enviado) && request()->link_enviado == '0') ? 'selected' : ''}}>No</option>
                                </select>
                                <label for="link_enviado">Link enviado</label>
                            </div>
                        </div>

                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                        <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 ps-lg-1">
                            <div class="form-floating">
                                <select class="form-select" name="responsable" id="responsable"
                                        onchange="buscar()"
                                    {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                >
                                    <option value="todos" {{( isset(request()->responsable) && request()->responsable == "todos") ? 'selected' : ''}}>Todos</option>
                                    <option value="nadie" {{( isset(request()->responsable) && request()->responsable == "nadie") ? 'selected' : ''}}>Sin responsable</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{( isset(request()->responsable) && request()->responsable == $user->id) ? 'selected' : ''}}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <label for="responsable">Responsable</label>
                            </div>
                        </div>
                        @endif

                        <div class="col-12 col-md-12 col-lg-6 col-xl-3 px-0 ps-lg-1">
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
                                       value="{{request()->busqueda}}" onchange="buscar()">
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
                                <th scope="col">DOMINIO</th>
                                <th scope="col">TIPO</th>
                                @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                <th scope="col">N° POLIZA</th>
                                <th scope="col">N° DENUNCIA</th>
                                <th scope="col">N° SINIESTRO</th>
                                <th scope="col">COBERTURA</th>
                                @endif
                                <th scope="col">PASO</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">
                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                        ÚLT. OBSERVACIÓN
                                    @else
                                        OBSERVACIÓN
                                    @endif
                                </th>
                                <th scope="col">
                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                        LINK
                                    @else
                                        LINK ENVIADO
                                    @endif
                                </th>
                                <th scope="col">OPERACIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($denuncia_siniestros)
                                @foreach($denuncia_siniestros as $denuncia)
                                    <tr>
                                        <td>{{ $denuncia->id }}</td>
                                        <td>{{ $denuncia->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $denuncia->fecha->format('d/m/Y') }} {{ \Carbon\Carbon::createFromFormat('H:i:s',$denuncia->hora)->format('H:i') }}</td>
                                        <td>{{ $denuncia->dominio_vehiculo_asegurado}}</td>
                                        <td>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                                <select id="tipo_siniestro" class="form-select form-select-sm"
                                                        onchange="cambiarTipoSiniestro(this,{{ $denuncia->id  }})">
                                                    <option value="" {{( $denuncia->tipo_siniestro == null) ? 'selected' : '' }}>Sin especificar</option>
                                                    @foreach($tipos_siniestros as $tipo_siniestro)
                                                        <option value="{{ $tipo_siniestro }}" {{( $denuncia->tipo_siniestro == $tipo_siniestro) ? 'selected' : '' }}>{{ $tipo_siniestro }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                {{ $denuncia->tipo_siniestro != null ? $denuncia->tipo_siniestro : 'Sin especificar' }}
                                            @endif
                                        </td>
                                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                        <td>
                                            <form
                                                action="{{ route('admin.siniestros.denuncia.update.nropoliza',$denuncia->id) }}"
                                                class="form-update-denuncia">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control" name="value"
                                                           value="{{ $denuncia->nro_poliza }}">
                                                    <button class="btn btn-outline-secondary" type="submit">
                                                        <i class="fa-solid fa-rotate"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('admin.siniestros.denuncia.update.nrodenuncia',$denuncia->id) }}"
                                                class="form-update-denuncia">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control" name="value"
                                                           value="{{ $denuncia->nro_denuncia }}">
                                                    <button class="btn btn-outline-secondary" type="submit">
                                                        <i class="fa-solid fa-rotate"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('admin.siniestros.denuncia.update.nrosiniestro',$denuncia->id) }}"
                                                class="form-update-denuncia">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control" name="value"
                                                           value="{{ $denuncia->nro_siniestro }}">
                                                    <button class="btn btn-outline-secondary" type="submit">
                                                        <i class="fa-solid fa-rotate"></i>
                                                    </button>
                                                </div>
                                            </form>
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
                                        @endif
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
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                                {{ $denuncia->observaciones->count() > 0 ? $denuncia->observaciones()->latest()->first()->detalle : '' }}
                                            @else
                                                {{ $denuncia->estado_observacion != null ? $denuncia->estado_observacion : 'Sin observación.' }}
                                                {{ $denuncia->estado_fecha ? '[Actualizado el '.$denuncia->estado_fecha->format('d/m/y').']' : '' }}
                                            @endif

                                        </td>
                                        <td>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                                <a target="_blank" class="btn-link"
                                                   href="https://api.whatsapp.com/send?phone={{$denuncia->responsable_contacto_telefono}}&text=Inicia tu denuncia (dominio: {{$denuncia->dominio_vehiculo_asegurado}}) ingresando a este link: {{route('asegurados-denuncias-paso1.create',['id' => $denuncia->identificador])}}"
                                                   style="color:#3366BB; font-weight: bold; " data-toggle="tooltip"
                                                   data-denuncia-id="{{ $denuncia->id }}"
                                                   data-placement="top" title="Enviar link">
                                                    <i class="fa-solid fa-link {{ $denuncia->link_enviado ? 'text-success' : '' }}"></i>
                                                </a>
                                            @else
                                                {{ $denuncia->link_enviado ? 'Si' : 'No' }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropstart position-static">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-gear"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                                    <li>
                                                        <a href="#"
                                                           class="dropdown-item {{ $denuncia->estado_carga == '12' && $denuncia->nro_poliza !== null && $denuncia->nro_denuncia === null ? '' : 'disabled' }}"
                                                           title="Enviar a compañia"
                                                           data-denuncia-id="{{ $denuncia->id }}"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#modalEnviarACompania">
                                                            <i class="fa-solid fa-file-export"></i><span>Enviar a compañía</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('admin.siniestros.denuncia.show',$denuncia->id) }}"
                                                           class="dropdown-item" title="Ver">
                                                            <i class="fa-solid fa-file-lines"></i><span>Ver</span>
                                                        </a>
                                                    </li>
                                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                                    <li>
                                                        <a href="{{ route('asegurados-denuncias-paso1.create',[ 'id' => $denuncia->identificador]) }}"
                                                           class="dropdown-item" title="Editar">
                                                            <i class="fa-solid fa-file-pen"></i><span>Editar</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                           data-bs-target="#modalEstado"
                                                           data-denuncia-id="{{ $denuncia->id }}"
                                                           class="dropdown-item" title="Estado">
                                                            <i class="fa-solid fa-message"></i></i>
                                                            <span>Estado</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('asegurados-denuncias.pdf',$denuncia->id) }}"
                                                           class="dropdown-item" title="Descargar" target="_blank">
                                                            <i class="fa-solid fa-file-pdf"></i><span>Descargar</span>
                                                        </a>
                                                    </li>
                                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                           data-bs-target="#modalObservaciones"
                                                           data-denuncia-id="{{ $denuncia->id }}"
                                                           class="dropdown-item" title="Observaciones">
                                                            <i class="fa-solid fa-inbox"></i>
                                                            <span>Observaciones</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('borrar denuncias'))
                                                    <li>
                                                        <a href="{{route('admin.siniestros.denuncia.delete',$denuncia->id)}}"
                                                           class="dropdown-item btn-eliminar text-danger"
                                                           title="Borrar">
                                                            <i class="fa-solid fa-trash"></i><span>Borrar</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan=""> No hay denuncias cargadas todavia</td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ $denuncia_siniestros->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                        <div class="col">
                            <button class="btn btn-secondary" type="button" id="btn-exportar"
                                    data-query="{{ request()->getQueryString() }}">
                                <i class="fa-solid fa-file-excel mr-2"></i> Exportar
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Observaciones -->
    <div class="modal fade" id="modalObservaciones" aria-labelledby="modalObservacionesLabel" tabindex="-1"
         aria-hidden="true">
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
                @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar denuncias'))
                <div class="modal-footer ">
                    <form action="" method="post" id="formNuevaObservacion" class="w-100">
                        @csrf
                        <div class="mb-3">
                            <label for="observacion" class="form-label">Nueva observación</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="3"
                                      required></textarea>
                        </div>
                        <div class="float-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Estado -->
    <div class="modal fade" id="modalEstado" aria-labelledby="modalEstadoLabel" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEstadoLabel">Estado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formEstadoDenuncia" class="w-100">
                        @csrf
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="modalestado-estado" name="estado" class="form-select form-select-sm">
                                <option value="ingresado">INGRESADO</option>
                                <option value="aceptado">ACEPTADO</option>
                                <option value="rechazado">RECHAZADO</option>
                                <option value="cerrado">CERRADO</option>
                                <option value="legales">LEGALES</option>
                                <option value="investigacion">INVESTIGACIÓN</option>
                                <option value="derivado-proveedor">DERIVADO A PROVEEDOR</option>
                                <option value="solicitud-documentacion">SOLICITUD DE DOCUMENTACIÓN</option>
                                <option value="informe-pericial">INFORME PERICIAL</option>
                                <option value="pendiente-de-pago">PENDIENTE DE PAGO</option>
                                <option value="esperando-baja-de-unidad">ESPERANDO BAJA DE UNIDAD</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="observacion" class="form-label">Observación</label>
                            <textarea class="form-control" id="modalestado-observacion"
                                      name="observacion" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="observacion" class="form-label">Modificado el</label>
                            <input type="date" class="form-control" id="modalestado-fecha" readonly/>
                        </div>
                        <div class="float-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formEnviarACompania" class="w-100">
                        @csrf
                        <div class="form-group">
                            <label for="tipo_vehiculo">Tipo de Vehiculo</label>
                            <select class="form-select" name="tipo_vehiculo">
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
            let tipo_siniestro = $('#tipo_siniestro');
            let estado = $('#estado');
            let cobertura = $('#cobertura');
            let carga = $('#carga');
            let nro_denuncia = $('#nro_denuncia');
            let link_enviado = $('#link_enviado');
            let responsable = $('#responsable');
            if (tipo == 'id') {
                fechas.attr('checked', false);
                desde.attr('disabled', true);
                desde.val('');
                hasta.attr('disabled', true);
                hasta.val('');
                tipo_siniestro.attr('disabled', true);
                tipo_siniestro.val('todos');
                estado.attr('disabled', true);
                estado.val('todos');
                cobertura.attr('disabled', true);
                cobertura.val('todos');
                carga.attr('disabled', true);
                carga.val('todos');
                nro_denuncia.attr('disabled', true);
                nro_denuncia.val('todos');
                link_enviado.attr('disabled', true);
                link_enviado.val('todos');
                responsable.attr('disabled', true);
                responsable.val('todos');
            } else {
                fechas.attr('checked', true);
                desde.attr('disabled', false);
                desde.val('{{ Carbon\Carbon::now()->subMonth()->toDateString() }}');
                hasta.attr('disabled', false);
                hasta.val('{{ Carbon\Carbon::now()->toDateString() }}');
                tipo_siniestro.attr('disabled', false);
                estado.attr('disabled', false);
                cobertura.attr('disabled', false);
                carga.attr('disabled', false);
                nro_denuncia.attr('disabled', false);
                link_enviado.attr('disabled', false);
                responsable.attr('disabled', false);
            }
        })


        $('.form-update-denuncia').submit(function (event) {
            event.preventDefault();
            let url = $(this).attr('action')
            let value = $(this).find('input[name="value"]').val() ? $(this).find('input[name="value"]').val() : null;
            showLoading();
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "value": value
                },
                success: function (result) {
                    location.reload();
                },
                error: function (error) {
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                }
            })
        })

        function cambiarCoberturaActiva(cobertura, denuncia_siniestro_id) {
            let url = '{{ route('admin.siniestros.denuncia.cambiar-cobertura-activa', ['denuncia' =>  ":denuncia_siniestro_id"]) }}';
            url = url.replace(':denuncia_siniestro_id', denuncia_siniestro_id);
            showLoading();
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "cobertura_activa": cobertura.value
                },
                error: function (error) {
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                }
            })
        }

        function cambiarTipoSiniestro(tipo_siniestro, denuncia_siniestro_id) {
            let url = '{{ route('ajax.admin.siniestros.denuncia.cambiar-tipo-siniestro', ['denuncia' =>  ":denuncia_siniestro_id"]) }}';
            url = url.replace(':denuncia_siniestro_id', denuncia_siniestro_id);
            showLoading();
            $.ajax(
                {
                    url: url,
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "tipo_siniestro": tipo_siniestro.value
                    },
                    error: function () {
                        alert('Hubo un error.');
                    },
                    complete: function () {
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
            url = url.replace(':denuncia_id', denuncia_id)
            url_store = url_store.replace(':denuncia_id', denuncia_id)
            $(this).find('tbody').append('<tr><td colspan="3" class="text-center"><i class="fas fa-spinner fa-pulse"></i> Cargando</td></tr>')
            $(this).find('form').attr('action', url_store)
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (result) {
                    console.log(result);
                    $('#modalObservaciones').find('tbody').empty()
                    if (result.observaciones.length > 0) {
                        let rows = '';
                        result.observaciones.forEach((observacion) => {
                            rows += '<tr><td>' + observacion.fecha_hora + '</td><td>' + observacion.detalle + '</td><td>' + observacion.user_name + '</td></tr>'
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

        $('#modalObservaciones').on('shown.bs.modal', function (event) {
            $("#observacion").focus()
        })

        $('#modalObservaciones').on('hidden.bs.modal', function (event) {
            $(this).find('tbody').empty()
            $(this).find('textarea').val('')
        })

        $("#modalObservaciones form").submit(function (e) {
            showLoading()
        });

        $('#modalEstado').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let denuncia_id = button.data('denuncia-id')
            let url = '{{ route('ajax.admin.siniestros.denuncia.estado.index', ['denuncia' =>  ':denuncia_id']) }}'
            let url_store = '{{ route('admin.siniestros.denuncia.estado.store', ['denuncia' =>  ':denuncia_id']) }}'
            url = url.replace(':denuncia_id', denuncia_id)
            url_store = url_store.replace(':denuncia_id', denuncia_id)
            $(this).find('tbody').append('<tr><td colspan="3" class="text-center"><i class="fas fa-spinner fa-pulse"></i> Cargando</td></tr>')
            $(this).find('form').attr('action', url_store)
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (result) {
                    $('#modalestado-estado').val(result.estado);
                    $('#modalestado-observacion').val(result.observacion);
                    if(result.fecha)
                    {
                        $('#modalestado-fecha').val(result.fecha);
                    }
                },
                error: function (error) {
                    alert('Hubo un error.');
                }
            })
        })

        $("#modalEstado form").submit(function (e) {
            showLoading();
        });

        $('#modalEnviarACompania').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let denuncia_id = button.data('denuncia-id')
            let url = '{{ route('ajax.admin.siniestros.denuncia.enviar-compania', ['denuncia' =>  ':denuncia_id']) }}'
            url = url.replace(':denuncia_id', denuncia_id)
            console.log(url);
            $('#modalEnviarACompania').find('form').attr('action', url);
        })

        $("#modalEnviarACompania form").submit(function (e) {
            e.preventDefault();
            showLoading();
            let tipo_vehiculo = $(this).find('select').val()
            let url = $(this).attr('action')

            $.ajax({
                url: url,
                type: 'post',
                data: {"_token": "{{ csrf_token() }}", 'tipo_vehiculo': tipo_vehiculo},
                timeout: 0,
                async: true,
                success: function (result) {
                    if (result.mensaje) {
                        alert(result.mensaje);
                    } else {
                        location.reload();
                    }
                },
                error: function (error) {
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                    $('#modalEnviarACompania').find('button.close').click();
                }
            })
        });

        $('#check-fechas').change(function () {
            if ($(this).prop('checked')) {
                $('#desde').attr('disabled', false)
                $('#hasta').attr('disabled', false)
            } else {
                $('#desde').attr('disabled', true)
                $('#hasta').attr('disabled', true)
            }
        })

        $('#btn-exportar').click(function () {
            let url = '{{ route('admin.siniestros.export') }}' + '?' + $(this).data('query');
            showLoading();
            $.ajax({
                url: url,
                type: 'get',
                timeout: 0,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (result) {
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(result);
                    link.download = `denuncias.xlsx`;
                    link.click();
                    link.remove();

                },
                error: function (error) {
                    alert('Hubo un error.');
                },
                complete: function (jqXHR, textStatus) {
                    hideLoading();
                }
            })
        });

    </script>

@endsection
