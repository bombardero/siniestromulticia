<div>
    <form class="w-75 mx-auto container-page" wire:submit.prevent="submit" method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 11 </b>| 12 <b>Carga de documentos</b></span>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Documentación  necesaria para finalizar el trámite de Denuncia Administrativa.


            </label>

      
				@include('partial.archivos_simultaneos')
		        <div class="form-group row ">
		        
		        	<div class="text-center col-12 col-md-4 ">	
		        		<p class="documentos-denuncia-title">*DNI Titular del Asegurado </p>
						<p class="ambos-lados">(Foto de ambos lados)</p>
		        		
		        		<input type="file"  id="foto_dni" name="fotos_dni" wire:change="$emit('single_file_choosed_dni')">
		        		<label for="foto_dni">
		        			<div class="row">
		        				<div class="col-12  subir-archivo-bg-morado">
		        					<img src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}" class="img-fluid pt-4">
		        					<p class="subir-archivo-morado">Subir documento</p>
		        					<div>
		        						<img src="{{url('/images/siniestros/recursos_siniestros/add-image-iconFrame11.png')}}" class="d-none d-md-inline img-fluid">
			        					<span class="subir-archivo-gris" style="text-decoration: underline;">
			        					Agregar <span class="d-none d-md-inline">otra foto<span>	
			        					</span>
		        					</div>
		        				</div>
		        			</div>		        			
		        		</label>

		        	
		        		<div>
			        		@if(count($denuncia_siniestro->documentosDenuncia) > 0)
                                    {{-- TIPO 1 = DNI --}}
					        		@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 1)->get() as $archivo)
										<div class="row">
											<div class="col-12">
											<p>
												<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

												@if($denuncia_siniestro->documentosDenuncia()->where('type', 1)->count() > 1)
												 <button 
								                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								                 </button>
								                @endif
											</p>

											</div>
										</div>
									@endforeach
			        		@endif
		        		</div>
						@error('fotos') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
										
					
		        	</div>

		        	<div class="text-center col-12 col-md-4 ">	
		        		<p class="documentos-denuncia-title">*Cédula verde o título </p>
						<p class="ambos-lados">(Foto de ambos lados)</p>
		        		
		        		<input type="file"  id="foto_cedula"  name="fotos_cedula" wire:change="$emit('single_file_choosed_cedula')">
		        		<label for="foto_cedula">
		        			<div class="row">
		        				<div class="col-12  subir-archivo-bg-morado">
		        					<img src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}" class="img-fluid pt-4">
		        					<p class="subir-archivo-morado">Subir cédula</p>
		        					<div>
		        						<img src="{{url('/images/siniestros/recursos_siniestros/add-image-iconFrame11.png')}}" class="d-none d-md-inline img-fluid">
			        					<span class="subir-archivo-gris" style="text-decoration: underline;">
			        					Agregar <span class="d-none d-md-inline">otra foto<span>	
			        					</span>
		        					</div>
		        				</div>
		        			</div>		        			
		        		</label>

		        		
		        		<div>
			        		@if(count($denuncia_siniestro->documentosDenuncia) > 0)
                                    {{-- TIPO 1 = DNI --}}
					        		@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 2)->get() as $archivo)
										<div class="row">
											<div class="col-12">
											<p>
												<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

												@if($denuncia_siniestro->documentosDenuncia()->where('type', 2)->count() > 1)
												 <button 
								                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								                 </button>
								                @endif
											</p>

											</div>
										</div>
									@endforeach
			        		@endif
		        		</div>
										
						<p>@error('cedulas') <span class="text-danger">{{ $message }}</span> @enderror</p>
					
		        	</div>			
					
		        	<div class="text-center col-12 col-md-4 ">	
		        		<p class="documentos-denuncia-title">*Carnet de conducir </p>
						<p class="ambos-lados">(Foto de ambos lados)</p>
		        		
		        		<input type="file"  id="foto_carnet"  name="foto_carnet" wire:change="$emit('single_file_choosed_carnet')">
		        		<label for="foto_carnet">
		        			<div class="row">
		        				<div class="col-12  subir-archivo-bg-morado">
		        					<img src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}" class="img-fluid pt-4">
		        					<p class="subir-archivo-morado">Subir carnet</p>
		        					<div>
		        						<img src="{{url('/images/siniestros/recursos_siniestros/add-image-iconFrame11.png')}}" class="d-none d-md-inline img-fluid">
			        					<span class="subir-archivo-gris" style="text-decoration: underline;">
			        					Agregar <span class="d-none d-md-inline">otra foto<span>	
			        					</span>
		        					</div>
		        				</div>
		        			</div>		        			
		        		</label>

		        		
		        		<div>
			        		@if(count($denuncia_siniestro->documentosDenuncia) > 0)
                                    {{-- TIPO 1 = DNI --}}
					        		@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 3)->get() as $archivo)
										<div class="row">
											<div class="col-12">
											<p>
												<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

												@if($denuncia_siniestro->documentosDenuncia()->where('type', 3)->count() > 1)
												 <button 
								                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								                 </button>
								                @endif
											</p>

											</div>
										</div>
									@endforeach
			        		@endif
		        		</div>
										
						<p>@error('carnet') <span class="text-danger">{{ $message }}</span> @enderror</p>
					
		        	</div>

		        

             
				</div>	

					
				<div class="form-group row">
					
					<div class="col-12 col-md-12 pt-0" >
						<hr style="border:1px solid lightgray;">
					</div>
					

		        	<div class="text-center col-12 col-md-12 ">	
		        		<p class="documentos-denuncia-title">*Fotos vehículo Asegurado </p>
						<p class="ambos-lados">Obligatorio 4 fotos:1 de cada lateral, adelante, atrás: donde se vean los daños y al menos uno con patente visible y completa.</p>
		        		
		        		<input type="file"  id="foto_vehiculo"  name="foto_vehiculo" wire:change="$emit('single_file_choosed_vehiculo')">
		        		<label class="w-100" for="foto_vehiculo">
		        			<div class="row">
		        				<div class="col-12  subir-archivo-bg-morado">
		        					<img src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}" class="img-fluid pt-4">
		        					<p class="subir-archivo-morado">Subir imagen</p>
		        					<div>
		        						<img src="{{url('/images/siniestros/recursos_siniestros/add-image-iconFrame11.png')}}" class="d-none d-md-inline img-fluid">
			        					<span class="subir-archivo-gris" style="text-decoration: underline;">
			        					Agregar <span class="d-none d-md-inline">otra foto<span>	
			        					</span>
		        					</div>
		        				</div>
		        			</div>		        			
		        		</label>

		        		
		        		<div>
			        		@if(count($denuncia_siniestro->documentosDenuncia) > 0)
                                    {{-- TIPO 1 = DNI --}}
					        		@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 4)->get() as $archivo)
										<div class="row">
											<div class="col-12">
											<p>
												<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

												@if($denuncia_siniestro->documentosDenuncia()->where('type', 4)->count() > 1)
												 <button 
								                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								                 </button>
								                @endif
											</p>

											</div>
										</div>
									@endforeach
			        		@endif
		        		</div>
										
						<p>@error('vehiculo') <span class="text-danger">{{ $message }}</span> @enderror</p>
					
		        	</div>					
				</div>


{{------------------------------------------------ ACA COMIENZA -----------				 --}}

<div class="form-group row ">
	<div class="col-12 col-md-12 pt-0" >
		<hr style="border:1px solid lightgray;">
	</div>
	<div class="text-center col-12 col-md-4 ">	
		<p class="documentos-denuncia-title">Último recibo del seguro </p>
		<p class="ambos-lados">Pagado</p>
		
		<input type="file"  id="foto_recibo" name="fotos_recibo" wire:change="$emit('single_file_choosed_recibo')">
		<label for="foto_recibo">
			<div class="row">
				<div class="col-12  subir-archivo-bg-morado">
					<img src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}" class="img-fluid pt-4">
					<p class="subir-archivo-morado">Subir imagen</p>
					<div>
						<img src="{{url('/images/siniestros/recursos_siniestros/add-image-iconFrame11.png')}}" class="d-none d-md-inline img-fluid">
						<span class="subir-archivo-gris" style="text-decoration: underline;">
						Agregar <span class="d-none d-md-inline">otra foto<span>	
						</span>
					</div>
				</div>
			</div>		        			
		</label>

	
		<div>
			@if(count($denuncia_siniestro->documentosDenuncia) > 0)
					{{-- TIPO 1 = DNI --}}
					@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 5)->get() as $archivo)
						<div class="row">
							<div class="col-12">
							<p>
								<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

								@if($denuncia_siniestro->documentosDenuncia()->where('type', 5)->count() > 1)
								 <button 
								  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								 </button>
								@endif
							</p>

							</div>
						</div>
					@endforeach
			@endif
		</div>
		@error('recibo') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
						
	
	</div>

	<div class="text-center col-12 col-md-4 ">	
		<p class="documentos-denuncia-title">Exposición policial</p>
		<p class="ambos-lados">o denuncia de Tránsito</p>
		
		<input type="file"  id="foto_policial"  name="fotos_policial" wire:change="$emit('single_file_choosed_policial')">
		<label for="foto_policial">
			<div class="row">
				<div class="col-12  subir-archivo-bg-morado">
					<img src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}" class="img-fluid pt-4">
					<p class="subir-archivo-morado">Subir Documento</p>
					<div>
						<img src="{{url('/images/siniestros/recursos_siniestros/add-image-iconFrame11.png')}}" class="d-none d-md-inline img-fluid">
						<span class="subir-archivo-gris" style="text-decoration: underline;">
						Agregar <span class="d-none d-md-inline">otro documento<span>	
						</span>
					</div>
				</div>
			</div>		        			
		</label>

		
		<div>
			@if(count($denuncia_siniestro->documentosDenuncia) > 0)
					{{-- TIPO 1 = DNI --}}
					@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 6)->get() as $archivo)
						<div class="row">
							<div class="col-12">
							<p>
								<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

								@if($denuncia_siniestro->documentosDenuncia()->where('type', 6)->count() > 1)
								 <button 
								  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								 </button>
								@endif
							</p>

							</div>
						</div>
					@endforeach
			@endif
		</div>
						
		<p>@error('policial') <span class="text-danger">{{ $message }}</span> @enderror</p>
	
	</div>			
	
	<div class="text-center col-12 col-md-4 ">	
		<p class="documentos-denuncia-title">Habilitación municipal </p>
		<p class="ambos-lados">(Sólo taxis y remises)</p>
		
		<input type="file"  id="foto_habilitacion"  name="foto_habilitacion" wire:change="$emit('single_file_choosed_habilitacion')">
		<label for="foto_habilitacion">
			<div class="row">
				<div class="col-12  subir-archivo-bg-morado">
					<img src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}" class="img-fluid pt-4">
					<p class="subir-archivo-morado">Subir Documento</p>
					<div>
						<img src="{{url('/images/siniestros/recursos_siniestros/add-image-iconFrame11.png')}}" class="d-none d-md-inline img-fluid">
						<span class="subir-archivo-gris" style="text-decoration: underline;">
						Agregar <span class="d-none d-md-inline">otro documento<span>	
						</span>
					</div>
				</div>
			</div>		        			
		</label>

		
		<div>
			@if(count($denuncia_siniestro->documentosDenuncia) > 0)
					{{-- TIPO 1 = DNI --}}
					@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 7)->get() as $archivo)
						<div class="row">
							<div class="col-12">
							<p>
								<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

								@if($denuncia_siniestro->documentosDenuncia()->where('type', 7)->count() > 1)
								 <button 
								  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								 </button>
								@endif
							</p>

							</div>
						</div>
					@endforeach
			@endif
		</div>
						
		<p>@error('habilitacion') <span class="text-danger">{{ $message }}</span> @enderror</p>
	
	</div>




</div>	
				
				
							
				
									 <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso10.create',['id'=> $identificador])}}'>ANTERIOR</a>
									 <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
									 @include('components.loading')

    </form>
</div>

