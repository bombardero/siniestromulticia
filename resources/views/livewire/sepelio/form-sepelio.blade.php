<div>
	<form  class="w-100" wire:submit.prevent="store" enctype="multipart/form-data">
		{{-- CARD ASEGURABLE --}}
		@include('livewire.sepelio.partial.asegurable')
		{{-- CARD GRUPO FAMILIAR --}}
		@include('livewire.sepelio.partial.grupo-familiar')
		{{-- CARD DATOS POLIZA --}}
		@include('livewire.sepelio.partial.datos-poliza')
		{{-- CARD BENEFICIARIO --}}
		@include('livewire.sepelio.partial.beneficiario')
		{{-- CARD PRODUCTOR --}}
		@include('livewire.sepelio.partial.productor')
		{{-- CARD FIRMA --}}
		@include('livewire.sepelio.partial.firma')
		<div class="row">
			<div class="col-12">
				@if(Session::has('message'))                
					<span class="text-center text-danger mensaje-error-sepelio ">{{ Session::get('message') }}</span>
				@endif	
				
			</div>		
		</div>
		<div class="col-12 mt-4 text-center" >
			@include('livewire.boton-azul', ['url' => '/', 'name' => 'Enviar Formulario'])
		</div>

	</form>
</div>


	
<script>


    document.addEventListener('livewire:load', function () {
	$(document).ready(function()
	{
		
		const date = new Date();
		// MASCARAS
		var numberMask = IMask(
	  		document.getElementById('dni_asegurable'),
	  		{
				mask: Number,
				min: 00000000,
				max: 99999999,
	  		}); 

		var numberMask_cuit = IMask(
	  		document.getElementById('cuit_asegurable'),
	  		{
				mask: Number,
				min: 00000000000,
				max: 99999999999,
	  		}); 

		var date_mask = IMask(

		  document.getElementById('fecha_nacimiento_asegurable'),
		  {

		    mask: Date,
		    min: new Date(1900, 0, 1),
		    max: new Date(date.getFullYear(), date.getMonth() + 1,date.getDate()),
		    lazy: true
		  });
		var numberMask = IMask(
	  		document.getElementById('dni_familia'),
	  		{
				mask: Number,
				min: 00000000,
				max: 99999999,
	  		}); 		
		
		var date_mask_family = IMask(
		  document.getElementById('fecha_nacimiento_familia'),
		  {
		    mask: Date,
		    min: new Date(1900, 0, 1),
		    max: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
		    lazy: true
		  });
		var numberMask_cel = IMask(
	  		document.getElementById('celular_familia'),
	  		{
				mask: Number,
				min: 0000000000000,
				max: 9999999999999
	  		}); 
		var date_mask_vigencia = IMask(
		  document.getElementById('inicio_vigencia'),
		  {
		    mask: Date,
		    min: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
		    max: new Date(date.getFullYear(), date.getMonth() +1, date.getDate()),
		    lazy: true,

		  });
		var numberMask_carencia = IMask(
	  		document.getElementById('plazo_carencia'),
	  		{
				mask: Number,
				min: 00,
				max: 365
	  		}); 		
		var numberMask_dni_beneficiario = IMask(

	  		document.getElementById('dni_beneficiario'),
	  		{
				mask: Number,
				min: 00000000,
				max: 99999999,
	  		}); 	

		var numberMask = IMask(
	  		document.getElementById('codigo_compania'),
	  		{
				mask: Number,
				min: 00000,
				max: 99999,
	  		});

		var numberMask = IMask(
	  		document.getElementById('porcentaje_beneficiario'),
	  		{
				mask: Number,
				min: 1,
				max: 100,
	  		}); 	

		var numberMask_dni_beneficiario = IMask(

	  		document.getElementById('dni_beneficiario'),
	  		{
				mask: Number,
				min: 00000000,
				max: 99999999,
	  		}); 		


		var ciudades = [];

		$('#provincia_asegurable').on('change', function()
		{
			console.log("cambio")
			$('#city_asegurable option').remove()
			var provincia_id = $(this).val()
			var url = '{{ route('city.get', ['city' => ":provincia_id"]) }}'

			url = url.replace(':provincia_id', provincia_id)
			$( '#select-city-by-provincia-asegurable' ).val( '' );
			$( '#select-city-by-provincia-id-asegurable' ).val( '' );
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

				    $('#select-city-by-provincia-asegurable').autocomplete({
					    minLength: 0,
					    source: ciudades,
					    appendTo: ".modal",
					    focus: function( event, ui ) {
					        $( '#select-city-by-provincia-asegurable' ).val( ui.item.label );
					        return false;
					    },
					    select: function( event, ui ) {
					        $( '#select-city-by-provincia-asegurable' ).val( ui.item.label );
					        $( '#select-city-by-provincia-id-asegurable' ).val( ui.item.value );
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
