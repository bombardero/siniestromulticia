<div class="">
	@if($blockMode == 1)
	   @if($tipoPersonaAlerta && $updateModeHum) 
		    <div class="mt-3 alert alert-danger" role="alert">
 				  {{$tipoPersonaAlerta}}
			</div>
			@endif
	@else
<div class="stepwizard pt-3">

    <div class=" row setup-panel">

        <div class="stepwizard-step col-6">

            <a href="#step-1" wire:click="thisStep(1)"type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>

            <p>Informacion Inquilino</p>

        </div>

        <div class="stepwizard-step col-6">
        	@if(!$solicitud->inquilino)
        	<fieldset disabled="disabled">
            	<a href="#step-2" type="button" class="btn btn-circle ">2</a>
        	</fieldset>
        	@else
        		<a href="#step-2" wire:click="thisStep(2)" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
        	@endif

            <p>Archivos</p>

        </div>
    </div>

</div>

 	<div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
	    <form wire:submit.prevent="{{$formMode}}" enctype="multipart/form-data">
	    	@if($solicitud->pago->status == 'Pagada' || $solicitud->status == 'Aprobada')
	    	<fieldset disabled="disabled">
	    	@endif
	    	
			<div class = "bg-form">
			    <p class="pt-5 pb-3 completa-datos text-center">
			      Información Inquilino Persona Humana  	{{$updateModeHum}}	
			    </p> 

			   
			    
			    	<div class="form-group row">
			    
			    
		     			<div class="col-12">
			        	   @error('nombre') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				            	<input  class="mayus form-estilo prueba w-100" type="text" class="form-control" id="nombre" placeholder="  Nombre" wire:model.defer="nombre" > 
				            </div>			
			        	</div>
			          
			        </div>
			        
			        <div class="form-group row">
		     			<div class="col-12 col-md-6">
				        	@error('dni') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				               <input class="form-estilo prueba w-100" type="text" class="form-control" id="dni" placeholder="  DNI" wire:model.defer="dni">
				            </div>	
			        	</div>
			        	<div class="col-12 col-md-6 pt-3 pt-md-0">
				        	@error('telefono') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				                <input class="form-estilo prueba w-100" type="telefono" class="form-control" id="telefono" placeholder="  N° de Telefono" wire:model.defer="telefono">           
				            </div>	
			        	</div>
			             
			        </div>

			        
			      <div class="form-group row">
		     			<div class="col-12 col-md-6">
				            @error('email') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				                <input class="form-estilo prueba w-100" type="email" class="form-control" id="email" placeholder="  Correo electrónico" wire:model.defer="email">
				               
				            </div>
			        	</div>

			        	<div class="col-12 col-md-6 pt-3 pt-md-0">
			        		@error('province') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <select class="mayus custom-select form-estilo prueba w-100" id="provincia_inqui_human" name="provincia"  wire:model.defer="province_id">
	                             <option value="" selected disable> Provincia</option>
	                             @foreach($provinces as $province)
	                             	<option value={{$province->id }} {{ old('provincia') == $province->id ? 'selected' : '' }}>{{$province->name}}</option>
	                             @endforeach
	                        </select>

			        	</div>
			        </div>
			        
			        
			      
			       
			        <div class="form-group row">
			        	<div class="col-12 col-md-6 pt-md-0">
			        		@error('city_id') <span class="pl-2 text-danger">{{ $message }}</span> @enderror

	 		 			<div class="ui-widget" wire:ignore>
							<input placeholder="ESCRIBA EL NOMBRE DE LA LOCALIDAD" value="{{$city_old}}" id="select-city-by-provincia-human" class="mayus form-estilo prueba w-100" autocomplete="off">
							<input type="hidden" name="city_id" wire:model.defer="city_id" id="select-city-by-provincia-id-human">
						</div>


			        	</div>


		     			<div class="col-12 col-md-6 pt-3 pt-md-0">
			        		@error('domicilio') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				               <input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="domicilio" placeholder="  Domicilio" wire:model.defer="domicilio">
				            </div>
			        	</div>
			        </div>

			      
			        <div class="form-group row">
			        	<div class="col-12">
			        		<p class="text-center completa-datos">
			        			A continuación ingresar los últimos tres recibos de sueldo.
			        		</p>
			        	</div>

			        	<div class="col-12 col-md-4">
			        		@error('sueldo_uno') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				               <input class="form-estilo prueba w-100" type="text" class="form-control" name="sueldo_uno" id="sueldo_uno" placeholder="  Sueldo Mensual 1" wire:model.defer="sueldo_uno">
				            </div>
	                        

			        	</div> 

		     			<div class="col-12 col-md-4 pt-3 pt-md-0">
			        		@error('sueldo_dos') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				               <input class="form-estilo prueba w-100" type="text" class="form-control" name="sueldo_dos" id="sueldo_dos" placeholder="  Sueldo Mensual 2" wire:model.defer="sueldo_dos">
				            </div>
			        	</div>



			        	<div class="col-12 col-md-4 pt-3 pt-md-0">
			        		@error('sueldo_tres') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
				            <div class="input-group  ">
				               <input class="form-estilo prueba w-100" type="text" class="form-control" name="sueldo_tres" id="sueldo_tres" placeholder="  Sueldo Mensual 3" wire:model.defer="sueldo_tres">
				            </div>

			        	</div>

			        	
			            
			        </div>


	        
			        <div class="col-12 mt-4 text-center" >
			        	
						<div>
						<a id="consultar" class="" href="">

					    	<button wire:loading.attr="disabled" type="submit" class="boton-azul btn btn-danger">Siguiente
					    	
					  
					    	</button>
							    <div wire:loading class="spinner-border" role="status">
							 		 <span class="sr-only">Cargando...</span>
								</div>
					    </a>
					</div>
			        </div>
			    </div>
			    	
			  
			       
		</fieldset>
	    </form>
	</div>



		        		{{--______________ SIGUIENTE PASO_________________ --}}

		       	<div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">

		       	<form wire:submit.prevent="secondStep()"  enctype="multipart/form-data">
		       		<div class = "bg-form">
		       	<div class="col-1">
		       		<i class="fas fa-backward" type="button" wire:click="back(1)"></i>
		       	</div>
		       			<p class="pt-5 pb-3 completa-datos text-center">
			     		 Subir Archivos
			    		</p> 
		        <div class="form-group row ">

		        
		        	<div class="text-center col-6 ">
		        		<p class="titulo-subir-archivo">Últimos 3 recibos de sueldo </p>
		        		
		        		<input type="file"  id="recibos_sueldo"  name="recibos_sueldo" wire:change="$emit('single_file_choosed_sueldo')" >
		        		<label for="recibos_sueldo">
		        			<div class="row">
		        				<div class="col-12  subir-archivo-bg">
		        					<img src="{{url('/images/mobile/file-upload-outline 1.svg')}}" class="img-fluid pt-4">
		        					<p class="subir-archivo">Subir archivo</p>
		        					<div>
		        						<img src="{{url('/images/mobile/text-box-plus-outline 1.svg')}}" class="d-none d-md-inline img-fluid">
			        					<span class="subir-archivo" style="text-decoration: underline;">
			        					Agregar <span class="d-none d-md-inline">otro documento<span>	
			        					</span>
		        					</div>
		        				</div>
		        			</div>
		        		</label>

		        		<p>@error('sueldos') <span class="text-danger">{{ $message }}</span> @enderror</p>

		        		@if($updateModeHum && $solicitud->inquilino!=null)
				        		@if(!$solicitud->inquilino->documentos()->get()->isEmpty())
					        		@foreach($solicitud->inquilino->documentos()->where('type', 2)->get() as $archivo)
										<div class="row">
											<div class="col-12">
											<p>
												<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

												@if($solicitud->inquilino->documentos()->where('type', 2)->count() > 1)
												 <button 
								                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								                 </button>
								                @endif
											</p>

											</div>
										</div>
									@endforeach
				        		@endif
			        		@endif

		        	</div>

		        	<div class="text-center col-6 ">
		 
		        		<p class="titulo-subir-archivo">Foto DNI frente y reverso </p>
		        		
		        		<input type="file"  id="foto_dni"  name="foto_dni" wire:change="$emit('single_file_choosed_dni')">
		        		<label for="foto_dni">
		        			<div class="row">
		        				<div class="col-12  subir-archivo-bg">
		        					<img src="{{url('/images/mobile/file-upload-outline 1.svg')}}" class="img-fluid pt-4">
		        					<p class="subir-archivo">Subir archivo</p>
		        					<div>
		        						<img src="{{url('/images/mobile/text-box-plus-outline 1.svg')}}" class="d-none d-md-inline img-fluid">
			        					<span class="subir-archivo" style="text-decoration: underline;">
			        					Agregar <span class="d-none d-md-inline">otro documento<span>	
			        					</span>
		        					</div>
		        				</div>
		        			</div>		        			
		        		</label>

		        		<p>@error('fotos_dni') <span class="text-danger">{{ $message }}</span> @enderror</p>
		        		<div>
			        		@if($updateModeHum && $solicitud->inquilino!=null)
				        		@if(!$solicitud->inquilino->documentos()->get()->isEmpty())
					        		@foreach($solicitud->inquilino->documentos()->where('type', 7)->get() as $archivo)
										<div class="row">
											<div class="col-12">
											<p>
												<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

												@if($solicitud->inquilino->documentos()->where('type', 7)->count() > 1)
												 <button 
								                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								                 </button>
								                @endif
											</p>

											</div>
										</div>
									@endforeach
				        		@endif
			        		@endif
		        		</div>

		        	</div>
		        	@include('partial.archivos_simultaneos')
		        <div class="col-12 mt-4 text-center" >
			        	
			            @include('livewire.boton-azul', ['url' => '/', 'name' => '¡Listo!'])
			    </div>
		        </div>


               
            </div>
		    	</form>
		    	</div>
    @endif
</div>


 	<script>
    document.addEventListener('livewire:load', function () {
	$(document).ready(function()
	{
		var ciudades = [];

		$('#provincia_inqui_human').on('change', function()
		{

			$('#city_inqui option').remove()
			var provincia_id = $(this).val()
			var url = '{{ route('city.get', ['city' => ":provincia_id"]) }}'

			url = url.replace(':provincia_id', provincia_id)
			$( '#select-city-by-provincia-human' ).val( '' );
			$( '#select-city-by-provincia-id-human' ).val( '' );
			$.ajax(
			{
				url: url,
				type: 'get',
				dataType: 'json',
				success: function(cities) 
				{

					ciudades = [];

					cities.forEach(city => 
					{
						let obj = {value: city['id'], label: city['name']}
						ciudades.push(obj)
					})

					ciudades.sort((ciudad_a, ciudad_b) => ciudad_a - ciudad_b)

				    $('#select-city-by-provincia-human').autocomplete({
					    minLength: 0,
					    source: ciudades,
					    appendTo: ".modal",
					    focus: function( event, ui ) {
					        $( '#select-city-by-provincia-human' ).val( ui.item.label );
					        return false;
					    },
					    select: function( event, ui ) {
					        $( '#select-city-by-provincia-human' ).val( ui.item.label );
					        $( '#select-city-by-provincia-id-human' ).val( ui.item.value );
							// $( '#select-city-by-provincia-id' ).dispatchEvent(new Event('input'));
							@this.set('city_id', ui.item.value)

					        return false;
					      }
				    })
				    //Este metodo renderiza cada item de la lista.
				    .autocomplete( "instance" )._renderItem = function( ul, item ) {
					    return $( "<li>" )
					        .append( "<div>" + item.label + "</div>" )
					        .appendTo( ul );
				    };
				}
			})
		})

	});

        })
    </script>





