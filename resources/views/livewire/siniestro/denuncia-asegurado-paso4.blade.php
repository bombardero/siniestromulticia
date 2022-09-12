<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso4.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 4 </b>| 12 <b>Datos del asegurado</b></span>

            <div class="input-group  ">

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="asegurado_nombre" placeholder="*Nombre y apellido" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->nombre : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="asegurado_documento_id" id="tipo_documentos" style="border-radius:10px; height: 33px;background: white;">
                          @foreach($tipo_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}" {{ $denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                          @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="asegurado_documento_numero" placeholder="*Documento numero" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->documento_numero : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="asegurado_domicilio" placeholder="*Domicilio" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->domicilio : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="asegurado_codigo_postal" placeholder="*Codigo Postal" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->codigo_postal : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="asegurado_pais_id" id="paises" style="border-radius:10px; height: 33px;background: white;">
						  <option value="1">Argentina</option>
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="asegurado_provincia_id" id="provincias" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ $denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->province_id == $provincia->id ? 'selected' : '' }}
                            >{{ $provincia->name }}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="asegurado_localidad_id" id="localidades" style="border-radius:10px; height: 33px;background: white;">
                            @if($localidades)
                                @foreach($localidades as $localidad)
                                    <option value="{{ $localidad->id }}"
                                        {{$denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->city_id == $localidad->id ? 'selected' : '' }}
                                    >{{ $localidad->name }}</option>
                                @endforeach
                            @endif
						</select>

                    </div>
                </div>


                <div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="asegurado_ocupacion" placeholder="*Ocupacion" style="border-radius:10px; height: 33px;background: white;"
                               value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->ocupacion : '' }}"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="asegurado_telefono" placeholder="*Telefono" style="border-radius:10px; height: 33px;background: white;"
                               value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->telefono : '' }}"
                        >
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

                     <a class="mt-5 boton-enviar-siniestro btn" style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso3.create',['id'=> request('id')])}}'>ANTERIOR</a>
                     <input type="submit" class="mt-5 boton-enviar-siniestro btn" value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
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
