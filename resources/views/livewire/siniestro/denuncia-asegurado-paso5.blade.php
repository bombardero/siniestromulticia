<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso5.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 5 </b>| 12 <b>Datos del vehiculo asegurado</b></span>

            <div class="input-group  first-row">
                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <select class='w-100' name="vehiculo_marca_id" id="marca_id" style="border-radius:10px; height: 33px;background: white;">
    						  @foreach($marcas as $marca)
                                <option value="{{$marca->id}}" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_marca_id == $marca->id ? 'selected':''):''}}>{{$marca->nombre}}</option>
                              @endforeach
    						</select>

                        </div>
                    </div>

                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <select class='w-100' name="vehiculo_modelo_id" id="modelo_id" style="border-radius:10px; height: 33px;background: white;">
    						  @if($modelos)
                                    @foreach($modelos as $modelo)
                                        <option value="{{$modelo->id}}"{{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_modelo_id == $modelo->id ? 'selected':''):''}}>{{$modelo->nombre}}</option>
                                    @endforeach
                                @endif
    						</select>

                        </div>
                    </div>

                    <div class="col-12 col-md-2 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_tipo" placeholder="*Tipo" style="border-radius:10px; height: 33px;background: white;" value="{{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_tipo):''}}">
                        </div>
                    </div>

                    <div class="col-12 col-md-2 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_anio" placeholder="*Año" style="border-radius:10px; height: 33px;background: white;" value="{{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_anio):''}}">
                        </div>
                    </div>


                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_dominio" placeholder="*Dominio" style="border-radius:10px; height: 33px;background: white;" value="{{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_dominio == '' ? $denuncia_siniestro->vehiculo->precarga_dominio_vehiculo_asegurado : $denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_dominio ):''}}">
                        </div>
                    </div>

                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_motor" placeholder="*Nº de motor" style="border-radius:10px; height: 33px;background: white;" value="{{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_motor):''}}">
                        </div>
                    </div>

                    <div class="col-12 col-md-4 pt-3">
                        <div class="input-group  ">
                            <input class='w-100' type="text" name="vehiculo_chasis" placeholder="*Nº de Chasis" style="border-radius:10px; height: 33px;background: white;" value="{{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_chasis):''}}">
                        </div>
                    </div>

                </div>
                <div class="input-group  second-row">

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <label>*Uso</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_particular" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_particular == 'on' ? 'checked':''):''}}>
                        <label>Particular</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_comercial" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_comercial == 'on' ? 'checked':''):''}}>
                        <label>Comercial</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_taxi" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_taxi == 'on' ? 'checked':''):''}}>
                        <label>Taxi/Remis</label>
                    </div>
                </div>

                <div class="col-6 col-md-1">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_tp" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_tp == 'on' ? 'checked':''):''}}>
                        <label>TPP</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_urgencia" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_urgencia == 'on' ? 'checked':''):''}}>
                        <label>Serv/Urgencias</label>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_seguridad" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_seguridad == 'on' ? 'checked':''):''}}>
                        <label>Serv/Seguridad</label>
                    </div>
                </div>



                <div class="col-12 col-md-12 pt-1" >
                        <hr style="border:1px solid lightgray;">
                </div>

                <div class="col-12 col-md-3 pt-0">
                    <div class="input-group  ">
                        <label><b>*Tipo de siniestro</b></label>
                    </div>
                </div>

                <div class="col-12 col-md-3 pt-0">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_siniestro_danio" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_siniestro_danio == 'on' ? 'checked':''):''}}>
                        <label>Daños</label>
                    </div>
                </div>

                <div class="col-12 col-md-3 pt-0">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_siniestro_robo" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_siniestro_robo == 'on' ? 'checked':''):''}}>
                        <label>Robo</label>
                    </div>
                </div>

                <div class="col-12 col-md-3 pt-0">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="vehiculo_siniestro_incendio" {{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_siniestro_incendio == 'on' ? 'checked':''):''}}>
                        <label>Incendio</label>
                    </div>
                </div>

                </div>
            <div class="input-group  ">
                 <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <textarea class='w-100' type="text" name="vehiculo_detalles" placeholder="Detalles 1500 caracteres" style="border-radius:10px; height: 82px;background: white;" name="vehiculo_detalles">{{$denuncia_siniestro->vehiculo ?($denuncia_siniestro->vehiculo->carga_paso_5_vehiculo_detalles):''}}</textarea>
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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso4.create',['id'=> request('id')])}}'>ANTERIOR</a>
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
</script>

@endsection