<!DOCTYPE html>
<html>
<head>

	<title>
		
		Mail
	</title>

	    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/somos-nosotros.css') }}">
    <link rel="stylesheet" href="{{ asset('css/garantias.css') }}">
    <link rel="stylesheet" href="{{ asset('css/legales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preguntas-frecuentes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/precio-estimativo-alquileres.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estado-poliza.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/89abc6e7c2.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<p class="conoce-nuestros-productos ">Tienes una nueva solicitud de {{$from}} para analizar.</p>

				<p class="completa-datos">Detalles de la solicitud :</p>
				<ul>
					<li>Solicitud Numero: {{$solicitud->id}}</li>
					<li>Solicitante: {{$solicitud->user->name}}</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				
			
				<p class="completa-datos">Datos de Inquilino</p>

				<p>Nombre: {{$solicitud->inquilino->nombre}}</p>
				<p>DNI: {{$solicitud->inquilino->dni}}</p>
				<p>Telefono: {{$solicitud->inquilino->telefono}}</p>
				<p>Email: {{$solicitud->inquilino->email}}</p>
				<p>Provincia: {{$solicitud->inquilino->province->name}}</p>
				<p>localidad: {{$solicitud->inquilino->localidad}}</p>
				<p>Domicilio: {{$solicitud->inquilino->domicilio}}</p>

				@if($solicitud->inquilino->type == 0)

				<p>Tipo de Persona: Juridica</p>
				<p>Documentos:</p>
					@foreach($solicitud->inquilino->documentos as $documento)
					
					<p><a target="_blank" class="documento-formato-texto pt-2" href={{$documento->url}}>{{$documento->nombre}}</a></p>

					@endforeach	

				@endif

				@if($solicitud->inquilino->type == 1)
				<p>Sueldo uno: {{$solicitud->inquilino->sueldo_uno}}</p>
				<p>Sueldo dos: {{$solicitud->inquilino->sueldo_dos}}</p>
				<p>Sueldo tres: {{$solicitud->inquilino->sueldo_tres}}</p>
				<p>Tipo de Persona: Humana</p>
				<p>Documentos:</p>
					@foreach($solicitud->inquilino->documentos as $documento)
					
					<p><a target="_blank" class="documento-formato-texto pt-2" href={{$documento->url}}>{{$documento->nombre}}</a></p>

					@endforeach	

				@endif


			</div>

			<div class="col-4">
				
			
				<p class="completa-datos">Datos de Propietario</p>

				<p>Nombre: {{$solicitud->propietario->nombre}}</p>
				<p>DNI: {{$solicitud->propietario->dni}}</p>
				<p>Telefono: {{$solicitud->propietario->telefono}}</p>
				<p>Email: {{$solicitud->propietario->email}}</p>
				<p>Provincia: {{$solicitud->propietario->province->name}}</p>
				<p>localidad: {{$solicitud->propietario->localidad}}</p>
				<p>Domicilio: {{$solicitud->propietario->domicilio}}</p>

				@if($solicitud->propietario->type == 0)

				<p>Tipo de Persona: Juridica</p>
				

				@endif

				@if($solicitud->inquilino->type == 1)
				
				<p>Tipo de Persona: Humana</p>
				
				@endif


			</div>

			<div class="col-4">
				
			
				<p class="completa-datos">Contratos</p>
				@if($solicitud->documentos)
				@foreach($solicitud->documentos as $documento)
				@if($documento->type == 0)	
				<p><a target="_blank" class="documento-formato-texto pt-2" href={{$documento->url}}>{{$documento->nombre}}</a></p>
				@endif
				@endforeach	

				@endif



			</div>

			<div class="col-4">
				
			
				<p class="completa-datos">Avales</p>
				@if($solicitud->documentos)
				@foreach($solicitud->documentos as $documento)
				@if($documento->type == 1)	
				<p><a target="_blank" class="documento-formato-texto pt-2" href={{$documento->url}}>{{$documento->nombre}}</a></p>
				@endif
				@endforeach	

				@endif



			</div>
			
		</div>	
		
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
