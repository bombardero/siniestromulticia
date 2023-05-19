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
                                            <option value="{{ $key }}" {{ (request()->estado && request()->estado == $key) ? 'selected' : ''}}>{{ $estado }}</option>
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
                            <table class="table table-sm table-hover table-border-external">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">FECHA CREACIÓN</th>
                                        <th scope="col">FECHA SINIESTRO</th>
                                        <th scope="col">RECLAMANTE</th>
                                        <th scope="col">DOMINIO ASEGURADO</th>
                                        <th scope="col">ESTADO</th>
                                        <th scope="col">TIPO</th>
                                        <th scope="col">PASO</th>
                                        <th scope="col">ÚLT. OBSERVACIÓN</th>
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
                                            <td>{{ $reclamo->vehiculo_asegurado_dominio}}</td>
                                            <td>
                                                <select id="estado" class="form-select form-select-sm"
                                                        onchange="cambiarEstado(this, {{ $reclamo->id  }})">
                                                    @foreach($estados as $key => $estado)
                                                        <option value="{{ $key }}" {{( $reclamo->estado == $key) ? 'selected' : '' }}>{{ $estado }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                {{ implode(', ',$reclamo->tiposReclamos) }}
                                            </td>
                                            <td>
                                                @if($reclamo->estado_carga == 'precarga')
                                                    <span>PRECARGA</span>
                                                @elseif($reclamo->estado_carga == '10')
                                                    <span>COMPLETO</span>
                                                @else
                                                    <span>{{ $reclamo->estado_carga.'/10' }}</span>
                                                @endif</td>
                                            <td>
                                                {{-- $reclamo->observaciones->count() > 0 ? $reclamo->observaciones()->latest()->first()->detalle : '' --}}
                                            </td>
                                            <td>
                                                <a target="_blank" class="btn-link"
                                                   href="https://api.whatsapp.com/send?phone={{ $reclamo->responsable_contacto_telefono}}&text=Inicia tu reclamo ingresando a este link: {{ route('siniestros.terceros.paso1.create',['id' => $reclamo->identificador])}}"
                                                   style="color:#3366BB; font-weight: bold; " data-toggle="tooltip" data-reclamo-id="{{ $reclamo->id }}"
                                                   data-placement="top" title="Enviar link">
                                                    <i class="fa-solid fa-link {{ $reclamo->link_enviado ? 'text-success' : '' }}"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="dropstart position-static">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gear"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{route('admin.siniestros.reclamos.show',$reclamo->id)}}"
                                                               class="dropdown-item" title="Ver">
                                                                <i class="fa-solid fa-file-lines"></i><span>Ver</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('siniestros.terceros.paso1.create',[ 'id' => $reclamo->identificador]) }}"
                                                               class="dropdown-item" title="Editar">
                                                                <i class="fa-solid fa-file-pen"></i><span>Editar</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalObservaciones" data-denuncia-id="{{ $reclamo->id }}"
                                                               class="dropdown-item disabled" title="Observaciones">
                                                                <i class="fa-solid fa-message"></i></i><span>Observaciones</span>
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
