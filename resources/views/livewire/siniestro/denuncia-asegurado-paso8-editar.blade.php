<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso8.update")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <input type="hidden" name="v" value="{{request('v')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 8 </b>| 12 <b>Lesiones a terceros transportados y no transportados</b></span>

            <div class="input-group  margin-bottom-en-ambos margin">

            	<div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_nombre" placeholder="Nombre y Apellido" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados->carga_paso_8_lesionado_nombre}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_telefono" placeholder="Telefono" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados->carga_paso_8_lesionado_telefono}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="lesionado_documento_id" id="tipo_documentos" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($tipo_documentos as $tipo_documento)
						  	<option value="{{$tipo_documento->id}}" {{$lesionados ?($lesionados->carga_paso_8_lesionado_documento_id == $tipo_documento->id ? 'selected':''):''}}>{{$tipo_documento->nombre}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_documento_numero" placeholder="Documento número" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados->carga_paso_8_lesionado_documento_numero}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_codigo_postal" placeholder="Código Postal" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados->carga_paso_8_lesionado_codigo_postal}}">
                    </div>
                </div>

                <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_domicilio" placeholder="Domicilio" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados->carga_paso_8_lesionado_domicilio}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_estado_civil" placeholder="*Estado Civil" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados ?($lesionados->carga_paso_8_lesionado_estado_civil):''}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_fecha_nacimiento" placeholder="*Fecha de Nacimiento)" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados ?($lesionados->carga_paso_8_lesionado_fecha_nacimiento):''}}">
                    </div>
                </div>


                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" id='asegurado_relacion' name="lesionado_relacion" placeholder="Relación con el asegurado" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados ?($lesionados->carga_paso_8_lesionado_relacion):''}}">
                    </div>
                </div>

                <div class="input-group  second-row pt-3">

                <div class="col-6 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="lesionado_conductor" {{$lesionados->carga_paso_8_lesionado_conductor == 'on' ? 'checked':''}}>
                        <label>Conductor del vehículo</label>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="lesionado_pasajero_otro" {{$lesionados->carga_paso_8_lesionado_pasajero_otro == 'on' ? 'checked':''}}>
                        <label>Pasajero de otro vehículo</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="lesionado_peaton" {{$lesionados->carga_paso_8_lesionado_peaton == 'on' ? 'checked':''}}>
                        <label>Peatón</label>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="lesionado_pasajero_asegurado" {{$lesionados->carga_paso_8_lesionado_pasajero_asegurado == 'on' ? 'checked':''}}>
                        <label>Pasajero de vehículo asegurado</label>
                    </div>
                </div>


                </div>

                <div class="col-12 col-md-12 pt-0" >
                        <hr style="border:1px solid lightgray;">
                </div>

                <div class="input-group  margin-left-en-mobile">
	                <div class="col-12 col-md-3">
	                    <div class="input-group  ">
	                        <label>Tipo de lesiones</label>
	                    </div>
	                </div>

	                <div class="col-12 col-md-1">
	                    <div class="input-group  ">
	                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_leve" name="lesionado_leve" {{$lesionados->carga_paso_8_lesionado_leve == 'on' ? 'checked':''}}>
	                        <label>Leve</label>
	                    </div>
	                </div>

	                <div class="col-12 col-md-1">
	                    <div class="input-group  ">
	                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_grave" name="lesionado_grave" {{$lesionados->carga_paso_8_lesionado_grave == 'on' ? 'checked':''}}>
	                        <label>Grave</label>
	                    </div>
	                </div>

	                <div class="col-12 col-md-2">
	                    <div class="input-group  ">
	                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_mortal" name="lesionado_mortal" {{$lesionados->carga_paso_8_lesionado_mortal == 'on' ? 'checked':''}}>
	                        <label>Mortal</label>
	                    </div>
	                </div>
                </div>

                <div class="col-12 col-md-12 pt-1" >
                        <hr style="border:1px solid lightgray;">
                </div>

                <div class="input-group  margin-left-en-mobile">
	                <div class="col-12 col-md-3">
	                    <div class="input-group  ">
	                        <label>Examen de alcoholemia</label>
	                    </div>
	                </div>

	                <div class="col-12 col-md-1">
	                    <div class="input-group  ">
	                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_alcoholemia_si" name="lesionado_alcoholemia_si" {{$lesionados->carga_paso_8_lesionado_alcoholemia_si == 'on' ? 'checked':''}}>
	                        <label>Si</label>
	                    </div>
	                </div>

	                <div class="col-12 col-md-1">
	                    <div class="input-group  ">
	                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_alcoholemia_no" name="lesionado_alcoholemia_no" {{$lesionados->carga_paso_8_lesionado_alcoholemia_no == 'on' ? 'checked':''}}>
	                        <label>No</label>
	                    </div>
	                </div>

	                <div class="col-12 col-md-2">
	                    <div class="input-group  ">
	                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_alcoholemia_nego" name="lesionado_alcoholemia_nego" {{$lesionados->carga_paso_8_lesionado_alcoholemia_nego == 'on' ? 'checked':''}}>
	                        <label>Se negó</label>
	                    </div>
	                </div>
                </div>

            <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_centro_asistencial" placeholder="Centro asistencial" style="border-radius:10px; height: 33px;background: white;" value="{{$lesionados->carga_paso_8_lesionado_centro_asistencial}}">
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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso8.create',['id'=> request('id')])}}'>CANCELAR</a>
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

    $( "#checkbox_leve" ).click(function() {
        $( "#checkbox_grave" ).prop('checked', false);
        $( "#checkbox_mortal" ).prop('checked', false);
    });

    $( "#checkbox_grave" ).click(function() {
        $( "#checkbox_leve" ).prop('checked', false);
        $( "#checkbox_mortal" ).prop('checked', false);
    });

    $( "#checkbox_mortal" ).click(function() {
        $( "#checkbox_leve" ).prop('checked', false);
        $( "#checkbox_grave" ).prop('checked', false);
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

</script>

@endsection