<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siniestros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<main class="container-fluid">
    <div class="row">
        <div class="col-4">
            <!--<img class="w-100" src="{{ asset('images/finisterre logo 5.svg') }}">-->
        </div>
        <div class="col-8 text-center mt-auto">
            <h1>SECCCIÓN AUTOMOTORES</h1>
            <H3>FORMULARIO DE DENUNCIA DE SINIESTRO - ASEGURADO</H3>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-6">
            <h5>Fecha del
                Siniestro: {{ \Carbon\Carbon::createFromFormat('Y-m-d',$denuncia->fecha)->format('d/m/Y') }}</h5>
        </div>
        <div class="col-6">
            <h5>Hora del Siniestro: {{\Carbon\Carbon::createFromFormat('H:i:s',$denuncia->hora)->format('H:i') }}
                HS</h5>
        </div>
        <div class="col-12">
            <span class="fw-semibold">Momento del día: </span>{{ $denuncia->momento_dia }}
        </div>
        <div class="col-12">
            <span class="fw-semibold">Estado del tiempo: </span>
            {{ $denuncia->estado_tiempo_seco ? 'Seco. ' : '' }}
            {{ $denuncia->estado_tiempo_lluvia ? 'Lluvia. ' : '' }}
            {{ $denuncia->estado_tiempo_niebla ? 'Niebla. ' : '' }}
            {{ $denuncia->estado_tiempo_despejado ? 'Despejado. ' : '' }}
            {{ $denuncia->estado_tiempo_nieve ? 'Nieve. ' : '' }}
            {{ $denuncia->estado_tiempo_granizo ? 'Granizo. ' : '' }}
            {{ $denuncia->estado_tiempo_otros_detalles }}
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header fw-bold">Lugar del Siniestro</div>
        <div class="card-body container-fluid">
            <div class="row">
                <div class="col-12"><span class="fw-semibold">Lugar: </span>{{ $denuncia->lugar_nombre }}</div>
            </div>
            <div class="row">
                <div class="col-4"><span class="fw-semibold">País: </span>Argentina</div>
                <div class="col-4"><span class="fw-semibold">Provincia: </span>{{ $denuncia->provincia->name }}</div>
                <div class="col-4"><span class="fw-semibold">Localidad: </span>{{ $denuncia->localidad->name }}</div>
            </div>
            <div class="row">
                <div class="col-4"><span class="fw-semibold">Calle: </span>{{ $denuncia->calle }}</div>
                <div class="col-4"><span
                        class="fw-semibold">Tipo de Calzada: </span>{{ $denuncia->tipoCalzada->nombre }}</div>
                <div class="col-4"><span
                        class="fw-semibold">Detalle de la Calzada: </span>{{ $denuncia->calzada_detalle }}</div>
            </div>
            <div class="row">
                <div class="col-12"><span class="fw-semibold">Insersección: </span>{{ $denuncia->interseccion }}</div>
            </div>
            <div class="row">
                <div class="col-4"><span
                        class="fw-semibold">Cruce Señalizado: </span>{{ $denuncia->cruce_senalizado ? 'Si' : 'No' }}
                </div>
                <div class="col-4"><span
                        class="fw-semibold">Tren barrera señalizado: </span>{{ $denuncia->tren ? 'Si' : 'No' }}</div>
            </div>
            <div class="row">
                <div class="col-3"><span class="fw-semibold">Semaforo: </span>{{ $denuncia->semaforo ? 'Si' : 'No' }}
                </div>
                <div class="col-3"><span
                        class="fw-semibold">Funciona: </span>{{ $denuncia->semaforo_funciona ? 'Si' : 'No' }}</div>
                <div class="col-3"><span
                        class="fw-semibold">Intermitente: </span>{{ $denuncia->semaforo_intermitente ? 'Si' : 'No' }}
                </div>
                <div class="col-3"><span class="fw-semibold">Color: </span>{{ $denuncia->semaforo_color }}</div>
            </div>
        </div>
    </div>


    {{--
    <div class="col-12 pt-5">
        <div class="container">
            <div style="padding-left:8px;padding-right:8px;" class="pt-4">
                <div style="background: white;padding-left: 12px;">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <p class="pt-3">Notificación <b>{{$denuncia->id}}</b></p>
                        </div>
                        <div class="col-12 col-md-4">
                            <p class="pt-3" style="color:red;">Estado Actual: <b>{{$denuncia->state}}</b></p>
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12 col-md-4">
                        <p>Fecha del Siniestro: {{$denuncia->fecha_siniestro}}</p>
                    </div>
                    <div class="col-12 col-md-4">
                    </div>
                    <div class="col-12 col-md-4">
                        <p>Hora del Siniestro: {{$denuncia->hora_siniestro}}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-12">
                        <p>Estado del
                            Tiempo: {{$denuncia->carga_paso_1_diurno == 'on' ? ' Diurno. ':''}} {{$denuncia->carga_paso_1_nocturno == 'on' ? ' Nocturno. ':''}} {{$denuncia->carga_paso_1_seco == 'on' ? ' Seco. ':''}} {{$denuncia->carga_paso_1_lluvia == 'on' ? ' Lluvia. ':''}} {{$denuncia->carga_paso_1_niebla == 'on' ? ' Niebla. ':''}} {{$denuncia->carga_paso_1_despejado == 'on' ? ' Despejado. ':''}} {{$denuncia->carga_paso_1_nieve == 'on' ? ' Nieve. ':''}} {{$denuncia->carga_paso_1_granizo == 'on' ? ' Granizo. ':''}} {{$denuncia->carga_paso_1_otros == 'on' ? ' Otros. ':''}} {{$denuncia->carga_paso_1_otros_detalle}}</p>
                    </div>
                </div>

            </div>

            <p class="pt-3 panel-operaciones-subtitle"
               style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Lugar del
                Siniestro </p>

            <div style="padding-left:8px;padding-right:8px;">
                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>País: Argentina</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <p>
                            Provincia: {{ $denuncia->lugar ? \App\Models\Province::where('id',$denuncia->lugar->carga_paso_2_provincia_id)->first()->name : '' }}</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <p>
                            Localidad: {{ $denuncia->lugar ? \App\Models\City::where('id',$denuncia->lugar->carga_paso_2_localidad_id)->first()->name : '' }}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Calle/Ruta: {{ $denuncia->lugar ? $denuncia->lugar->carga_paso_2_calle : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Tipo
                            Calzada: {{ $denuncia->lugar ? \App\Models\TipoCalzada::where('id',$denuncia->lugar->carga_paso_2_calzada_id)->first()->nombre : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Detalle
                            Calzada: {{ $denuncia->lugar ? $denuncia->lugar->carga_paso_2_calzada_detalle : '' }}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-8">
                        <p>
                            Intersección: {{ $denuncia->lugar ? $denuncia->lugar->carga_paso_2_interseccion : '' }}</p>
                    </div>
                </div>
            </div>

            <p class="pt-3 panel-operaciones-subtitle"
               style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Datos del
                conductor del vehiculo asegurado </p>

            <div style="padding-left:8px;padding-right:8px;">
                <div class="row pt-0">
                    <div class="col-12 col-md-8">
                        <p>Nombre y
                            Apellido: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_nombre : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>
                            Teléfono: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_telefono : '' }}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-8">
                        <p>
                            Domicilio: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_domicilio : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Código
                            Postal: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_codigo_postal : '' }}</p>
                    </div>
                </div>


                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>País: Argentina</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>
                            Provincia: {{ $denuncia->conductor ? $denuncia->conductor->provincia->name : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>
                            Localidad: {{ $denuncia->conductor ? $denuncia->conductor->localidad->name : '' }}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Fecha de
                            Nacimiento: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_fecha_nacimiento : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Documento
                            Tipo: {{ $denuncia->conductor ? $denuncia->conductor->tipoDocumento->nombre : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Documento
                            Número: {{ $denuncia->conductor ? $denuncia->conductor->documento_numero : '' }}</p>
                    </div>
                </div>


                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>
                            Ocupación: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_ocupacion : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>N de
                            Registro: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_numero_registro : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Estado
                            Civil: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_estado_civil : '' }}</p>
                    </div>

                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Licencia Tipo: Nacional</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Licencia
                            Categoria: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_carnet_categoria : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Licencia
                            Vencimiento: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_carnet_vencimiento : '' }}</p>
                    </div>
                </div>
            </div>


            <p class="pt-3 panel-operaciones-subtitle"
               style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Datos del
                asegurado </p>

            <div style="padding-left:8px;padding-right:8px;">
                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Nombre y Apellido: {{ $denuncia->asegurado ? $denuncia->asegurado->nombre : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Tipo
                            Documento: {{ $denuncia->asegurado ? $denuncia->asegurado->tipoDocumento->nombre : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Número
                            Documento: {{ $denuncia->asegurado ? $denuncia->asegurado->documento_numero : '' }}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-8">
                        <p>Domicilio: {{ $denuncia->asegurado ? $denuncia->asegurado->domicilio : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Código Postal: {{ $denuncia->asegurado ? $denuncia->asegurado->codigo_postal : '' }}</p>
                    </div>
                </div>


                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>País: Argentina</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>
                            Provincia: {{ $denuncia->asegurado ? $denuncia->asegurado->provincia->name : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>
                            Localidad: {{ $denuncia->asegurado ? $denuncia->asegurado->localidad->name : '' }}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Ocupación: {{ $denuncia->asegurado ? $denuncia->asegurado->ocupacion : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Teléfono: {{ $denuncia->asegurado ? $denuncia->asegurado->telefono : '' }}</p>
                    </div>
                </div>
            </div>


            <p class="pt-3 panel-operaciones-subtitle"
               style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Datos del
                vehiculo asegurado </p>

            <div style="padding-left:8px;padding-right:8px;">
                <div class="row pt-0">
                    <div class="col-12 col-md-3">
                        <p>
                            Marca: {{ $denuncia->vehiculo ? ($denuncia->vehiculo->marca ? $denuncia->vehiculo->marca->nombre : $denuncia->vehiculo->otra_marca) : '' }}</p>
                    </div>

                    <div class="col-12 col-md-3">
                        <p>
                            Modelo: {{ $denuncia->vehiculo ? ($denuncia->vehiculo->modelo ? $denuncia->vehiculo->modelo->nombre : $denuncia->vehiculo->otro_modelo )  : '' }}</p>
                    </div>

                    <div class="col-12 col-md-3">
                        <p>Tipo: {{ $denuncia->vehiculo ? $denuncia->vehiculo->tipo : '' }}</p>
                    </div>

                    <div class="col-12 col-md-3">
                        <p>Año: {{ $denuncia->vehiculo ? $denuncia->vehiculo->anio : '' }}</p>
                    </div>

                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Dominio: {{ $denuncia->vehiculo ? $denuncia->vehiculo->dominio : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Motor: {{ $denuncia->vehiculo ? $denuncia->vehiculo->motor : '' }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Chasis: {{$denuncia->vehiculo ? $denuncia->vehiculo->chasis : '' }}</p>
                    </div>
                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-6">
                        <p>
                            Uso:
                            @if($denuncia->vehiculo)
                                {{$denuncia->vehiculo->particular ? ' Particular. ':''}}
                                {{$denuncia->vehiculo->comercial ? ' Comercial. ':''}}
                                {{$denuncia->vehiculo->taxi ? ' Taxi. ':''}}
                                {{$denuncia->vehiculo->tp ? ' Transporte Publico. ':''}}
                                {{$denuncia->vehiculo->urgencia ? ' Transporte de Urgencia. ':''}}
                                {{$denuncia->vehiculo->seguridad ? ' Transporte de Seguridad. ':''}}</p>
                        @endif
                    </div>

                    <div class="col-12 col-md-6">
                        <p>Tipo
                            Siniestro:
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
                            Detalles: {{ $denuncia->vehiculo ? $denuncia->vehiculo->carga_paso_5_vehiculo_detalles : '' }}</p>
                    </div>
                </div>
            </div>

            <p class="pt-3 panel-operaciones-subtitle"
               style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Detalles del
                siniestro </p>

            <div style="padding-left:8px;padding-right:8px;">
                <div class="row pt-0">
                    <div class="col-12 col-md-3">
                        <p>Comisaria: {{ $denuncia->denuncia_policial_comisaria }}</p>
                    </div>

                    <div class="col-12 col-md-3">
                        <p>Acta: {{ $denuncia->denuncia_policial_acta }}</p>
                    </div>

                    <div class="col-12 col-md-3">
                        <p>Folio: {{ $denuncia->denuncia_policial_folio }}</p>
                    </div>

                    <div class="col-12 col-md-3">
                        <p>Sumario: {{ $denuncia->denuncia_policial_sumario }}</p>
                    </div>

                </div>

                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Juzgado: {{ $denuncia->denuncia_policial_juzgado }}</p>
                    </div>

                    <div class="col-12 col-md-4">
                        <p>Secretaria: {{ $denuncia->denuncia_policial_secretarias }}</p>
                    </div>
                </div>


                <div class="row pt-0">
                    <div class="col-12 col-md-4">
                        <p>Grafico: </p>
                    </div>
                    <div class="col-12 col-md-12 p-5">
                        <img class="w-100" id="graficoBD"
                             src="{{ $denuncia->croquis_descripcion }}" alt="">
                    </div>


                </div>


                <p class="pt-3 panel-operaciones-subtitle"
                   style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Documentos de
                    la denuncia</p>

                <div style="padding-left:8px;padding-right:8px;">
                    <div class="form-group row ">

                        <div class="text-center col-12 col-md-4 ">
                            <p class="documentos-denuncia-title">*DNI Titular del Asegurado </p>
                            <p class="ambos-lados">(Foto de ambos lados)</p>
                            <div>
                                @if(count($denuncia->documentosDenuncia) > 0)
                                    @foreach($denuncia->documentosDenuncia()->where('type', 1)->get() as $archivo)
                                        <div class="row">
                                            <div class="col-6 col-md-6 pt-2">
                                                <img style="width:100% !important; margin-top: 10px !important;"
                                                     src="{{$archivo->url}}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @error('fotos') <span class="pl-2 text-danger">{{ $message }}</span> @enderror


                        </div>

                        <div class="text-center col-12 col-md-4 ">
                            <p class="documentos-denuncia-title">*Cédula verde o título </p>
                            <p class="ambos-lados">(Foto de ambos lados)</p>
                            <div>
                                @if(count($denuncia->documentosDenuncia) > 0)
                                    @foreach($denuncia->documentosDenuncia()->where('type', 2)->get() as $archivo)
                                        <div class="row">
                                            <div class="col-6 col-md-6 pt-2">
                                                <img style="width:100% !important; margin-top: 10px !important;"
                                                     src="{{$archivo->url}}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                        </div>

                        <div class="text-center col-12 col-md-4 ">
                            <p class="documentos-denuncia-title">*Carnet de conducir </p>
                            <p class="ambos-lados">(Foto de ambos lados)</p>
                            <div>
                                @if(count($denuncia->documentosDenuncia) > 0)
                                    @foreach($denuncia->documentosDenuncia()->where('type', 3)->get() as $archivo)
                                        <div class="row">
                                            <div class="col-6 col-md-6 pt-2">
                                                <img style="width:100% !important; margin-top: 10px !important;"
                                                     src="{{$archivo->url}}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                        </div>


                    </div>
                    --}}
    {{--

                        <div class="form-group row">

                          <div class="col-12 col-md-12 pt-0" >
                            <hr style="border:1px solid lightgray;">
                          </div>


                              <div class="text-center col-12 col-md-12 ">
                                <p class="documentos-denuncia-title">*Fotos vehículo Asegurado </p>
                            <p class="ambos-lados">Obligatorio 4 fotos:1 de cada lateral, adelante, atrás: donde se vean los daños y al menos uno con patente visible y completa.</p>


                                <div>
                                  @if(count($denuncia->documentosDenuncia) > 0)
                                      @foreach($denuncia->documentosDenuncia()->where('type', 4)->get() as $archivo)
                                    <div class="row">
                                      <div class="col-12">
                                      <p>
                                        <a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

                                        @if($denuncia->documentosDenuncia()->where('type', 4)->count() > 1)
                                         <button
                                                  style="border:none;background: none;" id="confirmacion-popupa" ><i class="fas fa-trash-alt"></i>
                                          </button>
                                                @endif
                                      </p>

                                      </div>
                                    </div>
                                  @endforeach
                                  @endif
                                </div>

                            <p>@error('vehiculo') <span class="text-danger">{{ $message }}</span> @enderror</p>

                              </div>
                        </div>


                        <div class="form-group row ">
                          <div class="col-12 col-md-12 pt-0" >
                            <hr style="border:1px solid lightgray;">
                          </div>
                          <div class="text-center col-12 col-md-4 ">
                            <p class="documentos-denuncia-title">Último recibo del seguro </p>
                            <p class="ambos-lados">Pagado</p>



                            <div>
                              @if(count($denuncia->documentosDenuncia) > 0)
                                  @foreach($denuncia->documentosDenuncia()->where('type', 5)->get() as $archivo)
                                    <div class="row">
                                      <div class="col-12">
                                      <p>
                                        <a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

                                        @if($denuncia->documentosDenuncia()->where('type', 5)->count() > 1)
                                         <button
                                          style="border:none;background: none;" id="confirmacion-popupa" ><i class="fas fa-trash-alt"></i>
                                         </button>
                                        @endif
                                      </p>

                                      </div>
                                    </div>
                                  @endforeach
                              @endif
                            </div>
                            @error('recibo') <span class="pl-2 text-danger">{{ $message }}</span> @enderror


                          </div>

                          <div class="text-center col-12 col-md-4 ">
                            <p class="documentos-denuncia-title">Exposición policial</p>
                            <p class="ambos-lados">o denuncia de Tránsito</p>

                            <div>
                              @if(count($denuncia->documentosDenuncia) > 0)
                                  @foreach($denuncia->documentosDenuncia()->where('type', 6)->get() as $archivo)
                                    <div class="row">
                                      <div class="col-12">
                                      <p>
                                        <a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

                                        @if($denuncia->documentosDenuncia()->where('type', 6)->count() > 1)
                                         <button
                                          style="border:none;background: none;" id="confirmacion-popupa"><i class="fas fa-trash-alt"></i>
                                         </button>
                                        @endif
                                      </p>

                                      </div>
                                    </div>
                                  @endforeach
                              @endif
                            </div>

                            <p>@error('policial') <span class="text-danger">{{ $message }}</span> @enderror</p>

                          </div>

                          <div class="text-center col-12 col-md-4 ">
                            <p class="documentos-denuncia-title">Habilitación municipal </p>
                            <p class="ambos-lados">(Sólo taxis y remises)</p>


                            <div>
                              @if(count($denuncia->documentosDenuncia) > 0)
                                  @foreach($denuncia->documentosDenuncia()->where('type', 7)->get() as $archivo)
                                    <div class="row">
                                      <div class="col-12">
                                      <p>
                                        <a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

                                        @if($denuncia->documentosDenuncia()->where('type', 7)->count() > 1)
                                         <button
                                          style="border:none;background: none;" id="confirmacion-popupa"><i class="fas fa-trash-alt"></i>
                                         </button>
                                        @endif
                                      </p>

                                      </div>
                                    </div>
                                  @endforeach
                              @endif
                            </div>

                            <p>@error('habilitacion') <span class="text-danger">{{ $message }}</span> @enderror</p>

                          </div>




                        </div>
    --}}
    {{--
    <p class="pt-3 panel-operaciones-subtitle"
       style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Datos del
        denunciante </p>

    <div style="padding-left:8px;padding-right:8px;">
        <div class="row pt-0">
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


        <div class="row pt-0">
            <div class="col-12 col-md-4">
                <p>País: Argentina</p>
            </div>

            <div class="col-12 col-md-4">
                <p>
                    Provincia: {{ $denuncia->denunciante ? $denuncia->denunciante->provincia->name : '' }}</p>
            </div>

            <div class="col-12 col-md-4">
                <p>
                    Localidad: {{ $denuncia->denunciante ? $denuncia->denunciante->localidad->name : '' }}</p>
            </div>
        </div>

        <div class="row pt-0">

            <div class="col-12 col-md-4">
                <p>Documento
                    Tipo: {{ $denuncia->denunciante ? $denuncia->denunciante->tipoDocumento->nombre : '' }}</p>
            </div>

            <div class="col-12 col-md-4">
                <p>Documento
                    Número: {{ $denuncia->denunciante ? $denuncia->denunciante->documento_numero : '' }}</p>
            </div>
        </div>
    </div>
    --}}
    {{--
                        <p class="pt-3 panel-operaciones-subtitle" style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Observaciones </p>
                        @foreach($denuncia->observaciones as $observacion )
                        <p>{{$observacion->detalle}}</p>
                        @endforeach
    --}}
    <!--
                        <div class="row">
                            <div class="col-6 col-md-6 pt-2">
                                <img style="margin-top: 10px !important; height: 150px !important;"
                                     src="images/pdf_sello.png" alt="">
                            </div>
                        </div>-->
    {{--
                    <div class="row">
                        <div class="col-6 col-md-6 pt-2">
                            <p>Fecha y hora recibido: {{ date('d-m-Y H:i:s') }}</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>--}}
</main>
</body>
</html>

