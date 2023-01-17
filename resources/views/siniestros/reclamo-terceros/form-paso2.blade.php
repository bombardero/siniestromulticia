<form class="" action='{{route("siniestros.terceros.paso2.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 2 </b>de 6 | Datos del Vehículo</span>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-4">
                <label>Tengo un vehículo involucrado</label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="vehiculo_si"
                           name="vehiculo"
                           value="1" {{ old('vehiculo') && old('vehiculo') === '1' ? 'checked' : ($reclamo->dominio_vehiculo_tercero != null ? 'checked' : '') }}>
                    <label for="vehiculo_si" class="form-check-label">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="vehiculo_no"
                           name="vehiculo"
                           value="0" {{ old('vehiculo') && old('vehiculo') === '0' ? 'checked' : '' }}>
                    <label for="vehiculo_no" class="form-check-label">No</label>
                </div>
            </div>
            <div class="col-12 offset-md-4 col-md-8">
                @error('vehiculo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

            <div class="col-12 mt-3">
                <label><b>Vehículo</b></label>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <div class="input-group">
                        <select name="marca_id" id="marca-select" class="custom-select {{ old('otra_marca') ? 'd-none' : '' }} @error('marca_id') is-invalid @enderror">
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}"
                                    {{ old('marca_id') == $marca->id || ($reclamo->vehiculo && $reclamo->vehiculo->marca_id == $marca->id) ? 'selected' : '' }}
                                >{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="marca-text" name="marca"
                               class="form-control {{ old('otra_marca') ? '' : 'd-none' }} @error('marca') is-invalid @enderror"
                               value=""
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otra_marca" id="otra-marca" class="mr-1" {{ old('otra_marca') ? 'checked' : '' }}>Otra
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
                        <select name="modelo_id" id="modelo-select" class="custom-select {{ old('otro_modelo') ? 'd-none' : '' }} @error('modelo_id') is-invalid @enderror">
                            @foreach($modelos as $modelo)
                                <option value="{{ $modelo->id }}"
                                    {{  old('modelo_id') == $marca->id || ($reclamo->vehiculo && $reclamo->vehiculo->modelo_id == $modelo->id) ? 'selected' : '' }}
                                >{{ $modelo->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="modelo-text" name="modelo"
                               class="form-control {{ old('otro_modelo') ? '' : 'd-none' }} @error('modelo') is-invalid @enderror"
                               value=""
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otro_modelo" id="otro-modelo" class="mr-1" {{ old('otro_modelo') ? 'checked' : '' }}>Otro
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
                           value="{{ old('vehiculo_tipo') ? old('vehiculo_tipo') : ($reclamo->vehiculo ? $reclamo->vehiculo->tipo : '') }}"
                    >
                    @error('vehiculo_tipo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_anio">Año</label>
                    <input type="text" id="vehiculo_anio" name="vehiculo_anio"
                           class="form-control @error('vehiculo_anio') is-invalid @enderror"
                           value="{{ old('vehiculo_anio') ? old('vehiculo_anio') : ($reclamo->vehiculo ? $reclamo->vehiculo->anio : '') }}"
                    >
                    @error('vehiculo_anio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_dominio">Dominio</label>
                    <input type="text" id="vehiculo_dominio" name="vehiculo_dominio"
                           class="form-control text-uppercase @error('vehiculo_dominio') is-invalid @enderror"
                           value="{{ old('vehiculo_dominio') ? old('vehiculo_dominio') : ($reclamo->vehiculo ? $reclamo->vehiculo->dominio : $reclamo->dominio_vehiculo_tercero) }}">
                    @error('vehiculo_dominio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

                <div class="col-12 mt-3">
                <label><b>Seguro del vehículo</b></label>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="compania_seguro">Compañía de Seguro</label>
                    <input type="text" id="compania_seguro" name="compania_seguro"
                           class="form-control @error('compania_seguro') is-invalid @enderror"
                           value="{{ old('compania_seguro') ? old('compania_seguro') : ($reclamo->vehiculo ? $reclamo->vehiculo->compania_seguro : '') }}"
                    >
                    @error('compania_seguro') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="numero_poliza">Número de Póliza</label>
                    <input type="text" id="numero_poliza" name="numero_poliza"
                           class="form-control @error('numero_poliza') is-invalid @enderror"
                           value="{{ old('numero_poliza') ? old('numero_poliza') : ($reclamo->vehiculo ? $reclamo->vehiculo->numero_poliza : '') }}"
                    >
                    @error('numero_poliza') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="tipo_cobertura">Tipo de Cobertura</label>
                    <input type="text" id="tipo_cobertura" name="tipo_cobertura"
                           class="form-control @error('tipo_cobertura') is-invalid @enderror"
                           value="{{ old('tipo_cobertura') ? old('tipo_cobertura') : ($reclamo->vehiculo ? $reclamo->vehiculo->tipo_cobertura : '') }}"
                    >
                    @error('tipo_cobertura') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="franquicia">Franquicia</label>
                    <input type="text" id="franquicia" name="franquicia"
                           class="form-control @error('franquicia') is-invalid @enderror"
                           value="{{ old('franquicia') ? old('franquicia') : ($reclamo->vehiculo ? $reclamo->vehiculo->franquicia : '') }}"
                    >
                    @error('franquicia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 mt-3">
                <label><b>Conductor</b></label>
            </div>

            <div class="col-12 col-md-4">
                <label>El conductor es el reclamante</label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="reclamante_conductor_si"
                           name="reclamante_conductor"
                           value="1"
                           {{ old('reclamante_conductor') === '1' ? 'checked' : '' }}
                    >
                    <label for="reclamante_conductor_si" class="form-check-label">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="reclamante_conductor_no"
                           name="reclamante_conductor"
                           value="0"
                           {{ old('reclamante_conductor') === '0' ? 'checked' : '' }}
                    >
                    <label for="reclamante_conductor_no" class="form-check-label">No</label>
                </div>
            </div>

            <div class="col-12 offset-md-4 col-md-8 mb-2">
                @error('reclamante_conductor') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="conductor_nombre">Nombre y Apellido</label>
                    <input type="text" name="conductor_nombre" id="conductor_nombre" placeholder="Nombre completo"
                           class="form-control @error('conductor_nombre') is-invalid @enderror"
                           value="{{ $reclamo->vehiculo ? $reclamo->vehiculo->conductor_nombre : '' }}"
                    >
                    @error('conductor_nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_telefono">Teléfono </label>
                    <input type="text" id="conductor_telefono" name="conductor_telefono"
                           class="form-control @error('conductor_telefono') is-invalid @enderror"
                           value="{{ $reclamo->vehiculo ? $reclamo->vehiculo->conductor_telefono : '' }}">
                    @error('conductor_telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="conductor_domicilio">Domicilio</label>
                    <input type="text" name="conductor_domicilio" id="conductor_domicilio"
                           class="form-control @error('conductor_domicilio') is-invalid @enderror"
                           value="{{ $reclamo->vehiculo ? $reclamo->vehiculo->domicilio : '' }}">
                    @error('conductor_domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_codigo_postal">Código Postal *</label>
                    <input type="text" id="conductor_codigo_postal" name="conductor_codigo_postal"
                           class="form-control @error('conductor_codigo_postal') is-invalid @enderror"
                           value="{{ ($reclamo->vehiculo && $reclamo->vehiculo->conductor_codigo_postal) ? $reclamo->vehiculo->conductor_codigo_postal : '' }}">
                    @error('conductor_codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País *</label>
                    <select name="pais" id="pais" class="custom-select">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->vehiculo && $reclamo->vehiculo->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->vehiculo && $reclamo->vehiculo->pais_id == null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo && !$reclamo->vehiculo->pais_id && !$reclamo->vehiculo->province_id && !$reclamo->vehiculo->city_id)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad != null ? $reclamo->vehiculo->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo && $reclamo->vehiculo->province_id == null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia *</label>
                    <select name="asegurado_provincia_id" id="provincias" class="custom-select">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($reclamo->vehiculo && $reclamo->vehiculo->province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo && !$reclamo->vehiculo->pais_id && !$reclamo->vehiculo->province_id) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad *</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades" class="custom-select {{ old('check_otra_localidad') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad) ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->vehiculo && $reclamo->vehiculo->city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad) ? '' : 'd-none' }} @error('otra_localidad') is-invalid @enderror"
                               value="{{ $reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad != null ? $reclamo->vehiculo->otro_pais_provincia_localidad : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad) ? 'checked' :  '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="licencia_numero">Número de Licencia</label>
                    <input type="text" name="licencia_numero" id="licencia_numero"
                           class="form-control @error('licencia_numero') is-invalid @enderror"
                           value="{{ ($reclamo->vehiculo && $reclamo->vehiculo->licencia_numero) ? $reclamo->vehiculo->licencia_numero : '' }}">
                    @error('licencia_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="licencia_clase">Clase de Licencia</label>
                    <input type="text" id="licencia_clase" name="licencia_clase"
                           class="form-control @error('licencia_clase') is-invalid @enderror"
                           value="{{ ($reclamo->vehiculo && $reclamo->vehiculo->licencia_clase) ? $reclamo->vehiculo->licencia_clase : '' }}">
                    @error('licencia_clase') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
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
        $('#compania_seguro').attr('disabled', deshabilitar);
        $('#numero_poliza').attr('disabled', deshabilitar);
        $('#tipo_cobertura').attr('disabled', deshabilitar);
        $('#franquicia').attr('disabled', deshabilitar);
        $('#reclamante_conductor_si').attr('disabled', deshabilitar);
        $('#reclamante_conductor_no').attr('disabled', deshabilitar);
        if(deshabilitar)
        {
            deshabilitarConductor();
        }
        if(!deshabilitar && $('#reclamante_conductor_no').is(':checked'))
        {
            deshabilitarConductor(deshabilitar);
        }
    }

    $("input[type='radio'][name='reclamante_conductor']").change(function () {
        if($(this).val() === '1')
        {
            deshabilitarConductor();
        } else {
            deshabilitarConductor(false);
        }
    });

    function deshabilitarConductor(deshabilitar = true)
    {

        $('#conductor_nombre').attr('disabled', deshabilitar);
        $('#conductor_telefono').attr('disabled', deshabilitar);
        $('#conductor_domicilio').attr('disabled', deshabilitar);
        $('#conductor_codigo_postal').attr('disabled', deshabilitar);
        $('#pais').attr('disabled', deshabilitar);
        $('#provincias').attr('disabled', deshabilitar);
        $('#localidades').attr('disabled', deshabilitar);
        $('#otra_localidad').attr('disabled', deshabilitar);
        $('#check_otra_localidad').attr('disabled', deshabilitar);
        $('#otro_pais_provincia_localidad').attr('disabled', deshabilitar);
        $('#licencia_numero').attr('disabled', deshabilitar);
        $('#licencia_clase').attr('disabled', deshabilitar);
    }
</script>
@endsection
