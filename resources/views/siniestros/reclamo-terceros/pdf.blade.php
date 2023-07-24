<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Finisterre Seguros</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
                <img style="width: 250px; margin-top: 30px" src="{{ asset('images/finisterre-logo-5.png') }}" >
            </td>
            <td class="text-center" style="width: 400px;">
                <h2>SECCCIÓN AUTOMOTORES</h2>
                <h4>RECLAMO DE SINIESTRO - TERCERO</h4>
            </td>
        </tr>
    </table>

    <table class="table tb-content">
        <tr>
            <td colspan="2">
                <b>Número de Gestión: </b>{{ $reclamo->id }}
            </td>
        </tr>
        <tr>
            <td>
                <b>Fecha del Siniestro: </b>
                {{ $reclamo->fecha->format('d/m/Y') }}
            </td>
            <td>
                <b>Hora del Siniestro: </b>
                {{\Carbon\Carbon::createFromFormat('H:i:s',$reclamo->hora)->format('H:i') }} HS
            </td>
        </tr>
        <tr>
            <td>
                <b>Dominio Vehículo Asegurado: </b>{{ $reclamo->vehiculo_asegurado_dominio }}
            </td>
            <td>
                <b>Dominio Vehículo Tercero: </b>{{ $reclamo->vehiculo_tercero_dominio }}
            </td>
        </tr>
        <tr>
            <td>
                <b>Fecha de aviso: </b>{{ $reclamo->created_at->format('d/m/Y') }}
            </td>
            <td>
                <b>Tipo de Reclamo: </b>{{ implode(', ',$reclamo->tipos_reclamos) }}
            </td>
        </tr>
    </table>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Datos del Contacto</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="2">
                    <b>Nombre: </b>{{ $reclamo->responsable_contacto_nombre }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Teléfono: </b>{{ $reclamo->responsable_contacto_telefono }}
                </td>
                <td>
                    <b>Email: </b>{{ $reclamo->responsable_contacto_email }}
                </td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Datos del Asegurado</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="2">
                    <b>Nombre: </b>{{ $reclamo->asegurado_nombre }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Dominio: </b>{{ $reclamo->vehiculo_asegurado_dominio }}
                </td>
                <td>
                    <b>Número de Póliza: </b>{{ $reclamo->vehiculo_asegurado_nro_poliza }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Marca: </b>{{ $reclamo->marcaVehiculoAsegurado ? $reclamo->marcaVehiculoAsegurado->nombre : $reclamo->vehiculo_asegurado_otra_marca }}
                </td>
                <td>
                    <b>Modelo: </b>{{ $reclamo->modeloVehiculoAsegurado ? $reclamo->modeloVehiculoAsegurado->nombre : $reclamo->vehiculo_asegurado_otro_modelo }}
                </td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Reclamante</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="3">
                    <b>Nombre: </b>{{ $reclamo->reclamante ? $reclamo->reclamante->nombre : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Tipo de Documento: </b>{{ $reclamo->reclamante ? $reclamo->reclamante->tipoDocumento->nombre : '' }}
                </td>
                <td>
                    <b>N° de Documento: </b>{{ $reclamo->reclamante ? $reclamo->reclamante->documento_numero : '' }}
                </td>
                <td>
                    <b>Teléfono: </b>{{ $reclamo->reclamante ? $reclamo->reclamante->telefono : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Domicilio: </b>{{ $reclamo->reclamante ? $reclamo->reclamante->tipoDocumento->nombre : '' }}
                </td>
                <td>
                    <b>Código Postal: </b>{{ $reclamo->reclamante ? $reclamo->reclamante->codigo_postal : '' }}
                </td>
            </tr>
            @if($reclamo->reclamante && $reclamo->reclamante->pais_id && $reclamo->reclamante->province_id)
                <tr>
                    <td>
                        <b>País: </b>{{ $reclamo->reclamante->pais->nombre }}
                    </td>
                    <td>
                        <b>Provincia: </b>{{ $reclamo->reclamante->provincia->name }}
                    </td>
                    <td>
                        <b>Localidad: </b>{{ $reclamo->reclamante->city_id != null ? $reclamo->reclamante->localidad->name : $reclamo->reclamante->otro_pais_provincia_localidad }}
                    </td>
                </tr>
            @elseif($reclamo->reclamante && $reclamo->reclamante->otro_pais_provincia_localidad)
                <tr>
                    <td colspan="3">
                        <b>Localidad/Provincia/Pais: </b>{{ $reclamo->otro_pais_provincia_localidad }}
                    </td>
                </tr>
            @else
                <tr>
                    <td><b>País: </b></td>
                    <td><b>Provincia: </b></td>
                    <td><b>Localidad: </b></td>
                </tr>
            @endif
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Datos del conductor del vehículo asegurado</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="3">
                    <b>Dominio: </b>{{ $reclamo->vehiculo_asegurado_dominio }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Marca: </b>{{ $reclamo->vehiculo ? ($reclamo->vehiculo->marca ? $reclamo->vehiculo->marca->nombre : $reclamo->vehiculo->otra_marca) : '' }}
                </td>
                <td>
                    <b>Modelo: </b>{{ $reclamo->vehiculo ? ($reclamo->vehiculo->modelo ? $reclamo->vehiculo->modelo->nombre : $reclamo->vehiculo->otro_modelo) : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Tipo: </b>{{ $reclamo->vehiculo ? $reclamo->vehiculo->tipo : '' }}
                </td>
                <td>
                    <b>Año: </b>{{ $reclamo->vehiculo ? $reclamo->vehiculo->anio : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Compañía de Seguro: </b>{{ $reclamo->vehiculo ? $reclamo->vehiculo->compania_seguros : '' }}
                </td>
                <td>
                    <b>Número de Póliza: </b>{{ $reclamo->vehiculo ? $reclamo->vehiculo->numero_poliza : '' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Tipo de Cobertura: </b>{{ $reclamo->vehiculo ? $reclamo->vehiculo->tipo_cobertura : '' }}
                </td>
                <td>
                    <b>Franquicia: </b>{{ $reclamo->vehiculo ? $reclamo->vehiculo->franquicia : '' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Datos del Conductor del Vehículo</div>
        <table class="table tb-content pb-0">
            @if($reclamo->reclamante && $reclamo->reclamante->conductor)
                <tr>
                    <td colspan="3">
                        <b>El conductor es el reclamante</b>
                    </td>

                </tr>
            @else
                <tr>
                    <td colspan="3">
                        <b>Nombre: </b>{{ $reclamo->conductor ? $reclamo->conductor->nombre : '' }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Tipo de Documento: </b>{{ $reclamo->conductor ? $reclamo->conductor->tipoDocumento->nombre : '' }}
                    </td>
                    <td>
                        <b>N° de Documento: </b>{{ $reclamo->conductor ? $reclamo->conductor->documento_numero : '' }}
                    </td>
                    <td>
                        <b>Teléfono: </b>{{ $reclamo->conductor ? $reclamo->conductor->telefono : '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Domicilio: </b>{{ $reclamo->conductor ? $reclamo->conductor->domicilio : '' }}
                    </td>
                    <td>
                        <b>Código Postal: </b>{{ $reclamo->conductor ? $reclamo->conductor->codigo_postal : '' }}
                    </td>
                </tr>
                <tr>
                    @if($reclamo->vehiculo && $reclamo->conductor->pais_id && $reclamo->conductor->province_id)
                        <td>
                            <b>País: </b>{{ $reclamo->conductor->pais->nombre }}
                        </td>
                        <td>
                            <b>Provincia: </b>{{ $reclamo->conductor->provincia->name }}
                        </td>
                        <td>
                            <b>Localidad: </b>{{ $reclamo->conductor->city_id != null ? $reclamo->conductor->localidad->name : $reclamo->conductor->otro_pais_provincia_localidad }}
                        </td>
                    @elseif($reclamo->conductor && $reclamo->conductor->otro_pais_provincia_localidad)
                        <td>
                            <b>Localidad/Provincia/Pais: </b>{{ $denuncia->conductor->otro_pais_provincia_localidad }}
                        </td>
                    @else
                        <td><b>País: </b></td>
                        <td><b>Provincia: </b></td>
                        <td><b>Localidad: </b></td>
                    @endif
                </tr>
            @endif
            <tr>
                <td>
                    <b>Número de Licencia: </b>{{ $reclamo->conductor ? $reclamo->conductor->licencia_numero : '' }}
                </td>
                <td colspan="2">
                    <b>Licencia Clase: </b>{{ $reclamo->conductor ? $reclamo->conductor->licencia_clase : '' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Lesionados</div>
        <table class="table tb-content pb-0">
            @if($reclamo->lesionados->count() > 0 || ($reclamo->conductor && $reclamo->conductor->lesiones))
                @if($reclamo->conductor && $reclamo->conductor->lesiones)
                    <tr>
                        <td colspan="{{ $reclamo->reclamante && $reclamo->reclamante->conductor ? '' : '3' }}">
                            <b>Tipo: </b>Conductor
                        </td>
                        @if($reclamo->reclamante && $reclamo->reclamante->conductor)
                            <td colspan="2">El conductor es el reclamante</td>
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <b>Gravedad: </b>{{ $reclamo->conductor->gravedad_lesion }}
                        </td>
                        <td>
                            <b>Alcoholemia: </b>{{ $reclamo->conductor->alcoholemia ? 'Si' : 'No' }}
                        </td>
                        <td>
                            <b>Se negó: </b>{{ $reclamo->conductor->alcoholemia_se_nego ? 'Si' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Centro Asistencial: </b>{{ $reclamo->conductor->centro_asistencial }}
                        </td>
                    </tr>
                @endif
                @foreach($reclamo->lesionados as $lesionado)
                        <tr>
                            <td colspan="3">
                                <b>Tipo: </b><span class="text-capitalize">{{ $lesionado->tipo }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Nombre: </b>{{ $lesionado->nombre }}</td>
                            <td><b>Teléfono: </b>{{ $lesionado->telefono }}</td>
                        </tr>
                        <tr>
                            <td><b>Tipo Documento: </b>{{ $lesionado->tipoDocumento->nombre }}</td>
                            <td><b>Número de Documento: </b>{{ $lesionado->documento_numero }}</td>
                            <td><b>Fecha de Nacimiento: </b>{{ $lesionado->fecha_nacimiento->toDateString() }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Domicilio: </b>{{ $lesionado->domicilio }}</td>
                            <td><b>Código Postal: </b>{{ $lesionado->codigo_postal }}</td>
                        </tr>
                        @if($lesionado->pais_id && $lesionado->province_id)
                            <tr>
                                <td><b>País: </b>{{ $lesionado->pais->nombre }}</td>
                                <td><b>Provincia: </b>{{ $lesionado->provincia->name }}</td>
                                <td>
                                    <b>Localidad: </b>
                                    {{ $lesionado->city_id != null ? $lesionado->localidad->name : $lesionado->otro_pais_provincia_localidad }}
                                </td>
                            </tr>
                        @elseif($lesionado->otro_pais_provincia_localidad)
                            <tr>
                                <td colspan="3"><b>Localidad/Provincia/Pais: </b>{{ $lesionado->otro_pais_provincia_localidad }}</td>
                            </tr>
                        @else
                            <tr>
                                <td><b>País: </b></td>
                                <td><b>Provincia: </b></td>
                                <td><b>Localidad: </b></td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                <b>Gravedad: </b>{{ $lesionado->gravedad_lesion }}
                            </td>
                            <td>
                                <b>Alcoholemia: </b>{{ $lesionado->alcoholemia ? 'Si' : 'No' }}
                            </td>
                            <td>
                                <b>Se negó: </b>{{ $lesionado->alcoholemia_se_nego ? 'Si' : 'No' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <b>Centro Asistencial: </b>{{ $lesionado->centro_asistencial }}
                            </td>
                        </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center">Sin lesionados</td>
                </tr>
            @endif

        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Daños Materiales</div>
        <table class="table tb-content pb-0">
            @foreach($reclamo->daniosMateriales as $danio_material)
                <tr>
                    <td colspan="2">
                        <b>Tipo: </b>{{ $danio_material->tipo }}
                    </td>
                    <td>
                        <b>Detalles: </b>{{ $danio_material->detalles }}
                    </td>
                </tr>
            @endforeach
            @if($reclamo->daniosMateriales->count() == 0)
                <tr><td class="text-center">Sin daños materiales</td></tr>
            @endif
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Lugar del Siniestro</div>
        <table class="table tb-content pb-0">
            <tr>
                <td colspan="3">
                    <b>Lugar: </b>{{ $reclamo->lugar_nombre }}
                </td>
            </tr>
            <tr>
                @if($reclamo->pais_id && $reclamo->province_id)
                    <td>
                        <b>País: </b>{{ $reclamo->pais->nombre }}
                    </td>
                    <td>
                        <b>Provincia: </b>{{ $reclamo->provincia->name }}
                    </td>
                    <td>
                        <b>Localidad: </b>{{ $reclamo->city_id != null ? $reclamo->localidad->name : $reclamo->otro_pais_provincia_localidad }}
                    </td>
                @elseif($reclamo->otro_pais_provincia_localidad)
                    <td colspan="3">
                        <b>Localidad/Provincia/Pais: </b>{{ $reclamo->otro_pais_provincia_localidad }}
                    </td>
                @else
                    <td><b>País: </b></td>
                    <td><b>Provincia: </b></td>
                    <td><b>Localidad: </b></td>
                @endif
            </tr>
            <tr>
                <td colspan="2">
                    <b>Calle/Ruta: </b>{{ $reclamo->calle }}
                </td>
                <td >
                    <b>Tipo Calzada: </b>{{ $reclamo->tipo_calzada_id != null ? $reclamo->tipoCalzada->nombre : ''}}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Detalle Calzada: </b>{{ $reclamo->calle }}
                </td>
                <td >
                    <b>Intersección: </b>{{ $reclamo->interseccion }}
                </td>
                <td >
                    <b>Cruce Señalizado: </b>{{ $reclamo->cruce_senalizado ? 'Si' : 'No' }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Barrera de tren señalizado: </b>{{ $reclamo->tren != null ? ($reclamo->tren ? 'Si' : 'No') : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Semaforo: </b>{{ $reclamo->semaforo ? 'Si' : 'No' }}
                </td>
            </tr>
            @if($reclamo->semaforo)
            <tr>
                <td>
                    <b>Funciona: </b>{{ $reclamo->semaforo_funciona ? 'Si' : 'No' }}
                </td>
                <td >
                    <b>Intermitente: </b>{{ $reclamo->semaforo_funciona ? 'Si' : 'No' }}
                </td>
                <td >
                    <b>Color: </b>{{ $reclamo->semaforo_color }}
                </td>
            </tr>
            @endif
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Croquis del Siniestro</div>
    </div>

    <table class="table tb-content">
        <tr>
            <td colspan="3">
                <b>Croquis: </b>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <img class="w-100" src="{{ $reclamo->croquis_url }}">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <b>Descripción: </b>{{ $reclamo->descripcion }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <b>Comisaría: </b>{{ $reclamo->comisaria }}
            </td>
        </tr>
    </table>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Montos que reclama</div>
        <table class="table tb-content pb-0">
            <tr>
                <td>
                    <b>Daño Vehicular: </b>$ {{ $reclamo->monto_vehicular != null ? $reclamo->monto_vehicular : '0'}}
                </td>
                <td>
                    <b>Daños Materiales: </b>$ {{ $reclamo->monto_danios_materiales != null ? $reclamo->monto_danios_materiales : '0' }}
                </td>
                <td>
                    <b>Lesiones: </b>$ {{ $reclamo->monto_lesiones != null ? $reclamo->monto_lesiones : '0' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default mt-3">
        <div class="panel-heading">Testigos</div>
        <table class="table tb-content pb-0">
            @if($reclamo->testigos()->count() > 0)
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Domicilio</th>
                </tr>
            @endif
            @foreach($reclamo->testigos as $testigo)
                <tr>
                    <td>{{ $testigo->nombre }}</td>
                    <td>{{ $testigo->telefono }}</td>
                    <td>{{ $testigo->domicilio_completo }}</td>
                </tr>
            @endforeach
            @if($reclamo->testigos()->count() == 0)
                <tr>
                    <td class="text-center">Sin testigos</td>
                </tr>
            @endif
        </table>
    </div>
</main>
</body>
</html>

