<form class="" action='{{route("asegurados-denuncias-paso5.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container form-denuncia-siniestro p-4">

        <div class="row">
            <div class="col-12">
                <span
                    style="color:#6e4697;font-size: 24px;"><b>Paso 5 </b>| 12 <b>Datos del vehiculo asegurado</b></span>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <label for="marca_id">Marca *</label>
                <div class="form-group">
                    <select name="marca_id" id="marca_id" class="custom-select form-estilo">
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marca_id') == $marca->id || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->marca_id == $marca->id) ? 'selected' : '' }}
                            >{{ $marca->nombre }}</option>
                        @endforeach
                        <option value="otra"
                            {{ old('marca_id') == 'otra' || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->marca_id == null) ? 'selected' : '' }}
                        >Otra
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6 otro_marca_modelo
                 {{ old('marca_id') !== 'otra' && (!$denuncia_siniestro->vehiculo || ($denuncia_siniestro->vehiculo->marca_id && $denuncia_siniestro->vehiculo->modelo_id)) ? 'd-none' : '' }}">
                <div class="form-group">
                    <label for="marca">Otra Marca *</label>
                    <input type="text" id="marca" name="marca"
                           class="form-control form-estilo @error('marca') is-invalid @enderror"
                           value="{{ old('marca') ? old('marca') : ($denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->otra_marca : '') }}"
                    >
                    @error('marca') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="modelo_id">Modelo *</label>
                    <select name="modelo_id" id="modelo_id" class="form-control form-estilo">
                        @foreach($modelos as $modelo)
                            <option value="{{ $modelo->id }}"
                                {{  old('modelo_id') == $marca->id || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->modelo_id == $modelo->id) ? 'selected' : '' }}
                            >{{ $modelo->nombre }}</option>
                        @endforeach
                        @if(old('modelo_id') == 'otro' || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->modelo_id == null))
                            <option value="otro" selected>Otro</option>
                        @endif
                    </select>
                </div>
            </div>

            <div
                class="col-12 col-md-6 otro_marca_modelo {{ old('modelo_id') !== 'otro' && (!$denuncia_siniestro->vehiculo || ($denuncia_siniestro->vehiculo->marca_id && $denuncia_siniestro->vehiculo->modelo_id)) ? 'd-none' : '' }}">
                <div class="form-group">
                    <label for="modelo">Otro Modelo *</label>
                    <input type="text" id="modelo" name="modelo"
                           class="form-control form-estilo @error('modelo') is-invalid @enderror"
                           value="{{ old('modelo') ? old('modelo') : ($denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->otro_modelo : '') }}">
                    @error('modelo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_tipo">Tipo de Vehículo *</label>
                    <input type="text" id="vehiculo_tipo" name="vehiculo_tipo"
                           class="form-control form-estilo @error('vehiculo_tipo') is-invalid @enderror"
                           value="{{ old('vehiculo_tipo') ? old('vehiculo_tipo') : ($denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->tipo : '') }}"
                    >
                    @error('vehiculo_tipo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_anio">Año *</label>
                    <input type="text" id="vehiculo_anio" name="vehiculo_anio"
                           class="form-control form-estilo @error('vehiculo_anio') is-invalid @enderror"
                           value="{{ old('vehiculo_anio') ? old('vehiculo_anio') : ($denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->anio : '') }}"
                    >
                    @error('vehiculo_anio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_dominio">Dominio *</label>
                    <input type="text" id="vehiculo_dominio" name="vehiculo_dominio"
                           class="form-control form-estilo text-uppercase @error('vehiculo_dominio') is-invalid @enderror"
                           value="{{ $denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->dominio : $denuncia_siniestro->dominio_vehiculo_asegurado }}"
                           readonly
                    >
                    @error('vehiculo_dominio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="vehiculo_motor">Número del Motor *</label>
                    <input type="text" id="vehiculo_motor" name="vehiculo_motor"
                           class="form-control form-estilo @error('vehiculo_motor') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('vehiculo_motor') ? old('vehiculo_motor') : ($denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->motor : '') }}"
                    >
                    @error('vehiculo_motor') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="vehiculo_chasis">Número de Chasis *</label>
                    <input type="text" id="vehiculo_chasis" name="vehiculo_chasis"
                           class="form-control form-estilo @error('vehiculo_chasis') is-invalid @enderror"
                           maxlength="255"
                           value="{{ old('vehiculo_chasis') ? old('vehiculo_chasis') : ($denuncia_siniestro->vehiculo ? $denuncia_siniestro->vehiculo->chasis : '') }}">
                    @error('vehiculo_chasis') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12">
                <label>Tipo de uso *</label>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_particular" name="vehiculo_particular"
                        {{ old('vehiculo_particular') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->uso_particular) ? 'checked' : '' }}
                    >
                    <label for="vehiculo_particular">Particular</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_comercial" name="vehiculo_comercial"
                        {{ old('vehiculo_comercial') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->uso_comercial) ? 'checked' : '' }}>
                    <label for="vehiculo_comercial">Comercial</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_taxi" name="vehiculo_taxi"
                        {{ old('vehiculo_taxi') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->uso_taxi) ? 'checked' : '' }}>
                    <label for="vehiculo_taxi">Taxi/Remis</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_tp" name="vehiculo_tp"
                        {{ old('vehiculo_tp') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->uso_tpp) ? 'checked' : '' }}>
                    <label for="vehiculo_tp">TPP</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_urgencia" name="vehiculo_urgencia"
                        {{ old('vehiculo_urgencia') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->uso_urgencia) ? 'checked' : '' }}>
                    <label for="vehiculo_urgencia">Serv/Urgencias</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_seguridad" name="vehiculo_seguridad"
                        {{ old('vehiculo_seguridad') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->uso_seguridad) ? 'checked' : '' }}>
                    <label for="vehiculo_seguridad">Serv/Seguridad</label>
                </div>
            </div>

            <div class="col-12">
                @if($errors->has('vehiculo_particular') || $errors->has('vehiculo_comercial')
                    || $errors->has('vehiculo_taxi') || $errors->has('vehiculo_tp')
                    || $errors->has('vehiculo_urgencia') || $errors->has('vehiculo_seguridad'))
                    <span class="invalid-feedback pl-2">Debe indicar al menos un tipo de uso</span>
                @endif
            </div>


            <div class="col-12 pt-1">
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12">
                <label><b>Tipo de siniestro *</b></label>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_siniestro_danio"
                           name="vehiculo_siniestro_danio"
                        {{ old('vehiculo_siniestro_danio') || ($denuncia_siniestro->vehiculo &&  $denuncia_siniestro->vehiculo->siniestro_danio) ? 'checked' : '' }}>
                    <label for="vehiculo_siniestro_danio">Daños</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_siniestro_robo"
                           name="vehiculo_siniestro_robo"
                        {{ old('vehiculo_siniestro_robo') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->siniestro_robo) ? 'checked' : ''}}>
                    <label for="vehiculo_siniestro_robo">Robo</label>
                </div>
            </div>

            <div class="col-12 col-md-3 pt-0">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_siniestro_incendio"
                           name="vehiculo_siniestro_incendio"
                        {{ old('vehiculo_siniestro_incendio') || ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->siniestro_incendio) ? 'checked' : '' }}>
                    <label for="vehiculo_siniestro_incendio">Incendio</label>
                </div>
            </div>

            <div class="col-12">
                @if($errors->has('vehiculo_siniestro_danio') || $errors->has('vehiculo_siniestro_robo') || $errors->has('vehiculo_siniestro_incendio'))
                    <span class="invalid-feedback pl-2">Debe indicar al menos un tipo de siniestro</span>
                @endif
            </div>

            <div class="col-12 mt-3">
                <div class="form-group">
                    <label for="vehiculo_detalles">Detalles</label>
                    <textarea type="text" id="vehiculo_detalles" name="vehiculo_detalles"
                              placeholder="Describir los daños del vehículo"
                              class="form-control form-estilo"
                    >{{ old('vehiculo_detalles') ? old('vehiculo_detalles') : ($denuncia_siniestro->vehiculo && $denuncia_siniestro->vehiculo->detalles ? $denuncia_siniestro->vehiculo->detalles : '') }}</textarea>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-5 boton-enviar-siniestro btn "
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso4.create',['id'=> request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>

    </div>

</form>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#marca_id").change(function () {
                marca_id = $("#marca_id").val();
                $('#modelo_id').empty();
                if (marca_id == 'otra') {
                    $(".otro_marca_modelo").removeClass('d-none');
                    $('#modelo_id').append($('<option>', {value: 'otro', text: 'Otro'}));
                } else {
                    $(".otro_marca_modelo").addClass('d-none');
                    $.ajax(
                        {
                            url: '/api/marcas/' + marca_id + '/modelos',
                            type: 'get',
                            dataType: 'json',
                            success: function (modelos) {

                                modelos.forEach(modelo => {
                                    $('#modelo_id').append($('<option>', {
                                        value: modelo['id'],
                                        text: modelo['nombre']
                                    }));
                                })

                            }
                        })
                }
            });

            IMask(
                document.getElementById('vehiculo_dominio'),
                {
                    mask: [
                        {
                            mask: 'aaa000'
                        },
                        {
                            mask: '000aaa'
                        },
                        {
                            mask: 'aa000aa'
                        },
                        {
                            mask: 'a000aaa'
                        }
                    ]
                });

            IMask(
                document.getElementById('vehiculo_anio'),
                {
                    mask: '0000'
                });

        });
    </script>

@endsection
