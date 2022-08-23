<div>
	<div class="card card-datos-poliza w-75 mx-auto mb-4">
  		<div class="card-body">
    		<p class="panel-operaciones-subtitle">
    		{{$title}}
    		@if($title == 'Propietario.')
    		Persona
        		@if($solicitud->propietario->type == 0)
                    Juridica
                    @else
                    Humana
                    @endif
                @endif

            @if($title == 'Inquilino.')
             Persona
                @if($solicitud->inquilino->type == 0)
                Juridica
                @else
                Humana
                @endif
    		@endif
    		</p>

            @if($nombre == 'Dueño Directo')
            <p class="text-center card-datos-subtitle">Dueño directo</p>
            @else
    		<div class="text-left container pt-2">
    			<div class="row">
    				@if($dni)
    				<div class="col-12 col-md-6">
    					@if($solicitud->propietario->type == 0)

    					<p class="card-datos-title"> Razon Social:   <span class="pl-md-2 card-datos-subtitle">  {{$nombre}} </span></p>
    					<p class="card-datos-title"> CUIL: <span class="pl-md-2 card-datos-subtitle"> {{$dni}}</span></p>
    					@else
    					<p class="card-datos-title"> Nombre y Apellido: <span class="pl-md-2  card-datos-subtitle"> {{$nombre}} </span></p>
    					<p class="card-datos-title"> N° Documento: <span class="pl-md-2 card-datos-subtitle"> {{$dni}} </span></p>
    					@endif
    					<p class="card-datos-title"> Correo: <span class="pl-md-2 card-datos-subtitle"> {{$email}} </span></p>
    					<p class="card-datos-title"> Domicilio: <span class="pl-md-2 card-datos-subtitle"> {{$domicilio}} </span></p>
    				</div>

    				<div class="col-12 col-md-6">
    					<p class="card-datos-title"> N°Telefono: <span class="pl-md-2 card-datos-subtitle"> {{$telefono}}</span></p>
    					<p class="card-datos-title"> Provincia: <span class="pl-md-2 card-datos-subtitle"> {{$provincia}}</span></p>
    					<p class="card-datos-title"> Localidad: <span class="pl-md-2 card-datos-subtitle"> {{$localidad}}</span></p>
                        
    				</div>




    		@endif
    			</div>
                @if($solicitud->inquilino->type == 1 && $title == 'Inquilino.')
                <div class="row">
                    <div class="col-md-4">
                        <p class="card-datos-title"> Sueldo 1: <span class="pl-md-2 card-datos-subtitle">${{$solicitud->inquilino->sueldo_uno}}</span></p>
                        
                    </div>
                    <div class="col-md-4">
                        <p class="card-datos-title"> Sueldo 2: <span class="pl-md-2 card-datos-subtitle">${{$solicitud->inquilino->sueldo_dos}}</span></p>
                        
                    </div>
                    <div class="col-md-4">
                        <p class="card-datos-title"> Sueldo 3:<span class="pl-md-2 card-datos-subtitle">${{$solicitud->inquilino->sueldo_tres}}</span></p>
                        
                    </div>
                    
                </div>
               
                @endif
    			@if($archivos)
    			<div class="row">
    				<div class="text-center col-12 col-md-12">
    					@foreach($archivos as $archivo)
		        			<p><a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a></p>


		        		@endforeach
    				</div>

    				
    			</div>
    			@endif
    			
    		</div>

            @endif
  		</div>
	</div>
</div>