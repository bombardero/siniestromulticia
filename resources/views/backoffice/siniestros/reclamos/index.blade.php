@extends('layouts.super-admin')
@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-5 pb-5">
                    <form action="{{ route('admin.siniestros.reclamos.index') }}" method="get" class="container-fluid" id="buscador">
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
                                        @foreach($estados as $key => $estado)
                                            <option value="{{ $key }}" {{ (request()->estado && request()->estado == $key) ? 'selected' : ''}}>{{ Str::contains($key,':') ? '- '.$estado : $estado }}</option>
                                        @endforeach
                                    </select>
                                    <label for="estado">Estado</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 pl-md-0 px-xl-1">
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

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 pr-lg-1 pl-lg-0 px-xl-1">
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

                            <div class="col-12 col-md-3 col-lg-2 col-xl-1 px-0 pr-lg-1 pl-lg-0 px-xl-1">
                                <div class="form-floating">
                                    <select class="form-select" name="con_denuncia" id="con_denuncia"
                                            onchange="buscar()"
                                        {{ request()->tipo == 'id' ? 'disabled' : '' }}
                                    >
                                        <option value="todos" {{( isset(request()->con_denuncia) && request()->con_denuncia == "todos") ? 'selected' : ''}}>Todos</option>
                                        <option value="si" {{( isset(request()->con_denuncia) && request()->con_denuncia == "si") ? 'selected' : ''}}>Si</option>
                                        <option value="no" {{( isset(request()->con_denuncia) && request()->con_denuncia == 'no') ? 'selected' : ''}}>No</option>
                                    </select>
                                    <label for="con_denuncia">Con Denuncia</label>
                                </div>
                            </div>

                            {{--
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
                            --}}

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
                            <table class="table table-sm table-hover table-border-external">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">FECHA CREACIÓN</th>
                                        <th scope="col">FECHA SINIESTRO</th>
                                        <th scope="col">RECLAMANTE</th>
                                        <th scope="col">DOMINIO</th>
                                        <th scope="col">DOMINIO ASEGURADO</th>
                                        <th scope="col">DENUNCIA ASEGURADO</th>
                                        <th scope="col">NRO POLIZA</th>
                                        <th scope="col">NRO DENUNCIA</th>
                                        <th scope="col">NRO SINIESTRO</th>
                                        <th scope="col">TIPO</th>
                                        <th scope="col">PASO</th>
                                        <th scope="col">ESTADO</th>
                                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                        <th scope="col">ÚLT. OBSERVACIÓN</th>
                                        @endif
                                        <th scope="col">LINK</th>
                                        <th scope="col">OPERACIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($reclamos)
                                    @foreach($reclamos as $reclamo)
                                        <tr>
                                            <td>{{ $reclamo->id }}</td>
                                            <td>{{ $reclamo->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $reclamo->fecha->format('d/m/Y') }} {{ \Carbon\Carbon::createFromFormat('H:i:s',$reclamo->hora)->format('H:i') }}</td>
                                            <td>{{ $reclamo->reclamante ? $reclamo->reclamante->nombre : ''}}</td>
                                            <td>{{ $reclamo->vehiculo_tercero_dominio }}</td>
                                            <td>{{ $reclamo->vehiculo_asegurado_dominio }}</td>
                                            <td>
                                                @if($reclamo->denuncia)
                                                    <a
                                                        href="{{ route('admin.siniestros.denuncia.show',$reclamo->denuncia->id) }}"
                                                        class="btn btn-outline-primary btn-sm"
                                                    >{{ $reclamo->denuncia->id }}</a>
                                                @endif
                                            </td>
                                            <td>{{ $reclamo->denuncia ? $reclamo->denuncia->nro_poliza : '' }}</td>
                                            <td>{{ $reclamo->denuncia ? $reclamo->denuncia->nro_denuncia : '' }}</td>
                                            <td>{{ $reclamo->denuncia ? $reclamo->denuncia->nro_siniestro : '' }}</td>
                                            <td>
                                                {{ implode(', ',$reclamo->tipos_reclamos) }}
                                            </td>
                                            <td>
                                                @if($reclamo->estado_carga == 'precarga')
                                                    <span>PRECARGA</span>
                                                @elseif($reclamo->estado_carga == '10')
                                                    <span>COMPLETO</span>
                                                @else
                                                    <span>{{ $reclamo->estado_carga.'/10' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                                    <select id="estado" class="form-select form-select-sm"
                                                            onchange="cambiarEstado(this, {{ $reclamo->id  }})">
                                                        @foreach($estados as $key => $estado)
                                                            <option value="{{ $key }}" {{ ( $reclamo->full_estado == $key) ? 'selected' : '' }}>{{ Str::contains($key,':') ? '- '.$estado : $estado }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    {{ $estados[$reclamo->estado] }}
                                                @endif
                                            </td>
                                            @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                            <td>
                                                {{ $reclamo->observaciones->count() > 0 ? Illuminate\Support\Str::limit($reclamo->observaciones()->latest()->first()->detalle, 150, ' (...)') : '' }}
                                            </td>
                                            @endif
                                            <td>
                                                @if($reclamo->denuncia_siniestro_id)
                                                    <a target="_blank" class="btn-link"
                                                       href="https://api.whatsapp.com/send?phone={{ $reclamo->responsable_contacto_telefono}}&text=Inicia tu reclamo ingresando a este link: {{ route('siniestros.terceros.paso1.create',['id' => $reclamo->identificador])}}"
                                                       style="color:#3366BB; font-weight: bold; " data-toggle="tooltip" data-reclamo-id="{{ $reclamo->id }}"
                                                       data-placement="top" title="Enviar link">
                                                        <i class="fa-solid fa-link {{ $reclamo->link_enviado ? 'text-success' : '' }}"></i>
                                                    </a>
                                                @else
                                                    <i class="fa-solid fa-link-slash text-secondary" title="No disponible"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropstart position-static">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gear"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.siniestros.reclamos.show',$reclamo->id) }}"
                                                               class="dropdown-item" title="Ver">
                                                                <i class="fa-solid fa-file-lines"></i><span>Ver</span>
                                                            </a>
                                                        </li>
                                                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('editar-reclamos-terceros'))
                                                        <li>
                                                            @if($reclamo->denuncia_siniestro_id)
                                                                <a href="{{ route('admin.siniestros.reclamos.desvincular',['reclamo' => $reclamo->id]) }}"
                                                                   class="dropdown-item btn-desvincular" title="Desvincular Denuncia">
                                                                    <i class="fa-solid fa-file-circle-xmark"></i><span>Desvincular Denuncia</span>
                                                                </a>
                                                            @else
                                                                <button type="button"
                                                                        class="dropdown-item" title="Vincular Denuncia"
                                                                        data-bs-toggle="modal" data-bs-target="#modalVincularDenuncia"
                                                                        data-reclamo-id="{{ $reclamo->id }}"
                                                                >
                                                                    <i class="fa-solid fa-file-circle-plus"></i><span>Vincular Denuncia</span>
                                                                </button>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('siniestros.terceros.paso1.create',[ 'id' => $reclamo->identificador]) }}"
                                                               class="dropdown-item" title="Editar">
                                                                <i class="fa-solid fa-file-pen"></i><span>Editar</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalObservaciones" data-reclamo-id="{{ $reclamo->id }}"
                                                               class="dropdown-item" title="Observaciones">
                                                                <i class="fa-solid fa-message"></i></i><span>Observaciones</span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if(auth()->user()->hasRole('superadmin') || auth()->user()->can('borrar-reclamos-terceros'))
                                                        <li>
                                                            <a href="{{route('admin.siniestros.reclamos.delete',$reclamo->id)}}"
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
                                    <td> No hay denuncias cargadas todavia</td>
                                @endif
                                </tbody>
                            </table>
                            {{ $reclamos->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
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

    <!-- Modal Vincular Denuncia -->
    <div class="modal fade" id="modalVincularDenuncia" tabindex="-1" aria-labelledby="modalLabelVincularDenuncia" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabelVincularDenuncia">Vincular Reclano ID <span id="mvd-reclamo-id-title"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid">
                    <div id="mvd-reclamo"></div>
                    <h5 class="mt-2">Buscar Denuncias</h5>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <form action="" id="mvd-form">
                                <input type="hidden" id="mvd-reclamo-id">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <select class="form-select" id="mvd-tipo">
                                            <option value="dominio">Dominio Asegurado</option>
                                            <option value="id">ID o N° Gestión</option>
                                        </select>
                                        <label for="tipo">Buscar por</label>
                                    </div>
                                    <input type="text" id="mvd-busqueda" name="busqueda" class="form-control no-border-radius-left" required>
                                    <button class="btn btn-outline-secondary" type="submit" id="mvd-buscar">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col table-responsive">
                            <table class="table table-sm table-hover table-border-external">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">FECHA CREACIÓN</th>
                                    <th scope="col">FECHA SINIESTRO</th>
                                    <th scope="col">ASEGURADO</th>
                                    <th scope="col">DOMINIO</th>
                                    <th scope="col">N° POLIZA</th>
                                    <th scope="col">N° DENUNCIA</th>
                                    <th scope="col">N° SINIESTRO</th>
                                    <th scope="col">COBERTURA</th>
                                    <th scope="col">PASO</th>
                                    <th scope="col">ESTADO</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>

    $('.btn-eliminar').click(function (event) {
        let result = confirm('¿Confirme que desea eliminar el Reclamo?');
        if (!result) {
            event.preventDefault();
            return false;
        }
        showLoading();
    });

    $('.btn-link').click(function (event) {
        event.preventDefault();
        let btn_link = $(this);
        let url = '{{ route('ajax.admin.siniestros.reclamos.link-enviado', ['reclamo' =>  ":reclamo_tercero_id"]) }}';
        url = url.replace(':reclamo_tercero_id', btn_link.data('reclamo-id'));
        let link = btn_link.attr('href');

        $.ajax(
            {
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (result) {
                    btn_link.find("i").addClass('text-success');
                    window.open(link, '_blank');
                },
                error: function (error) {
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
        let carga = $('#carga');
        let responsable = $('#responsable');
        let link_enviado = $('#link_enviado');
        if(tipo == 'id')
        {
            fechas.attr('checked', false);
            desde.attr('disabled', true);
            desde.val('');
            hasta.attr('disabled', true);
            hasta.val('');
            estado.attr('disabled', true);
            estado.val('todos');
            carga.attr('disabled', true);
            carga.val('todos');
            responsable.attr('disabled', true);
            responsable.val('todos');
            link_enviado.attr('disabled', true);
            link_enviado.val('todos');
        } else {
            fechas.attr('checked', true);
            desde.attr('disabled', false);
            desde.val('{{ Carbon\Carbon::now()->subMonth()->toDateString() }}');
            hasta.attr('disabled', false);
            hasta.val('{{ Carbon\Carbon::now()->toDateString() }}');
            estado.attr('disabled', false);
            carga.attr('disabled', false);
            responsable.attr('disabled', false);
            link_enviado.attr('disabled', false);
        }
    })

    function cambiarEstado(estado, reclamo_id) {
        let url = '{{ route('ajax.admin.siniestros.reclamos.cambiar-estado', ['reclamo' =>  ":reclamo_id"]) }}';
        url = url.replace(':reclamo_id', reclamo_id)
        showLoading();
        $.ajax(
            {
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "estado": estado.value
                },
                error: function (error) {
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
        let reclamo_id = button.data('reclamo-id')
        let url = '{{ route('ajax.admin.siniestros.reclamos.observaciones.index', ['reclamo' =>  ':reclamo_id']) }}'
        let url_store = '{{ route('admin.siniestros.reclamos.observaciones.store', ['reclamo' =>  ':reclamo_id']) }}'
        url = url.replace(':reclamo_id',reclamo_id)
        url_store = url_store.replace(':reclamo_id',reclamo_id)
        $(this).find('tbody').append('<tr><td colspan="3" class="text-center"><i class="fas fa-spinner fa-pulse"></i> Cargando</td></tr>')
        $(this).find('form').attr('action',url_store)
        $.ajax({
            url: url,
            type: 'get',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (result) {
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

    $('#modalVincularDenuncia').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget)
        let reclamo_id = button.data('reclamo-id')
        let url_show = '{{ route('ajax.admin.siniestros.reclamos.show', ['reclamo' =>  ':reclamo_id']) }}'
        url_show = url_show.replace(':reclamo_id',reclamo_id);

        $.ajax({
            url: url_show,
            type: 'get',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (result) {
                cargarDatosReclamos(result.reclamo)
                $('#mvd-form').submit();
            },
            error: function (error) {
                alert('Hubo un error.');
            }
        })
    })

    function cargarDatosReclamos(reclamo)
    {
        let reclamo_html = '';
        reclamo_html += '<div class="row"><div class="col-12 col-md-6 mb-2">Fecha de creación: '+reclamo.fecha_hora_alta+'</div>';
        reclamo_html += '<div class="col-12 col-md-6 mb-2">Fecha del Siniestro: '+reclamo.fecha_hora+'</div></div>';
        reclamo_html += '<div class="row"><div class="col-12 col-md-6 mb-2">Dominio Tercero: '+reclamo.dominio+'</div>';
        reclamo_html += '<div class="col-12 col-md-6 mb-2">Dominio Asegurado: '+reclamo.dominio_asegurado+'</div></div>';
        reclamo_html += '<div class="row"><div class="col-12 mb-2">Lugar: '+reclamo.lugar+'</div>';
        if(reclamo.pais && reclamo.provincia)
        {
            reclamo_html += '<div class="row"><div class="col-12 col-md-4 mb-2">País: '+reclamo.pais+'</div>';
            reclamo_html += '<div class="col-12 col-md-4 mb-2">Provincia: '+reclamo.provincia+'</div>';
            reclamo_html += '<div class="col-12 col-md-4 mb-2">Localidad: '+reclamo.localidad+'</div></div>';
        } else if (reclamo.localidad) {
            reclamo_html += '<div class="row"><div class="col-12 mb-2">Localidad/Provincia/Pais: '+reclamo.localidad+'</div></div>';
        } else {
            reclamo_html += '<div class="row"><div class="col-12 col-md-4 mb-2">País: </div><div class="col-12 col-md-4 mb-2">Provincia: </div><div class="col-12 col-md-4 mb-2">Localidad: </div></div>';
        }
        $('#mvd-reclamo').html(reclamo_html);
        $('#mvd-reclamo-id').val(reclamo.id);
        $('#mvd-reclamo-id-title').html(reclamo.id);
        $('#mvd-busqueda').val(reclamo.dominio_asegurado);
    }

    $('#modalVincularDenuncia').on('shown.bs.modal', function (event)
    {
        $("#mvd-busqueda").focus()
    })

    $('#modalVincularDenuncia').on('hidden.bs.modal', function (event)
    {
        $('#mvd-reclamo').html('');
        $('#mvd-reclamo-id-title').html('');
        $('#mvd-tipo').val('dominio')
        $('#mvd-busqueda').val('');
        $(this).find('tbody').empty()
    })

    $('#mvd-form').submit(function (event) {
        event.preventDefault();
        let tbody = $('#modalVincularDenuncia').find('tbody');
        tbody.empty();
        tbody.append('<tr><td colspan="12" class="text-center"><i class="fas fa-spinner fa-pulse"></i> Cargando</td></tr>');
        let reclamo_id = $('#mvd-reclamo-id').val();
        let url_search = '{{ route('ajax.admin.siniestros.reclamos.vincular.search', ['reclamo' =>  ':reclamo_id']) }}'
        url_search = url_search.replace(':reclamo_id',reclamo_id);
        let busqueda = $('#mvd-busqueda').val();
        let tipo = $('#mvd-tipo').val();

        $.ajax({
            url: url_search,
            type: 'get',
            data: {
                '_token': "{{ csrf_token() }}",
                'busqueda': busqueda,
                'tipo': tipo,
            },
            success: function (result) {
                $('#modalVincularDenuncia').find('tbody').empty();
                cargarDenuncias(result.denuncias, reclamo_id);
            },
            error: function (error) {
                alert('Hubo un error.');
            }
        })
    });

    function cargarDenuncias(denuncias, reclamo_id)
    {
        let rows = '';
        let url_denuncia_show = '{{ route('admin.siniestros.denuncia.show', ['denuncia' =>  ':denuncia_id:']) }}';
        let url_vincular = '{{ route('admin.siniestros.reclamos.vincular.store', ['reclamo' =>  ':reclamo_id:']) }}';
        url_vincular = url_vincular.replace(':reclamo_id:',reclamo_id);
        let form = '<form action=":url_vincular:" method="post" id="vincular-denuncia-:denuncia_id:"><input type="hidden" name="_token" value="{{ csrf_token() }}" /> <input type="hidden" name="denuncia_siniestro_id" value=":denuncia_id:"> </form>';
        form = form.replace(':url_vincular:',url_vincular);
        let btns = '<div class="btn-group" role="group"><a href=":url_denuncia_show:" target="_blank" type="button" class="btn btn-info btn-sm">Ver</a> <button type="submit" class="btn btn-primary btn-sm" form="vincular-denuncia-:denuncia_id:">Vincuar</button></div>';

        denuncias.forEach(denuncia => {
            let denuncia_url = url_denuncia_show.replace(':denuncia_id:',denuncia.id);
            rows += '<tr>';
            rows += '<td>'+denuncia.id+'</td>';
            rows += '<td>'+denuncia.fecha_creacion+'</td>';
            rows += '<td>'+denuncia.fecha_siniestro+'</td>';
            rows += '<td>'+denuncia.asegurado+'</td>';
            rows += '<td>'+denuncia.dominio+'</td>';
            rows += '<td>'+denuncia.nro_poliza+'</td>';
            rows += '<td>'+denuncia.nro_denuncia+'</td>';
            rows += '<td>'+denuncia.nro_siniestro+'</td>';
            rows += '<td>'+denuncia.cobertura+'</td>';
            rows += '<td>'+denuncia.paso+'</td>';
            rows += '<td>'+denuncia.estado+'</td>';
            rows += '<td>'+form.replaceAll(':denuncia_id:', denuncia.id)+btns.replaceAll(':denuncia_id:', denuncia.id).replace(':url_denuncia_show:',denuncia_url)+'</td>';
            rows += '</tr>';
        });
        if(denuncias.length == 0)
        {
            rows = '<tr><td class="text-center" colspan="12">No se encontraron denuncias</td></tr>'
        }
        $('#modalVincularDenuncia').find('tbody').html(rows);
    }

    $('.btn-desvincular').click(function (event) {
        let result = confirm('¿Confirme que desea desvincular la Denuncia asociada?');
        if (!result) {
            event.preventDefault();
            return false;
        }
        showLoading();
    });

</script>

@endsection
