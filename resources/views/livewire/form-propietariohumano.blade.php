<div class="">
@if($blockMode == 1)
	  	@if($tipoPersonaAlerta && $updateMode) 
			<div class="alert alert-danger mt-3" role="alert">
				  {{$tipoPersonaAlerta}}
			</div>
		@endif  
	@else
	  
    <form wire:submit.prevent="{{$formMode}}"  >
    @if($solicitud->pago->status == 'Pagada' || $solicitud->status == 'Aprobada')
    <fieldset disabled="disabled">
    @endif	
    	<div class = "bg-form">
		    <p class="pt-5 pb-3 completa-datos text-center">
		      Información Propietario (Persona Humana)
            </p>  
            
		        <div class="form-group row">
	     	<div class="col-12">
		        	   @error('nombre') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
			            <div class="input-group  ">
			            	<input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="name" placeholder="  Nombre" wire:model.defer="nombre">
			            </div>			
		        	</div>
		          
		        </div>
		        
		        <div class="form-group row">
	     			<div class="col-12 col-md-6">
			        	@error('dni') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
			            <div class="input-group  ">
			               <input class="form-estilo prueba w-100" type="text" class="form-control" name="dni" id="dni_prop" placeholder=" Nº de Documento" wire:model.defer="dni">
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
			            <select class="mayus custom-select form-estilo prueba w-100" id="provincia_prop_human" name="provincia" wire:model.defer="province_id">
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
							<input placeholder="ESCRIBA EL NOMBRE DE LA LOCALIDAD" value="{{$city_old}}" id="select-city-by-provincia-prop-human" class="mayus form-estilo prueba w-100" autocomplete="off">
							<input type="hidden" name="city_id" wire:model.defer="city_id" id="select-city-by-provincia-id-prop-human">
						</div>

		        	</div>

	     			<div class="col-12 col-md-6 pt-3 pt-md-0">
		        		@error('domicilio') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
			            <div class="input-group  ">
			               <input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="domicilio" placeholder="  Domicilio" wire:model.defer="domicilio">
			            </div>
		        	</div>



		            
		        </div>

		      

		</div>           
		        <div class="col-12 mt-4 text-center">
                    @include('livewire.boton-azul', ['url' => '/', 'name' => '¡Listo!'])
		        </div>
	</fieldset>
    </form>
@endif
</div>

<script>
    document.addEventListener('livewire:load', function () {
	$(document).ready(function()
	{

		var ciudades = [];

		$('#provincia_prop_human').on('change', function()
		{
			$('#city_inqui option').remove()
			var provincia_id = $(this).val()
			var url = '{{ route('city.get', ['city' => ":provincia_id"]) }}'

			url = url.replace(':provincia_id', provincia_id)
			$( '#select-city-by-provincia-prop-human' ).val( '' );
			$( '#select-city-by-provincia-id-prop-human' ).val( '' );
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

				    $('#select-city-by-provincia-prop-human').autocomplete({
					    minLength: 0,
					    source: ciudades,
					    appendTo: ".modal-propietario",
					    focus: function( event, ui ) {
					        $( '#select-city-by-provincia-prop-human' ).val( ui.item.label );
					        return false;
					    },
					    select: function( event, ui ) {
					        $( '#select-city-by-provincia-prop-human' ).val( ui.item.label );
					        $( '#select-city-by-provincia-id-prop-human' ).val( ui.item.value );
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