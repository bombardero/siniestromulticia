<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Finisterre Seguros</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{--
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    --}}

    <style>
        {{--
        @font-face {
            font-family: Roboto;
            src: url({{ asset('fonts/Roboto/Roboto-Regular.ttf')  }});
        }--}}

        body {
            font-family: 'Roboto';
        }
        table {
            border-collapse: collapse;
            border-spacing: 0px;
            border-style: outset;
            border: 0px !important;
        }
        tr,td,th{
            border: 0px !important;
        }
        td{
            padding: 0px !important;
        }
        .tb-header td{

        }
        .tb-content td{
            max-width: 200px;
        }
        .panel table{
            padding: 5px;
        }
        .m-1{
            margin: 5px;
        }
        .px-0{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .pb-0{
            padding-bottom: 0px !important;
        }
        .pt-0{
            padding-top: 0px !important;
        }
        .w-100{
            max-width: 100%;
        }
        .border{
            border: 1px red solid !important;
        }
        .page-break {
            page-break-after: always;
        }

        .img-sello{
            width: 120px;
            text-align: right;
            transform: rotate(-10deg);
            position: relative;
            right: 15px;
            bottom: 15px;
        }

    </style>
</head>
<body>
<main>

    <table class="table">
        <tr>
            <td>
                <img style="width: 250px; margin-top: 30px" src="{{ asset('images/finisterre-logo-5_1.png') }}" >
            </td>
            <td class="text-center" style="width: 400px;">
                <h2>SECCCIÓN AUTOMOTORES</h2>
                <h4>FORMULARIO DE DENUNCIA DE SINIESTRO<br>ASEGURADO</h4>
            </td>
        </tr>
    </table>

    <table class="table tb-content">
        <tr>
            <td class="">
                <b>Fecha del Siniestro: </b>
                {{ $denuncia->fecha->format('d/m/Y') }}
            </td>
            <td class="">
                <b>Hora del Siniestro: </b>
                {{\Carbon\Carbon::createFromFormat('H:i:s',$denuncia->hora)->format('H:i') }} HS
            </td>
        </tr>
        <tr>
            <td>
                <b>Momento del día: </b>{{ $denuncia->momento_dia }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Estado del tiempo: </b>
                {{ $denuncia->estado_tiempo_seco ? 'Seco. ' : '' }}
                {{ $denuncia->estado_tiempo_lluvia ? 'Lluvia. ' : '' }}
                {{ $denuncia->estado_tiempo_niebla ? 'Niebla. ' : '' }}
                {{ $denuncia->estado_tiempo_despejado ? 'Despejado. ' : '' }}
                {{ $denuncia->estado_tiempo_nieve ? 'Nieve. ' : '' }}
                {{ $denuncia->estado_tiempo_granizo ? 'Granizo. ' : '' }}
                {{ $denuncia->estado_tiempo_otros_detalles }}
            </td>
        </tr>
    </table>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Lugar del Siniestro</div>
        <table class="table tb-content pb-0">
            <tr>
                <td class="">
                    <b>Lugar: </b>
                    {{ $denuncia->lugar_nombre }}
                </td>
            </tr>
            <tr>
                <td class="">
                    <b>País: </b>Argentina
                </td>
                <td>
                    <b>Provincia: </b>
                    {{ $denuncia->provincia->name }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Localidad: </b>
                    {{ $denuncia->localidad->name }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Calle: </b>
                    {{ $denuncia->calle }}
                </td>
                <td>
                    <b>Tipo Calzada: </b>
                    {{ $denuncia->tipoCalzada->nombre }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Detalle calzada: </b>
                    {{ $denuncia->calzada_detalle }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Intersección: </b>
                    {{ $denuncia->interseccion }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Cruce Señalizado: </b>
                    {{ $denuncia->semaforo ? 'Si' : 'No' }}
                </td>
                <td>
                    <b>Tren barrera señalizado: </b>
                    {{ $denuncia->tren ? 'Si' : 'No' }}
                </td>
            </tr>
        </table>
        <table class="table tb-content pt-0">
            <tr>
                <td>
                    <b>Semaforo: </b>
                    {{ $denuncia->semaforo ? 'Si' : 'No' }}
                </td>
                <td>
                    <b>Funciona: </b>
                    {{ $denuncia->semaforo_funciona ? 'Si' : 'No' }}
                </td>
                <td>
                    <b>Intermitente: </b>
                    {{ $denuncia->semaforo_intermitente ? 'Si' : 'No' }}
                </td>
                <td>
                    <b>Color: </b>
                    {{ $denuncia->semaforo_color }}
                </td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Datos del conductor del vehículo asegurado</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="2">
                    <b>Nombre y Apellido: </b>{{ $denuncia->conductor ? $denuncia->conductor->nombre : '' }}
                </td>
                <td>
                    <b>Teléfono: </b>{{ $denuncia->conductor ? $denuncia->conductor->telefono : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Domicilio: </b>{{ $denuncia->conductor ? $denuncia->conductor->domicilio : '' }}
                </td>
                <td>
                    <b>CP: </b>{{ $denuncia->conductor ? $denuncia->conductor->codigo_postal : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>País: </b>Argentina
                </td>
                <td>
                    <b>Provincia: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->provincia->name : '' }}
                </td>
                <td>
                    <b>Localidad: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->localidad->name : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Fecha de Nacimiento: </b>
                    {{ $denuncia->conductor && $denuncia->conductor->fecha_nacimiento ? $denuncia->conductor->fecha_nacimiento->format('d/m/Y') : '' }}
                </td>
                <td>
                    <b>Tipo de Documento: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->tipoDocumento->nombre : '' }}
                </td>
                <td>
                    <b>N° de Documento: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->documento_numero : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Ocupación: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->ocupacion : '' }}
                </td>
                <td>
                    <b>N° de Reg. de Conducir: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->numero_registro : '' }}
                </td>
                <td>
                    <b>Estado Civil: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->estado_civil : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Tipo de Carnet: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->tipoCarnet->nombre : '' }}
                </td>
                <td>
                    <b>Categoria del Carnet: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->carnet_categoria : '' }}
                </td>
                <td>
                    <b>Vencimiento: </b>
                    {{ $denuncia->conductor && $denuncia->conductor->carnet_vencimiento ? $denuncia->conductor->carnet_vencimiento->format('d/m/Y') : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    <b>Examen de alcoholemia: </b>
                    {{ $denuncia->conductor ? ($denuncia->conductor->conductor_alcoholemia ? 'Si' : 'No') : '' }}
                </td>
                <td colspan="1">
                    <b>Se negó: </b>
                    {{ $denuncia->conductor ? ($denuncia->conductor->alcoholemia_se_nego ? 'Si' : 'No') : '' }}
                </td>
                <td colspan="1">
                    <b>Conductor habitual: </b>
                    {{ $denuncia->conductor ? ($denuncia->conductor->habitual ? 'Si' : 'No') : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    <b>Es el propio asegurado: </b>
                    {{ $denuncia->conductor ? ($denuncia->conductor->asegurado ? 'Si' : 'No') : '' }}
                </td>
                <td colspan="1">
                    <b>Relación con el asegurado: </b>
                    {{ $denuncia->conductor ? $denuncia->conductor->asegurado_relacion : '' }}
                </td>
            </tr>
        </table>
    </div>

    @if($denuncia->estado_carga == 12)
    <table class="table">
        <tr>
            <td class="text-right">
                <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
            </td>
        </tr>
    </table>
    @endif

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Datos del Asegurado</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="2">
                    <b>Nombre y Apellido: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->nombre : '' }}
                </td>
                <td>
                    <b>Teléfono: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->telefono : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Domicilio: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->domicilio : '' }}
                </td>
                <td>
                    <b>CP: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->codigo_postal : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>País: </b>Argentina
                </td>
                <td>
                    <b>Provincia: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->provincia->name : '' }}
                </td>
                <td>
                    <b>Localidad: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->localidad->name : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Ocupación: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->ocupacion : '' }}
                </td>
                <td>
                    <b>Tipo de Documento: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->tipoDocumento->nombre : '' }}
                </td>
                <td>
                    <b>N° de Documento: </b>
                    {{ $denuncia->asegurado ? $denuncia->asegurado->documento_numero : '' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Datos del vehículo asegurado</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="3">
                    <b>Marca: </b>
                    {{ $denuncia->vehiculo ? ($denuncia->vehiculo->marca ? $denuncia->vehiculo->marca->nombre : $denuncia->vehiculo->otra_marca  ) : '' }}
                </td>
                <td colspan="3">
                    <b>Modelo: </b>
                    {{ $denuncia->vehiculo ? ($denuncia->vehiculo->modelo ? $denuncia->vehiculo->modelo->nombre : $denuncia->vehiculo->otro_modelo  ) : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Tipo: </b>
                    {{ $denuncia->vehiculo ? $denuncia->vehiculo->tipo : '' }}
                </td>
                <td colspan="2">
                    <b>Año: </b>
                    {{ $denuncia->vehiculo ? $denuncia->vehiculo->codigo_postal : '' }}
                </td>
                <td colspan="2">
                    <b>Dominio: </b>
                    {{ $denuncia->vehiculo ? $denuncia->vehiculo->dominio : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>Uso: </b>
                    @if($denuncia->vehiculo)
                        {{ $denuncia->vehiculo->uso_particular ? 'Particular. ' : '' }}
                        {{ $denuncia->vehiculo->uso_comercial ? 'Comercial. ' : '' }}
                        {{ $denuncia->vehiculo->uso_taxi_remis ? 'Taxi. ' : '' }}
                        {{ $denuncia->vehiculo->uso_tpp ? 'Transporte Publico. ' : '' }}
                        {{ $denuncia->vehiculo->uso_urgencia ? 'Transporte de Urgencia. ' : '' }}
                        {{ $denuncia->vehiculo->uso_seguridad ? 'Transporte de Seguridad. ' : '' }}</p>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>Tipo de Siniestro: </b>
                    @if($denuncia->vehiculo)
                        {{ $denuncia->vehiculo->siniestro_danio ? 'Daño. ' : '' }}
                        {{ $denuncia->vehiculo->siniestro_robo ? 'Robo. ' : '' }}
                        {{ $denuncia->vehiculo->siniestro_incendio ? 'Incendio. ' : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>Detalles: </b>
                    {{ $denuncia->vehiculo ? $denuncia->vehiculo->detalles : '' }}
                </td>
            </tr>
        </table>
    </div>

    @if($denuncia->estado_carga == 12)
        <table class="table">
            <tr>
                <td class="text-right">
                    <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
                </td>
            </tr>
        </table>
    @endif

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Detalles del Siniestro</div>
    </div>

    <table class="table tb-content">
        <tr>
            <td colspan="6">
                <b>Gráfigo:</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <img class="w-100" src="{{ $denuncia->croquis_url }}" alt="">
            </td>
        </tr>
        <td colspan="6">
            <b>Descripción:</b>
            {{ $denuncia->croquis_descripcion }}
        </td>
    </table>

    <table class="table tb-content pb-0">
        <tr>
            <td colspan="2">
                <b>Comisaria:</b>
                {{ $denuncia->denuncia_policial_comisaria }}
            </td>
            <td colspan="2">
                <b>Acta:</b>
                {{ $denuncia->denuncia_policial_comisaria }}
            </td>
            <td colspan="2">
                <b>Folio:</b>
                {{ $denuncia->denuncia_policial_folio }}
            </td>
        </tr>
        <tr>
            <<td colspan="2">
                <b>Sumario:</b>
                {{ $denuncia->denuncia_policial_sumario }}
            </td>
            <td colspan="2">
                <b>Juzgado:</b>
                {{ $denuncia->denuncia_policial_juzgado }}
            </td>
            <td colspan="2">
                <b>Secretaria:</b>
                {{ $denuncia->denuncia_policial_secretaria }}
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Documentos</div>
    </div>

    <table class="table tb-content pb-0">
        <tr>
            <td colspan="2"><b>DNI</b></td>
        </tr>
        @if($denuncia->documentosDenuncia()->where('type','dni')->count())
        <tr>
            @foreach($denuncia->documentosDenuncia()->where('type','dni')->get() as $doc)
                <td>
                    <img class="w-100" src="{{ $doc->url }}" alt="">
                </td>
            @endforeach
        </tr>
        @endif
    </table>

    <table class="table tb-content pb-0">
        <tr>
            <td colspan="2"><b>Cédula</b></td>
        </tr>
        @if($denuncia->documentosDenuncia()->where('type','cedula')->count())
            <tr>
                @foreach($denuncia->documentosDenuncia()->where('type','cedula')->get() as $doc)
                    <td>
                        <img class="w-100" src="{{ $doc->url }}" alt="">
                    </td>
                @endforeach
            </tr>
        @endif
    </table>

    @if($denuncia->estado_carga == 12)
        <table class="table">
            <tr>
                <td class="text-right">
                    <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
                </td>
            </tr>
        </table>
    @endif

    <div class="page-break"></div>

    <table class="table tb-content pb-0">
        <tr>
            <td colspan="2"><b>Carnet de Conducir</b></td>
        </tr>
        @if($denuncia->documentosDenuncia()->where('type','carnet')->count())
            <tr>
                @foreach($denuncia->documentosDenuncia()->where('type','carnet')->get() as $doc)
                    <td>
                        <img class="w-100" src="{{ $doc->url }}" alt="">
                    </td>
                @endforeach
            </tr>
        @endif
    </table>

    @if($denuncia->estado_carga == 12)
        <table class="table">
            <tr>
                <td class="text-right">
                    <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
                </td>
            </tr>
        </table>
    @endif

    <table class="table tb-content pb-0">
        <tr>
            <td><b>Fotos vehículo</b></td>
        </tr>
        @if($denuncia->documentosDenuncia()->where('type','vehiculo')->count())
            @foreach($denuncia->documentosDenuncia()->where('type','vehiculo')->get() as $doc)
            <tr>
                <td>
                    <img class="w-100" src="{{ $doc->url }}" alt="">
                </td>
            </tr>
            @if($denuncia->estado_carga == 12)
                <tr>
                    <td class="text-right">
                        <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
                    </td>
                </tr>
            @endif
            @endforeach
        @endif
    </table>

    @if($denuncia->documentosDenuncia()->where('type','recibo')->count())
    <table class="table tb-content pb-0">
        <tr>
            <td><b>Último recibo del seguro</b></td>
        </tr>
            @foreach($denuncia->documentosDenuncia()->where('type','recibo')->get() as $doc)
                <tr>
                    <td>
                        <img class="w-100" src="{{ $doc->url }}" alt="">
                    </td>
                </tr>
            @endforeach
    </table>
    @endif

    @if($denuncia->documentosDenuncia()->where('type','exposicion_policial')->count())
        <table class="table tb-content pb-0">
            <tr>
                <td><b>Exposición Policial</b></td>
            </tr>
            @foreach($denuncia->documentosDenuncia()->where('type','exposicion_policial')->get() as $doc)
                <tr>
                    <td>
                        <img class="w-100" src="{{ $doc->url }}" alt="">
                    </td>
                </tr>
            @endforeach
            @if($denuncia->estado_carga == 12)
                <tr>
                    <td class="text-right">
                        <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
                    </td>
                </tr>
            @endif
        </table>
    @endif

    @if($denuncia->documentosDenuncia()->where('type','habilitacion')->count())
        <table class="table tb-content pb-0">
            <tr>
                <td><b>Habilitación municipal</b></td>
            </tr>
            @foreach($denuncia->documentosDenuncia()->where('type','habilitacion')->get() as $doc)
                <tr>
                    <td>
                        <img class="w-100" src="{{ $doc->url }}" alt="">
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Detalles de los otros vehiculos</div>
    </div>

    <table class="table tb-content pb-0">
        <tr>
            <td colspan="3">
                <b>Intervino otro/s vehículo:</b>
                {{ $denuncia->intervino_otro_vehiculo !== null ? ($denuncia->intervino_otro_vehiculo ? 'Si' : 'No') : ''}}
            </td>
            <td colspan="3">
                <b>Tengo los datos:</b>
                {{ $denuncia->intervino_otro_vehiculo_datos !== null ? ($denuncia->intervino_otro_vehiculo_datos ? 'Si' : 'No') : ''}}
            </td>
        </tr>
    </table>

    @foreach($denuncia->vehiculoTerceros as $tercero)
    <table class="table tb-content pb-0">
        <tr>
            <th colspan="6" class="px-0">
                Datos del Propietario
            </th>
        </tr>
        <tr>
            <td colspan="4">
                <span>Nombre y Apellido: </span>
                {{ $tercero->propietario_nombre }}
            </td>
            <td colspan="2">
                <span>Teléfono: </span>
                {{ $tercero->propietario_telefono }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Tipo de Documento: </span>
                {{ $tercero->tipoDocumentoPropietario->nombre }}
            </td>
            <td colspan="2">
                <span>N° de Documento: </span>
                {{ $tercero->propietario_documento_numero }}
            </td>
            <td colspan="2">
                <span>CP: </span>
                {{ $tercero->propietario_codigo_postal }}
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <span>Domicilio: </span>
                {{ $tercero->propietario_domicilio }}
            </td>
        </tr>

        @if($denuncia->estado_carga == 12)
            <tr>
                <td colspan="6" class="text-right">
                    <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
                </td>
            </tr>
        @endif

        <tr>
            <th colspan="6" class="px-0">
                Datos del Vehículo
            </th>
        </tr>
        <tr>
            <td colspan="3">
                <span>Marca: </span>
                {{ $tercero->marca ? $tercero->marca->nombre : $tercero->otra_marca }}
            </td>
            <td colspan="3">
                <span>Modelo: </span>
                {{ $tercero->marca ? $tercero->marca->nombre : $tercero->otra_marca }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Tipo: </span>
                {{ $tercero->tipo }}
            </td>
            <td colspan="2">
                <span>Año: </span>
                {{ $tercero->anio }}
            </td>
            <td colspan="2">
                <span>Dominio: </span>
                {{ $tercero->dominio }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span>Número de Motor: </span>
                {{ $tercero->motor }}
            </td>
            <td colspan="3">
                <span>Número de Chasis: </span>
                {{ $tercero->chasis }}
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <span>Uso: </span>
                {{ $tercero->uso_particular ? 'Particular. ' : '' }}
                {{ $tercero->uso_comercial ? 'Comercial. ' : '' }}
                {{ $tercero->uso_taxi_remis ? 'Taxi. ' : '' }}
                {{ $tercero->uso_tpp ? 'Transporte Publico. ' : '' }}
                {{ $tercero->uso_urgencia ? 'Transporte de Urgencia. ' : '' }}
                {{ $tercero->uso_seguridad ? 'Transporte de Seguridad. ' : '' }}
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <span>Detalle de los daños: </span>
                {{ $tercero->detalles }}
            </td>
        </tr>
        <tr>
            <th colspan="6" class="px-0">Datos del Conductor</th>
        </tr>
        <tr>
            <td colspan="4">
                <span>Nombre y Apellido: </span>
                {{ $tercero->conductor_nombre }}
            </td>
            <td colspan="2">
                <span>Teléfono: </span>
                {{ $tercero->conductor_telefono }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Tipo de Documento: </span>
                {{ $tercero->tipoDocumentoPropietario->nombre }}
            </td>
            <td colspan="2">
                <span>N° de Documento: </span>
                {{ $tercero->conductor_documento_numero }}
            </td>
            <td colspan="2">
                <span>CP: </span>
                {{ $tercero->conductor_codigo_postal }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <span>Domicilio: </span>
                {{ $tercero->conductor_domicilio }}
            </td>
            <td colspan="2">
                <span>N° de Reg. de Conducir: </span>
                {{ $tercero->conductor_registro }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Tipo de Carnet: </span>
                {{ $tercero->tipoCarnetConductor->nombre }}
            </td>
            <td colspan="2">
                <span>Categoría Carnet: </span>
                {{ $tercero->conductor_categoria }}
            </td>
            <td colspan="2">
                <span>Vencimiento: </span>
                {{ $tercero->conductor_vencimiento ? $tercero->conductor_vencimiento->format('d/m/Y') : '' }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span>Alcoholemía: </span>
                {{ $tercero->conductor_alcoholemia ? 'Si' : 'No' }}
            </td>
            <td colspan="2">
                <span>Se Negó: </span>
                {{ $tercero->conductor_alcoholemia_se_nego ? 'Si' : 'No' }}
            </td>
            <td colspan="2">
                <span>Conductor habitual: </span>
                {{ $tercero->conductor_habitual ? 'Si' : 'No' }}
            </td>
        </tr>
    </table>
    @endforeach

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Daños materiales</div>
    </div>

    <table class="table tb-content pb-0">
        <tr>
            <td colspan="3">
                <b>Hubo daños materiales:</b>
                {{ $denuncia->hubo_danios_materiales !== null ? ($denuncia->hubo_danios_materiales ? 'Si' : 'No') : ''}}
            </td>
        </tr>
    </table>

    @foreach($denuncia->danioMateriales as $danio)
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="3">
                    <span>Detalle de los daños: </span>
                    {{ $danio->detalles }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <span>Nombre y Apellido del Propietario: </span>
                    {{ $danio->propietario_nombre }}
                </td>
            </tr>
            <tr>
                <td>
                    <span>Tipo de Documento: </span>
                    {{ $danio->tipoDocumento->nombre }}
                </td>
                <td>
                    <span>N° de Documento: </span>
                    {{ $danio->propietario_documento_numero }}
                </td>
                <td>
                    <span>CP: </span>
                    {{ $danio->propietario_codigo_postal }}
                </td>
            </tr>
            <tr>
                <td>
                    <span>Domicilio: </span>
                    {{ $danio->propietario_domicilio }}
                </td>
            </tr>
        </table>
    @endforeach

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Lesionados</div>
    </div>

    <table class="table tb-content pb-0">
        <tr>
            <td colspan="3">
                <b>Hubo personas lesionadas:</b>
                {{ $denuncia->hubo_lesionados !== null ? ($denuncia->hubo_lesionados ? 'Si' : 'No') : ''}}
            </td>
        </tr>
    </table>

    @foreach($denuncia->lesionados as $lesionado)
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="4">
                    <span>Nombre y Apellido: </span>
                    {{ $lesionado->nombre }}
                </td>
                <td colspan="2">
                    <span>Teléfono: </span>
                    {{ $lesionado->telefono }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span>Tipo de Documento: </span>
                    {{ $lesionado->tipoDocumento->nombre }}
                </td>
                <td colspan="2">
                    <span>N° de Documento: </span>
                    {{ $lesionado->documento_numero }}
                </td>
                <td colspan="2">
                    <span>CP: </span>
                    {{ $lesionado->codigo_postal }}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <span>Domicilio: </span>
                    {{ $lesionado->domicilio }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span>Estado Civil: </span>
                    {{ $lesionado->estado_civil }}
                </td>
                <td colspan="2">
                    <span>Fecha de Nacimiento: </span>
                    {{ $lesionado->fecha_nacimiento ? $lesionado->fecha_nacimiento->format('d/m/Y') : '' }}
                </td>
                <td colspan="2">
                    <span>Relación con el asegurado: </span>
                    {{ $lesionado->relacion }}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <span>Tipo: </span>
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
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <span>Gravedad de Lesiones: </span>
                    {{ $lesionado->gravedad_lesion }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span>Examen de alcoholemia: </span>
                    {{ $lesionado->alcoholemia ? 'Si' : 'No' }}
                </td>
                <td colspan="4">
                    <span>Se negó: </span>
                    {{ $lesionado->alcoholemia_se_nego ? 'Si' : 'No' }}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <span>Centro Asistencial: </span>
                    {{ $lesionado->centro_asistencial }}
                </td>
            </tr>
        </table>
    @endforeach

    @if($denuncia->estado_carga == 12)
        <table class="table">
            <tr>
                <td class="text-right">
                    <img class="img-sello" src="{{ asset('images/pdf_sello.png')  }}" alt="">
                </td>
            </tr>
        </table>
    @endif

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Detalles del Denunciante</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="4">
                    <b>Nombre y Apellido: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->nombre : '' }}
                </td>
                <td colspan="2">
                    <b>Teléfono: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->telefono : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Tipo de Documento: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->tipoDocumento->nombre : '' }}
                </td>
                <td colspan="3">
                    <b>N° de Documento: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->documento_numero : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Provincia: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->provincia->name : '' }}
                </td>
                <td colspan="3">
                    <b>Localidad: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->localidad->name : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <b>Domicilio: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->domicilio : '' }}
                </td>
                <td colspan="2">
                    <b>CP: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->codigo_postal : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <b>Es el asegurado: </b>
                    {{ $denuncia->denunciante ? ($denuncia->denunciante->asegurado ? 'Si' : 'No' ) : '' }}
                </td>
                <td colspan="2">
                    <b>Relación: </b>
                    {{ $denuncia->denunciante ? $denuncia->denunciante->asegurado_relacion : '' }}
                </td>
            </tr>
        </table>
    </div>

    <table class="table tb-content pb-0">
        <tr>
            <td>
                Documento generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
            </td>
        </tr>
        <tr>
            <td>
                en <a href="https://finisterreseguros.com.ar/">finisterreseguros.com.ar</a>
            </td>
        </tr>
    </table>

</main>
</body>
</html>

