<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso6.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 6 </b>| 12 <b>Detalles de los otros vehiculos</b></span>

            <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">
                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <label><b>*Intervino otro/s vehiculo</b></label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_si" name="intervino_si" {{$denuncia_siniestro->carga_paso_6_intervino_si == 'on' ? 'checked':''}}>
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_intervino_no" name="intervino_no" {{$denuncia_siniestro->carga_paso_6_intervino_no == 'on' ? 'checked':''}}>
                        <label>No</label>
                    </div>
                </div>


                <div class="col-12 col-md-3">
                    <div class="input-group  ">
                        <label><b>*Tengo los datos</b></label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_datos_si" name="datos_si" {{$denuncia_siniestro->carga_paso_6_datos_si == 'on' ? 'checked':''}}>
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_datos_no" name="datos_no" {{$denuncia_siniestro->carga_paso_6_datos_no == 'on' ? 'checked':''}}>
                        <label>No</label>
                    </div>
                </div>
                </div>


                {{-- INICIO TABLE*********************************  --}}
                <div class="table-responsive">

                      <table class="table" style="margin-bottom: 120px;">
                           <tbody>

                              @if($denuncia_siniestro->vehiculoTerceros)
                              @foreach($denuncia_siniestro->vehiculoTerceros as $vehiculo)
                              <tr class="borde-tabla">
                                <td>{{$vehiculo->carga_paso_6_vehiculo_terceros_propietario_nombre}}</td>
                                <td>{{\App\Models\Marca::where('id',$vehiculo->carga_paso_6_vehiculo_terceros_marca_id)->first()->nombre}} {{\App\Models\Modelo::where('id',$vehiculo->carga_paso_6_vehiculo_terceros_modelo_id)->first()->nombre}}</td>
                                <td>{{$vehiculo->carga_paso_6_vehiculo_terceros_detalles}}</td>
                                <td><a href="{{route('asegurados-denuncias-paso6.edit',['id'=> request('id'),'v'=> $vehiculo->id])}}"><img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"></a></td>
                                </div>
                              </tr>
                              @endforeach
                              @else

                              <td> No hay vehiculos de otros cargadas todavia </td>

                              @endif
                            </tbody>

                      </table>
                       {{--
                       {{$denuncia_siniestro->links('vendor.pagination.bootstrap-4')}}
                    --}}

                    </div>

                {{-- FIN TABLE*********************************  --}}



                 <div class="col-12 col-md-12">
                    <div class="input-group  ">
                        <a href="{{route('asegurados-denuncias-paso6agregar.create',['id'=> request('id')])}}" style="color:#6E4697;"><img src="{{url('/images/siniestros/denuncia_asegurado/agregar.png')}}"/> Agregar vehiculo</a>
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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso5.create',['id'=> request('id')])}}'>ANTERIOR</a>
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

    $( "#checkbox_intervino_si" ).click(function() {
        $( "#checkbox_intervino_no" ).prop('checked', false);
    });

    $( "#checkbox_intervino_no" ).click(function() {
        $( "#checkbox_intervino_si" ).prop('checked', false);
    });

    $( "#checkbox_datos_si" ).click(function() {
        $( "#checkbox_datos_no" ).prop('checked', false);
    });

    $( "#checkbox_datos_no" ).click(function() {
        $( "#checkbox_datos_si" ).prop('checked', false);
    });


</script>

@endsection