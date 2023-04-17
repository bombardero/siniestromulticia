<form class="" action='{{route("siniestros.terceros.paso5.lesionado.update")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="lesionado" value="{{ $lesionado->id }}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">
            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 5</b> de 10 | Lesionados</span>
                <hr style="border:1px solid lightgray;">
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : $lesionado->nombre }}"
                    >
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') ? old('telefono') : $lesionado->telefono }}">
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="tipo_documento_id" id="tipo_documento"
                            class="custom-select">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}" {{ (old('tipo_documento_id') && old('tipo_documento_id') == $tipo_documento->id) || $lesionado->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento</label>
                    <input type="text" name="documento_numero" id="documento_numero" maxlength="8"
                           class="form-control @error('documento_numero') is-invalid @enderror"
                           value="{{ old('documento_numero') ? old('documento_numero') : $lesionado->documento_numero }}">
                    @error('documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                           class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                           value="{{ old('fecha_nacimiento') ? old('fecha_nacimiento') : $lesionado->fecha_nacimiento->toDateString() }}"
                    >
                    @error('fecha_nacimiento') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                           class="form-control @error('domicilio') is-invalid @enderror"
                           value="{{ old('domicilio') ? old('domicilio') : $lesionado->domicilio }}">
                    @error('domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" name="codigo_postal" id="codigo_postal"
                           class="form-control @error('codigo_postal') is-invalid @enderror"
                           value="{{ old('codigo_postal') ? old('codigo_postal') : $lesionado->codigo_postal }}">
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>


            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País</label>
                    <select name="pais" id="pais" class="custom-select">
                        <option
                            value="1" {{ (old('pais') && old('pais') == '1') || $lesionado->pais_id == '1' ?  'selected' : '' }}>
                            Argentina
                        </option>
                        <option
                            value="otro" {{ (old('pais') && old('pais') == 'otro') || $lesionado->pais_id == null ?  'selected' : '' }}>
                            Otro
                        </option>
                    </select>
                </div>
            </div>

            <div
                class="col-12 col-md-8 {{ old('pais') && old('pais') == 'otro' || (!$lesionado->pais_id && !$lesionado->province_id && !$lesionado->city_id) ? '' : 'd-none' }}"
                id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($lesionado->otro_pais_provincia_localidad != null ? $lesionado->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div
                class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || $lesionado->province_id == null ? 'd-none' : '' }}"
                id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select name="provincia_id" id="provincias" class="custom-select">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ (old('provincia_id') && old('provincia_id') == $provincia->id) || $lesionado->province_id == $provincia->id ? 'selected' : '' }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div
                class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || (!$lesionado->pais_id && !$lesionado->province_id) ?  'd-none' : '' }}"
                id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades"
                                class="custom-select {{ old('check_otra_localidad') || $lesionado->otro_pais_provincia_localidad ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ (old('localidad_id') && old('localidad_id') == $localidad->id) || $lesionado->city_id == $localidad->id ? 'selected' : '' }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || $lesionado->otro_pais_provincia_localidad ? '' : 'd-none' }}"
                               value="{{ old('otra_localidad') ? old('otra_localidad') : $lesionado->otro_pais_provincia_localidad }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || $lesionado->otro_pais_provincia_localidad ? 'checked' : '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12 mt-2">
                <div class="form-group mb-0">
                    <label>Tipos *</label>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="tipo_conductor"
                           name="tipo" value="conductor"
                           {{ (old('tipo') && old('tipo') == 'conductor') || $lesionado->tipo == 'conductor' ? 'checked' : '' }}
                    >
                    <label for="conductor">Conductor</label>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="tipo_pasajero"
                           name="tipo" value="pasajero"
                           {{ (old('tipo') && old('tipo') == 'pasajero') || $lesionado->tipo == 'pasajero' ? 'checked' : '' }}
                    >
                    <label for="pasajero_otro_vehiculo">Pasajero</label>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="tipo_peaton"
                           name="tipo" value="peaton"
                           {{ (old('tipo') && old('tipo') == 'peaton') || $lesionado->tipo == 'peaton' ? 'checked' : '' }}
                    >
                    <label for="peaton">Peatón</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @error('tipo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        </div>

        <hr style="border:1px solid lightgray;">

        <div class="row">
            <div class="col-12 col-md-4">
                <label>Tipo de lesiones</label>
            </div>
            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_leve" name="gravedad_lesion"
                           value="leve"
                            {{ (old('gravedad_lesion') && old('gravedad_lesion') == 'leve') || $lesionado->gravedad_lesion == 'leve' ? 'checked' : '' }}
                    >
                    <label for="checkbox_leve">Leve</label>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_grave" name="gravedad_lesion"
                           value="grave"
                            {{ (old('gravedad_lesion') && old('gravedad_lesion') == 'grave') || $lesionado->gravedad_lesion == 'grave' ? 'checked' : '' }}
                    >
                    <label for="checkbox_grave">Grave</label>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_mortal" name="gravedad_lesion"
                           value="mortal"
                            {{ (old('gravedad_lesion') && old('gravedad_lesion') == 'mortal') || $lesionado->gravedad_lesion == 'mortal' ? 'checked' : '' }}
                    >
                    <label for="checkbox_mortal">Mortal</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @error('gravedad_lesion') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        </div>

        <hr style="border:1px solid lightgray;">

        <div class="row">
            <div class="col-12 col-md-4">
                <label>Examen de alcoholemia</label>
            </div>
            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_si"
                           name="alcoholemia" value="1"
                           {{ (old('alcoholemia') && old('alcoholemia') == '1') || $lesionado->alcoholemia ? 'checked' : '' }}
                    >
                    <label>Si</label>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_no"
                           name="alcoholemia" value="0"
                           {{ (old('alcoholemia') && old('alcoholemia') == '0') || $lesionado->alcoholemia == false ? 'checked' : '' }}
                    >
                    <label>No</label>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_alcoholemia_nego"
                           name="alcoholemia_se_nego"
                           {{ old('alcoholemia_se_nego') || $lesionado->alcoholemia_se_nego ? 'checked' : '' }}
                    >
                    <label for="checkbox_alcoholemia_nego">Se negó</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @error('alcoholemia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-3">
                <div class="form-group">
                    <label for="centro_asistencial">Centro Asistencial</label>
                    <input type="text" name="centro_asistencial" id="centro_asistencial"
                           class="form-control"
                           value="{{ old('centro_asistencial') ? old('centro_asistencial') : $lesionado->centro_asistencial }}"
                    >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('siniestros.terceros.paso5.create',['id' => request('id')])}}'>VOLVER</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='AGREGAR'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    <script src="{{ asset('js/pais_provincia_localidad.js')}}"></script>
    <script type="text/javascript">
    </script>
@endsection
