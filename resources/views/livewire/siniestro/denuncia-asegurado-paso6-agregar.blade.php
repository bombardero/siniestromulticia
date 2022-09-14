<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso6agregar.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 6 </b>| 12 <b>Detalle del otro vehiculo</b></span>

            <div class="input-group  margin-bottom-en-ambos margin">


                <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <label style="margin-bottom:28px;"><b>1. Vehiculo</b></label>
                    </div>
                </div>

                <div class="col-12 col-md-8">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="propietario_nombre" placeholder="Nombre y apellido del propietario" style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="propietario_telefono" placeholder="Telefono" style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="propietario_documento_id" id="tipo_documentos" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($tipo_documentos as $tipo_documento)
						  	<option value="{{$tipo_documento->id}}">{{$tipo_documento->nombre}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class="w-100" type="text" name="propietario_documento_numero"
                            placeholder="Documento numero" style="border-radius:10px; height: 33px;background: white;"
                            maxlength="8"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class="w-100" type="text" name="propietario_codigo_postal" placeholder="Codigo Postal"
                               style="border-radius:10px; height: 33px;background: white;"
                               maxlength="8"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="propietario_domicilio" placeholder="Domicilio" style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="input-group first-row">
                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <select class='w-100' name="marca_id" id="marca_id" style="border-radius:10px; height: 33px;background: white;">
    						  @foreach($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                              @endforeach
                              <option value="otra">Otra</option>
    						</select>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <select class='w-100' name="modelo_id" id="modelo_id" style="border-radius:10px; height: 33px;background: white;">
    						  @if($modelos)
                                    @foreach($modelos as $modelo)
                                        <option value="{{$modelo->id}}">{{$modelo->nombre}}</option>
                                    @endforeach
                                @endif
    						</select>
                        </div>
                    </div>

                    <div class="col-12 col-md-2 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_tipo" placeholder="Tipo" style="border-radius:10px; height: 33px;background: white;">
                        </div>
                    </div>

                    <div class="col-12 col-md-2 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_anio" placeholder="Año"
                                   style="border-radius:10px; height: 33px;background: white;"
                                   maxlength="4"
                            >
                        </div>
                    </div>

                    <div class="input-group col-12 col-md-4 pt-3 otro_marca_modelo d-none">
                        <input class='w-100' type="text" name="marca" placeholder="Marca" style="border-radius:10px; height: 33px;background: white;">
                    </div>
                    <div class="input-group col-12 col-md-4 pt-3 otro_marca_modelo d-none">
                        <input class='w-100' type="text" name="modelo" placeholder="Modelo" style="border-radius:10px; height: 33px;background: white;">
                    </div>
                    <div class="col-12 col-md-4 pt-3 otro_marca_modelo d-none"></div>

                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_dominio" placeholder="Dominio"
                                   style="border-radius:10px; height: 33px;background: white;"
                                   maxlength="7"
                            >
                        </div>
                    </div>

                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_motor" placeholder="Nº de motor" style="border-radius:10px; height: 33px;background: white;" >
                        </div>
                    </div>

                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_chasis" placeholder="Nº de Chasis" style="border-radius:10px; height: 33px;background: white;">
                        </div>
                    </div>

                </div>

                <div class="input-group  second-row">

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <label>Uso</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vehiculo_particular" >
                        <label>Particular</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vehiculo_comercial" >
                        <label>Comercial</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vehiculo_taxi" >
                        <label>Taxi/Remis</label>
                    </div>
                </div>

                <div class="col-6 col-md-1">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vehiculo_tp" >
                        <label>TPP</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vehiculo_urgencia" >
                        <label>Serv/Urgencias</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="vehiculo_seguridad" >
                        <label>Serv/Seguridad</label>
                    </div>
                </div>

                </div>

                <div class="input-group  ">
                 <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <textarea class='w-100' type="text" name="vehiculo_detalles" placeholder="Detalles 1500 caracteres" style="border-radius:10px; height: 82px;background: white;" name="vehiculo_detalles"></textarea>
                    </div>
                </div>


            </div>


            <div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_nombre" placeholder="Nombre y apellido del conductor" style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_telefono" placeholder="Telefono"
                               style="border-radius:10px; height: 33px;background: white;"
                               maxlength="15"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="conductor_documento_id" id="tipo_documentos" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($tipo_documentos as $tipo_documento)
						  	<option value="{{$tipo_documento->id}}" {{$denuncia_siniestro->conductor ?($denuncia_siniestro->conductor->carga_paso_3_documento_id == $tipo_documento->id ? 'selected':''):''}}>{{$tipo_documento->nombre}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_documento_numero" placeholder="Documento numero"
                               style="border-radius:10px; height: 33px;background: white;"
                               maxlength="8"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_codigo_postal" placeholder="Codigo Postal"
                               style="border-radius:10px; height: 33px;background: white;"
                               maxlength="8"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_domicilio" placeholder="Domicilio" style="border-radius:10px; height: 33px;background: white;" >
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_registro" placeholder="Numero de Registro de Conducir" style="border-radius:10px; height: 33px;background: white;" >
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="conductor_carnet_id" id="tipo_carnet" style="border-radius:10px; height: 33px;background: white;">
						  	@foreach($tipo_carnets as $tipo_carnet)
                                <option value="{{$tipo_carnet->id}}" {{$denuncia_siniestro->conductor ?($denuncia_siniestro->conductor->carga_paso_3_carnet_id == $tipo_carnet->id ? 'selected':''):''}}>{{$tipo_carnet->nombre}}</option>
                            @endforeach
						</select>
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_categoria" placeholder="Categoria/Clase"
                               style="border-radius:10px; height: 33px;background: white;"
                               maxlength="5"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="conductor_vencimiento" placeholder="Vencimiento"
                               style="border-radius:10px; height: 33px;background: white;"
                               maxlength="5"
                        >
                    </div>
                </div>
                </div>
                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <label><b>*Examen de alcoholemia</b></label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="radio" class="form-check-input" id="checkbox_alcoholemia_si" name="conductor_alcoholemia" value="1">
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="radio" class="form-check-input" id="checkbox_alcoholemia_no" name="conductor_alcoholemia" value="0" >
                        <label>No</label>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input" id="checkbox_alcoholemia_nego" name="conductor_alcoholemia_nego" >
                        <label>Se negó</label>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <label>Conductor habitual</label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="radio" class="form-check-input" id="checkbox_habitual_si" name="conductor_habitual" value="1" >
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="radio" class="form-check-input" id="checkbox_habitual_no" name="conductor_habitual" value="0" >
                        <label>No</label>
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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso6.create',['id'=> request('id')])}}'>CANCELAR</a>
                     <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='GUARDAR' style="background:#6e4697;font-weight: bold;"/>
        </div>


        <div class="col-12 text-center text-md-right">
            <div wire:loading class="spinner-border" role="status">
                 <span class="sr-only">Cargando...</span>
                 <span class="sr-only">Cargando...</span>
            </div>
        </div>
    </form>
</div>
<br>
<br>
<br>

@section('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#marca_id" ).change(function() {
            marca_id =$( "#marca_id" ).val();
            $('#modelo_id').empty();
            if(marca_id == 'otra')
            {
                $(".otro_marca_modelo").removeClass('d-none');
                $('#modelo_id').append($('<option>', {value: 'otro', text: 'Otro'}));
            } else
            {
                $(".otro_marca_modelo").addClass('d-none');
                $.ajax({
                    url: '/api/marcas/'+marca_id+'/modelos',
                    type: 'get',
                    dataType: 'json',
                    success: function(modelos)
                    {
                        modelos.forEach(modelo =>
                        {
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

    $( "#checkbox_alcoholemia_si" ).click(function() {
        $( "#checkbox_alcoholemia_no" ).prop('checked', false);
        $( "#checkbox_alcoholemia_nego" ).prop('checked', false);
    });

    $( "#checkbox_alcoholemia_no" ).click(function() {
        $( "#checkbox_alcoholemia_si" ).prop('checked', false);
        $( "#checkbox_alcoholemia_nego" ).prop('checked', false);
    });

    $( "#checkbox_alcoholemia_nego" ).click(function() {
        $( "#checkbox_alcoholemia_si" ).prop('checked', false);
        $( "#checkbox_alcoholemia_no" ).prop('checked', false);
    });

    $( "#checkbox_habitual_si" ).click(function() {
        $( "#checkbox_habitual_no" ).prop('checked', false);
    });

    $( "#checkbox_habitual_no" ).click(function() {
        $( "#checkbox_habitual_si" ).prop('checked', false);
    });

    $( "#checkbox_asegurado_si" ).click(function() {
        $( "#checkbox_asegurado_no" ).prop('checked', false);

        if($(this).prop("checked") == true){
            $( "#asegurado_relacion" ).prop('disabled',true);

        }else if($(this).prop("checked") == false){

            if($( "#checkbox_asegurado_no" ).prop("checked") == true){
                $( "#asegurado_relacion" ).prop('disabled',false);
            }

        }

    });

    $( "#checkbox_asegurado_no" ).click(function() {
        $( "#checkbox_asegurado_si" ).prop('checked', false);

        if($(this).prop("checked") == true){
            $( "#asegurado_relacion" ).prop('disabled',false);

        }else if($(this).prop("checked") == false){
            $( "#asegurado_relacion" ).prop('disabled',true);
        }

    });

    if($( "#checkbox_asegurado_no" ).prop("checked") == true){
        $( "#asegurado_relacion" ).prop('disabled',false);

    }


</script>

@endsection
