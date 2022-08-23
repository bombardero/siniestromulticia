<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso7.update")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <input type="hidden" name="v" value="{{request('v')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 7 </b>| 12 <b>Daños materiales a cosas</b></span>

            <div class="input-group  margin-bottom-en-ambos margin">

                 <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                    	<label style="margin-bottom:28px;"><b>1. Item de daños</b></label>
                        <textarea class='w-100' type="text" name="danio_detalles" placeholder="*Detalles de los daños a las cosas 1500 caracteres" style="border-radius:10px; height: 82px;background: white;" name="vehiculo_detalles">{{$danio->carga_paso_7_danio_materiales_detalles}}</textarea>
                    </div>
                </div>



            	<div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="propietario_nombre" placeholder="Nombre y apellido del propietario de las cosas materiales" style="border-radius:10px; height: 33px;background: white;" value="{{$danio->carga_paso_7_danio_materiales_nombre}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="propietario_documento_id" id="tipo_documentos" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($tipo_documentos as $tipo_documento)
						  	<option value="{{$tipo_documento->id}}" {{$danio ?($danio->carga_paso_7_danio_materiales_documento_id == $tipo_documento->id ? 'selected':''):''}}>{{$tipo_documento->nombre}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="propietario_documento_numero" placeholder="Documento numero" style="border-radius:10px; height: 33px;background: white;" value="{{$danio->carga_paso_7_danio_materiales_documento_numero}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="propietario_codigo_postal" placeholder="Codigo Postal" style="border-radius:10px; height: 33px;background: white;" value="{{$danio->carga_paso_7_danio_materiales_codigo_postal}}">
                    </div>
                </div>

                <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="propietario_domicilio" placeholder="Domicilio" style="border-radius:10px; height: 33px;background: white;" value="{{$danio->carga_paso_7_danio_materiales_domicilio}}">
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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso7.create',['id'=> request('id')])}}'>CANCELAR</a>
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
		console.log(marca_id);
	  $.ajax(
			{
				url: '/api/marcas/'+marca_id+'/modelos',
				type: 'get',
				dataType: 'json',
				success: function(modelos)
				{
					$('#modelo_id').empty();
					modelos.forEach(modelo =>
					{
						$('#modelo_id').append($('<option>', {
						    value: modelo['id'],
						    text: modelo['nombre']
						}));
					})

				}
			})


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