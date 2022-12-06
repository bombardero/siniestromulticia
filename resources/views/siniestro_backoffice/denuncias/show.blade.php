@extends('layouts.backoffice')
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
                                        <h5 class="col-3 mb-0">
                                            Notificación: {{$denuncia->id}}
                                        </h5>
                                        <h5 class="col-3 text-danger mb-0">
                                            Estado Carga: <span
                                                class="text-uppercase">{{$denuncia->estado_carga}}</span>
                                        </h5>
                                        <div class="col-6 text-right">
                                            <img
                                                src="{{url('/images/siniestros/denuncia_asegurado/backoffice/aprobar.png')}}"
                                                class="px-2">
                                            <img
                                                src="{{url('/images/siniestros/denuncia_asegurado/backoffice/rechazar.png')}}"
                                                class="px-2">
                                            <a href="{{route('asegurados-denuncias.pdf',$denuncia->id)}}">
                                                <img
                                                    src="{{url('/images/siniestros/denuncia_asegurado/backoffice/bajarpdf.png')}}"
                                                    class="px-2">
                                            </a>
                                            <a href="{{ route('panel-siniestros.denuncia.delete',$denuncia->id) }}"
                                               class="px-2 btn-eliminar text-danger" title="Eliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body container">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <p>Fecha del Siniestro: {{ $denuncia->fecha->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>Hora del
                                                Siniestro: {{ \Carbon\Carbon::createFromFormat('H:i:s',$denuncia->hora)->format('H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <p>Estado del
                                                Tiempo: {{$denuncia->momento_dia != null ? $denuncia->momento_dia : '' }}
                                                {{ $denuncia->estado_tiempo_seco ? ' Seco. ' : ''}}
                                                {{$denuncia->estado_tiempo_lluvia ? ' Lluvia. ' : ''}}
                                                {{$denuncia->estado_tiempo_niebla ? ' Niebla. ':''}}
                                                {{$denuncia->estado_tiempo_despejado ? ' Despejado. ':''}}
                                                {{$denuncia->estado_tiempo_nieve ? ' Nieve. ':''}}
                                                {{$denuncia->estado_tiempo_granizo == 'on' ? ' Granizo. ':''}}
                                                {{$denuncia->estado_tiempo_otros_detalles}}</p>
                                        </div>
                                    </div>
                                    @if($denuncia->estado_carga == '12' && $denuncia->finalized_at)
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <p>Finalizado: {{ $denuncia->finalized_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($denuncia->estado_carga == 'precarga')
                                        <div class="row">
                                            <div class="col-12">
                                                Dominio: {{ $denuncia->dominio_vehiculo_asegurado }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                Lugar del siniestro: {{ $denuncia->lugar_nombre }}
                                            </div>
                                            <div class="col-12 col-md-6">
                                                Código Postal: {{ $denuncia->codigo_postal }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Dirección: {{ $denuncia->direccion }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Nombre del Conductor: {{ $denuncia->nombre_conductor }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Descripción del Siniestro: {{ $denuncia->descripcion }}
                                            </div>
                                        </div>
                                        <h5 class="card-title mt-3">Datos del Contacto</h5>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                Nombre: {{ $denuncia->responsable_contacto_nombre }}
                                            </div>
                                            <div class="col-12 col-md-6">
                                                Teléfono: {{ $denuncia->responsable_contacto_telefono }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                Domicilio: {{ $denuncia->responsable_contacto_domicilio }}
                                            </div>
                                            <div class="col-12 col-md-6">
                                                Email: {{ $denuncia->responsable_contacto_email }}
                                            </div>
                                        </div>
                                    @else

                                        <div class="alert alert-secondary mt-3 " role="alert">Datos del Contacto</div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Nombre: {{ $denuncia->responsable_contacto_nombre }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Teléfono: {{ $denuncia->responsable_contacto_telefono }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Domicilio: {{ $denuncia->responsable_contacto_domicilio }}</p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Email: {{ $denuncia->responsable_contacto_email }}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">Lugar del Siniestro<a
                                                href="{{ route('asegurados-denuncias-paso2.create',['id' => $denuncia->identificador]) }}"
                                                class="badge badge-secondary float-right "><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar</a>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-8">
                                                <p>Lugar: {{ $denuncia->lugar_nombre }}</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p>CP: {{ $denuncia->codigo_postal }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            @if($denuncia->pais_id && $denuncia->province_id)
                                                <div class="col-12 col-md-4">
                                                    <p>País: {{ $denuncia->pais->nombre }}</p>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <p>Provincia: {{ $denuncia->provincia->name }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>
                                                        Localidad:
                                                        {{ $denuncia->city_id != null ? $denuncia->localidad->name : $denuncia->otro_pais_provincia_localidad }}
                                                    </p>
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

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>Calle/Ruta: {{ $denuncia->calle }}</p>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <p>Intersección: {{ $denuncia->interseccion }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>Tipo
                                                    Calzada: {{ $denuncia->tipo_calzada_id != null ? $denuncia->tipoCalzada->nombre : ''}}</p>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <p>Detalle
                                                    Calzada: {{ $denuncia->calzada_detalle }}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Datos del conductor del vehiculo asegurado
                                            <a href="{{ route('asegurados-denuncias-paso3.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-8">
                                                <p>Nombre y
                                                    Apellido: {{ $denuncia->conductor ? $denuncia->conductor->nombre : ''}}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Teléfono: {{ $denuncia->conductor ? $denuncia->conductor->telefono : ''}}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-8">
                                                <p>
                                                    Domicilio: {{ $denuncia->conductor ? $denuncia->conductor->domicilio : ''}}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Código
                                                    Postal: {{ $denuncia->conductor ? $denuncia->conductor->codigo_postal : ''}}</p>
                                            </div>
                                        </div>


                                        <div class="row pt-0">
                                            @if($denuncia->conductor)
                                                @if($denuncia->conductor->pais && $denuncia->conductor->provincia)
                                                    <div class="col-12 col-md-4">
                                                        <p>País: {{ $denuncia->conductor->pais->nombre }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Provincia: {{ $denuncia->conductor->provincia->name }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>
                                                            Localidad:
                                                            {{ $denuncia->conductor->localidad ? $denuncia->conductor->localidad->name : $denuncia->conductor->otro_pais_provincia_localidad }}
                                                        </p>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <p>Localidad/Provincia/Pais: {{ $denuncia->conductor->otro_pais_provincia_localidad }}</p>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="col-12 col-md-4"><p>País:</p></div>
                                                <div class="col-12 col-md-4"><p>Provincia: </p></div>
                                                <div class="col-12 col-md-4"><p>Localidad: </p></div>
                                            @endif
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>Fecha de
                                                    Nacimiento: {{ $denuncia->conductor ? $denuncia->conductor->fecha_nacimiento->format('d/m/Y') : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Documento
                                                    Tipo: {{ $denuncia->conductor ? $denuncia->conductor->tipoDocumento->nombre : ''}}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Documento
                                                    Número: {{ $denuncia->conductor ? $denuncia->conductor->documento_numero : '' }}</p>
                                            </div>
                                        </div>


                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Ocupación:
                                                    {{ $denuncia->conductor ? $denuncia->conductor->ocupacion : '' }}
                                                </p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Nro. de Registro:
                                                    {{ $denuncia->conductor ? $denuncia->conductor->numero_registro : '' }}
                                                </p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Estado Civil:
                                                    {{ $denuncia->conductor ? $denuncia->conductor->estado_civil : '' }}
                                                </p>
                                            </div>

                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>Licencia
                                                    Tipo: {{ $denuncia->conductor && $denuncia->conductor->tipoCarnet ? $denuncia->conductor->tipoCarnet->nombre : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Licencia
                                                    Categoria: {{ $denuncia->conductor ? $denuncia->conductor->carnet_categoria : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Licencia
                                                    Vencimiento: {{ $denuncia->conductor ? $denuncia->conductor->carnet_vencimiento->format('d/m/Y') : ''}}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Datos del asegurado
                                            <a href="{{ route('asegurados-denuncias-paso4.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>Nombre y
                                                    Apellido: {{ $denuncia->asegurado ? $denuncia->asegurado->nombre : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Tipo
                                                    Documento: {{ $denuncia->asegurado ? $denuncia->asegurado->tipoDocumento->nombre : '' }} </p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Número
                                                    Documento: {{ $denuncia->asegurado ? $denuncia->asegurado->documento_numero : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-8">
                                                <p>
                                                    Domicilio: {{ $denuncia->asegurado ? $denuncia->asegurado->domicilio : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Código
                                                    Postal: {{ $denuncia->asegurado ? $denuncia->asegurado->codigo_postal : '' }}</p>
                                            </div>
                                        </div>


                                        <div class="row pt-0">
                                            @if($denuncia->asegurado)
                                                @if($denuncia->asegurado->pais && $denuncia->asegurado->provincia)
                                                    <div class="col-12 col-md-4">
                                                        <p>País: {{ $denuncia->asegurado->pais->nombre }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Provincia: {{ $denuncia->asegurado->provincia->name }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Localidad: {{ $denuncia->asegurado->localidad ? $denuncia->asegurado->localidad->name : $denuncia->asegurado->otro_pais_provincia_localidad }}</p>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <p>Localidad/Provincia/Pais: {{ $denuncia->asegurado->otro_pais_provincia_localidad }}</p>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="col-12 col-md-4"><p>País:</p></div>
                                                <div class="col-12 col-md-4"><p>Provincia: </p></div>
                                                <div class="col-12 col-md-4"><p>Localidad: </p></div>
                                            @endif
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Ocupación: {{ $denuncia->asegurado ? $denuncia->asegurado->ocupacion : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Teléfono: {{ $denuncia->asegurado ? $denuncia->asegurado->telefono : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Datos del vehiculo asegurado
                                            <a href="{{ route('asegurados-denuncias-paso5.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-3">
                                                <p>
                                                    Marca: {{ $denuncia->vehiculo ? ($denuncia->vehiculo->marca ? $denuncia->vehiculo->marca->nombre : $denuncia->vehiculo->otra_marca) : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <p>
                                                    Modelo: {{ $denuncia->vehiculo ? ($denuncia->vehiculo->modelo ? $denuncia->vehiculo->modelo->nombre : $denuncia->vehiculo->otro_modelo) : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <p>
                                                    Tipo: {{ $denuncia->vehiculo ? $denuncia->vehiculo->tipo : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <p>
                                                    Año: {{ $denuncia->vehiculo ? $denuncia->vehiculo->anio : '' }}</p>
                                            </div>

                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Dominio: {{ $denuncia->vehiculo ? $denuncia->vehiculo->dominio : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Motor: {{ $denuncia->vehiculo ? $denuncia->vehiculo->motor : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Chasis: {{ $denuncia->vehiculo ? $denuncia->vehiculo->chasis : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-6">
                                                <p>
                                                    Uso:
                                                    @if($denuncia->vehiculo)
                                                        {{$denuncia->vehiculo->uso_particular ? ' Particular. ':''}}
                                                        {{$denuncia->vehiculo->uso_comercial ? ' Comercial. ':''}}
                                                        {{$denuncia->vehiculo->uso_taxi ? ' Taxi. ':''}}
                                                        {{$denuncia->vehiculo->uso_tpp ? ' Transporte Publico. ':''}}
                                                        {{$denuncia->vehiculo->uso_urgencia ? ' Transporte de Urgencia. ':''}}
                                                        {{$denuncia->vehiculo->uso_seguridad ? ' Transporte de Seguridad. ':''}}</p>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <p>
                                                    Tipo Siniestro:
                                                    @if($denuncia->vehiculo)
                                                        {{$denuncia->vehiculo->siniestro_danio ? ' Daño. ':''}}
                                                        {{$denuncia->vehiculo->siniestro_robo ? ' Robo. ':''}}
                                                        {{$denuncia->vehiculo->siniestro_incendio ? ' Incendio. ':''}}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Detalles: {{ $denuncia->vehiculo ? $denuncia->vehiculo->detalles : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Detalles del siniestro
                                            <a href="{{ route('asegurados-denuncias-paso10.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <p>Comisaria: {{ $denuncia->denuncia_policial_comisaria }}</p>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <p>Acta: {{ $denuncia->denuncia_policial_acta }} </p>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <p>Folio: {{ $denuncia->denuncia_policial_folio }}</p>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <p>Sumario: {{ $denuncia->denuncia_policial_sumario }}</p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Juzgado: {{ $denuncia->denuncia_policial_juzgado }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Secretaria: {{ $denuncia->denuncia_policial_secretaria }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Descripcion: {{ $denuncia->croquis_descripcion }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>Grafico: </p>
                                            </div>
                                            <div class="col-12 pb-3">
                                                <img class="w-100" id="graficoBD"
                                                     src="{{ $denuncia->croquis_url }}"
                                                     alt="">
                                            </div>
                                            <div class="col-12">
                                                <p>Descripción: {{ $denuncia->croquis_descripcion }}</p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Datos del Accidente
                                            <a href="{{ route('asegurados-denuncias-paso9.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>
                                                    Tipo de accidente:
                                                    {{ $denuncia->tipo_accidente_frontal ? 'Frontal. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_posterior ? 'Posterior. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_cadena ? 'En cadena. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_lateral ? 'Lateral. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_vuelco ? 'Vuelco. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_desplaza ? 'Desplaza. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_incendio ? 'Incendio. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_inmersion ? 'Inmersión. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_explosion ? 'Explosión. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_carga ? 'Daños a la carga. ' : '' }}
                                                    {{ $denuncia->tipo_accidente_otros ? 'Otros. ' : '' }}
                                                </p>
                                            </div>
                                            <div class="col-12">
                                                <p>
                                                    Lugar:
                                                    {{ $denuncia->lugar_autopista ? 'En autopista. ' : '' }}
                                                    {{ $denuncia->lugar_calle ? 'En calle. ' : '' }}
                                                    {{ $denuncia->lugar_avenida ? 'En avenida. ' : '' }}
                                                    {{ $denuncia->lugar_curva ? 'En curva. ' : '' }}
                                                    {{ $denuncia->lugar_pendiente ? 'En pendiente. ' : '' }}
                                                    {{ $denuncia->lugar_tunel ? 'En túnel. ' : '' }}
                                                    {{ $denuncia->lugar_puente ? 'Sobre puente. ' : '' }}
                                                    {{ $denuncia->lugar_otros ? 'Otros. ' : '' }}
                                                </p>
                                            </div>
                                            <div class="col-12">
                                                <p>
                                                    Colisión con:
                                                    {{ $denuncia->colision_peaton ? 'Peatón. ' : '' }}
                                                    {{ $denuncia->colision_vehiculo ? 'Vehículo. ' : '' }}
                                                    {{ $denuncia->colision_edificio ? 'Edificio. ' : '' }}
                                                    {{ $denuncia->colision_columna ? 'Columna. ' : '' }}
                                                    {{ $denuncia->colision_animal ? 'Animal. ' : '' }}
                                                    {{ $denuncia->colision_transporte_publico ? 'Transporte público. ' : '' }}
                                                    {{ $denuncia->colision_otros ? 'Otros. ' : '' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Documentos de la denuncia
                                            <a href="{{ route('asegurados-denuncias-paso11.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row">

                                            <div class="text-center col-12 col-md-4 ">
                                                <p class="documentos-denuncia-title">DNI Titular del Asegurado </p>
                                                <div>
                                                    @if(count($denuncia->documentosDenuncia) > 0)
                                                        @foreach($denuncia->documentosDenuncia()->where('type', 'dni')->get() as $archivo)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>
                                                                        <a target="_blank"
                                                                           class="text-info pt-2"
                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-center col-12 col-md-4 ">
                                                <p class="documentos-denuncia-title">Cédula verde o título </p>
                                                <div>
                                                    @if(count($denuncia->documentosDenuncia) > 0)
                                                        @foreach($denuncia->documentosDenuncia()->where('type', 'cedula')->get() as $archivo)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>
                                                                        <a target="_blank"
                                                                           class="text-info pt-2"
                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-center col-12 col-md-4 ">
                                                <p class="documentos-denuncia-title">Carnet de conducir </p>
                                                <div>
                                                    @if(count($denuncia->documentosDenuncia) > 0)
                                                        {{-- TIPO 1 = DNI --}}
                                                        @foreach($denuncia->documentosDenuncia()->where('type', 'carnet')->get() as $archivo)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>
                                                                        <a target="_blank"
                                                                           class="documento-text-info pt-2"
                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </button>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <div class="row">
                                            <div class="text-center col-12 col-md-12 ">
                                                <p class="documentos-denuncia-title">Fotos vehículo Asegurado </p>
                                                <div>
                                                    @if(count($denuncia->documentosDenuncia) > 0)
                                                        {{-- TIPO 1 = DNI --}}
                                                        @foreach($denuncia->documentosDenuncia()->where('type', 'vehiculo')->get() as $archivo)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>
                                                                        <a target="_blank"
                                                                           class="text-info pt-2"
                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="text-center col-12 col-md-4 ">
                                                <p class="documentos-denuncia-title">Último recibo del seguro</p>
                                                <div>
                                                    @if(count($denuncia->documentosDenuncia) > 0)
                                                        @foreach($denuncia->documentosDenuncia()->where('type', 'recibo')->get() as $archivo)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>
                                                                        <a target="_blank"
                                                                           class="text-info pt-2"
                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                        </button>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-center col-12 col-md-4 ">
                                                <p class="documentos-denuncia-title">Exposición policial o denuncia de
                                                    Tránsito</p>
                                                <div>
                                                    @if(count($denuncia->documentosDenuncia) > 0)
                                                        @foreach($denuncia->documentosDenuncia()->where('type', 'exposicion_policial')->get() as $archivo)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>
                                                                        <a target="_blank"
                                                                           class="text-info pt-2"
                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-center col-12 col-md-4 ">
                                                <p class="documentos-denuncia-title">Habilitación municipal</p>
                                                <div>
                                                    @if(count($denuncia->documentosDenuncia) > 0)
                                                        @foreach($denuncia->documentosDenuncia()->where('type', 'habilitacion')->get() as $archivo)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p>
                                                                        <a target="_blank"
                                                                           class="text-info pt-2"
                                                                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Detalles de los otros vehiculos
                                            <a href="{{ route('asegurados-denuncias-paso6.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <p>
                                                    Intervino otro/s vehículo:
                                                    {{ $denuncia->intervino_otro_vehiculo !== null ? ($denuncia->intervino_otro_vehiculo ? 'Si' : 'No') : ''}}
                                                </p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Tiene los datos:
                                                    {{ $denuncia->intervino_otro_vehiculo_datos !== null ? ($denuncia->intervino_otro_vehiculo_datos ? 'Si' : 'No') : ''}}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <p>
                                                    Intervino otro/s vehículo:
                                                    {{ $denuncia->intervino_otro_vehiculo !== null ? ($denuncia->intervino_otro_vehiculo ? 'Si' : 'No') : ''}}
                                                </p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Tiene los datos:
                                                    {{ $denuncia->intervino_otro_vehiculo_datos !== null ? ($denuncia->intervino_otro_vehiculo_datos ? 'Si' : 'No') : ''}}
                                                </p>
                                            </div>
                                        </div>

                                        @foreach($denuncia->vehiculoTerceros as $tercero)

                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <p><b>Datos del Propietario</b></p>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <p>Nombre y Apellido: {{ $tercero->propietario_nombre }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Teléfono: {{ $tercero->propietario_telefono }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Tipo de Documento: {{ $tercero->tipoDocumentoPropietario->nombre }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>N° de Documento: {{ $tercero->propietario_documento_numero }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>CP: {{ $tercero->propietario_codigo_postal }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <p>Domicilio: {{ $tercero->propietario_domicilio }}</p>
                                                </div>

                                                <div class="col-12">
                                                    <p><b>Datos del Vehículo</b></p>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p>Marca: {{ $tercero->marca ? $tercero->marca->nombre : $tercero->otra_marca }}</p>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p>Modelo: {{ $tercero->marca ? $tercero->marca->nombre : $tercero->otra_marca }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Tipo: {{ $tercero->tipo }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Año: {{ $tercero->anio }}</p>

                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Dominio: {{ $tercero->dominio }}</p>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p>Número de Motor: {{ $tercero->motor }}</p>

                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p>Número de Chasis: {{ $tercero->chasis }}</p>
                                                </div>


                                                <div class="col-12">
                                                    <p>Uso:
                                                        {{ $tercero->uso_particular ? 'Particular. ' : '' }}
                                                        {{ $tercero->uso_comercial ? 'Comercial. ' : '' }}
                                                        {{ $tercero->uso_taxi_remis ? 'Taxi. ' : '' }}
                                                        {{ $tercero->uso_tpp ? 'Transporte Publico. ' : '' }}
                                                        {{ $tercero->uso_urgencia ? 'Transporte de Urgencia. ' : '' }}
                                                        {{ $tercero->uso_seguridad ? 'Transporte de Seguridad. ' : '' }}
                                                    </p>
                                                </div>


                                                <div class="col-12">
                                                    <p>Detalle de los daños: {{ $tercero->detalles }}</p>
                                                </div>

                                                <div class="col-12">
                                                    <p><b>Datos del Conductor</b></p>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <p>Nombre y Apellido: {{ $tercero->conductor_nombre }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Teléfono: {{ $tercero->conductor_telefono }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Tipo de
                                                        Documento: {{ $tercero->tipoDocumentoPropietario->nombre }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>N° de Documento: {{ $tercero->conductor_documento_numero }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>CP: {{ $tercero->conductor_codigo_postal }}</p>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <p>Domicilio: {{ $tercero->conductor_domicilio }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>N° de Reg. de Conducir: {{ $tercero->conductor_registro }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Tipo de Carnet: {{ $tercero->tipoCarnetConductor->nombre }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Categoría Carnet: {{ $tercero->conductor_categoria }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>
                                                        Vencimiento: {{ $tercero->conductor_vencimiento ? $tercero->conductor_vencimiento->format('d/m/Y') : '' }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>
                                                        Alcoholemía: {{ $tercero->conductor_alcoholemia ? 'Si' : 'No' }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Se
                                                        Negó: {{ $tercero->conductor_alcoholemia_se_nego ? 'Si' : 'No' }}</p>

                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Conductor
                                                        habitual: {{ $tercero->conductor_habitual ? 'Si' : 'No' }}</p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Daños materiales
                                            <a href="{{ route('asegurados-denuncias-paso7.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>
                                                    Hubo daños materiales:
                                                    {{ $denuncia->hubo_danios_materiales !== null ? ($denuncia->hubo_danios_materiales ? 'Si' : 'No') : ''}}
                                                </p>
                                            </div>
                                        </div>

                                        @foreach($denuncia->danioMateriales as $danio)
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <p>Detalle de los daños: {{ $danio->detalles }}</p>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p>Nombre y Apellido del Propietario: {{ $danio->propietario_nombre }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Tipo de Documento: {{ $danio->tipoDocumento->nombre }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>N° de Documento: {{ $danio->propietario_documento_numero }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>CP: {{ $danio->propietario_codigo_postal }}</p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p>Domicilio: {{ $danio->propietario_domicilio }}</p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Lesionados
                                            <a href="{{ route('asegurados-denuncias-paso8.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p>
                                                    Hubo personas lesionadas:
                                                    {{ $denuncia->hubo_lesionados !== null ? ($denuncia->hubo_lesionados ? 'Si' : 'No') : ''}}
                                                </p>
                                            </div>
                                        </div>

                                        @foreach($denuncia->lesionados as $lesionado)
                                            <hr>
                                            <div class="row">
                                                    <div class="col-12 col-md-8">
                                                        <p>Nombre y Apellido: {{ $lesionado->nombre }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Teléfono: {{ $lesionado->telefono }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Tipo de Documento: {{ $lesionado->tipoDocumento->nombre }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>N° de Documento: {{ $lesionado->documento_numero }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>CP: {{ $lesionado->codigo_postal }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p>Domicilio: {{ $lesionado->domicilio }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Estado Civil: {{ $lesionado->estado_civil }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Fecha de Nacimiento: {{ $lesionado->fecha_nacimiento ? $lesionado->fecha_nacimiento->format('d/m/Y') : '' }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Relación con el asegurado: {{ $lesionado->relacion }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p>Tipo:
                                                        @switch($lesionado->tipo)
                                                            @case('conductor')
                                                                Conductor del vehículo
                                                                @break
                                                            @case('pasajero_otro_vehiculo')
                                                                Pasajero de otro vehículo
                                                                @break
                                                            @case('pasajero_vehiculo_asegurado')
                                                                Pasajero de vehículo asegurado
                                                                @break
                                                            @case('peaton')
                                                                Peatón
                                                                @break
                                                        @endswitch
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p>Gravedad de Lesiones: {{ $lesionado->gravedad_lesion }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Examen de alcoholemia: {{ $lesionado->alcoholemia ? 'Si' : 'No' }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <p>Se negó: {{ $lesionado->alcoholemia_se_nego ? 'Si' : 'No' }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p>Centro Asistencial: {{ $lesionado->centro_asistencial }}</p>
                                                    </div>
                                            </div>
                                        @endforeach

                                        <div class="alert alert-secondary mt-3 " role="alert">
                                            Datos del denunciante
                                            <a href="{{ route('asegurados-denuncias-paso12.create',['id' => $denuncia->identificador]) }}"
                                               class="badge badge-secondary float-right"><i
                                                    class="fa-solid fa-pen-to-square"></i>
                                                Editar</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <p>Nombre y
                                                    Apellido: {{ $denuncia->denunciante ? $denuncia->denunciante->nombre : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Teléfono: {{ $denuncia->denunciante ? $denuncia->denunciante->telefono : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-8">
                                                <p>
                                                    Domicilio: {{ $denuncia->denunciante ? $denuncia->denunciante->domicilio : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Código
                                                    Postal: {{ $denuncia->denunciante ? $denuncia->denunciante->codigo_postal : '' }}</p>
                                            </div>
                                        </div>


                                        <div class="row">
                                            @if($denuncia->denunciante)
                                                @if($denuncia->denunciante->pais && $denuncia->denunciante->provincia)
                                                    <div class="col-12 col-md-4">
                                                        <p>País: {{ $denuncia->denunciante->pais->nombre }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Provincia: {{ $denuncia->denunciante->provincia->name }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p>Localidad: {{ $denuncia->denunciante->localidad ? $denuncia->denunciante->localidad->name : $denuncia->denunciante->otro_pais_provincia_localidad }}</p>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <p>Localidad/Provincia/Pais: {{ $denuncia->denunciante->otro_pais_provincia_localidad }}</p>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="col-12 col-md-4"><p>País:</p></div>
                                                <div class="col-12 col-md-4"><p>Provincia: </p></div>
                                                <div class="col-12 col-md-4"><p>Localidad: </p></div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <p>Tipo de
                                                    Documento: {{$denuncia->denunciante ? $denuncia->denunciante->tipoDocumento->nombre : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>Nro. de
                                                    Documentos: {{ $denuncia->denunciante ? $denuncia->denunciante->documento_numero : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="row pt-0">
                                            <div class="col-12 col-md-4">
                                                <p>Es el
                                                    asegurado: {{ $denuncia->denunciante ? ($denuncia->denunciante->asegurado ? 'Si' : 'No' ) : '' }}</p>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <p>
                                                    Relación: {{ $denuncia->denunciante ? $denuncia->denunciante->asegurado_relacion : '' }}</p>
                                            </div>
                                        </div>

                                        <div class="card my-3">
                                            <div class="card-header alert-secondary">
                                                Certificado de Cobertura:
                                                @if($denuncia->certificado_cobertura_path)
                                                    <a class="text-info" href="{{ $denuncia->certificado_cobertura_url }}"
                                                       title="Ver Certificado de Cobertura" target="_blank"
                                                    >{{ $denuncia->certificado_cobertura_name }}</a>
                                                @else
                                                    Ninguno
                                                @endif
                                                <a class="badge badge-secondary float-right"
                                                   data-toggle="collapse" href="#collapseCertificadoCobertura" role="button" aria-expanded="false" aria-controls="collapseCertificadoCobertura">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    {{ $denuncia->certificado_cobertura_path ? 'Modificar' : 'Agregar' }}
                                                </a>
                                            </div>
                                            <div class="collapse" id="collapseCertificadoCobertura">
                                                <div class="card-body">

                                                    <form action="{{ route('panel-siniestros.denuncia.update-certificado-poliza', $denuncia->id) }}"
                                                          method="post" id="formCartificadoCobertura" enctype="multipart/form-data"
                                                    >
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="certificado_cobertura">Agregar archivo</label>
                                                            <input type="file" class="form-control-file"
                                                                   name="certificado_cobertura"
                                                                   accept="application/pdf"
                                                                   required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ $denuncia->certificado_cobertura_path ? 'Modificar' : 'Agregar' }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @if($denuncia->documentosDenuncia()->where('type', 'baja_unidad')->count() > 0)
                                            <div class="alert alert-secondary mt-3 " role="alert">
                                                Baja de Unidad
                                            </div>
                                            @foreach($denuncia->documentosDenuncia()->where('type', 'baja_unidad')->get() as $archivo)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>
                                                            <a target="_blank" class="text-info pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                                        </p>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

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

                                        <form action="{{ route('panel-siniestros.denuncia.observaciones.store',['denuncia' => $denuncia]) }}" method="post" class="w-100">
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
