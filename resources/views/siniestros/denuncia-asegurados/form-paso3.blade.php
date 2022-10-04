<form class="" action='{{route("asegurados-denuncias-paso3.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 3 </b>| 12 <b>Datos del conductor del vehiculo asegurado</b></span>

        <div class="row mt-3">

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre completo"
                           class="form-control form-estilo @error('nombre') is-invalid @enderror"
                           maxlength="255"
                           value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->nombre) ? $denuncia_siniestro->conductor->nombre : $denuncia_siniestro->nombre_conductor }}">
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono *</label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control form-estilo @error('telefono') is-invalid @enderror"
                           value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->telefono) ? $denuncia_siniestro->conductor->telefono : ''}}">
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio *</label>
                    <input type="text" id="domicilio" name="domicilio"
                           class="form-control form-estilo @error('domicilio') is-invalid @enderror"
                           value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->domicilio) ? $denuncia_siniestro->conductor->domicilio : '' }}">
                    @error('domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal *</label>
                    <input type="text" id="codigo_postal" name="codigo_postal"
                           class="form-control form-estilo @error('codigo_postal') is-invalid @enderror"
                           value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->codigo_postal) ? $denuncia_siniestro->conductor->codigo_postal : '' }}">
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País</label>
                    <select name="pais" id="pais" class="custom-select form-estilo">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->otro_pais_provincia_localidad != null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->otro_pais_provincia_localidad != null)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control form-estilo @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->otro_pais_provincia_localidad ? $denuncia_siniestro->conductor->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincias</label>
                    <select name="provincia_id" id="provincias" class="custom-select form-estilo">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidades</label>
                    <select name="localidad_id" id="localidades" class="custom-select form-estilo">
                        @foreach($localidades as $localidad)
                            <option value="{{ $localidad->id }}"
                                {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->city_id == $localidad->id ? 'selected' : '') }}
                            >{{ $localidad->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento *</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                           class="form-control form-estilo @error('fecha_nacimiento') is-invalid @enderror"
                           value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->fecha_nacimiento) ? $denuncia_siniestro->conductor->fecha_nacimiento->toDateString() : '' }}">
                    @error('fecha_nacimiento') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="documento_id" id="tipo_documentos" class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option value="{{ $tipo_documento->id }}"
                                {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->tipo_documento_id == $tipo_documento->id) ? 'selected':''}}>{{$tipo_documento->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento *</label>
                    <input type="text" id="documento_numero" name="documento_numero" maxlength="8"
                           class="form-control form-estilo @error('documento_numero') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->documento_numero ? $denuncia_siniestro->conductor->documento_numero : '' }}">
                    @error('documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="ocupacion">Ocupación *</label>
                    <input type="text" id="ocupacion" name="ocupacion"
                           class="form-control form-estilo @error('ocupacion') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->ocupacion ? $denuncia_siniestro->conductor->ocupacion : ''}}">
                    @error('ocupacion') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="numero_registro">Numero de Reg. de Conducir *</label>
                    <input type="text" id="numero_registro" name="numero_registro"
                           class="form-control form-estilo @error('numero_registro') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->numero_registro ? $denuncia_siniestro->conductor->numero_registro : '' }}">
                    @error('numero_registro') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="estado_civil">Estado Civil *</label>
                    <input type="text" id="estado_civil" name="estado_civil"
                           class="form-control form-estilo @error('estado_civil') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->estado_civil ? $denuncia_siniestro->conductor->estado_civil : '' }}">
                    @error('estado_civil') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_carnet">Tipo de Carnet *</label>
                    <select name="carnet_id" id="tipo_carnet" class="custom-select form-estilo">
                        @foreach($tipo_carnets as $tipo_carnet)
                            <option value="{{ $tipo_carnet->id }}"
                                {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->tipo_carnet_id == $tipo_carnet->id ? 'selected' : '' }}>{{ $tipo_carnet->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="carnet_categoria">Categoría/Clase del Carnet</label>
                    <input type="text" id="carnet_categoria" name="carnet_categoria"
                           class="form-control form-estilo @error('carnet_categoria') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->carnet_categoria ? $denuncia_siniestro->conductor->carnet_categoria : '' }}">
                    @error('carnet_categoria') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="carnet_vencimiento">Vencimiento</label>
                    <input type="date" id="carnet_vencimiento" name="carnet_vencimiento"
                           class="form-control form-estilo @error('carnet_vencimiento') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->conductor  && $denuncia_siniestro->conductor->carnet_vencimiento ? $denuncia_siniestro->conductor->carnet_vencimiento->toDateString() : '' }}">
                    @error('carnet_vencimiento') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-4">
                <label><b>Examen de alcoholemia *</b></label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_si" value="1" name="alcoholemia"
                            {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->alcoholemia ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="checkbox_alcoholemia_si">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_no" value="0" name="alcoholemia"
                        {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->alcoholemia == false ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="checkbox_alcoholemia_no">No</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_alcoholemia_nego"
                           name="alcoholemia_nego" {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->alcoholemia_se_nego ? 'checked' : '' }}>
                    <label for="checkbox_alcoholemia_nego" class="form-check-label">Se negó</label>
                </div>
            </div>

            <div class="col-12 col-md-8 offset-md-4">
                @error('alcoholemia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-4">
                <label>Conductor habitual</label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_habitual_si"
                           name="habitual"
                           value="1" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->habitual) ? 'checked' : '' }}>
                    <label for="checkbox_habitual_si" class="form-check-label">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_habitual_no"
                           name="habitual"
                           value="0" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->habitual == false) ? 'checked' : '' }}>
                    <label for="checkbox_habitual_no" class="form-check-label">No</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-4">
                <label><b>Es el propio asegurado *</b></label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input"
                           id="checkbox_asegurado_si" name="asegurado"
                           value="1" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->asegurado) ? 'checked' : '' }}>
                    <label for="checkbox_asegurado_si" class="form-check-label">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input"
                           id="checkbox_asegurado_no" name="asegurado"
                           value="0" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->asegurado == false) ? 'checked' : '' }}>
                    <label for="checkbox_asegurado_no" class="form-check-label">No</label>
                </div>
            </div>

            <div class="col-12 col-md-8 offset-md-4">
                @error('asegurado') <span class="invalid-feedback pl-2 mt-0 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-md-4">
                <label for="asegurado_relacion" class="pt-2">Relación con el asegurado</label>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <input type="text" id='asegurado_relacion' name="asegurado_relacion"
                           class="form-control form-estilo @error('asegurado_relacion') is-invalid @enderror"
                           value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->asegurado_relacion) ? $denuncia_siniestro->conductor->asegurado_relacion : '' }}"
                           disabled>
                    @error('asegurado_relacion') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-5 boton-enviar-siniestro btn "
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso2.create',['id'=> request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#provincias").change(function () {
                provincia_id = $("#provincias").val();
                console.log(provincia_id);
                $.ajax(
                    {
                        url: '/api/provincias/' + provincia_id + '/localidades',
                        type: 'get',
                        dataType: 'json',
                        success: function (cities) {
                            $('#localidades').empty();
                            cities.forEach(city => {
                                $('#localidades').append($('<option>', {
                                    value: city['id'],
                                    text: city['name']
                                }));
                            })

                        }
                    })
            });
        });

        $("#pais").change(function () {
            let pais = $(this).val();
            //console.log(pais);
            if(pais == 'otro')
            {
                $('#div_otro_pais_provincia_localidad').removeClass('d-none')
                $('#div_provincia').addClass('d-none')
                $('#div_localidad').addClass('d-none')
            } else {
                $('#div_otro_pais_provincia_localidad').addClass('d-none')
                $('#div_provincia').removeClass('d-none')
                $('#div_localidad').removeClass('d-none')
            }
        });

        $("#checkbox_asegurado_si").click(function () {
            $("#checkbox_asegurado_no").prop('checked', false);

            if ($(this).prop("checked") == true) {
                $("#asegurado_relacion").prop('disabled', true);

            } else if ($(this).prop("checked") == false) {

                if ($("#checkbox_asegurado_no").prop("checked") == true) {
                    $("#asegurado_relacion").prop('disabled', false);
                }

            }

        });

        $("#checkbox_asegurado_no").click(function () {
            $("#checkbox_asegurado_si").prop('checked', false);

            if ($(this).prop("checked") == true) {
                $("#asegurado_relacion").prop('disabled', false);

            } else if ($(this).prop("checked") == false) {
                $("#asegurado_relacion").prop('disabled', true);
            }

        });

        if ($("#checkbox_asegurado_no").prop("checked") == true) {
            $("#asegurado_relacion").prop('disabled', false);

        }


    </script>

@endsection
