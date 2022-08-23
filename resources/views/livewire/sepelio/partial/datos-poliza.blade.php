<div class="card card-datos-sepelio w-75 mx-auto mb-4">
  		<div class="card-body">
    		<p class="sepelios-title">DATOS DE LA POLIZA</p>
	        <div class="form-group row">
	        	<div class="col-md-2 col-12">
		            <div class="input-group  ">
		            	<label class="sepelios-subtitle " for="tipo_cobertura">TIPO DE COBERTURA</label>
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="tipo_cobertura" wire:model.defer="tipo_cobertura" >
		                    <option value="" selected disable>TIPO</option>
		                    <option value="cobertura_prestacional">Cobertura Prestacional</></option>
		                    <option value="reintegro_gastos">Reintegro de Gastos</option>

		             
		                </select>		               			  
		            </div>
		            @error('tipo_cobertura') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="col-md-2 col-12">
		            <div class="input-group  ">
		            	<label class="sepelios-subtitle" for="inicio_vigencia">INICIO VIGENCIA</label>
		                <input class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="inicio_vigencia" placeholder="  _ _ /_ _ /_ _" wire:model.defer="inicio_vigencia">	             
		            </div>
	             	@error('inicio_vigencia') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="col-md-3 col-12">
		            <div class="input-group  ">
		            	<label class="sepelios-subtitle" for="plazo_carencia">PLAZO CARENCIA</label>
		                <input class="form-estilo w-mayus form-estilo prueba w-100" type="text" class="form-control" id="plazo_carencia" placeholder="  CARENCIA" wire:model.defer="plazo_carencia">	             
		            </div>
	             	@error('plazo_carencia') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="col-md-3 col-12">
		            <div class="input-group  ">
		            	<label class="sepelios-subtitle"for="facturacion">FACTURACION</label>
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="facturacion" wire:model.defer="facturacion" >
		                    <option value="" selected disable>SELECCION</option>
		                    <option value="anual">ANUAL</></option>
		                    <option value="semestral">SEMESTRAL</option>
		                    <option value="cuatrimestral">CUATRIMESTRAL</option>
		                    <option value="trimestral">TRIMESTRAL</option>
		                    <option value="mensual">MENSUAL</option>	
		             
		                </select>		               			  
		            </div>
		            @error('facturacion') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="col-md-2 col-12">
		            <div class="input-group  ">
		            	<label class="sepelios-subtitle" for="cuotas">CUOTAS</label>
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="cuotas" wire:model.defer="cuotas" >
		                    <option value="" selected disable>CUOTAS</option>
		                    <option value="anual">ANUAL</></option>
		                    <option value="semestral">SEMESTRAL</option>
		                    <option value="cuatrimestral">CUATRIMESTRAL</option>
		                    <option value="trimestral">TRIMESTRAL</option>
		                    <option value="mensual">MENSUAL</option>	
		             
		                </select>		               			  
		            </div>
		            @error('cuotas') <span class="text-danger mensaje-error-sepelio ">{{ $message }}</span> @enderror
	       	 	</div>
        	</div>
        </div>        	    	         	
 </div>