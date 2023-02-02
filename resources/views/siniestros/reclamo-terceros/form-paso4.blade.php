<form class="" action='{{route("siniestros.terceros.paso4.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 4 </b>de 8 | Datos del Vehículo Asegurado</span>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 mt-3">
                <label><b>Vehículo</b></label>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <div class="input-group">
                        <select name="marca_id" id="marca-select" class="custom-select {{ old('otra_marca') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otra_marca) ? 'd-none' : '' }} @error('marca_id') is-invalid @enderror">
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}"
                                    {{ old('marca_id') == $marca->id || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->marca_id == $marca->id) ? 'selected' : '' }}
                                >{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="marca-text" name="marca"
                               class="form-control {{ old('otra_marca') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otra_marca) ? '' : 'd-none' }} @error('marca') is-invalid @enderror"
                               value="{{ old('marca') ? old('marca') : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otra_marca ? $reclamo->vehiculoAsegurado->otra_marca : '') }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otra_marca" id="otra-marca"
                                       class="mr-1"
                                        {{ old('otra_marca') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otra_marca) ? 'checked' : '' }}
                                >Otra
                            </div>
                        </div>
                        @error('marca_id') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        @error('marca') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <div class="input-group">
                        <select name="modelo_id" id="modelo-select" class="custom-select {{ old('otro_modelo') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otro_modelo) ? 'd-none' : '' }} @error('modelo_id') is-invalid @enderror">
                            @foreach($modelos as $modelo)
                                <option value="{{ $modelo->id }}"
                                    {{  old('modelo_id') == $marca->id || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->modelo_id == $modelo->id) ? 'selected' : '' }}
                                >{{ $modelo->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="modelo-text" name="modelo"
                               class="form-control {{ old('otro_modelo') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otro_modelo) ? '' : 'd-none' }} @error('modelo') is-invalid @enderror"
                               value="{{ old('modelo') ? old('modelo') : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otro_modelo ? $reclamo->vehiculoAsegurado->otro_modelo : '') }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otro_modelo" id="otro-modelo" class="mr-1" {{ old('otro_modelo') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otro_modelo) ? 'checked' : '' }}>Otro
                            </div>
                        </div>
                        @error('modelo_id') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        @error('modelo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_tipo">Tipo de Vehículo</label>
                    <input type="text" id="vehiculo_tipo" name="vehiculo_tipo"
                           class="form-control @error('vehiculo_tipo') is-invalid @enderror"
                           value="{{ old('vehiculo_tipo') ? old('vehiculo_tipo') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->tipo : '') }}"
                    >
                    @error('vehiculo_tipo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_anio">Año</label>
                    <input type="text" id="vehiculo_anio" name="vehiculo_anio"
                           class="form-control @error('vehiculo_anio') is-invalid @enderror"
                           value="{{ old('vehiculo_anio') ? old('vehiculo_anio') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->anio : '') }}"
                    >
                    @error('vehiculo_anio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_dominio">Dominio</label>
                    <input type="text" id="vehiculo_dominio" name="vehiculo_dominio"
                           class="form-control text-uppercase @error('vehiculo_dominio') is-invalid @enderror"
                           readonly
                           value="{{ $reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->dominio : $reclamo->dominio_vehiculo_asegurado }}">
                    @error('vehiculo_dominio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 mt-3">
                <label><b>Conductor</b></label>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : $reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->conductor_nombre : '' }}"
                    >
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="tipo_documento_id" id="tipo_documento"
                            class="custom-select">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}"
                                {{ old('tipo_documento_id') == $tipo_documento->id || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_tipo_documento_id == $tipo_documento->id) ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento</label>
                    <input type="text" name="documento_numero" id="documento_numero" maxlength="8"
                           class="form-control @error('documento_numero') is-invalid @enderror"
                           value="{{ old('documento_numero') ? old('documento_numero') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->conductor_documento_numero : '') }}">
                    @error('documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') ? old('telefono') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->conductor_telefono : '') }}">
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                           class="form-control @error('domicilio') is-invalid @enderror"
                           value="{{ old('domicilio') ? old('domicilio') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->conductor_domicilio : '') }}">
                    @error(' domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" id="codigo_postal" name="codigo_postal"
                           class="form-control @error('codigo_postal') is-invalid @enderror"
                           value="{{ old('codigo_postal') ? old('codigo_postal') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->conductor_codigo_postal : '') }}">
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País</label>
                    <select name="pais" id="pais" class="custom-select">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_pais_id == null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculoAsegurado && !$reclamo->vehiculoAsegurado->conductor_pais_id && !$reclamo->vehiculoAsegurado->conductor_province_id && !$reclamo->vehiculoAsegurado->conductor_city_id)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otro_pais_provincia_localidad != null ? $reclamo->vehiculoAsegurado->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_province_id == null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select name="provincia_id" id="provincias" class="custom-select">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculoAsegurado && !$reclamo->vehiculoAsegurado->conductor_pais_id && !$reclamo->vehiculoAsegurado->conductor_province_id) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades" class="custom-select {{ old('check_otra_localidad') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_otro_pais_provincia_localidad) ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_otro_pais_provincia_localidad) ? '' : 'd-none' }} @error('otra_localidad') is-invalid @enderror"
                               value="{{ $reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_otro_pais_provincia_localidad != null ? $reclamo->vehiculoAsegurado->conductor_otro_pais_provincia_localidad : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->conductor_otro_pais_provincia_localidad) ? 'checked' :  '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <label>Es el propietario del vehículo</label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="propietario_conductor_si"
                           name="propietario_conductor"
                           value="1" {{ (old('propietario_conductor') && old('propietario_conductor') === '1') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_conductor === true) ? 'checked' : '' }}>
                    <label for="propietario_conductor_si" class="form-check-label">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="propietario_conductor_no"
                           name="propietario_conductor"
                           value="0" {{ (old('propietario_conductor') && old('propietario_conductor') === '0') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_conductor === false) ? 'checked' : '' }}>
                    <label for="propietario_conductor_no" class="form-check-label">No</label>
                </div>
            </div>
            <div class="col-12 offset-md-4 col-md-8">
                @error('propietario_conductor') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script src="{{ asset('js/pais_provincia_localidad.js')}}"></script>
<script src="{{ asset('js/marca_modelo.js')}}"></script>

<script type="text/javascript">
    $("input[type='radio'][name='vehiculo']").change(function () {
        if($(this).val() === '1')
        {
            deshabilitarCampos(false);
        } else {
            deshabilitarCampos();
        }
    });

    function deshabilitarCampos(deshabilitar = true)
    {
        $('#marca-select').attr('disabled', deshabilitar);
        $('#marca-text').attr('disabled', deshabilitar);
        $('#otra-marca').attr('disabled', deshabilitar);
        $('#modelo-select').attr('disabled', deshabilitar);
        $('#modelo-text').attr('disabled', deshabilitar);
        $('#otro-modelo').attr('disabled', deshabilitar);
        $('#vehiculo_tipo').attr('disabled', deshabilitar);
        $('#vehiculo_anio').attr('disabled', deshabilitar);
        $('#vehiculo_dominio').attr('disabled', deshabilitar);
        $('#compania_seguros').attr('disabled', deshabilitar);
        $('#numero_poliza').attr('disabled', deshabilitar);
        $('#tipo_cobertura').attr('disabled', deshabilitar);
        $('#franquicia').attr('disabled', deshabilitar);
        $('#reclamante_conductor_si').attr('disabled', deshabilitar);
        $('#reclamante_conductor_no').attr('disabled', deshabilitar);
    }

    $( document ).ready(function() {
        if($('#vehiculo_si').is(':checked'))
        {
            deshabilitarCampos(false);
        }
        if($('#vehiculo_no').is(':checked'))
        {
            deshabilitarCampos();
        }
    });
</script>
@endsection
