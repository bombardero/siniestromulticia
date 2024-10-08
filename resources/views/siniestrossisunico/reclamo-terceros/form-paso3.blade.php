<form class="" action='{{route("siniestros.terceros.paso3.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="reclamo_vehicular" value="{{ $reclamo->reclamo_vehicular ? '1' : '0' }}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">
            <div class="col-12">
                <h4 style="color:#6e4697;"><b>Paso 3 </b>de 10 | Datos del Vehículo</h4>
                <hr style="border:1px solid lightgray;">
            </div>
        </div>

        <div class="row">

            <div class="col-12 mt-3">
                <label><b>Vehículo</b></label>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <div class="input-group">
                        <select name="marca_id" id="marca-select"
                                class="custom-select {{ old('otra_marca') || ($reclamo->vehiculo && $reclamo->vehiculo->otra_marca) ? 'd-none' : '' }} @error('marca_id') is-invalid @enderror"
                                {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                        >
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}"
                                    {{ old('marca_id') == $marca->id || ($reclamo->vehiculo && $reclamo->vehiculo->marca_id == $marca->id) ? 'selected' : '' }}
                                >{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="marca-text" name="marca"
                               class="form-control {{ old('otra_marca') || ($reclamo->vehiculo && $reclamo->vehiculo->otra_marca) ? '' : 'd-none' }} @error('marca') is-invalid @enderror"
                               value="{{ old('marca') ? old('marca') : ($reclamo->vehiculo && $reclamo->vehiculo->otra_marca ? $reclamo->vehiculo->otra_marca : '') }}"
                                {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otra_marca" id="otra-marca"
                                       class="mr-1"
                                        {{ old('otra_marca') || ($reclamo->vehiculo && $reclamo->vehiculo->otra_marca) ? 'checked' : '' }}
                                        {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                                >Otra
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
                        <select name="modelo_id" id="modelo-select"
                                class="custom-select {{ old('otro_modelo') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_modelo) ? 'd-none' : '' }} @error('modelo_id') is-invalid @enderror"
                                {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                        >
                            @foreach($modelos as $modelo)
                                <option value="{{ $modelo->id }}"
                                    {{  old('modelo_id') == $marca->id || ($reclamo->vehiculo && $reclamo->vehiculo->modelo_id == $modelo->id) ? 'selected' : '' }}
                                >{{ $modelo->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="modelo-text" name="modelo"
                               class="form-control {{ old('otro_modelo') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_modelo) ? '' : 'd-none' }} @error('modelo') is-invalid @enderror"
                               value="{{ old('modelo') ? old('modelo') : ($reclamo->vehiculo && $reclamo->vehiculo->otro_modelo ? $reclamo->vehiculo->otro_modelo : '') }}"
                                {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otro_modelo" id="otro-modelo"
                                       class="mr-1" {{ old('otro_modelo') || ($reclamo->vehiculo && $reclamo->vehiculo->otro_modelo) ? 'checked' : '' }}
                                        {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                                >Otro
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
                            {{ $reclamo->reclamo_vehicular == false ? 'readonly' : '' }}
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
                            {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    @error('vehiculo_anio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_dominio">Dominio</label>
                    <input type="text" id="vehiculo_dominio" name="vehiculo_dominio"
                           class="form-control text-uppercase @error('vehiculo_dominio') is-invalid @enderror"
                           value="{{ old('vehiculo_dominio') ? old('vehiculo_dominio') : ($reclamo->vehiculo ? $reclamo->vehiculo->dominio : $reclamo->vehiculo_tercero_dominio) }}"
                           {{ $reclamo->vehiculo_tercero_dominio != null ? 'readonly' : '' }}
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    @error('vehiculo_dominio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="custom-control custom-radio">
                    <input type="checkbox" class="form-check-input" id="en_transferencia"
                           name="en_transferencia"
                           {{ old('en_transferencia') || ($reclamo->vehiculo && $reclamo->vehiculo->en_transferencia) ? 'checked' : '' }}
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    <label for="en_transferencia" class="form-check-label">Vehículo en transferencia</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-3">
                <label><b>Seguro del vehículo</b></label>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12 col-md-4">
                <label>¿Cobertura al momento del siniestro?</label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="con_seguro_si"
                           name="con_seguro"
                           value="1"
                        {{ old('con_seguro') === '1' || ($reclamo->vehiculo && $reclamo->vehiculo->con_seguro) ? 'checked' : '' }}
                        {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    <label for="con_seguro_si" class="form-check-label">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="con_seguro_no"
                           name="con_seguro"
                           value="0"
                        {{ old('con_seguro') === '0' || ($reclamo->vehiculo && $reclamo->vehiculo->con_seguro === false) ? 'checked' : '' }}
                        {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    <label for="con_seguro_no" class="form-check-label">No</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="compania_seguros">Compañía de Seguro</label>
                    <input type="text" id="compania_seguros" name="compania_seguros"
                           class="form-control @error('compania_seguros') is-invalid @enderror"
                           value="{{ old('compania_seguros') ? old('compania_seguros') : ($reclamo->vehiculo ? $reclamo->vehiculo->compania_seguros : '') }}"
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    @error('compania_seguros') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="numero_poliza">Número de Póliza</label>
                    <input type="text" id="numero_poliza" name="numero_poliza"
                           class="form-control @error('numero_poliza') is-invalid @enderror"
                           value="{{ old('numero_poliza') ? old('numero_poliza') : ($reclamo->vehiculo ? $reclamo->vehiculo->numero_poliza : '') }}"
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
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
                           {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                    @error('tipo_cobertura') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="franquicia">Franquicia</label>
                    <select name="franquicia" id="franquicia"
                            class="custom-select @error('franquicia') is-invalid @enderror"
                            {{ $reclamo->reclamo_vehicular == false ? 'disabled' : '' }}
                    >
                        <option value="Si"
                            {{ old('franquicia') == 'Si' || ($reclamo->vehiculo && $reclamo->vehiculo->franquicia == 'Si') ? 'selected' : '' }}
                        >Si</option>
                        <option value="No"
                            {{ old('franquicia') == 'No' || ($reclamo->vehiculo && $reclamo->vehiculo->franquicia == 'No') ? 'selected' : '' }}
                        >No</option>
                        <option value="No se"
                            {{ old('franquicia') == 'No se' || ($reclamo->vehiculo && $reclamo->vehiculo->franquicia == 'No se') ? 'selected' : '' }}
                        >No se</option>
                    </select>
                    @error('franquicia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('siniestros.terceros.paso2.create',['id' => request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script src="{{ asset('js/pais_provincia_localidad.js')}}"></script>
<script src="{{ asset('js/marca_modelo.js')}}"></script>

<script type="text/javascript">
    $("input[type='radio'][name='con_seguro']").change(function () {
        if($(this).val() === '1')
        {
            deshabilitarCampos(false);
        } else {
            deshabilitarCampos();
        }
    });

    function deshabilitarCampos(deshabilitar = true)
    {
        $('#compania_seguros').attr('disabled', deshabilitar);
        $('#numero_poliza').attr('disabled', deshabilitar);
        $('#tipo_cobertura').attr('disabled', deshabilitar);
        $('#franquicia').attr('disabled', deshabilitar);
    }

    $( document ).ready(function() {
        if($('#con_seguro_si').is(':checked'))
        {
            deshabilitarCampos(false);
        }
        if($('#con_seguro_no').is(':checked'))
        {
            deshabilitarCampos();
        }
    });
</script>
@endsection
