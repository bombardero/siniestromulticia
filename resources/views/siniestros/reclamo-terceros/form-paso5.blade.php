<form class="" action='{{route("siniestros.terceros.paso5.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 5 </b>de 8 | Datos del Vehículo Asegurado</span>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 mt-3">
                <label><b>Propitario</b></label>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : $reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->propietario_nombre : '' }}"
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
                                {{ old('tipo_documento_id') == $tipo_documento->id || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_tipo_documento_id == $tipo_documento->id) ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento</label>
                    <input type="text" name="documento_numero" id="documento_numero" maxlength="8"
                           class="form-control @error('documento_numero') is-invalid @enderror"
                           value="{{ old('documento_numero') ? old('documento_numero') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->propietario_documento_numero : '') }}">
                    @error('documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') ? old('telefono') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->propietario_telefono : '') }}">
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                           class="form-control @error('domicilio') is-invalid @enderror"
                           value="{{ old('domicilio') ? old('domicilio') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->propietario_domicilio : '') }}">
                    @error(' domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" id="codigo_postal" name="codigo_postal"
                           class="form-control @error('codigo_postal') is-invalid @enderror"
                           value="{{ old('codigo_postal') ? old('codigo_postal') : ($reclamo->vehiculoAsegurado ? $reclamo->vehiculoAsegurado->propietario_codigo_postal : '') }}">
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País</label>
                    <select name="pais" id="pais" class="custom-select">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_pais_id == null && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad != null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculoAsegurado && !$reclamo->vehiculoAsegurado->propietario_pais_id && !$reclamo->vehiculoAsegurado->propietario_province_id && !$reclamo->vehiculoAsegurado->propietario_city_id && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->otro_pais_provincia_localidad != null ? $reclamo->vehiculoAsegurado->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_province_id == null && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select name="provincia_id" id="provincias" class="custom-select">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculoAsegurado && !$reclamo->vehiculoAsegurado->propietario_pais_id && !$reclamo->vehiculoAsegurado->propietario_province_id && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades" class="custom-select {{ old('check_otra_localidad') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad) ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad) ? '' : 'd-none' }} @error('otra_localidad') is-invalid @enderror"
                               value="{{ $reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad != null ? $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || ($reclamo->vehiculoAsegurado && $reclamo->vehiculoAsegurado->propietario_otro_pais_provincia_localidad) ? 'checked' :  '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
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
        $('#compania_seguros').attr('disabled', deshabilitar);
        $('#numero_poliza').attr('disabled', deshabilitar);
        $('#tipo_cobertura').attr('disabled', deshabilitar);
        $('#franquicia').attr('disabled', deshabilitar);
        $('#reclamante_propietario_si').attr('disabled', deshabilitar);
        $('#reclamante_propietario_no').attr('disabled', deshabilitar);
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
