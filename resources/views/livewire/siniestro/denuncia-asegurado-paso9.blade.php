<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso9.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 9 </b>| 12 <b>Tipo de accidente</b></span>

            <div class="input-group  ">

                <label style="margin-bottom:28px;margin-top: 18px;"><b>Tipo de accidente</b></label>
                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_si" name="tipo_accidente_frontal" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_frontal == 'on' ? 'checked':''}}>
                        <label>Frontal</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_posterior" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_posterior == 'on' ? 'checked':''}}>
                        <label>Posterior</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_cadena" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_cadena == 'on' ? 'checked':''}}>
                        <label>En cadena</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_lateral" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_lateral == 'on' ? 'checked':''}}>
                        <label>Lateral</label>
                    </div>
                </div>

                </div>

            </div>

            <div class="col-12 col-md-12 pt-0" >
                        <hr style="border:1px solid lightgray;margin-top: 0px;margin-bottom: 8px;">
                </div>


                <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_si" name="tipo_accidente_vuelco" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_vuelco == 'on' ? 'checked':''}}>
                        <label>Vuelco</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_desplaza" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_desplaza == 'on' ? 'checked':''}}>
                        <label>Desplaza</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_incendio" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_incendio == 'on' ? 'checked':''}}>
                        <label>Incendio</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_inmersion" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_inmersion == 'on' ? 'checked':''}}>
                        <label>Inmersión</label>
                    </div>
                </div>

                </div>

            </div>

            <div class="col-12 col-md-12 pt-0" >
                        <hr style="border:1px solid lightgray;margin-top: 0px;margin-bottom: 8px;">
                </div>


                <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_si" name="tipo_accidente_explosion" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_explosion == 'on' ? 'checked':''}}>
                        <label>Explosión</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_carga" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_carga == 'on' ? 'checked':''}}>
                        <label>Daños a la carga</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="tipo_accidente_otros" {{$denuncia_siniestro->carga_paso_9_tipo_accidente_otros == 'on' ? 'checked':''}}>
                        <label>Otros</label>
                    </div>
                </div>

                </div>

            </div>

            <div class="col-12 col-md-12 pt-0" >
                        <hr style="border:1px solid lightgray;margin-top: 0px;">
                </div>

                <div class="input-group  ">

                <label style="margin-bottom:28px;"><b>Lugar</b></label>
                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_si" name="lugar_autopista" {{$denuncia_siniestro->carga_paso_9_lugar_autopista == 'on' ? 'checked':''}}>
                        <label>En autopista</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="lugar_calle" {{$denuncia_siniestro->carga_paso_9_lugar_calle == 'on' ? 'checked':''}}>
                        <label>En calle</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="lugar_avenida" {{$denuncia_siniestro->carga_paso_9_lugar_avenida == 'on' ? 'checked':''}}>
                        <label>En avenida</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="lugar_curva" {{$denuncia_siniestro->carga_paso_9_lugar_curva == 'on' ? 'checked':''}}>
                        <label>En curva</label>
                    </div>
                </div>

                </div>

            </div>

                <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_si" name="lugar_pendiente" {{$denuncia_siniestro->carga_paso_9_lugar_pendiente == 'on' ? 'checked':''}}>
                        <label>En pendiente</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="lugar_tunel" {{$denuncia_siniestro->carga_paso_9_lugar_tunel == 'on' ? 'checked':''}}>
                        <label>En túnel</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="lugar_sobrepuente" {{$denuncia_siniestro->carga_paso_9_lugar_sobrepuente == 'on' ? 'checked':''}}>
                        <label>Sobre puente</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="lugar_otros" {{$denuncia_siniestro->carga_paso_9_lugar_otros == 'on' ? 'checked':''}}>
                        <label>Otros</label>
                    </div>
                </div>

                </div>

            </div>

				<div class="col-12 col-md-12 pt-0" >
                        <hr style="border:1px solid lightgray;">
                </div>



                   <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3" style="padding-left: 4px !important;">
                    <div class="input-group  ">
                        <label><b>Colisión con</b></label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="colision_peaton" {{$denuncia_siniestro->carga_paso_9_colision_peaton == 'on' ? 'checked':''}}>
                        <label>Peatón</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="colision_vehiculo" {{$denuncia_siniestro->carga_paso_9_colision_vehiculo == 'on' ? 'checked':''}}>
                        <label>Vehículo</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="colision_edificio" {{$denuncia_siniestro->carga_paso_9_colision_edificio == 'on' ? 'checked':''}}>
                        <label>Edificio</label>
                    </div>
                </div>

                </div>

            </div>

            <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">

                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="colision_columna" {{$denuncia_siniestro->carga_paso_9_colision_columna == 'on' ? 'checked':''}}>
                        <label>Columna</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="colision_animal" {{$denuncia_siniestro->carga_paso_9_colision_animal == 'on' ? 'checked':''}}>
                        <label>Animal</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="colision_transporte" {{$denuncia_siniestro->carga_paso_9_colision_transporte == 'on' ? 'checked':''}}>
                        <label>Transporte público</label>
                    </div>
                </div>

                </div>

            </div>

            <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">

                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="colision_otros" {{$denuncia_siniestro->carga_paso_9_colision_otros == 'on' ? 'checked':''}}>
                        <label>Otros</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                </div>

                <div class="col-12 col-md-3">

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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso8.create',['id'=> request('id')])}}'>ANTERIOR</a>
                     <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
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
	$( "#provincias" ).change(function() {
		provincia_id =$( "#provincias" ).val();
		console.log(provincia_id);
	  $.ajax(
			{
				url: '/api/provincias/'+provincia_id+'/localidades',
				type: 'get',
				dataType: 'json',
				success: function(cities)
				{
					$('#localidades').empty();
					cities.forEach(city =>
					{
						$('#localidades').append($('<option>', {
						    value: city['id'],
						    text: city['name']
						}));
					})

				}
			})


	});

});
</script>

@endsection