<form class="" action='{{route("siniestros.terceros.paso9.testigo.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">
            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 9 </b>de 10 | Testigos</span>
                <hr style="border:1px solid lightgray;">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : '' }}"
                    >
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') ? old('telefono') : '' }}">
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                           class="form-control @error('domicilio') is-invalid @enderror"
                           value="{{ old('domicilio') ? old('domicilio') : '' }}">
                    @error('domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>


            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País</label>
                    <select name="pais" id="pais" class="custom-select">
                        <option
                            value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : '' }}>
                            Argentina
                        </option>
                        <option
                            value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : '' }}>
                            Otro
                        </option>
                    </select>
                </div>
            </div>

            <div
                class="col-12 col-md-8 {{ old('pais') && old('pais') == 'otro' ? '' : 'd-none' }}"
                id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : '' }}">
                    @error('otro_pais_provincia_localidad') <span
                        class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div
                class="col-12 col-md-4 {{ old('pais') && old('pais') == 'otro' ? 'd-none' : '' }}"
                id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select name="provincia_id" id="provincias" class="custom-select">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : '' }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div
                class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') ?  'd-none' : '' }}"
                id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades"
                                class="custom-select {{ old('check_otra_localidad') ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : '' }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') ? '' : 'd-none' }}"
                               value="{{ old('otra_localidad') ? old('otra_localidad') : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') ? 'checked' : '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('siniestros.terceros.paso9.create',['id' => request('id')])}}'>VOLVER</a>
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
