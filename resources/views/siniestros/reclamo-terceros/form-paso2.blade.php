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
                    <input type="radio" class="form-check-input" id="vehículo_si"
                           name="vehículo"
                           value="1" {{ $reclamo->dominio_vehiculo_tercero != null ? 'checked' : '' }}>
                    <label for="vehículo_si" class="form-check-label">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="vehículo_no"
                           name="vehículo"
                           value="0" {{ $reclamo->dominio_vehiculo_tercero == null ? 'checked' : '' }}>
                    <label for="vehículo_no" class="form-check-label">No</label>
                </div>
            </div>

            <div class="col-12 mt-3">
                <label><b>Vehículo</b></label>
            </div>

            <div class="col-12 col-md-6">
                <label for="marca_id">Marca</label>
                <div class="form-group">
                    <select name="marca_id" id="marca_id" class="custom-select form-estilo">
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marca_id') == $marca->id || ($reclamo->vehiculo && $reclamo->vehiculo->marca_id == $marca->id) ? 'selected' : '' }}
                            >{{ $marca->nombre }}</option>
                        @endforeach
                        <option value="otra"
                            {{ old('marca_id') == 'otra' || ($reclamo->vehiculo && $reclamo->vehiculo->marca_id == null) ? 'selected' : '' }}
                        >Otra
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6 otro_marca_modelo
                 {{ old('marca_id') !== 'otra' && (!$reclamo->vehiculo || ($reclamo->vehiculo->marca_id && $reclamo->vehiculo->modelo_id)) ? 'd-none' : '' }}">
                <div class="form-group">
                    <label for="marca">Otra Marca</label>
                    <input type="text" id="marca" name="marca"
                           class="form-control form-estilo @error('marca') is-invalid @enderror"
                           value="{{ old('marca') ? old('marca') : ($reclamo->vehiculo ? $reclamo->vehiculo->otra_marca : '') }}"
                    >
                    @error('marca') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="modelo_id">Modelo</label>
                    <select name="modelo_id" id="modelo_id" class="form-control form-estilo">
                        @foreach($modelos as $modelo)
                            <option value="{{ $modelo->id }}"
                                {{  old('modelo_id') == $marca->id || ($reclamo->vehiculo && $reclamo->vehiculo->modelo_id == $modelo->id) ? 'selected' : '' }}
                            >{{ $modelo->nombre }}</option>
                        @endforeach
                        @if(old('modelo_id') == 'otro' || ($reclamo->vehiculo && $reclamo->vehiculo->modelo_id == null))
                            <option value="otro" selected>Otro</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6 otro_marca_modelo {{ old('modelo_id') !== 'otro' && (!$reclamo->vehiculo || ($reclamo->vehiculo->marca_id && $reclamo->vehiculo->modelo_id)) ? 'd-none' : '' }}">
                <div class="form-group">
                    <label for="modelo">Otro Modelo</label>
                    <input type="text" id="modelo" name="modelo"
                           class="form-control form-estilo @error('modelo') is-invalid @enderror"
                           value="{{ old('modelo') ? old('modelo') : ($reclamo->vehiculo ? $reclamo->vehiculo->otro_modelo : '') }}">
                    @error('modelo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_tipo">Tipo de Vehículo</label>
                    <input type="text" id="vehiculo_tipo" name="vehiculo_tipo"
                           class="form-control form-estilo @error('vehiculo_tipo') is-invalid @enderror"
                           value="{{ old('vehiculo_tipo') ? old('vehiculo_tipo') : ($reclamo->vehiculo ? $reclamo->vehiculo->tipo : '') }}"
                    >
                    @error('vehiculo_tipo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_anio">Año</label>
                    <input type="text" id="vehiculo_anio" name="vehiculo_anio"
                           class="form-control form-estilo @error('vehiculo_anio') is-invalid @enderror"
                           value="{{ old('vehiculo_anio') ? old('vehiculo_anio') : ($reclamo->vehiculo ? $reclamo->vehiculo->anio : '') }}"
                    >
                    @error('vehiculo_anio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_dominio">Dominio *</label>
                    <input type="text" id="vehiculo_dominio" name="vehiculo_dominio"
                           class="form-control form-estilo text-uppercase @error('vehiculo_dominio') is-invalid @enderror"
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
                           class="form-control form-estilo @error('compania_seguro') is-invalid @enderror"
                           value="{{ old('compania_seguro') ? old('compania_seguro') : ($reclamo->vehiculo ? $reclamo->vehiculo->compania_seguro : '') }}"
                    >
                    @error('compania_seguro') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="numero_poliza">Número de Póliza</label>
                    <input type="text" id="numero_poliza" name="numero_poliza"
                           class="form-control form-estilo @error('numero_poliza') is-invalid @enderror"
                           value="{{ old('numero_poliza') ? old('numero_poliza') : ($reclamo->vehiculo ? $reclamo->vehiculo->numero_poliza : '') }}"
                    >
                    @error('numero_poliza') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="tipo_cobertura">Tipo de Cobertura</label>
                    <input type="text" id="tipo_cobertura" name="tipo_cobertura"
                           class="form-control form-estilo @error('tipo_cobertura') is-invalid @enderror"
                           value="{{ old('tipo_cobertura') ? old('tipo_cobertura') : ($reclamo->vehiculo ? $reclamo->vehiculo->tipo_cobertura : '') }}"
                    >
                    @error('tipo_cobertura') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="franquicia">Franquicia</label>
                    <input type="text" id="franquicia" name="franquicia"
                           class="form-control form-estilo @error('franquicia') is-invalid @enderror"
                           value="{{ old('franquicia') ? old('franquicia') : ($reclamo->vehiculo ? $reclamo->vehiculo->franquicia : '') }}"
                    >
                    @error('franquicia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 mt-3">
                <label><b>Conductor</b></label>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="conductor_nombre">Nombre y Apellido</label>
                    <input type="text" name="conductor_nombre" placeholder="Nombre completo"
                           class="form-control form-estilo @error('conductor_nombre') is-invalid @enderror"
                           value="{{ $reclamo->vehiculo ? $reclamo->vehiculo->conductor_nombre : '' }}"
                    >
                    @error('conductor_nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_telefono">Teléfono </label>
                    <input type="text" id="conductor_telefono" name="conductor_telefono"
                           class="form-control form-estilo @error('conductor_telefono') is-invalid @enderror"
                           value="{{ $reclamo->vehiculo ? $reclamo->vehiculo->conductor_telefono : '' }}">
                    @error('conductor_telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="conductor_domicilio">Domicilio</label>
                    <input type="text" name="conductor_domicilio" id="conductor_domicilio"
                           class="form-control form-estilo @error('conductor_domicilio') is-invalid @enderror"
                           value="{{ $reclamo->vehiculo ? $reclamo->vehiculo->domicilio : '' }}">
                    @error('conductor_domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_codigo_postal">Código Postal *</label>
                    <input type="text" id="conductor_codigo_postal" name="conductor_codigo_postal"
                           class="form-control form-estilo @error('conductor_codigo_postal') is-invalid @enderror"
                           value="{{ ($reclamo->vehiculo && $reclamo->vehiculo->conductor_codigo_postal) ? $reclamo->vehiculo->conductor_codigo_postal : '' }}">
                    @error('conductor_codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País *</label>
                    <select name="pais" id="pais" class="custom-select form-estilo">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->vehiculo && $reclamo->vehiculo->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->vehiculo && $reclamo->vehiculo->pais_id == null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo && !$reclamo->vehiculo->pais_id && !$reclamo->vehiculo->province_id && !$reclamo->vehiculo->city_id)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control form-estilo @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad != null ? $reclamo->vehiculo->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->vehiculo && $reclamo->vehiculo->province_id == null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia *</label>
                    <select name="asegurado_provincia_id" id="provincias" class="custom-select form-estilo">
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
                        <select name="localidad_id" id="localidades" class="custom-select form-estilo {{ old('check_otra_localidad') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad) ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->vehiculo && $reclamo->vehiculo->city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control form-estilo {{ old('check_otra_localidad') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_pais_provincia_localidad) ? '' : 'd-none' }}"
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
                           class="form-control form-estilo @error('licencia_numero') is-invalid @enderror"
                           value="{{ ($reclamo->vehiculo && $reclamo->vehiculo->licencia_numero) ? $reclamo->vehiculo->licencia_numero : '' }}">
                    @error('licencia_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="licencia_clase">Clase de Licencia</label>
                    <input type="text" id="licencia_clase" name="licencia_clase"
                           class="form-control form-estilo @error('licencia_clase') is-invalid @enderror"
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
    <script type="text/javascript">

    </script>
@endsection
