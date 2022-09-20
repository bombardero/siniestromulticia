<form class="container w-75" action='{{route("asegurados-denuncias-paso6agregar.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <label style="font-size: 12px">
        Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en
        nuestro sistema.
    </label>
    <label class="text-danger" style="font-size: 12px">
        <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se
        recomienda cargar este formulario desde una computadora</label>

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 6 </b>| 12 <b>Detalle del otro vehiculo</b></span>

        <div class="row mt-3">

            <div class="col-12">
                <label><b>Datos del Propietario</b></label>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="propietario_nombre">Nombre y Apellido</label>
                    <input type="text" name="propietario_nombre" id="propietario_nombre"
                           placeholder="Nombre completo" class="form-control form-estilo"
                           maxlength="255"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="propietario_telefono">Teléfono</label>
                    <input type="tel" name="propietario_telefono" id="propietario_telefono"
                           class="form-control form-estilo" maxlength="15">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="propietario_documento_id" id="tipo_documentos"
                            class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}">{{$tipo_documento->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="propietario_documento_numero">Número de Documento</label>
                    <input type="text" name="propietario_documento_numero" id="propietario_documento_numero"
                           class="form-control form-estilo" maxlength="8"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="propietario_codigo_postal">Código Postal</label>
                    <input type="text" name="propietario_codigo_postal" id="propietario_codigo_postal"
                           class="form-control form-estilo" maxlength="8"
                    >
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="propietario_domicilio">Domicilio</label>
                    <input type="text" name="propietario_domicilio" id="propietario_domicilio"
                           class="form-control form-estilo" maxlength="255"
                    >
                </div>
            </div>

            <div class="col-12 mt-3">
                <label><b>Datos del Vehículo</b></label>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="marca_id">Marca</label>
                    <select name="marca_id" id="marca_id" class="custom-select form-estilo">
                        @foreach($marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                        @endforeach
                        <option value="otra">Otra</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6 otro_marca_modelo d-none">
                <div class="form-group">
                    <label for="marca">Otra Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control form-estilo">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="modelo_id">Modelo</label>
                    <select name="modelo_id" id="modelo_id" class="custom-select form-estilo">
                        @foreach($modelos as $modelo)
                            <option value="{{$modelo->id}}">{{$modelo->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6 otro_marca_modelo d-none">
                <div class="form-group">
                    <label for="modelo">Otro Modelo</label>
                    <input type="text" name="modelo" id="modelo" class="form-control form-estilo">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_tipo">Tipo</label>
                    <input type="text" name="vehiculo_tipo" id="vehiculo_tipo"
                           class="form-control form-estilo">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_anio">Año</label>
                    <input type="tel" name="vehiculo_anio" id="vehiculo_anio"
                           class="form-control form-estilo"
                           maxlength="4"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_dominio">Dominio</label>
                    <input type="text" name="vehiculo_dominio" id="vehiculo_dominio"
                           class="form-control form-estilo"
                           maxlength="7"
                    >
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="vehiculo_motor">Número de Motor</label>
                    <input type="text" name="vehiculo_motor" id="vehiculo_motor"
                           class="form-control form-estilo"
                    >
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="vehiculo_chasis">Número de Chasis</label>
                    <input type="text" name="vehiculo_chasis" id="vehiculo_chasis"
                           class="form-control form-estilo"
                    >
                </div>
            </div>

            <div class="col-12">
                <label>Tipo de Uso</label>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_particular" name="vehiculo_particular">
                    <label for="vehiculo_particular">Particular</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_comercial" name="vehiculo_comercial">
                    <label for="vehiculo_comercial">Comercial</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_taxi" name="vehiculo_taxi">
                    <label for="vehiculo_taxi">Taxi/Remis</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_tp" name="vehiculo_tp">
                    <label for="vehiculo_tp">TPP</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_urgencia" name="vehiculo_urgencia">
                    <label for="vehiculo_urgencia">Serv/Urgencias</label>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="vehiculo_seguridad" name="vehiculo_seguridad">
                    <label for="vehiculo_seguridad">Serv/Seguridad</label>
                </div>
            </div>

            <div class="col-12 mt-2">
                <div class="form-group">
                    <label for="vehiculo_detalles">Detalles de los daños</label>
                    <textarea type="text" name="vehiculo_detalles" id="vehiculo_detalles"
                              class="form-control form-estilo" maxlength="65535"
                              placeholder="Describa los daños del vehículo"></textarea>
                </div>
            </div>

            <div class="col-12 mt-3">
                <label><b>Datos del Conductor</b></label>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="conductor_nombre">Nombre y Apellido</label>
                    <input type="text" name="conductor_nombre" id="conductor_nombre"
                           placeholder="Nombre completo" maxlength="255"
                           class="form-control form-estilo"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_telefono">Teléfono</label>
                    <input type="tel" name="conductor_telefono" id="conductor_telefono"
                           maxlength="15" class="form-control form-estilo">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="conductor_documento_id" id="tipo_documentos" class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}" >{{$tipo_documento->nombre}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_documento_numero">Número de Documento</label>
                    <input type="text" name="conductor_documento_numero" id="conductor_documento_numero"
                           maxlength="8" class="form-control form-estilo"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_codigo_postal">Código Postal</label>
                    <input type="text" name="conductor_codigo_postal" id="conductor_codigo_postal"
                           maxlength="8" class="form-control form-estilo"
                    >
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="conductor_domicilio">Domicilio</label>
                    <input type="text" name="conductor_domicilio" id="conductor_domicilio"
                           class="form-control form-estilo" maxlength="255">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_registro">Nro. de Registro de Conducir</label>
                    <input type="text" name="conductor_registro" id="conductor_registro"
                           class="form-control form-estilo" maxlength="255"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_carnet">Tipo de Carnet</label>
                    <select name="conductor_carnet_id" id="tipo_carnet" class="custom-select form-estilo">
                        @foreach($tipo_carnets as $tipo_carnet)
                            <option
                                value="{{$tipo_carnet->id}}" >{{$tipo_carnet->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_categoria">Categoría/Clase del Carnet</label>
                    <input type="text" name="conductor_categoria" id="conductor_categoria"
                           maxlength="5" class="form-control form-estilo"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="conductor_vencimiento">Vencimiento</label>
                    <input type="text" name="conductor_vencimiento" id="conductor_vencimiento"
                           maxlength="5" class="form-control form-estilo"
                           placeholder="00/00"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <label><b>Examen de alcoholemia *</b></label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_si"
                           name="conductor_alcoholemia" value="1">
                    <label for="checkbox_alcoholemia_si">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_no"
                           name="conductor_alcoholemia" value="0">
                    <label for="checkbox_alcoholemia_no">No</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="checkbox_alcoholemia_nego"
                           name="conductor_alcoholemia_nego">
                    <label for="checkbox_alcoholemia_nego">Se negó</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label>Conductor habitual</label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_habitual_si" name="conductor_habitual"
                           value="1">
                    <label for="checkbox_habitual_si">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_habitual_no" name="conductor_habitual"
                           value="0">
                    <label for="checkbox_habitual_no">No</label>
                </div>
            </div>
        </div>

        <span style="color:red;">
                            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
                        </span>

        <a class="mt-5 boton-enviar-siniestro btn "
           style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
           href='{{route('asegurados-denuncias-paso6.create',['id'=> request('id')])}}'>CANCELAR</a>
        <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='GUARDAR'
               style="background:#6e4697;font-weight: bold;"/>
    </div>


    <div class="col-12 text-center text-md-right">
        <div wire:loading class="spinner-border" role="status">
            <span class="sr-only">Cargando...</span>
            <span class="sr-only">Cargando...</span>
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
                    $.ajax({
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
        });
    </script>

@endsection
