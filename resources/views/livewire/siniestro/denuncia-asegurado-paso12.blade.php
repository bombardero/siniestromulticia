<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso12.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 12 </b>| 12 <b>datos del denunciante</b></span> <span style="color:#6E4697; font-size:13px;">(Persona que está complentando este formulario)</span>

            <div class="input-group margin-left-en-mobile" >
                <div class="col-12 col-md-12 pt-0" >
                        <hr style="border:1px solid lightgray;">
                </div>

                <div class="col-12 col-md-3 pt-0">
                    <div class="input-group  ">
                        <label><b>*Es el propio asegurado</b></label>
                    </div>
                </div>

                <div class="col-12 col-md-1 pt-0">
                    <div class="input-group  ">
                        <input type="radio" class="form-check-input" id="checkbox_asegurado_si" name="asegurado" value="1"
                            {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->asegurado ? 'checked' : '' }}>
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-1 pt-0">
                    <div class="input-group  ">
                        <input type="radio" class="form-check-input" id="checkbox_asegurado_no" name="asegurado" value="0"
                            {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->asegurado === false ? 'checked' : '' }}>
                        <label>No</label>
                    </div>
                </div>

                <div class="col-12 col-md-3 pt-0"></div>

                <div class="col-12 col-md-4 pt-0 padding-right-en-mobile">
                    <div class="input-group  ">
                        <input class='w-100' type="text" id='asegurado_relacion' name="asegurado_relacion" placeholder="Relación con el asegurado" style="border-radius:10px; height: 33px;background: white;"
                               value="{{$denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->asegurado_relacion : '' }}" disabled>
                    </div>
                </div>


            </div>
            <div class="input-group  margin-bottom-en-ambos margin">

            	<div class="col-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="nombre" placeholder="Nombre y apellido" style="border-radius:10px; height: 33px;background: white;"
                               value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->nombre : '' }}">
                    </div>
                </div>


                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="tipo_documento_id" id="tipo_documentos" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($tipo_documentos as $tipo_documento)
						  	<option value="{{$tipo_documento->id}}"
                                {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->tipo_documento_id == $tipo_documento->id ? 'selected' : ''}}
                            >{{$tipo_documento->nombre}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="documento_numero" placeholder="*Documento numero" style="border-radius:10px; height: 33px;background: white;"
                               value="{{ $denuncia_siniestro->denunciante  ? $denuncia_siniestro->denunciante->documento_numero : ''}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="telefono" placeholder="*Telefono" style="border-radius:10px; height: 33px;background: white;"
                               value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->telefono : ''}}">
                    </div>
                </div>

                <div class="col-12 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="provincia_id" id="provincias" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($provincias as $provincia)
						  	<option value="{{$provincia->id}}"
                                {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->province_id == $provincia->id ? 'selected' : '' }}
                            >{{$provincia->name}}</option>
						  @endforeach
						</select>

                    </div>
                </div>
                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="domicilio" placeholder="*Domicilio" style="border-radius:10px; height: 33px;background: white;"
                            value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante-> domicilio : ''}}"
                        >
                    </div>
                </div>


                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="localidad_id" id="localidades" style="border-radius:10px; height: 33px;background: white;">
                            @if($localidades)
                                @foreach($localidades as $localidad)
                                    <option value="{{$localidad->id}}"
                                        {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->city_id == $localidad->id ? 'selected' : '' }}
                                    >{{$localidad->name}}</option>
                                @endforeach
                            @endif
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="codigo_postal" placeholder="*Codigo Postal" style="border-radius:10px; height: 33px;background: white;"
                               value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->codigo_postal : '' }}">
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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso11.create',['id'=> request('id')])}}'>ANTERIOR</a>
                     <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='FINALIZAR' style="background:#6e4697;font-weight: bold;"/>
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
