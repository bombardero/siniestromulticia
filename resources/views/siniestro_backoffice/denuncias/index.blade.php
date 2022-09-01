@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mt-5 mb-5">

                    <h1 class="panel-operaciones-title">Bienvenido {{auth()->user()->name}}</h1>
                    <p class="pt-3 panel-operaciones-subtitle">Panel de Notificaciones de Siniestros | Asegurados</p>
                    <form action="/panel-siniestros/buscador" method="get" class="container">
                        <div class="row mb-3">
                            <input type="date" name="desde"
                                   value="{{ isset($desde) ? $desde : Carbon\Carbon::now()->subMonth()->toDateString() }}">
                            <input type="date" name="hasta"
                                   value="{{ isset($hasta) ? $hasta : Carbon\Carbon::now()->toDateString() }}">
                            <select class="form-select col-2" name="estado">
                                <option
                                    value="todos" {{(request()->estado && request()->estado == 'todos') ? 'selected' : ''}}>
                                    Todos
                                </option>
                                <option
                                    value="predenuncia" {{(request()->estado && request()->estado == 'predenuncia') ? 'selected' : ''}}>
                                    Predenuncia
                                </option>
                                <option
                                    value="incompleto" {{(request()->estado && request()->estado == 'incompleto') ? 'selected' : ''}}>
                                    Incompleto
                                </option>
                                <option
                                    value="completo" {{(request()->estado && request()->estado == 'completo') ? 'selected' : ''}}>
                                    Completo
                                </option>
                            </select>
                            <div class="input-group col-4">
                                <input type="text" name="busqueda" class="form-control" value="{{request()->busqueda}}">
                                <button class="btn btn-outline-secondary" type="submit" id="">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-3">
                        <div clas="col-12 col-md-6">

                        </div>
                        <div class="table-responsive">
                            <table class="table">

                                <thead class="thead tabla-panel">
                                <tr class="tabla-cabecera ">
                                    <th class="th-padding" scope="col">ID</th>
                                    <th class="th-padding" scope="col">F CREACIÓN</th>
                                    <th class="th-padding" scope="col">F SINIESTRO</th>
                                    <th class="th-padding" scope="col">ASEGURADO</th>
                                    <th class="th-padding" scope="col">DOMINIO</th>
                                    <th class="th-padding" scope="col">N°POLIZA</th>
                                    <th class="th-padding" scope="col">N°DENUNCIA</th>
                                    <th class="th-padding" scope="col">N°SINIESTRO</th>
                                    <th class="th-padding" scope="col">ESTADO</th>
                                    <th class="th-padding" scope="col">PASO</th>
                                    <th class="th-padding" scope="col">LINK</th>
                                    <th class="th-padding" scope="col">OPERACIONES</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if($denuncia_siniestros)
                                    @foreach($denuncia_siniestros as $denuncia)
                                        <tr class="borde-tabla">
                                            <td>{{$denuncia->id}}</td>
                                            <td>{{ \Carbon\Carbon::parse($denuncia->created_at)->format('d/m/Y H:i')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($denuncia->precarga_fecha_siniestro)->format('d/m/Y')}}  {{ \Carbon\Carbon::parse($denuncia->precarga_hora_siniestro)->format('H:i')}}</td>
                                            <td>{{ $denuncia->asegurado ? $denuncia->asegurado->carga_paso_4_asegurado_nombre : ''}}</td>
                                            <td>{{$denuncia->precarga_dominio_vehiculo_asegurado}}</td>
                                            <td><input
                                                    onblur="save('poliza',{{route('panel-siniestros.denuncia.update.nropoliza',$denuncia->id)}})"
                                                    type="text" id="npoliza" name="npoliza" value="1"
                                                    style="height: 21px;width:70px !important;"></td>
                                            <td><input
                                                    onblur="save('denuncia',{{route('panel-siniestros.denuncia.update.nrodenuncia',$denuncia->id)}})"
                                                    type="text" id="ndenuncia" name="ndenuncia" value="1"
                                                    style="height: 21px;width:70px !important;"></td>
                                            <td><input
                                                    onblur="save('siniestro',{{route('panel-siniestros.denuncia.update.nrosiniestro',$denuncia->id)}})"
                                                    type="text" id="nsiniestro" name="nsiniestro" value="1"
                                                    style="height: 21px;width:70px !important;"></td>
                                            <td>
                                                <select name="select">
                                                    <option value="aceptado">ACEPTADO</option>
                                                    <option value="rechazado">RECHAZADO</option>
                                                    <option value="cerrado">CERRADO</option>
                                                    <option value="legales">LEGALES</option>
                                                    <option value="investigacion">INVESTIGACION</option>
                                                </select>
                                            </td>
                                            <td>@if($denuncia->state != 12)
                                                    <span
                                                        style="color:#FF9400;">{{'Carga en curso - Paso '.$denuncia->state.'/12'}}</span>
                                                @else
                                                    <span style="color:#545358;">COMPLETO</span>
                                                @endif</td>
                                            <td><a target="_blank"
                                                   href="https://api.whatsapp.com/send?phone=+54{{$denuncia->precarga_responsable_contacto_telefono}}&text=Inicia tu denuncia ingresando a este link: {{route('asegurados-denuncias-paso1.create',['id' => $denuncia->identificador])}}"
                                                   style="color:#3366BB; font-weight: bold; " data-toggle="tooltip"
                                                   data-placement="top" title="Enviar link denuncia"><img
                                                        src="{{url('/images/siniestros/denuncia_asegurado/backoffice/link_no_enviado.png')}}"></a>
                                            </td>

                                            <td>


                                                <a href="#" style="color:#3366BB; font-weight: bold; margin-right:8px; "
                                                   data-toggle="tooltip" data-placement="top" title="Enviar a compañia"><img
                                                        src="{{url('/images/siniestros/denuncia_asegurado/backoffice/emitir.png')}}"></a>


                                                <a href="{{route('panel-siniestros.denuncia.show',$denuncia->id)}}"
                                                   style="color:#3366BB; font-weight: bold; margin-right:8px; "
                                                   data-toggle="tooltip" data-placement="top" title="Ver"><img
                                                        src="{{url('/images/siniestros/denuncia_asegurado/backoffice/ver.png')}}"></a>

                                                <a href="#" style="color:#3366BB; font-weight: bold; margin-right:8px; "
                                                   data-toggle="tooltip" data-placement="top" title="Editar"><img
                                                        src="{{url('/images/siniestros/denuncia_asegurado/backoffice/editar.png')}}"></a>

                                                <a onclick="eliminar('{{route('panel-siniestros.denuncia.delete',$denuncia->id)}}')"
                                                   href="#" style="color:#3366BB; font-weight: bold; margin-right:8px; "
                                                   data-toggle="tooltip" data-placement="top" title="Eliminar"><img
                                                        src="{{url('/images/siniestros/denuncia_asegurado/backoffice/eliminar.png')}}"></a>
                                                {{--
                                                                <a href="{{route('panel-siniestros.denuncia.update',$denuncia->id)}}" style="color:#3366BB; font-weight: bold; margin-right:8px; " data-toggle="tooltip" data-placement="top" title="Guardar"><img src="{{url('/images/siniestros/denuncia_asegurado/backoffice/save.png')}}"></a>
                                              --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td> No hay denuncias cargadas todavia</td>
                                @endif
                                </tbody>
                            </table>
                            {{ $denuncia_siniestros->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <script>
        function eliminar(ruta) {
            let text = "Confirma desea eliminar la denuncia?";
            if (confirm(text) == true) {
                text = "You pressed OK!";

                window.location.href = ruta;

            } else {
                text = "You canceled!";
            }
        }

        function save(entidad, ruta) {
            //alert(entidad);
            console.log(entidad);
            nro_poliza = document.getElementById('npoliza')
        :
            window.location.href = ruta;
        }
    </script>

@endsection
