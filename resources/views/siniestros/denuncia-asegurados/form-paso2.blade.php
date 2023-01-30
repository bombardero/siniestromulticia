<form class="" action='{{route("asegurados-denuncias-paso2.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container form-denuncia-siniestro p-4">

        <div class="row">
            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 2 </b>| 12 <b>Lugar del siniestro</b></span>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-12">
                <div class="form-group">
                    <label for="dominio">Lugar del Siniestro</label>
                    <input type="text" id="lugar_nombre" name="lugar_nombre"
                           class="form-control form-estilo"
                           maxlength="255" readonly
                           value="{{ $denuncia_siniestro->lugar_nombre }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pasis">País *</label>
                    <select class="custom-select form-estilo" name="pais" id="pais">
                        <option value="1" {{ old('pais') && old('pais') == '1' ?  'selected' : ($denuncia_siniestro->pais_id == 1 ? 'selected' : '') }}>Argentina</option>
                        <option value="otro" {{ old('pais') && old('pais') == 'otro' ?  'selected' : ($denuncia_siniestro->pais_id == null && $denuncia_siniestro->otro_pais_provincia_localidad != null ? 'selected' : '') }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8 {{ (old('pais') && old('pais') == 'otro') || (!$denuncia_siniestro->pais_id && !$denuncia_siniestro->province_id && !$denuncia_siniestro->city_id && $denuncia_siniestro->otro_pais_provincia_localidad != null)  ?  '' : 'd-none' }}" id="div_otro_pais_provincia_localidad">
                <div class="form-group">
                    <label for="otro_pais_provincia_localidad">Localidad - Provincia - País *</label>
                    <input type="text" id="otro_pais_provincia_localidad" name="otro_pais_provincia_localidad"
                           class="form-control form-estilo @error('otro_pais_provincia_localidad') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('otro_pais_provincia_localidad') ?  old('otro_pais_provincia_localidad') : $denuncia_siniestro->otro_pais_provincia_localidad }}">
                    @error('otro_pais_provincia_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || (!$denuncia_siniestro->pais_id && !$denuncia_siniestro->province_id && !$denuncia_siniestro->city_id && $denuncia_siniestro->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_provincia">
                <div class="form-group">
                    <label for="provincias">Provincia *</label>
                    <select class="custom-select form-estilo" name="provincia_id" id="provincias">
                        @foreach($provincias as $provincia)
                            <option  value="{{ $provincia->id }}"
                                {{ old('provincia_id') && old('provincia_id') == $provincia->id ? 'selected' : ($denuncia_siniestro->province_id == $provincia->id ? 'selected' : '') }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4 {{ (old('pais') && old('pais') == 'otro') || (!$denuncia_siniestro->pais_id && !$denuncia_siniestro->province_id && !$denuncia_siniestro->city_id && $denuncia_siniestro->otro_pais_provincia_localidad != null) ?  'd-none' : '' }}" id="div_localidad">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <div class="input-group">
                        <select name="localidad_id" id="localidades" class="custom-select form-estilo {{ old('check_otra_localidad') || $denuncia_siniestro->otro_pais_provincia_localidad ? 'd-none' :  '' }}">
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}"
                                    {{ old('localidad_id') && old('localidad_id') == $localidad->id ? 'selected' : ($denuncia_siniestro->city_id == $localidad->id ? 'selected' : '') }}
                                >{{ $localidad->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otra_localidad" id="otra_localidad" maxlength="255"
                               class="form-control form-estilo {{ old('check_otra_localidad') || ($denuncia_siniestro->otro_pais_provincia_localidad) ? '' : 'd-none' }}"
                               value="{{ $denuncia_siniestro->otro_pais_provincia_localidad != null ? $denuncia_siniestro->otro_pais_provincia_localidad : '' }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otra_localidad" name="check_otra_localidad"
                                       class="mr-1" {{ old('check_otra_localidad') || $denuncia_siniestro->otro_pais_provincia_localidad ? 'checked' : '' }}>Otra
                            </div>
                        </div>
                    </div>
                    @error('otra_localidad') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="dominio">Calle o Ruta *</label>
                    <input type="text" id="calle" name="calle"
                           class="form-control form-estilo @error('calle') is-invalid @enderror"
                           maxlength="255"
                           value="{{ $denuncia_siniestro->calle }}">
                    @error('calle') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_calzadas">Tipo de Calzada</label>
                    <select class="custom-select form-estilo" name="calzada_id" id="tipo_calzadas">
                        @foreach($tipo_calzadas as $tipo_calzada)
                            <option value="{{ $tipo_calzada->id }}"
                                {{ $denuncia_siniestro->tipo_calzada_id == $tipo_calzada->id ? 'selected' : '' }}
                            >{{$tipo_calzada->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="calzada_detalle">Detalle de la calzada</label>
                    <input type="text" id="calzada_detalle" name="calzada_detalle"
                           class="form-control form-estilo"
                           placeholder="Describa el estado de calzada"
                           maxlength="255"
                           value="{{ $denuncia_siniestro->calzada_detalle }}">
                </div>
            </div>

            <div class="form-group col-12 col-md-8">
                <label for="calzada_detalle">Insersección de calles</label>
                <input type="text" id="interseccion" name="interseccion"
                       class="form-control form-estilo"
                       placeholder="Indique entre que calles ocurrió el siniestro"
                       maxlength="255"
                       value="{{ $denuncia_siniestro->interseccion }}">
            </div>

            <div class="form-group col-12 col-md-4 pt-2">
                <label for=""></label>
                <div class="custom-control custom-checkbox pt-2">
                    <input type="checkbox" class="custom-control-input" id="cruce_senalizado" name="cruce_senalizado"
                        {{ $denuncia_siniestro->cruce_senalizado  ? 'checked' : '' }}
                    >
                    <label class="custom-control-label" for="cruce_senalizado">Cruce Señalizado</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-4">
                <div class="input-group">
                    <label>Tren Barrera señalizado</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="input-group  ">
                    <input type="radio" wire:model.defer="tren" class="form-check-input"
                           id="checkbox_tren_si" name="tren" value="1"
                        {{$denuncia_siniestro->tren ? 'checked':''}}
                    >
                    <label>Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="input-group  ">
                    <input type="radio" wire:model.defer="tren" class="form-check-input"
                           id="checkbox_tren_no" name="tren"
                           value="0" {{ $denuncia_siniestro->tren === 0 ? 'checked' : '' }}>
                    <label>No</label>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo" name="semaforo" {{ $denuncia_siniestro->semaforo ? 'checked' : '' }}>
                    <label for="checkbox_semaforo">Semaforo</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo_funciona" name="semaforo_funciona"
                           {{ $denuncia_siniestro->semaforo_funciona  ? 'checked' : '' }} disabled>
                    <label for="checkbox_semaforo_funciona">Funciona bien</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo_intermitente" name="semaforo_intermitente"
                           {{ $denuncia_siniestro->semaforo_intermitente ? 'checked':'' }} disabled>
                    <label for="checkbox_semaforo_intermitente">Intermitente</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="semaforo_color">Color del semaforo</label>
                    <input type="text" id='semaforo_color' name="semaforo_color"
                           class="form-control form-estilo"  placeholder="en color"
                           value="{{ $denuncia_siniestro->semaforo_color }}" disabled>

                </div>
            </div>

            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn "
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso1.create',['id'=> request('id'),'noredirect'=>true])}}'>ANTERIOR</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE'
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
                $.ajax({
                    url: '/api/provincias/' + provincia_id + '/localidades',
                    type: 'get',
                    dataType: 'json',
                    success: function (cities) {
                        let localidades = $('#localidades');
                        localidades.empty();
                        cities.forEach(city => {
                            localidades.append($('<option>', {
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

            $("#checkbox_semaforo_funciona").click(function () {
                if ($(this).prop("checked") == true) {
                    //$( "#semaforo_color" ).prop('disabled',true);
                } else if ($(this).prop("checked") == false) {
                    //$( "#semaforo_color" ).prop('disabled',false);
                }
            });

            $("#checkbox_semaforo_intermitente").click(function () {
                if ($(this).prop("checked") == true) {
                    //$( "#semaforo_color" ).prop('disabled',false);
                } else if ($(this).prop("checked") == false) {
                    //$( "#semaforo_color" ).prop('disabled',true);
                }
            });

            if ($("#checkbox_semaforo").prop("checked") == true) {
                $("#checkbox_semaforo_funciona").prop('disabled', false);
                $("#checkbox_semaforo_intermitente").prop('disabled', false);
                $("#semaforo_color").prop('disabled', false);

                /*if($( "#checkbox_semaforo_intermitente" ).prop("checked") == true){
                }*/
            }

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
