<div class="card card-datos-sepelio w-75 mx-auto mb-4">
  		<div class="card-body">
    		<p class="sepelios-title">DATOS DEL BENEFICIARIO</p>
    		@foreach($beneficiarios as $key => $beneficiario)
	        <div class="form-group row">
	        	<div class="col-md-3 col-12">
		            <div class="input-group  ">
		            	<input required class="form-estilo mayus prueba w-100" type="text" class="form-control" id="nombre_beneficiario" placeholder="  APELLIDOS Y NOMBRES" wire:model.defer="nombre_beneficiario.{{$beneficiario}}">	   
		            </div>
	             	@error('nombre_beneficiario.'.$beneficiario) <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-3 col-12">
		            <div class="input-group  ">
		                <select required class="select-font-size mayus custom-select form-estilo prueba w-100" id="parentesco_beneficiario" wire:model.defer="parentesco_beneficiario.{{$beneficiario}}" >
		                    <option value="" selected disable>PARENTESCO</option>
		                    <option value="ninguno">NINGUNO</></option>
		                    <option value="esposo/a">ESPOSO/A</option>
		                    <option value="hijo">HIJO</option>
		                    <option value="hija">HIJA</option>
		                    <option value="hermano">HERMANO</option>	
		                    <option value="hermana">HERMANA</option>	
		                    <option value="padre">PADRE</option>	
		             
		                </select>		               			  
		            </div>
		            @error('parentesco_beneficiario.'.$beneficiario) <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group">
		                <input required class="form-estilo prueba w-100 " type="text" class="form-control" name="dni_beneficiario" id="dni_beneficiario" placeholder="  DNI" wire:model.defer="dni_beneficiario.{{$beneficiario}}">	             
		            </div>
	             	@error('dni_beneficiario.'.$beneficiario) <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <select required class="select-font-size mayus custom-select form-estilo prueba w-100" id="prioridad_beneficiario" wire:model.defer="prioridad_beneficiario.{{$beneficiario}}" >
		                    <option value="" selected disable>PRIORIDAD</option>
		                    <option value="1">1</option>
		                    @if($beneficiarios)
			                    @foreach($beneficiarios as $key => $beneficiarioe )
			                    <option value="{{$loop->index +2}}">{{$loop->index + 2}}</option>
			             		@endforeach
		             		@endif		                    
		                </select>		               			  
		            </div>
		            @error('prioridad_beneficiario.'.$beneficiario) <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input required class="form-estilo  prueba w-100" type="text" class="form-control" id="porcentaje_beneficiario" placeholder=" PORCENTAJE" wire:model.defer="porcentaje_beneficiario.{{$beneficiario}}">	             
		            </div>
	             	@error('porcentaje_beneficiario.'.$beneficiario) @enderror
	             	
	       	 	</div>
        	</div>
        	<hr class="d-md-none" style="border-color:red;">
        	@endforeach
			{{-- ADD --}}
	        <div class="form-group row">
	        	<div class="col-md-3 col-12">
		            <div class="input-group  ">
		            	<input class="form-estilo mayus prueba w-100" type="text" class="form-control" id="nombre_beneficiario" placeholder="  APELLIDOS Y NOMBRES" wire:model.defer="nombre_beneficiario.0">	   
		            </div>
	             	@error('nombre_beneficiario.0') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-3 col-12">
		            <div class="input-group  ">
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="parentesco_beneficiario" wire:model.defer="parentesco_beneficiario.0" >
		                    <option value="" selected disable>PARENTESCO</option>
		                    <option value="ninguno">NINGUNO</></option>
		                    <option value="esposo/a">ESPOSO/A</option>
		                    <option value="hijo">HIJO</option>
		                    <option value="hija">HIJA</option>
		                    <option value="hermano">HERMANO</option>	
		                    <option value="hermana">HERMANA</option>	
		                    <option value="padre">PADRE</option>	
		             
		                </select>		               			  
		            </div>
		            @error('parentesco_beneficiario.0') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input class="form-estilo prueba w-100 dni_beneficiario" type="text" class="form-control" name="dni_beneficiario" id="dni_beneficiario" placeholder="  DNI" wire:model.defer="dni_beneficiario.0">	             
		            </div>
	             	@error('dni_beneficiario.0') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="prioridad_beneficiario" wire:model.defer="prioridad_beneficiario.0" >
		                    <option value="" selected disable>PRIORIDAD</option>
		                    <option value="1">1</option>
		                    @if($beneficiarios)
			                    @foreach($beneficiarios as $key => $beneficiario )
			                    <option value="{{$loop->index +2}}">{{$loop->index + 2}}</option>
			             		@endforeach
		             		@endif
		                </select>		               			  
		            </div>
		            @error('prioridad_beneficiario.0') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <input class="form-estilo prueba w-100" type="text" class="form-control" id="porcentaje_beneficiario" placeholder=" PORCENTAJE" wire:model.defer="porcentaje_beneficiario.0">	             
		            </div>
	             	@error('porcentaje_beneficiario.0') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="col-12 text-center pt-2">
                    <button class="btn text-white btn-circle btn-sm" wire:click.prevent="addBeneficiario({{$j}})">+</button> <span class="text-uppercase sepelios-subtitle">Agregar otro beneficiario</span>
                </div>
                @if(Session::has('message_2'))
					<span class="text-danger mensaje-error-sepelio ">{{ Session::get('message_2') }}</span>
				@endif

        	</div>
        </div>        	    	         	
 </div>