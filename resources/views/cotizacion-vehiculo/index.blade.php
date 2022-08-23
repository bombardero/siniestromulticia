@extends('layouts.app')
@section('content')

<section id="cotiza-vehiculo-principal">
<div class="container">
	<div class="row">
		<div class="col-12">
			<p class="pt-5 text-center pb-5 cotiza-vehiculo-title">Cotizá tu vehículo aquí</p>
		</div>
	</div>
</div>

</section>

<section>

<div id="cover-spin"></div>

	<form onsubmit="loading()" method="POST" id="form2" action={{route('cotiza-vehiculo-mail')}}>
		@csrf
		@include('forms.cotiza-vehiculo')
		<p class="text-center campos-obligatorios-cotizacion">Todos los campos son obligatorios</p>
		<section style="height:600px;" class="bg-cotizacion">
	    <div class="col-12 text-center">
	    	<button id="btnCotiza" type="submit" class="mt-3 boton-cotiza btn btn-warning">Enviar</button>
	    </div>	
		</section>
	</form>
</section>
@php
    $url_tipos=route('render-tipos');
    $url_marcas=route('render-marcas');
    $url_modelos=route('render-modelos');
    $url_usos=route('render-usos');
@endphp
</div>
@endsection

@section('scripts')
<script>
$( document ).ready(function() {
    // if( $("input[name='inlineRadioOptions']:checked").val() != null) { renderTipoVehiculo("<?php echo $url_tipos; ?>"); }
    // if( $("#tipos").val() != "") { renderMarcas("<?php echo $url_marcas; ?>"); renderUsos("<?php echo $url_usos; ?>"); }
    // if( $("#marcas").val() != "") renderModelos("<?php echo $url_modelos; ?>");
});
$("#cover-spin").hide()    

function loading() {
      // disable button
      $("#btnCotiza").prop("disabled", true);
      // add spinner to button
      $("#btnCotiza").html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...`
      );
    };

    function renderTipoVehiculo(url) {
        var checked = $("input[name='inlineRadioOptions']:checked").val();
        $.ajax({
            data: {
                checked,
            },
            url,
            method: "GET",
            beforeSend: function() {
                $("#cover-spin").show()         
            },
            success: (result) => {
                $("#tipos").replaceWith(result); 
                 $("#cover-spin").hide()                  
            },
            failure: (result) =>  {
                $("#cover-spin").hide()
            },
        });
    };

  	function renderMarcas(url) {
        var checked = $("input[name='inlineRadioOptions']:checked").val();
        tipoVehiculo = $("#tipos").val();
        $.ajax({
            data: {
                checked,
                tipoVehiculo,
            },
            url,
            method: "GET",
            beforeSend: function() {
			    $("#cover-spin").show()    		
            },
            success: (result) => {
                $("#marcas").replaceWith(result); 
                renderUsos('<?php echo $url_usos; ?>');              	
            },
            failure: (result) =>  {
                alert(msg_error)
                $("#cover-spin").hide()
            },
        });
    };
  	function renderModelos(url) {
        var checked = $("input[name='inlineRadioOptions']:checked").val();
        marca = $("#marcas").val();
        tipoVehiculo = $("#tipos").val();
        año = $("#año").val();
        $.ajax({
            data: {
                checked,
                marca,
                tipoVehiculo,
                año
            },
            url,
            method: "GET",
            beforeSend: function() {
                $("#cover-spin").show()         
            },            
            success: (result) => {
                $("#modelos").replaceWith(result);               	
                $("#cover-spin").hide()
            },
            failure: (result) => {
                alert(msg_error)
                $("#cover-spin").hide()
            },
        });
    };		

  	function renderUsos(url) {
        var checked = $("input[name='inlineRadioOptions']:checked").val();
        tipoVehiculo = $("#tipos").val();
        $.ajax({
            data: {
                checked,
                tipoVehiculo,
            },
            url,
            method: "GET",               
            success: (result) => {
                $("#usos").replaceWith(result);               	
                $("#cover-spin").hide()
            },
            failure: (result) => {
                alert(msg_error)
                $("#cover-spin").hide()
            },

        });
    };
$('#form2 input[type=checkbox], input[type=radio], select, textarea').on('change invalid', function() {
    var field = $(this).get(0);
    
    // 'setCustomValidity' not only sets the message, but also marks
    // the field as invalid. In order to see whether the field really is
    // invalid, we have to remove the message first
    field.setCustomValidity('');
    
    if (!field.validity.valid) {
      field.setCustomValidity('Por favor, elija una opcion');  
    }
});


$('#form2 input[type=text], input[type=email]').on('change invalid', function() {
    var field = $(this).get(0);
    
    // 'setCustomValidity' not only sets the message, but also marks
    // the field as invalid. In order to see whether the field really is
    // invalid, we have to remove the message first
    field.setCustomValidity('');
    
    if (!field.validity.valid) {
      field.setCustomValidity('Por favor, rellene el dato ');  
    }
});


</script>
@endsection