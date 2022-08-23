<div class="card card-datos-sepelio w-75 mx-auto mb-4">
  		<div class="card-body">
    		<p class="sepelios-title">DATOS DEL GRUPO FAMILIAR ASEGURABLE</p>
    		@foreach($familia as $key => $familiar)
	        <div class="form-group row">
	        	<div class="col-md-3 col-12">
		            <div class="input-group  ">
		            	<input required class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="nombre_familia" placeholder="  APELLIDOS Y NOMBRES" wire:model.defer="nombre_familia.{{$familiar}}">	   
		            </div>

	             @error('nombre_familia.'.$familiar) <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-3 col-12">
		            <div class="input-group  ">
		                <select required class="select-font-size mayus custom-select form-estilo prueba w-100" id="parentesco_grupo_familiar" wire:model.defer="parentesco_familiar.{{$familiar}}" >
		                    <option value="" selected disable>PARENTESCO</option>
		                    <option value="ninguno">NINGUNO</></option>
		                    <option value="esposo/a">ESPOSO/A</option>
		                    <option value="hijo">HIJO</option>
		                    <option value="hija">HIJA</option>
		                    <option value="hermano">HERMANO</option>	
		                    <option value="hermana">HERMANA</option>	
		                    <option value="padre">PADRE</option>			                    
		                    <option value="madre">MADRE</option>	
		             
		                </select>		               			  
		            </div>
		            @error('parentesco_familiar.'.$familiar) <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input required class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="dni_familia" placeholder="  DNI" wire:model.defer="dni_familia.{{$familiar}}">	             
		            </div>
	             	@error('dni_familia.'.$familiar) <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input required class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="fecha_nacimiento_familia" placeholder="  F.NAC:__/__/__" wire:model.defer="fecha_nacimiento_familia.{{$familiar}}">	             
		            </div>
	             	@error('fecha_nacimiento_familia'.$familiar) <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input required class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="celular_familia" placeholder="  Nro Celular" wire:model.defer="celular_familia.{{$familiar}}">	             
		            </div>
	             	@error('celular_familia.'.$familiar) <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>


        	</div>
	       	<hr class="d-md-none" style="border-color:red;">
        	@endforeach
			{{-- ADD --}}

	        <div class="form-group row">
	        	<div class="col-md-3 col-12">
		            <div class="input-group  ">
		            	<input class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="nombre_familia" placeholder="  APELLIDOS Y NOMBRES" wire:model.defer="nombre_familia.0">	   
		            </div>
	             @error('nombre_familia.0') <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-3 col-12">
		            <div class="input-group  ">
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="parentesco_grupo_familiar" wire:model.defer="parentesco_familiar.0" >
		                    <option value="" selected disable>PARENTESCO</option>
		                    <option value="ninguno">NINGUNO</></option>
		                    <option value="esposo/a">ESPOSO/A</option>
		                    <option value="hijo">HIJO</option>
		                    <option value="hija">HIJA</option>
		                    <option value="hermano">HERMANO</option>	
		                    <option value="hermana">HERMANA</option>	
		                    <option value="padre">PADRE</option>			                    
		                    <option value="madre">MADRE</option>	
		             
		                </select>		               			  
		            </div>
		            @error('parentesco_familiar.0') <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="dni_familia" placeholder="  DNI" wire:model.defer="dni_familia.0">	             
		            </div>
	             	@error('dni_familia.0') <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="fecha_nacimiento_familia" placeholder="  F.NAC:__/__/__" wire:model.defer="fecha_nacimiento_familia.0">	             
		            </div>
	             	@error('fecha_nacimiento_familia.0') <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class=" pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="celular_familia" placeholder="  Nro Celular" wire:model.defer="celular_familia.0">	             
		            </div>
	             	@error('celular_familia.0') <span class="text-danger error mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>
	       	 	<div class="col-12 text-center pt-2">
                    <button class="btn text-white btn-circle btn-sm" wire:click.prevent="addFamilia({{$i}})">+</button> <span class="text-uppercase sepelios-subtitle">Agregar otro familiar</span>
                </div>

                

        	</div>
        </div>        	    	         	
 </div>