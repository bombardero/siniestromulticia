<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso2.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 2 </b>| 12 <b>Lugar del siniestro</b></span>

            <div class="input-group  first-row">

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="paises" id="paises" style="border-radius:10px; height: 33px;background: white;">
						  <option value="salta">Argentina</option>
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' id="provincias" style="border-radius:10px; height: 33px;background: white;" name="provincia_id">
						  @foreach($provincias as $provincia)

						  	<option value="{{$provincia->id}}"{{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_provincia_id == $provincia->id ? 'selected':''):''}}>{{$provincia->name}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' id="localidades" style="border-radius:10px; height: 33px;background: white;" name="localidad_id">
                            @if($localidades)
                                @foreach($localidades as $localidad)
                                    <option value="{{$localidad->id}}"{{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_localidad_id == $localidad->id ? 'selected':''):''}}>{{$localidad->name}}</option>
                                @endforeach
                            @endif
						</select>

                    </div>
                </div>


                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" placeholder="*Calle o N° de Ruta (Nacional o Provincial)" style="border-radius:10px; height: 33px;background: white;" name="calle" value="{{$denuncia_siniestro->lugar ? $denuncia_siniestro->lugar->carga_paso_2_calle:($denuncia_siniestro->precarga_direccion_siniestro?$denuncia_siniestro->precarga_direccion_siniestro:'')}}">
                    </div>
                </div>
                 <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' id="tipo_calzadas" style="border-radius:10px; height: 33px;background: white;" name="calzada_id">
						  @foreach($tipo_calzadas as $tipo_calzada)

						  	<option value="{{$tipo_calzada->id}}" {{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_calzada_id == $tipo_calzada->id ? 'selected':''):''}} >{{$tipo_calzada->nombre}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" placeholder="Detalle del estado de calzada" style="border-radius:10px; height: 33px;background: white;" name="calzada_detalle" value="{{$denuncia_siniestro->lugar ? $denuncia_siniestro->lugar->carga_paso_2_calzada_detalle : ''}}">
                    </div>
                </div>

                <div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" placeholder="Interseccion de dos arterias" style="border-radius:10px; height: 33px;background: white;" name="interseccion" value="{{$denuncia_siniestro->lugar ? $denuncia_siniestro->lugar->carga_paso_2_interseccion : ''}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3 margin-left-en-mobile">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1" name="cruce_senalizado" {{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_cruce_senalizado == 'on' ? 'checked':''):''}}>
                        <label>*Cruce señalizado</label>
                    </div>
                </div>
            </div>
            <div class="input-group margin-left-en-mobile">
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <label>Tren Barrera señalizado</label>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_tren_si" name="tren_si" {{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_tren_si == 'on' ? 'checked':''):''}}>
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_tren_no" name="tren_no" {{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_tren_no == 'on' ? 'checked':''):''}}>
                        <label>No</label>
                    </div>
                </div>



                <div class="col-12 col-md-12 pt-1" >
                        <hr style="border:1px solid lightgray;">
                </div>
            </div>
            <div class="input-group margin-left-en-mobile margin-bottom-en-ambos">
                <div class="col-12 col-md-4 pt-1">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_semaforo" name="semaforo" {{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_semaforo == 'on' ? 'checked':''):''}}>
                        <label>Semaforo</label>
                    </div>
                </div>

                <div class="col-12 col-md-2 pt-1">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_semaforo_funciona" name="semaforo_funciona" {{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_semaforo_funciona == 'on' ? 'checked':''):''}} disabled>
                        <label>Funciona bien</label>
                    </div>
                </div>

                <div class="col-12 col-md-2 pt-1">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_semaforo_intermitente" name="semaforo_intermitente" {{$denuncia_siniestro->lugar ? ($denuncia_siniestro->lugar->carga_paso_2_semaforo_intermitente == 'on' ? 'checked':''):''}} disabled>
                        <label>Intermitente</label>
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-1">
                    <div class="input-group  padding-right-en-mobile">
                        <input class='w-100' type="text" id='semaforo_color' name="semaforo_color" placeholder="en color" style="border-radius:10px; height: 33px;background: white;" value="{{$denuncia_siniestro->lugar ? $denuncia_siniestro->lugar->carga_paso_2_semaforo_color:''}}" disabled>
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

                     <a class="mt-3 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso1.create',['id'=> request('id'),'noredirect'=>true])}}'>ANTERIOR</a>
                     <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
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

    $( "#checkbox_tren_si" ).click(function() {
        $( "#checkbox_tren_no" ).prop('checked', false);
    });

    $( "#checkbox_tren_no" ).click(function() {
        $( "#checkbox_tren_si" ).prop('checked', false);
    });

    $( "#checkbox_semaforo_funciona" ).click(function() {
        $( "#checkbox_semaforo_intermitente" ).prop('checked', false);
    });

    $( "#checkbox_semaforo_intermitente" ).click(function() {
        $( "#checkbox_semaforo_funciona" ).prop('checked', false);
    });

    $( "#checkbox_semaforo" ).click(function() {
        if($(this).prop("checked") == true){
            $( "#checkbox_semaforo_funciona" ).prop('disabled',false);
            $( "#checkbox_semaforo_intermitente" ).prop('disabled',false);
            $( "#semaforo_color" ).prop('disabled',false);
            if($( "#checkbox_semaforo_intermitente" ).prop("checked") == true){
            }
        }else if($(this).prop("checked") == false){
            $( "#checkbox_semaforo_funciona" ).prop('disabled',true);
            $( "#checkbox_semaforo_intermitente" ).prop('disabled',true);
            $( "#semaforo_color" ).prop('disabled',true);
        }
    });

    $( "#checkbox_semaforo_funciona" ).click(function() {
        if($(this).prop("checked") == true){
            //$( "#semaforo_color" ).prop('disabled',true);
        }else if($(this).prop("checked") == false){
            //$( "#semaforo_color" ).prop('disabled',false);
        }
    });

    $( "#checkbox_semaforo_intermitente" ).click(function() {
        if($(this).prop("checked") == true){
            //$( "#semaforo_color" ).prop('disabled',false);
        }else if($(this).prop("checked") == false){
            //$( "#semaforo_color" ).prop('disabled',true);
        }
    });

    if($( "#checkbox_semaforo" ).prop("checked") == true){
        $( "#checkbox_semaforo_funciona" ).prop('disabled',false);
        $( "#checkbox_semaforo_intermitente" ).prop('disabled',false);
        $( "#semaforo_color" ).prop('disabled',false);

        /*if($( "#checkbox_semaforo_intermitente" ).prop("checked") == true){
        }*/
    }

});
</script>

@endsection