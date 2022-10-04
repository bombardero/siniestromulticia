<form class="" action='{{route("asegurados-denuncias-paso4.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container form-denuncia-siniestro p-4">
        <div class="row">
            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 4 </b>| 12 <b>Datos del asegurado</b></span>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_nombre">Nombre y Apellido *</label>
                    <input type="text" name="asegurado_nombre" placeholder="Nombre completo"
                           class="form-control form-estilo @error('asegurado_nombre') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->nombre : '' }}"
                    >
                    @error('asegurado_nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento *</label>
                    <select name="asegurado_documento_id" id="tipo_documentos"
                            class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}" {{ $denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_documento_numero">Número de Documento *</label>
                    <input type="text" name="asegurado_documento_numero" id="asegurado_documento_numero" maxlength="8"
                           class="form-control form-estilo @error('asegurado_documento_numero') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->documento_numero : '' }}">
                    @error('asegurado_documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="asegurado_domicilio">Domicilio *</label>
                    <input type="text" name="asegurado_domicilio" id="asegurado_domicilio"
                           class="form-control form-estilo @error('asegurado_domicilio') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->domicilio : '' }}">
                    @error('asegurado_domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_codigo_postal">Código Postal *</label>
                    <input type="text" name="asegurado_codigo_postal" id="asegurado_codigo_postal"
                           class="form-control form-estilo @error('asegurado_domicilio') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->codigo_postal : '' }}">
                    @error('asegurado_domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País *</label>
                    <select name="pais" id="pais" class="custom-select form-estilo">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->otro_pais_provincia_localidad != null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->otro_pais_provincia_localidad != null)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control form-estilo @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->otro_pais_provincia_localidad != null ? $denuncia_siniestro->asegurado->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia *</label>
                    <select name="asegurado_provincia_id" id="provincias" class="custom-select form-estilo">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad *</label>
                    <select name="asegurado_localidad_id" id="localidades" class="custom-select form-estilo">
                        @foreach($localidades as $localidad)
                            <option value="{{ $localidad->id }}"
                                {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->city_id == $localidad->id ? 'selected' : '') }}
                            >{{ $localidad->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="asegurado_ocupacion">Ocupación *</label>
                    <input type="text" id="asegurado_ocupacion" name="asegurado_ocupacion"
                           class="form-control form-estilo @error('asegurado_ocupacion') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->ocupacion : '' }}">
                    @error('asegurado_ocupacion') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_telefono">Teléfono *</label>
                    <input type="text" id="asegurado_telefono" name="asegurado_telefono"
                           class="form-control form-estilo @error('asegurado_telefono') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->telefono : '' }}">
                    @error('asegurado_telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-5 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso3.create',['id'=> request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-5 boton-enviar-siniestro btn" value='SIGUIENTE'
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

        });
    </script>

@endsection
