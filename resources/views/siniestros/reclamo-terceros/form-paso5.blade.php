<form class="" action='{{route("siniestros.terceros.paso5.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 5 </b>de 8 | Lugar del Siniestro</span>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pasis">País</label>
                    <select class="custom-select" name="pais" id="pais">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($reclamo->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($reclamo->pais_id == null && $reclamo->otro_pais_provincia_localidad != null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || (!$reclamo->pais_id && !$reclamo->province_id && !$reclamo->city_id && $reclamo->otro_pais_provincia_localidad != null)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : $reclamo->otro_pais_provincia_localidad }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || (!$reclamo->pais_id && !$reclamo->province_id && !$reclamo->city_id && $reclamo->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select class="custom-select" name="provincia_id" id="provincias">
                        @foreach($provincias as $provincia)
                            <option  value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($reclamo->province_id == $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || (!$reclamo->pais_id && !$reclamo->province_id && !$reclamo->city_id && $reclamo->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades" class="custom-select {{ old('check_otra_localidad') || $reclamo->otro_pais_provincia_localidad ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($reclamo->city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control {{ old('check_otra_localidad') || ($reclamo->otro_pais_provincia_localidad) ? '' : 'd-none' }}"
                               value="{{ $reclamo->otro_pais_provincia_localidad != null ? $reclamo->otro_pais_provincia_localidad : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || $reclamo->otro_pais_provincia_localidad ? 'checked' : '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="dominio">Calle o Ruta</label>
                    <input type="text" id="calle" name="calle"
                           class="form-control @error('calle') is-invalid @enderror"
                           maxlength="255"
                           value="{{ $reclamo->calle }}">
                    @error('calle') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_calzadas">Tipo de Calzada</label>
                    <select class="custom-select" name="calzada_id" id="tipo_calzadas">
                        @foreach($tipo_calzadas as $tipo_calzada)
                            <option value="{{ $tipo_calzada->id }}"
                                {{ $reclamo->tipo_calzada_id == $tipo_calzada->id ? 'selected' : '' }}
                            >{{$tipo_calzada->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="calzada_detalle">Detalle de la calzada</label>
                    <input type="text" id="calzada_detalle" name="calzada_detalle"
                           class="form-control"
                           placeholder="Describa el estado de calzada"
                           maxlength="255"
                           value="{{ $reclamo->calzada_detalle }}">
                </div>
            </div>

            <div class="form-group col-12 col-md-8">
                <label for="calzada_detalle">Insersección de calles</label>
                <input type="text" id="interseccion" name="interseccion"
                       class="form-control"
                       placeholder="Indique entre que calles ocurrió el siniestro"
                       maxlength="255"
                       value="{{ $reclamo->interseccion }}">
            </div>

            <div class="form-group col-12 col-md-4 pt-2">
                <label for=""></label>
                <div class="custom-control custom-checkbox pt-2">
                    <input type="checkbox" class="custom-control-input" id="cruce_senalizado" name="cruce_senalizado"
                        {{ $reclamo->cruce_senalizado  ? 'checked' : '' }}
                    >
                    <label class="custom-control-label" for="cruce_senalizado">Cruce Señalizado</label>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-4">
                <div class="input-group">
                    <label>Tren barrera señalizado</label>
                </div>
            </div>
            <div class="col-12 col-md-1">
                <div class="input-group  ">
                    <input type="radio" wire:model.defer="tren" class="form-check-input"
                           id="checkbox_tren_si" name="tren" value="1"
                        {{ $reclamo->tren ? 'checked':''}}
                    >
                    <label>Si</label>
                </div>
            </div>
            <div class="col-12 col-md-1">
                <div class="input-group  ">
                    <input type="radio" wire:model.defer="tren" class="form-check-input"
                           id="checkbox_tren_no" name="tren"
                           value="0" {{ $reclamo->tren === 0 ? 'checked' : '' }}>
                    <label>No</label>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-3">
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo" name="semaforo" {{ $reclamo->semaforo ? 'checked' : '' }}>
                    <label for="checkbox_semaforo">Semaforo</label>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo_funciona" name="semaforo_funciona"
                           {{ $reclamo->semaforo_funciona  ? 'checked' : '' }} disabled>
                    <label for="checkbox_semaforo_funciona">Funciona bien</label>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo_intermitente" name="semaforo_intermitente"
                           {{ $reclamo->semaforo_intermitente ? 'checked':'' }} disabled>
                    <label for="checkbox_semaforo_intermitente">Intermitente</label>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Color</span>
                        </div>
                        <input type="text" id='semaforo_color' name="semaforo_color"
                               class="form-control"
                               value="{{ $reclamo->semaforo_color }}" disabled>
                    </div>
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
    $("#checkbox_tren_si").click(function () {
        $("#checkbox_tren_no").prop('checked', false);
    });

    $("#checkbox_tren_no").click(function () {
        $("#checkbox_tren_si").prop('checked', false);
    });

    $("#checkbox_semaforo_funciona").click(function () {
        $("#checkbox_semaforo_intermitente").prop('checked', false);
    });

    $("#checkbox_semaforo_intermitente").click(function () {
        $("#checkbox_semaforo_funciona").prop('checked', false);
    });

    $("#checkbox_semaforo").click(function () {
        if ($(this).prop("checked") == true) {
            $("#checkbox_semaforo_funciona").prop('disabled', false);
            $("#checkbox_semaforo_intermitente").prop('disabled', false);
            $("#semaforo_color").prop('disabled', false);
            if ($("#checkbox_semaforo_intermitente").prop("checked") == true) {
            }
        } else if ($(this).prop("checked") == false) {
            $("#checkbox_semaforo_funciona").prop('disabled', true);
            $("#checkbox_semaforo_intermitente").prop('disabled', true);
            $("#semaforo_color").prop('disabled', true);
        }
    });

    if ($("#checkbox_semaforo").prop("checked") == true) {
        $("#checkbox_semaforo_funciona").prop('disabled', false);
        $("#checkbox_semaforo_intermitente").prop('disabled', false);
        $("#semaforo_color").prop('disabled', false);
    }

</script>
@endsection
