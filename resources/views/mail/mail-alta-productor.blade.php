<div class="container">
		<div class="row">
			<div class="col-12">
				<p class="conoce-nuestros-productos ">Tienes una nueva solicitud de alta de productor de {{$name}} para analizar.</p>

				<p class="completa-datos">Datos de contacto:</p>
				<ul>
					<li>Nombre: {{$name}}</li>
					<li>Email: {{$email}}</li>
					@if($telefono)
						<li>Telefono: {{$telefono}}</li>
					@else
						<li>No proporcionado</li>
					@endif
					<li>Provincia: {{$provincia->name}}</li>
				</ul>
			</div>
		</div>
	
		
	</div>