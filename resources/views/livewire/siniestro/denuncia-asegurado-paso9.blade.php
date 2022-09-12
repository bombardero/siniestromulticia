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
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_frontal"
                            {{ $denuncia_siniestro->tipo_accidente_frontal ? 'checked' : '' }}>
                        <label>Frontal</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_posterior"
                            {{ $denuncia_siniestro->tipo_accidente_posterior ? 'checked' : '' }}>
                        <label>Posterior</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_cadena"
                            {{ $denuncia_siniestro->tipo_accidente_cadena ? 'checked' : '' }}>
                        <label>En cadena</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_lateral"
                            {{ $denuncia_siniestro->tipo_accidente_lateral ? 'checked' : '' }}>
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
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_vuelco"
                            {{ $denuncia_siniestro->tipo_accidente_vuelco ? 'checked' : '' }}>
                        <label>Vuelco</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_desplaza"
                            {{ $denuncia_siniestro->tipo_accidente_desplaza ? 'checked' : '' }}>
                        <label>Desplaza</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_incendio"
                            {{ $denuncia_siniestro->tipo_accidente_incendio ? 'checked' : '' }}>
                        <label>Incendio</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_inmersion"
                            {{ $denuncia_siniestro->tipo_accidente_inmersion ? 'checked' : '' }}>
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
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_explosion"
                            {{ $denuncia_siniestro->tipo_accidente_explosion ? 'checked' : '' }}>
                        <label>Explosión</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_carga"
                            {{ $denuncia_siniestro->tipo_accidente_carga ? 'checked' : '' }}>
                        <label>Daños a la carga</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="tipo_accidente_otros"
                            {{ $denuncia_siniestro->tipo_accidente_otros ? 'checked' : '' }}>
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
                        <input type="checkbox" class="form-check-input"
                            name="lugar_autopista"
                            {{ $denuncia_siniestro->lugar_autopista ? 'checked' : '' }}>
                        <label>En autopista</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="lugar_calle"
                            {{ $denuncia_siniestro->lugar_calle ? 'checked' : '' }}>
                        <label>En calle</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="lugar_avenida"
                            {{ $denuncia_siniestro->lugar_avenida ? 'checked' : '' }}>
                        <label>En avenida</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="lugar_curva"
                            {{ $denuncia_siniestro->lugar_curva ? 'checked' : '' }}>
                        <label>En curva</label>
                    </div>
                </div>

                </div>

            </div>

                <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="lugar_pendiente"
                            {{ $denuncia_siniestro->lugar_pendiente ? 'checked' : '' }}>
                        <label>En pendiente</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="lugar_tunel"
                            {{ $denuncia_siniestro->lugar_tunel ? 'checked' : '' }}>
                        <label>En túnel</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="lugar_sobrepuente"
                            {{ $denuncia_siniestro->lugar_puente ? 'checked' : '' }}>
                        <label>Sobre puente</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="lugar_otros"
                            {{ $denuncia_siniestro->lugar_otros ? 'checked' : '' }}>
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
                        <input type="checkbox" class="form-check-input"
                            name="colision_peaton"
                            {{ $denuncia_siniestro->colision_peaton ? 'checked' : '' }}>
                        <label>Peatón</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="colision_vehiculo"
                            {{ $denuncia_siniestro->colision_vehiculo ? 'checked' : '' }}>
                        <label>Vehículo</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="colision_edificio"
                            {{ $denuncia_siniestro->colision_edificio ? 'checked' : '' }}>
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
                        <input type="checkbox" class="form-check-input"
                            name="colision_columna"
                            {{ $denuncia_siniestro->colision_columna ? 'checked' : '' }}>
                        <label>Columna</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="colision_animal"
                            {{ $denuncia_siniestro->colision_animal ? 'checked' : '' }}>
                        <label>Animal</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" class="form-check-input"
                            name="colision_transporte"
                            {{ $denuncia_siniestro->colision_transporte_publico ? 'checked' : '' }}>
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
                        <input type="checkbox" class="form-check-input"
                            name="colision_otros"
                            {{ $denuncia_siniestro->colision_otros ? 'checked' : '' }}>
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
