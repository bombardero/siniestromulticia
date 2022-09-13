<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso3.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 3 </b>| 12 <b>Datos del conductor del vehiculo asegurado</b></span>

            <div class="input-group  margin-bottom-en-ambos margin">

            	<div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="nombre" placeholder="Nombre y apellido" style="border-radius:10px; height: 33px;background: white;" value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->nombre) ? $denuncia_siniestro->conductor->nombre : $denuncia_siniestro->nombre_conductor }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="telefono" placeholder="*Telefono" style="border-radius:10px; height: 33px;background: white;" value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->telefono) ? $denuncia_siniestro->conductor->telefono : ''}}">
                    </div>
                </div>

                <div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="domicilio" placeholder="*Domicilio" style="border-radius:10px; height: 33px;background: white;" value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->domicilio) ? $denuncia_siniestro->conductor->domicilio : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="codigo_postal" placeholder="*Codigo Postal" style="border-radius:10px; height: 33px;background: white;" value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->codigo_postal) ? $denuncia_siniestro->conductor->codigo_postal : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="pais_id" id="paises" style="border-radius:10px; height: 33px;background: white;">
						  <option value="1">Argentina</option>
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="provincia_id" id="provincias" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($provincias as $provincia)
						  	<option value="{{ $provincia->id }}"
                                {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->province_id ==  $provincia->id ? 'selected' : ''}}>{{ $provincia->name }}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="localidad_id" id="localidades" style="border-radius:10px; height: 33px;background: white;">
                            @if($localidades)
                                @foreach($localidades as $localidad)
                                    <option value="{{ $localidad->id }}"
                                        {{$denuncia_siniestro->conductor && $denuncia_siniestro->conductor->city_id == $localidad->id ? 'selected' : '' }}>{{ $localidad->name }}</option>
                                @endforeach
                            @endif
						</select>

                    </div>
                </div>


                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="date" name="fecha_nacimiento" placeholder="*Fecha de Nacimiento)" style="border-radius:10px; height: 33px;background: white;" value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->fecha_nacimiento) ? $denuncia_siniestro->conductor->fecha_nacimiento : '' }}">
                    </div>
                </div>

                 <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="documento_id" id="tipo_documentos" style="border-radius:10px; height: 33px;background: white;">
						  @foreach($tipo_documentos as $tipo_documento)
						  	<option value="{{ $tipo_documento->id }}"
                                {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->tipo_documento_id == $tipo_documento->id) ? 'selected':''}}>{{$tipo_documento->nombre}}</option>
						  @endforeach
						</select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="documento_numero" placeholder="*Documento numero" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->documento_numero ? $denuncia_siniestro->conductor->documento_numero : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="ocupacion" placeholder="*Ocupacion" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->ocupacion ? $denuncia_siniestro->conductor->ocupacion : ''}}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="numero_registro" placeholder="*Numero de Registro de Conducir" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->numero_registro ? $denuncia_siniestro->conductor->numero_registro : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="estado_civil" placeholder="*Estado Civil" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->estado_civil ? $denuncia_siniestro->conductor->estado_civil : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="carnet_id" id="tipo_carnet" style="border-radius:10px; height: 33px;background: white;">
						  	@foreach($tipo_carnets as $tipo_carnet)
                                <option value="{{ $tipo_carnet->id }}"
                                    {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->tipo_carnet_id == $tipo_carnet->id ? 'selected' : '' }}>{{ $tipo_carnet->nombre }}</option>
                            @endforeach
						</select>
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="carnet_categoria" placeholder="*Categoria/Clase" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->carnet_categoria ? $denuncia_siniestro->conductor->carnet_categoria : '' }}">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="carnet_vencimiento" placeholder="*Vencimiento" style="border-radius:10px; height: 33px;background: white;" value="{{ $denuncia_siniestro->conductor  && $denuncia_siniestro->conductor->carnet_vencimiento ? $denuncia_siniestro->conductor->carnet_vencimiento : '' }}">
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
                        <input type="radio" wire:model.defer="alcoholemia" class="form-check-input" id="checkbox_alcoholemia_si" name="alcoholemia" value="1" {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->alcoholemia ? 'checked' : '' }}>
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="radio" wire:model.defer="alcoholemia" class="form-check-input" id="checkbox_alcoholemia_no" name="alcoholemia" value="0" {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->alcoholemia == false ? 'checked' : ''}}>
                        <label>No</label>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="alcoholemia_se_nego" class="form-check-input" id="checkbox_alcoholemia_nego" name="alcoholemia_nego" {{ $denuncia_siniestro->conductor && $denuncia_siniestro->conductor->alcoholemia_se_nego ? 'checked' : '' }}>
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
                        <input type="radio" wire:model.defer="habitual" class="form-check-input" id="checkbox_habitual_si" name="habitual" value="1" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->habitual) ? 'checked' : '' }}>
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-1">
                    <div class="input-group  ">
                        <input type="radio" wire:model.defer="habitual" class="form-check-input" id="checkbox_habitual_no" name="habitual" value="0" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->habitual == false) ? 'checked' : '' }}>
                        <label>No</label>
                    </div>
                </div>
                </div>
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
                        <input type="radio" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_asegurado_si" name="asegurado" value="1" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->asegurado) ? 'checked' : '' }}>
                        <label>Si</label>
                    </div>
                </div>

                <div class="col-12 col-md-1 pt-0">
                    <div class="input-group  ">
                        <input type="radio" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_asegurado_no" name="asegurado" value="0" {{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->asegurado == false) ? 'checked' : '' }}>
                        <label>No</label>
                    </div>
                </div>

                <div class="col-12 col-md-3 pt-0"></div>

                <div class="col-12 col-md-4 pt-0 padding-right-en-mobile">
                    <div class="input-group  ">
                        <input class='w-100' type="text" id='asegurado_relacion' name="asegurado_relacion" placeholder="Relación con el asegurado" style="border-radius:10px; height: 33px;background: white;" value="{{ ($denuncia_siniestro->conductor && $denuncia_siniestro->conductor->asegurado_relacion) ? $denuncia_siniestro->conductor->asegurado_relacion : '' }}" disabled>
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

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso2.create',['id'=> request('id')])}}'>ANTERIOR</a>
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
