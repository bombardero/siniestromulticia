    <form class="" action='{{route("siniestros.terceros.paso4.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="reclamo_vehicular" value="{{ $reclamo->reclamo_vehicular ? '1' : '0' }}">
    <input type="hidden" name="reclamo_lesiones" value="{{ $reclamo->reclamo_lesiones ? '1' : '0' }}">
    <input type="hidden" name="conductor" value="{{ $conductor }}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 4 </b>de 8 | Datos del Conductor</span>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : ($reclamo->conductor ? $reclamo->conductor->nombre : '') }}"
                           {{ !$conductor  ? 'disabled' : '' }}
                    >
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono </label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') ? old('telefono') : ($reclamo->conductor ? $reclamo->conductor->telefono : '') }}"
                        {{ !$conductor ? 'disabled' : '' }}
                    >
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento *</label>
                    <select name="tipo_documento_id" id="tipo_documento"
                            class="custom-select"
                            {{ !$conductor ? 'disabled' : '' }}
                    >
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}"
                                {{ old('tipo_documento_id') == $tipo_documento->id || ($reclamo->conductor &&  $reclamo->conductor->tipo_documento_id == $tipo_documento->id) ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento</label>
                    <input type="text" name="documento_numero" id="documento_numero" maxlength="8"
                           class="form-control @error('documento_numero') is-invalid @enderror"
                           value="{{ old('documento_numero') ? old('documento_numero') : ($reclamo->conductor ? $reclamo->conductor->documento_numero : '') }}"
                           {{ !$conductor ? 'disabled' : '' }}
                    >
                    @error('documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                           class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                           value="{{ old('fecha_nacimiento') ? old('fecha_nacimiento') : ($reclamo->conductor ? $reclamo->conductor->fecha_nacimiento : '') }}"
                    >
                    @error('fecha_nacimiento') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                           class="form-control @error('domicilio') is-invalid @enderror"
                           value="{{ old('domicilio') ? old('domicilio') : ($reclamo->conductor ? $reclamo->conductor->domicilio : '') }}"
                        {{ !$conductor ? 'disabled' : '' }}
                    >
                    @error('domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal *</label>
                    <input type="text" id="codigo_postal" name="codigo_postal"
                           class="form-control @error('codigo_postal') is-invalid @enderror"
                           value="{{ old('codigo_postal') ? old('codigo_postal') : ($reclamo->conductor ? $reclamo->conductor->codigo_postal : '') }}"
                           {{ !$conductor ? 'disabled' : '' }}
                    >
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País *</label>
                    <select name="pais" id="pais" class="custom-select"
                            {{ !$conductor ? 'disabled' : '' }}
                    >
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->conductor && $reclamo->conductor->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->conductor && $reclamo->conductor->pais_id == null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->conductor && !$reclamo->conductor->conductor_pais_id && !$reclamo->conductor->conductor_province_id && !$reclamo->conductor->city_id)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($reclamo->conductor && $reclamo->conductor->otro_pais_provincia_localidad != null ? $reclamo->conductor->otro_pais_provincia_localidad : '') }}"
                           {{ !$conductor ? 'disabled' : '' }}
                    >
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->conductor && $reclamo->conductor->province_id == null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia *</label>
                    <select name="provincia_id" id="provincias" class="custom-select"
                            {{ !$conductor ? 'disabled' : '' }}
                    >
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($reclamo->conductor && $reclamo->conductor->province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->conductor && !$reclamo->conductor->pais_id && !$reclamo->conductor->province_id) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad *</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades"
                                class="custom-select {{ old('check_otra_localidad') || ($reclamo->conductor && $reclamo->conductor->otro_pais_provincia_localidad) ? 'd-none' :  '' }}"
                                {{ !$conductor ? 'disabled' : '' }}
                        >
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->conductor && $reclamo->conductor->city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || ($reclamo->conductor && $reclamo->conductor->otro_pais_provincia_localidad) ? '' : 'd-none' }} @error('otra_localidad') is-invalid @enderror"
                               value="{{ $reclamo->conductor && $reclamo->conductor->otro_pais_provincia_localidad != null ? $reclamo->conductor->otro_pais_provincia_localidad : '' }}"
                               {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || ($reclamo->conductor && $reclamo->conductor->otro_pais_provincia_localidad) ? 'checked' :  '' }}
                                       {{ !$conductor ? 'disabled' : '' }}
                                >Otra
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
                           value="{{ old('licencia_numero') != null  ? old('licencia_numero') : ($reclamo->conductor ? $reclamo->conductor->licencia_numero : '') }}"
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    @error('licencia_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="licencia_clase">Clase de Licencia</label>
                    <input type="text" id="licencia_clase" name="licencia_clase"
                           class="form-control @error('licencia_clase') is-invalid @enderror"
                           value="{{ old('licencia_clase') ? old('licencia_clase') : ($reclamo->conductor ? $reclamo->conductor->licencia_clase : '') }}"
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    @error('licencia_clase') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-4">
                <label>Examen de alcoholemia *</label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_si" value="1" name="alcoholemia"
                        {{ old('alcoholemia') === '1' ? 'checked' :  ($reclamo->conductor && $reclamo->conductor->alcoholemia ? 'checked' : '') }}
                        {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    <label class="form-check-label" for="checkbox_alcoholemia_si">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_no" value="0" name="alcoholemia"
                        {{ old('alcoholemia') === '0' ? 'checked' : ($reclamo->conductor && $reclamo->conductor->alcoholemia === false ? 'checked' : '') }}
                        {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    <label class="form-check-label" for="checkbox_alcoholemia_no">No</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="alcoholemia_nego" id="checkbox_alcoholemia_nego"
                            {{ old('alcoholemia_nego') ? 'checked' : ($reclamo->conductor && $reclamo->conductor->alcoholemia_se_nego ? 'checked' : '') }}
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    <label for="checkbox_alcoholemia_nego" class="form-check-label">Se negó</label>
                </div>
            </div>
            <div class="col-12 col-md-8 offset-md-4">
                @error('alcoholemia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        </div>

        @if($reclamo->reclamo_lesiones)
            <div class="row mb-2">
                <div class="col-12 col-md-4">
                    <label>¿Sufrió lesiones?</label>
                </div>
                <div class="col-12 col-md-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="form-check-input" id="lesiones_si"
                               name="lesiones"
                               value="1"
                            {{ old('lesiones') === '1' || ($reclamo->conductor && $reclamo->conductor->lesiones) ? 'checked' : '' }}
                        >
                        <label for="lesiones_si" class="form-check-label">Si</label>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="form-check-input" id="lesiones_no"
                               name="lesiones"
                               value="0"
                            {{ old('lesiones') === '0' || ($reclamo->conductor && $reclamo->conductor->lesiones === false) ? 'checked' : '' }}
                        >
                        <label for="lesiones_no" class="form-check-label">No</label>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-md-4">
                    @error('lesiones') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <label>Tipo de lesiones</label>
                </div>
                <div class="col-12 col-md-2">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="form-check-input"
                               id="gravedad_lesion_leve" name="gravedad_lesion" value="leve"
                                {{ old('gravedad_lesion') === 'leve' || ($reclamo->conductor && $reclamo->conductor->gravedad_lesion === 'leve') ? 'checked' : '' }}
                        >
                        <label for="gravedad_lesion_leve">Leve</label>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="form-check-input"
                               id="gravedad_lesion_grave" name="gravedad_lesion" value="grave"
                                {{ old('gravedad_lesion') === 'grave' || ($reclamo->conductor && $reclamo->conductor->gravedad_lesion === 'grave') ? 'checked' : '' }}
                        >
                        <label for="gravedad_lesion_grave">Grave</label>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="form-check-input"
                               id="gravedad_lesion_mortal" name="gravedad_lesion" value="mortal"
                                {{ old('gravedad_lesion') === 'mortal' || ($reclamo->conductor && $reclamo->conductor->gravedad_lesion === 'mortal') ? 'checked' : '' }}
                        >
                        <label for="gravedad_lesion_mortal">Mortal</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-4">
                    @error('gravedad_lesion') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <label for="centro_asistencial">Centro Asistencial</label>
                </div>
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <input type="text" name="centro_asistencial" id="centro_asistencial"
                               class="form-control"
                               value="{{ old('centro_asistencial') ? old('centro_asistencial') : ($reclamo->conductor ? $reclamo->conductor->centro_asistencial : '') }}"
                        >
                        @error('centro_asistencial') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('siniestros.terceros.paso3.create',['id' => request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script src="{{ asset('js/pais_provincia_localidad.js')}}"></script>

<script type="text/javascript">

    $("input[type='radio'][name='lesiones']").change(function () {
        if($(this).val() === '1')
        {
            $('#gravedad_lesion_leve').attr('disabled', false);
            $('#gravedad_lesion_grave').attr('disabled', false);
            $('#gravedad_lesion_mortal').attr('disabled', false);
            $('#centro_asistencial').attr('disabled', false);
        } else {
            $('#gravedad_lesion_leve').attr('disabled', true);
            $('#gravedad_lesion_grave').attr('disabled', true);
            $('#gravedad_lesion_mortal').attr('disabled', true);
            $('#centro_asistencial').attr('disabled', true);
        }
    });



    $( document ).ready(function() {
        if($('#lesiones_si').is(':checked'))
        {
            $('#gravedad_lesion_leve').attr('disabled', false);
            $('#gravedad_lesion_grave').attr('disabled', false);
            $('#gravedad_lesion_mortal').attr('disabled', false);
            $('#centro_asistencial').attr('disabled', false);
        }
        if($('#lesiones_no').is(':checked'))
        {
            $('#gravedad_lesion_leve').attr('disabled', true);
            $('#gravedad_lesion_grave').attr('disabled', true);
            $('#gravedad_lesion_mortal').attr('disabled', true);
            $('#centro_asistencial').attr('disabled', true);
        }
    });
</script>
@endsection
