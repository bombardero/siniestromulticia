    <form class="" action='{{route("siniestros.terceros.paso3.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 3 </b>de 8 | Datos del Conductor</span>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-4">
                <label>El reclamante es el conductor</label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="reclamante_conductor_si"
                           name="reclamante_conductor"
                           value="1"
                           {{ old('reclamante_conductor') === '1' || $reclamo->vehiculo->reclamante_conductor ? 'checked' : '' }}
                    >
                    <label for="reclamante_conductor_si" class="form-check-label">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="reclamante_conductor_no"
                           name="reclamante_conductor"
                           value="0"
                           {{ old('reclamante_conductor') === '0' || $reclamo->vehiculo->reclamante_conductor === false ? 'checked' : '' }}
                    >
                    <label for="reclamante_conductor_no" class="form-check-label">No</label>
                </div>
            </div>

            <div class="col-12 offset-md-4 col-md-8 mb-2">
                @error('reclamante_conductor') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : $reclamo->vehiculo->conductor_nombre }}"
                    >
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento *</label>
                    <select name="tipo_documento_id" id="tipo_documento"
                            class="custom-select">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}"
                                {{ old('tipo_documento_id') == $tipo_documento->id || $reclamo->vehiculo->conductor_tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento</label>
                    <input type="text" name="documento_numero" id="documento_numero" maxlength="8"
                           class="form-control @error('documento_numero') is-invalid @enderror"
                           value="{{ old('documento_numero') ? old('documento_numero') : $reclamo->vehiculo->conductor_documento_numero }}">
                    @error('documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono </label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') ? old('telefono') : $reclamo->vehiculo->conductor_telefono }}">
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                           class="form-control @error('domicilio') is-invalid @enderror"
                           value="{{ old('domicilio') ? old('domicilio') : $reclamo->vehiculo->conductor_domicilio }}">
                    @error('domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal *</label>
                    <input type="text" id="codigo_postal" name="codigo_postal"
                           class="form-control @error('codigo_postal') is-invalid @enderror"
                           value="{{ old('codigo_postal') ? old('codigo_postal') : $reclamo->vehiculo->conductor_codigo_postal }}">
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País *</label>
                    <select name="pais" id="pais" class="custom-select">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->vehiculo->conductor_pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->vehiculo->reclamante_conductor != null && $reclamo->vehiculo->conductor_pais_id == null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo->reclamante_conductor != null && !$reclamo->vehiculo->conductor_pais_id && !$reclamo->vehiculo->conductor_province_id && !$reclamo->vehiculo->conductor_city_id)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($reclamo->vehiculo->reclamante_conductor != null && $reclamo->vehiculo->otro_pais_provincia_localidad != null ? $reclamo->vehiculo->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo->reclamante_conductor != null && $reclamo->vehiculo->conductor_province_id == null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia *</label>
                    <select name="provincia_id" id="provincias" class="custom-select">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($reclamo->vehiculo->conductor_province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo->reclamante_conductor != null && !$reclamo->vehiculo->conductor_pais_id && !$reclamo->vehiculo->conductor_province_id) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad *</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades" class="custom-select {{ old('check_otra_localidad') || ($reclamo->vehiculo->conductor_otro_pais_provincia_localidad) ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->vehiculo->conductor_city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || ($reclamo->vehiculo->conductor_otro_pais_provincia_localidad) ? '' : 'd-none' }} @error('otra_localidad') is-invalid @enderror"
                               value="{{ $reclamo->vehiculo->conductor_otro_pais_provincia_localidad != null ? $reclamo->vehiculo->conductor_otro_pais_provincia_localidad : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || ($reclamo->vehiculo->conductor_otro_pais_provincia_localidad) ? 'checked' :  '' }}>Otra
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
                           value="{{ old('licencia_numero') ? old('licencia_numero') : $reclamo->vehiculo->licencia_numero }}">
                    @error('licencia_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="licencia_clase">Clase de Licencia</label>
                    <input type="text" id="licencia_clase" name="licencia_clase"
                           class="form-control @error('licencia_clase') is-invalid @enderror"
                           value="{{ old('licencia_clase') ? old('licencia_clase') : $reclamo->vehiculo->licencia_clase }}">
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

<script type="text/javascript">

    $("input[type='radio'][name='reclamante_conductor']").change(function () {
        if($(this).val() === '1')
        {
            deshabilitarCampos();
        } else {
            deshabilitarCampos(false);
        }
    });

    function deshabilitarCampos(deshabilitar = true)
    {

        $('#nombre').attr('disabled', deshabilitar);
        $('#tipo_documento').attr('disabled', deshabilitar);
        $('#documento_numero').attr('disabled', deshabilitar);
        $('#telefono').attr('disabled', deshabilitar);
        $('#domicilio').attr('disabled', deshabilitar);
        $('#codigo_postal').attr('disabled', deshabilitar);
        $('#pais').attr('disabled', deshabilitar);
        $('#provincias').attr('disabled', deshabilitar);
        $('#localidades').attr('disabled', deshabilitar);
        $('#otra_localidad').attr('disabled', deshabilitar);
        $('#check_otra_localidad').attr('disabled', deshabilitar);
        $('#otro_pais_provincia_localidad').attr('disabled', deshabilitar);
    }

    $( document ).ready(function() {
        if($('#reclamante_conductor_si').is(':checked'))
        {
            deshabilitarCampos();
        }
        if($('#reclamante_conductor_no').is(':checked'))
        {
            deshabilitarCampos(false);
        }
    });
</script>
@endsection
