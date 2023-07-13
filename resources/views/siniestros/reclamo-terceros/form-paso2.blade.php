<form class="" action='{{route("siniestros.terceros.paso2.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="reclamo_vehicular" value="{{ $reclamo->reclamo_vehicular ? '1' : '0' }}">
    <input type="hidden" name="reclamo_lesiones" value="{{ $reclamo->reclamo_lesiones ? '1' : '0' }}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12 mb-3">
                <h4 style="color:#6e4697;"><b>Paso 2 </b>de 10 | Datos del Reclamante</h4>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" placeholder="Nombre completo"
                               class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : ($reclamo->reclamante ? $reclamo->reclamante->nombre : '') }}"
                    >
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') ? old('telefono') : ($reclamo->reclamante ? $reclamo->reclamante->telefono : '') }}">
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documento_id">Tipo de Documento</label>
                    <select name="tipo_documento_id" id="tipo_documento"
                                class="custom-select">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}"
                                {{ old('tipo_documento_id') && old('tipo_documento_id') == $tipo_documento->id ? 'selected' : ($reclamo->reclamante && $reclamo->reclamante->tipo_documento_id == $tipo_documento->id ? 'selected' : '') }}
                            >{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento</label>
                    <input type="text" name="documento_numero" id="documento_numero" maxlength="8"
                               class="form-control @error('documento_numero') is-invalid @enderror"
                           value="{{ old('documento_numero') ? old('documento_numero') : ($reclamo->reclamante ? $reclamo->reclamante->documento_numero : '') }}">
                    @error('documento_numero') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                           class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                           value="{{ old('fecha_nacimiento') ? old('fecha_nacimiento') : ($reclamo->reclamante ? $reclamo->reclamante->fecha_nacimiento->toDateString() : '') }}"
                    >
                    @error('fecha_nacimiento') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                               class="form-control @error('domicilio') is-invalid @enderror"
                           value="{{ old('domicilio') ? old('domicilio') : ($reclamo->reclamante ? $reclamo->reclamante->domicilio : '') }}">
                    @error('domicilio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" name="codigo_postal" id="codigo_postal"
                               class="form-control @error('codigo_postal') is-invalid @enderror"
                           value="{{ old('codigo_postal') ? old('codigo_postal') : ($reclamo->reclamante ? $reclamo->reclamante->codigo_postal : '') }}">
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pais">País</label>
                        <select name="pais" id="pais" class="custom-select">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->reclamante && $reclamo->reclamante->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->reclamante && $reclamo->reclamante->pais_id == null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->reclamante && !$reclamo->reclamante->pais_id && !$reclamo->reclamante->province_id && !$reclamo->reclamante->city_id)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : ($reclamo->reclamante && $reclamo->reclamante->otro_pais_provincia_localidad != null ? $reclamo->reclamante->otro_pais_provincia_localidad : '') }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->reclamante && $reclamo->reclamante->province_id == null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select name="provincia_id" id="provincias" class="custom-select">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($reclamo->reclamante && $reclamo->reclamante->province_id ==  $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || ($reclamo->reclamante && !$reclamo->reclamante->pais_id && !$reclamo->reclamante->province_id) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades" class="custom-select {{ old('check_otra_localidad') || ($reclamo->reclamante && $reclamo->reclamante->otro_pais_provincia_localidad) ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->reclamante && $reclamo->reclamante->city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || ($reclamo->reclamante && $reclamo->reclamante->otro_pais_provincia_localidad) ? '' : 'd-none' }}"
                               value="{{ $reclamo->reclamante && $reclamo->reclamante->otro_pais_provincia_localidad != null ? $reclamo->reclamante->otro_pais_provincia_localidad : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || ($reclamo->reclamante && $reclamo->reclamante->otro_pais_provincia_localidad) ? 'checked' :  '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        @if($reclamo->reclamo_vehicular)
            <div class="row mb-2">
                <div class="col-12 col-md-4">
                    <label>¿Es el conductor?</label>
                </div>
                <div class="col-12 col-md-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="form-check-input" id="conductor_si"
                               name="conductor"
                               value="1"
                               {{ old('conductor') === '1' || ($reclamo->reclamante && $reclamo->reclamante->conductor) ? 'checked' : '' }}
                        >
                        <label for="conductor_si" class="form-check-label">Si</label>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="form-check-input" id="conductor_no"
                               name="conductor"
                               value="0"
                               {{ old('conductor') === '0' || ($reclamo->reclamante && $reclamo->reclamante->conductor === false) ? 'checked' : '' }}
                        >
                        <label for="conductor_no" class="form-check-label">No</label>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-md-4">
                    @error('conductor') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('siniestros.terceros.paso1.create',['id' => request('id'), 'noredirect' => true])}}'>ANTERIOR</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
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
            $.ajax({
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

                },
                complete: function () {
                    $('#check_otra_localidad').prop("checked",false);
                    $('#localidades').removeClass('d-none');
                    $("#localidades").prop('disabled', false);
                    $('#otra_localidad').addClass('d-none');
                    $("#otra_localidad").prop('disabled', true);
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

        $("#check_otra_localidad").click(function () {
            if ($(this).prop("checked")) {
                $('#localidades').addClass('d-none');
                $("#localidades").prop('disabled', true);
                $('#otra_localidad').removeClass('d-none');
                $("#otra_localidad").prop('disabled', false);
            } else{
                $('#localidades').removeClass('d-none');
                $("#localidades").prop('disabled', false);
                $('#otra_localidad').addClass('d-none');
                $("#otra_localidad").prop('disabled', true);
            }
        });

    });
</script>
@endsection
