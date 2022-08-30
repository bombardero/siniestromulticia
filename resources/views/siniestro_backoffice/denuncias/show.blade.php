@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 pt-5">
                    <div class="container">
                        <div style="padding-left:8px;padding-right:8px;" class="pt-4">

                            <div style="background: #C9C6D9;padding-left: 12px;">

                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <p class="pt-3">Notificación <b>{{$denuncia->id}}</b></p>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <p class="pt-3" style="color:red;">Estado Actual: <b>{{$denuncia->state}}</b>
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <img
                                            src="{{url('/images/siniestros/denuncia_asegurado/backoffice/aprobar.png')}}"
                                            style="position:absolute; right:170px;margin-top: 15px;">
                                        <img
                                            src="{{url('/images/siniestros/denuncia_asegurado/backoffice/rechazar.png')}}"
                                            style="position:absolute; right:130px;margin-top: 15px;">
                                        <a href="{{route('panel-siniestros.denuncia.pdf',$denuncia->id)}}">
                                            <img
                                                src="{{url('/images/siniestros/denuncia_asegurado/backoffice/bajarpdf.png')}}"
                                                style="position:absolute; right:90px;margin-top: 17px;">
                                        </a>
                                        <img
                                            src="{{url('/images/siniestros/denuncia_asegurado/backoffice/eliminar.png')}}"
                                            style="position:absolute; right:50px;margin-top: 17px;">
                                    </div>
                                </div>

                            </div>

                            <div class="row pt-4">
                                <div class="col-12 col-md-4">
                                    <p>Fecha del Siniestro: {{$denuncia->precarga_fecha_siniestro}}</p>
                                </div>
                                <div class="col-12 col-md-4">
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Hora del Siniestro: {{$denuncia->precarga_hora_siniestro}}</p>
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
                            Siniestro <img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                           style="position:absolute; right:50px;"></p>

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
                                        Localidad: {{ $denuncia->lugar ? \App\Models\City::where('id',$denuncia->lugar->carga_paso_2_localidad_id)->first()->name : ''}}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>Calle/Ruta: {{ $denuncia->lugar ? $denuncia->lugar->carga_paso_2_calle : ''}}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Tipo
                                        Calzada: {{ $denuncia->lugar ? \App\Models\TipoCalzada::where('id',$denuncia->lugar->carga_paso_2_calzada_id)->first()->nombre : ''}}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Detalle
                                        Calzada: {{ $denuncia->lugar ? $denuncia->lugar->carga_paso_2_calzada_detalle : ''}}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-8">
                                    <p>
                                        Intersección: {{ $denuncia->lugar ? $denuncia->lugar->carga_paso_2_interseccion : ''}}</p>
                                </div>
                            </div>
                        </div>

                        <p class="pt-3 panel-operaciones-subtitle"
                           style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Datos del
                            conductor del vehiculo asegurado <img
                                src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                style="position:absolute; right:50px;"></p>

                        <div style="padding-left:8px;padding-right:8px;">
                            <div class="row pt-0">
                                <div class="col-12 col-md-8">
                                    <p>Nombre y
                                        Apellido: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_nombre : ''}}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Teléfono: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_telefono : ''}}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-8">
                                    <p>
                                        Domicilio: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_domicilio : ''}}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Código
                                        Postal: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_codigo_postal : ''}}</p>
                                </div>
                            </div>


                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>País: Argentina</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Provincia: {{ $denuncia->conductor ? \App\Models\Province::where('id',$denuncia->conductor->carga_paso_3_provincia_id)->first()->name : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Localidad: {{ $denuncia->conductor ? \App\Models\City::where('id',$denuncia->conductor->carga_paso_3_localidad_id)->first()->name : '' }}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>Fecha de
                                        Nacimiento: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_fecha_nacimiento : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Documento
                                        Tipo: {{ $denuncia->conductor ? \App\Models\TipoDocumento::where('id',$denuncia->conductor->carga_paso_3_documento_id)->first()->nombre : ''}}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Documento
                                        Número: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_documento_numero : '' }}</p>
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
                                        Vencimiento: {{ $denuncia->conductor ? $denuncia->conductor->carga_paso_3_carnet_vencimiento : ''}}</p>
                                </div>
                            </div>
                        </div>


                        <p class="pt-3 panel-operaciones-subtitle"
                           style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Datos del
                            asegurado <img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                           style="position:absolute; right:50px;"></p>

                        <div style="padding-left:8px;padding-right:8px;">
                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>Nombre y
                                        Apellido: {{ $denuncia->asegurado ? $denuncia->asegurado->carga_paso_4_asegurado_nombre : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Tipo
                                        Documento: {{ $denuncia->asegurado ? \App\Models\TipoDocumento::where('id',$denuncia->asegurado->carga_paso_4_asegurado_documento_id)->first()->nombre : '' }} </p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Número
                                        Documento: {{ $denuncia->asegurado ? $denuncia->asegurado->carga_paso_4_asegurado_documento_numero : '' }}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-8">
                                    <p>
                                        Domicilio: {{ $denuncia->asegurado ? $denuncia->asegurado->carga_paso_4_asegurado_domicilio : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>Código
                                        Postal: {{ $denuncia->asegurado ? $denuncia->asegurado->carga_paso_4_asegurado_codigo_postal : '' }}</p>
                                </div>
                            </div>


                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>País: Argentina</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Provincia: {{ $denuncia->asegurado ? \App\Models\Province::where('id',$denuncia->asegurado->carga_paso_4_asegurado_provincia_id)->first()->name : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Localidad: {{ $denuncia->asegurado ? \App\Models\City::where('id',$denuncia->asegurado->carga_paso_4_asegurado_localidad_id)->first()->name : '' }}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>
                                        Ocupación: {{ $denuncia->asegurado ? $denuncia->asegurado->carga_paso_4_asegurado_ocupacion : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Teléfono: {{ $denuncia->asegurado ? $denuncia->asegurado->carga_paso_4_asegurado_telefono : '' }}</p>
                                </div>
                            </div>
                        </div>


                        <p class="pt-3 panel-operaciones-subtitle"
                           style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Datos del
                            vehiculo asegurado <img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                                    style="position:absolute; right:50px;"></p>

                        <div style="padding-left:8px;padding-right:8px;">
                            <div class="row pt-0">
                                <div class="col-12 col-md-3">
                                    <p>
                                        Marca: {{ $denuncia->vehiculo ? \App\Models\Marca::where('id',$denuncia->vehiculo->carga_paso_5_vehiculo_marca_id)->first()->nombre : '' }}</p>
                                </div>

                                <div class="col-12 col-md-3">
                                    <p>
                                        Modelo: {{ $denuncia->vehiculo ? \App\Models\Modelo::where('id',$denuncia->vehiculo->carga_paso_5_vehiculo_modelo_id)->first()->nombre : '' }}</p>
                                </div>

                                <div class="col-12 col-md-3">
                                    <p>
                                        Tipo: {{ $denuncia->vehiculo ? $denuncia->vehiculo->carga_paso_5_vehiculo_tipo : '' }}</p>
                                </div>

                                <div class="col-12 col-md-3">
                                    <p>
                                        Año: {{ $denuncia->vehiculo ? $denuncia->vehiculo->carga_paso_5_vehiculo_anio : '' }}</p>
                                </div>

                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>
                                        Dominio: {{ $denuncia->vehiculo ? $denuncia->vehiculo->carga_paso_5_vehiculo_dominio : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Motor: {{ $denuncia->vehiculo ? $denuncia->vehiculo->carga_paso_5_vehiculo_motor : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Chasis: {{ $denuncia->vehiculo ? $denuncia->vehiculo->carga_paso_5_vehiculo_chasis : '' }}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-6">
                                    <p>
                                        Uso:
                                        @if($denuncia->vehiculo)
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_particular == 'on' ? ' Particular. ':''}}
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_comercial == 'on' ? ' Comercial. ':''}}
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_taxi == 'on' ? ' Taxi. ':''}}
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_tp == 'on' ? ' Transporte Publico. ':''}}
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_urgencia == 'on' ? ' Transporte de Urgencia. ':''}}
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_seguridad == 'on' ? ' Transporte de Seguridad. ':''}}</p>
                                    @endif
                                </div>

                                <div class="col-12 col-md-6">
                                    <p>
                                        Tipo Siniestro:
                                        @if($denuncia->vehiculo)
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_siniestro_danio == 'on' ? ' Daño. ':''}}
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_siniestro_robo == 'on' ? ' Robo. ':''}}
                                            {{$denuncia->vehiculo->carga_paso_5_vehiculo_siniestro_incendio == 'on' ? ' Incendio. ':''}}
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
                           style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">Detalles
                            del siniestro <img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                               style="position:absolute; right:50px;"></p>

                        <div style="padding-left:8px;padding-right:8px;">
                            <div class="row pt-0">
                                <div class="col-12 col-md-3">
                                    <p>
                                        Comisaria: {{ $denuncia->detalleSiniestro ? $denuncia->detalleSiniestro->carga_paso_10_comisaria : '' }}</p>
                                </div>

                                <div class="col-12 col-md-3">
                                    <p>
                                        Acta: {{ $denuncia->detalleSiniestro ? $denuncia->detalleSIniestro->carga_paso_10_acta : '' }} </p>
                                </div>

                                <div class="col-12 col-md-3">
                                    <p>
                                        Folio: {{ $denuncia->detalleSiniestro ? $denuncia->detalleSiniestro->carga_paso_10_folio : '' }}</p>
                                </div>

                                <div class="col-12 col-md-3">
                                    <p>
                                        Sumario: {{ $denuncia->detalleSiniestro ? $denuncia->detalleSiniestro->carga_paso_10_sumario : '' }}</p>
                                </div>

                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>
                                        Juzgado: {{ $denuncia->detalleSiniestro ? $denuncia->detalleSiniestro->carga_paso_10_juzgado : ''}}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Secretaria: {{ $denuncia->detalleSiniestro ? $denuncia->detalleSiniestro->carga_paso_10_secretaria : '' }}</p>
                                </div>

                                <div class="col-12 col-md-4">
                                    <p>
                                        Descripcion: {{ $denuncia->detalleSiniestro ? $denuncia->detalleSiniestro->carga_paso_10_descripcion : '' }}</p>
                                </div>
                            </div>

                            <div class="row pt-0">
                                <div class="col-12 col-md-4">
                                    <p>Grafico: </p>
                                </div>
                                <div class="col-12 col-md-12 p-5">
                                    <img class="w-100" id="graficoBD"
                                         src="{{ $denuncia->detalleSiniestro ? $denuncia->detalleSiniestro->carga_paso_10_url_detalle : '' }}"
                                         alt="">
                                </div>
                            </div>


                            <p class="pt-3 panel-operaciones-subtitle"
                               style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">
                                Documentos de la denuncia<img
                                    src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                    style="position:absolute; right:50px;"></p>

                            <div style="padding-left:8px;padding-right:8px;">
                                <div class="form-group row ">

                                    <div class="text-center col-12 col-md-4 ">
                                        <p class="documentos-denuncia-title">*DNI Titular del Asegurado </p>
                                        <p class="ambos-lados">(Foto de ambos lados)</p>


                                        <div>
                                            @if(count($denuncia->documentosDenuncia) > 0)
                                                {{-- TIPO 1 = DNI --}}
                                                @foreach($denuncia->documentosDenuncia()->where('type', 1)->get() as $archivo)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a><i
                                                                    class="pl-2 fas fa-check"></i>

                                                                @if($denuncia->documentosDenuncia()->where('type', 1)->count() > 1)
                                                                    <button
                                                                        style="border:none;background: none;"
                                                                        id="confirmacion-popupa"><i
                                                                            class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endif
                                                            </p>

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
                                                {{-- TIPO 1 = DNI --}}
                                                @foreach($denuncia->documentosDenuncia()->where('type', 2)->get() as $archivo)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a><i
                                                                    class="pl-2 fas fa-check"></i>

                                                                @if($denuncia->documentosDenuncia()->where('type', 2)->count() > 1)
                                                                    <button
                                                                        style="border:none;background: none;"
                                                                        id="confirmacion-popupa"><i
                                                                            class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endif
                                                            </p>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>


                                    </div>

                                    <div class="text-center col-12 col-md-4 ">
                                        <p class="documentos-denuncia-title">*Carnet de conducir </p>
                                        <p class="ambos-lados">(Foto de ambos lados)</p>

                                        <input type="file" id="foto_carnet" name="foto_carnet" wire:change="$emit('single_file_choosed_carnet')">

                                        <div>
                                            @if(count($denuncia->documentosDenuncia) > 0)
                                                {{-- TIPO 1 = DNI --}}
                                                @foreach($denuncia->documentosDenuncia()->where('type', 3)->get() as $archivo)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a><i
                                                                    class="pl-2 fas fa-check"></i>

                                                                @if($denuncia->documentosDenuncia()->where('type', 3)->count() > 1)
                                                                    <button
                                                                        style="border:none;background: none;"
                                                                        id="confirmacion-popupa"><i
                                                                            class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endif
                                                            </p>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>


                                    </div>


                                </div>


                                <div class="form-group row">

                                    <div class="col-12 col-md-12 pt-0">
                                        <hr style="border:1px solid lightgray;">
                                    </div>


                                    <div class="text-center col-12 col-md-12 ">
                                        <p class="documentos-denuncia-title">*Fotos vehículo Asegurado </p>
                                        <p class="ambos-lados">Obligatorio 4 fotos:1 de cada lateral, adelante, atrás:
                                            donde se vean los daños y al menos uno con patente visible y completa.</p>


                                        <div>
                                            @if(count($denuncia->documentosDenuncia) > 0)
                                                {{-- TIPO 1 = DNI --}}
                                                @foreach($denuncia->documentosDenuncia()->where('type', 4)->get() as $archivo)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a><i
                                                                    class="pl-2 fas fa-check"></i>

                                                                @if($denuncia->documentosDenuncia()->where('type', 4)->count() > 1)
                                                                    <button
                                                                        style="border:none;background: none;"
                                                                        id="confirmacion-popupa"><i
                                                                            class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endif
                                                            </p>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <p>@error('vehiculo') <span class="text-danger">{{ $message }}</span> @enderror
                                        </p>

                                    </div>
                                </div>


                                <div class="form-group row ">
                                    <div class="col-12 col-md-12 pt-0">
                                        <hr style="border:1px solid lightgray;">
                                    </div>
                                    <div class="text-center col-12 col-md-4 ">
                                        <p class="documentos-denuncia-title">Último recibo del seguro </p>
                                        <p class="ambos-lados">Pagado</p>


                                        <div>
                                            @if(count($denuncia->documentosDenuncia) > 0)
                                                {{-- TIPO 1 = DNI --}}
                                                @foreach($denuncia->documentosDenuncia()->where('type', 5)->get() as $archivo)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a><i
                                                                    class="pl-2 fas fa-check"></i>

                                                                @if($denuncia->documentosDenuncia()->where('type', 5)->count() > 1)
                                                                    <button
                                                                        style="border:none;background: none;"
                                                                        id="confirmacion-popupa"><i
                                                                            class="fas fa-trash-alt"></i>
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
                                                {{-- TIPO 1 = DNI --}}
                                                @foreach($denuncia->documentosDenuncia()->where('type', 6)->get() as $archivo)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a><i
                                                                    class="pl-2 fas fa-check"></i>

                                                                @if($denuncia->documentosDenuncia()->where('type', 6)->count() > 1)
                                                                    <button
                                                                        style="border:none;background: none;"
                                                                        id="confirmacion-popupa"><i
                                                                            class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endif
                                                            </p>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <p>@error('policial') <span class="text-danger">{{ $message }}</span> @enderror
                                        </p>

                                    </div>

                                    <div class="text-center col-12 col-md-4 ">
                                        <p class="documentos-denuncia-title">Habilitación municipal </p>
                                        <p class="ambos-lados">(Sólo taxis y remises)</p>


                                        <div>
                                            @if(count($denuncia->documentosDenuncia) > 0)
                                                {{-- TIPO 1 = DNI --}}
                                                @foreach($denuncia->documentosDenuncia()->where('type', 7)->get() as $archivo)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p>
                                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                                   href={{$archivo->url}}>{{$archivo->nombre}}</a><i
                                                                    class="pl-2 fas fa-check"></i>

                                                                @if($denuncia->documentosDenuncia()->where('type', 7)->count() > 1)
                                                                    <button
                                                                        style="border:none;background: none;"
                                                                        id="confirmacion-popupa"><i
                                                                            class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endif
                                                            </p>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <p>@error('habilitacion') <span
                                                class="text-danger">{{ $message }}</span> @enderror</p>

                                    </div>


                                </div>

                                <p class="pt-3 panel-operaciones-subtitle"
                                   style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">
                                    Datos del denunciante <img
                                        src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                        style="position:absolute; right:50px;"></p>

                                <div style="padding-left:8px;padding-right:8px;">
                                    <div class="row pt-0">
                                        <div class="col-12 col-md-8">
                                            <p>Nombre y
                                                Apellido: {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_nombre : '' }}</p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>
                                                Teléfono: {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_telefono : '' }}</p>
                                        </div>
                                    </div>

                                    <div class="row pt-0">
                                        <div class="col-12 col-md-8">
                                            <p>
                                                Domicilio: {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_domicilio : '' }}</p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>Código
                                                Postal: {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_codigo_postal : '' }}</p>
                                        </div>
                                    </div>


                                    <div class="row pt-0">
                                        <div class="col-12 col-md-4">
                                            <p>País: Argentina</p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>
                                                Provincia: {{ $denuncia->denunciante ? \App\Models\Province::where('id',$denuncia->denunciante->carga_paso_12_provincia_id)->first()->name : '' }}</p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>
                                                Localidad: {{ $denuncia->denunciante ? \App\Models\City::where('id',$denuncia->denunciante->carga_paso_12_localidad_id)->first()->name : '' }}</p>
                                        </div>
                                    </div>

                                    <div class="row pt-0">
                                        <div class="col-12 col-md-4">
                                            <p>
                                                Fecha {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_fecha : '' }}</p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>
                                                Hora {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_hora : '' }}</p>
                                        </div>


                                        <div class="col-12 col-md-4">
                                            <p>
                                                Lugar {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_lugar : '' }}</p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>Documento
                                                Tipo: {{$denuncia->denunciante ? \App\Models\TipoDocumento::where('id',$denuncia->denunciante->carga_paso_12_documento_id)->first()->nombre : '' }}</p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <p>Documento
                                                Número: {{ $denuncia->denunciante ? $denuncia->denunciante->carga_paso_12_documento_numero : '' }}</p>
                                        </div>
                                    </div>
                                </div>


                                <p class="pt-3 panel-operaciones-subtitle"
                                   style="background: #E9E7EB;color:#545358;padding-bottom: 12px;padding-left: 12px;">
                                    Observaciones <a
                                        href="{{route('panel-siniestros.denuncia.observaciones',['denuncia'=>$denuncia])}}"><img
                                            src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"
                                            style="position:absolute; right:50px;"></a></p>
                                <table class="table" style="min-height:200px;margin-bottom: 120px;">

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
                                            <td>{{$observacion->created_at}}</td>
                                            <td>{{$observacion->detalle}}</td>
                                            <td>{{$observacion->user->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
