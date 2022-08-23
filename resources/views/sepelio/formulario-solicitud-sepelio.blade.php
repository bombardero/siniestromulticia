@extends('layouts.app')
@section('content')
<section> 
    <div class="container" >
        <div class="row ">
            <div class="col-12 pt-5">
                @livewire('sepelio.form-sepelio')
            </div>

        </div>
    </div>    
</section>

@endsection

@section('scripts')
<script>

		function clearCanvas(e) 
	    {	
	    	e.preventDefault();
			$('.js-signature').jqSignature('clearCanvas');
			$('#saveBtn').attr('disabled', true);
		}

	 	function saveSignature(e) 
	 	{
	 		e.preventDefault();
			$('#signature').empty();
			var dataUrl = $('.js-signature').jqSignature('getDataURL');
			var img = $('<img>').attr('src', dataUrl);
			$('#signature').append($('<p>').text("Aquí está tu firma"));
			$('#signature').append(img);
			url = '{{ route('sepelio.setFirma', ['firma' => ":dataUrl"]) }}';
			console.log(url);
	   		 $.ajax({
	   		 	dataUrl: dataUrl,
	            type: 'POST',
	            url: url,
	            dataType: 'text',
	            data: 
		            {
		            	"firma": dataUrl,
		        		"_token": "{{ csrf_token() }}",
		        	},
	            success: function(data) {
	                console.log("Firma seteada correctamente");
	            },
	            error: function(data) {
	                console.log('ERROR: ', data);
	            },
	        });
		}

		$(document).ready(function()
		{
				if ($('.js-signature').length) 
				{
					$('.js-signature').on('jq.signature.changed', function() {
						$('#saveBtn').attr('disabled', false);
					});
					$('.js-signature').jqSignature();
				}
		});
</script>

@endsection