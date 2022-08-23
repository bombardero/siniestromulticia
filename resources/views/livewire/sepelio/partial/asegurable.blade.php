	<div class="card card-datos-sepelio w-75 mx-auto mb-4">
  		<div class="card-body">
    		<p class="sepelios-title">DATOS del asegurable</p>
	        <div class="form-group row">
	        	<div class="col-md-12 col-12">
		            <div class="input-group  ">
		                <input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="nombre_asegurable" placeholder="  APELLIDOS Y NOMBRES / del asegurable"  wire:model.defer="nombre_asegurable">	             
		            </div>
	             	@error('nombre_asegurable') <span class="mensaje-error-sepelio text-danger ">{{ $message }}</span> @enderror
	       	 	</div>
        	</div>

	        <div class="form-group row">
	        	<div class="col-md-6 col-12">
		            <div class="input-group  ">
		                <input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="dni_asegurable" placeholder="  DNI" wire:model.defer="dni_asegurable">	             
		            </div>
	             	@error('dni_asegurable') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-6 col-12">
		            <div class="input-group  ">
		                <input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="ocupacion" placeholder="  OCUPACIÓN" wire:model.defer="ocupacion">             
		            </div>
	             	@error('ocupacion') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>	       	 
        	</div>

	        <div class="form-group row">
	        	<div class="col-md-6 col-12">
		            <div class="input-group  ">
		                <input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="cuit_asegurable" placeholder="  CUIT/CUIL" wire:model.defer="cuit_asegurable">	             
		            </div>
	             	@error('cuit_asegurable') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-6 col-12">
		            <div class="input-group  ">
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="inputGroupSelect08" wire:model.defer="condicion_iva">
		                    <option value="" selected disable>Condicion Frente al IVA</></option>
		                    <option value="Responsable Inscripto (A)">Responsable Inscripto (A)</option>
		                    <option value="Responsable Inscripto (Gran Contribuyente)">Responsable Inscripto (Gran Contribuyente)</option>
		                    <option value="Responsable NO Inscripto">Responsable NO Inscripto</option>
		                    <option value="Consumidor Final">Consumidor Final</option>
		                    <option value="Exento">Exento</option>    
		                    <option value="No Responsable">No Responsable</option>    
		                    <option value="No Categorizado">No Categorizado</option>
		                    <option value="Exento por Decreto">Exento por Decreto</option>
		                    <option value="Responsable Inscripto (M)">Responsable Inscripto (M)</option>
         
		                </select>		               
		            </div>
		            @error('condicion_iva') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>	       	 
        	</div>

	        <div class="form-group row">
	        	<div class="col-md-8 col-12">
		            <div class="input-group  ">
		                <input wire:click="setLugarNacimientoDefault" class="mayus form-estilo prueba w-100" type="text" class="form-control" id="lugar_nacimiento" placeholder="  LUGAR DE NACIMIENTO" wire:model.defer="lugar_nacimiento_asegurable">	             
		            </div>
	             	@error('lugar_nacimiento_asegurable') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-4 col-12">
		            <div class="input-group  ">
	               		<input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="fecha_nacimiento_asegurable" placeholder="  FECHA NACIMIENTO _ _/_ _/_ _" wire:model="fecha_nacimiento_asegurable" >	  
		            </div>
		            @error('fecha_nacimiento_asegurable') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>	       	 
        	</div>

	        <div class="form-group row">
	        	<div class="col-md-2 col-12">
		            <div class="input-group  ">
		                <input value="{{$edad_asegurable}}" disabled class="mayus form-estilo prueba w-100" type="text" class="form-control" id="edad" placeholder="  EDAD" wire:model.defer="edad_asegurable">	             
		            </div>
	             
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <select  class="select-font-size mayus custom-select form-estilo prueba w-100" id="sexo" wire:model.defer="sexo_asegurable" >
		                    <option value="" selected disable>SEXO</option>
		                    <option value="masculino">Masculino</></option>
		                    <option value="femenino">Femenino</option>	                    
		             
		                </select>		               			  
		            </div>
		            @error('sexo_asegurable') <span class="text-danger mensaje-error-sepelio-small">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-3 col-12">
		            <div class="input-group  ">
		                <input wire:click="setNacionalidadDefault" value="" class="mayus form-estilo prueba w-100" type="text" class="form-control" id="nacionalidad" placeholder="  NACIONALIDAD" wire:model.defer="nacionalidad_asegurable">	             
		            </div>
	             	@error('nacionalidad_asegurable') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>	    

	        	<div class="pt-3 pt-md-0 col-md-2 col-12">
		            <div class="input-group  ">
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="inputGroupSelect08" wire:model.defer="mano_habil">
		                    <option value="" selected disable>MANO HABIL</option>
		                    <option value="0">IZQUIERDA</></option>
		                    <option value="1">DERECHA</option>
		                </select>		               			  
		            </div>
		            @error('mano_habil') <span class="text-danger mensaje-error-sepelio-small">{{ $message }}</span> @enderror
	       	 	</div>	       	 

	        	<div class="pt-3 pt-md-0 col-md-3 col-12">
		            <div class="input-group  ">
		                <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="inputGroupSelect08" wire:model.defer="estado_civil">
		                    <option value="" selected disable>ESTADO CIVIL</option>
		                    <option value="Ninguno">NINGUNO</option>
		                    <option value="soltero/a">SOLTERO/A</option>
		                    <option value="casado/a">CASADO/A</option>
		                    <option value="viudo/a">VIUDO/A</option>
		                    <option value="separado/a">SEPARADO/A</option> 
		                    <option value="en pareja">EN PAREJA</option>
		                    <option value="divorciado/a">DIVORCIADO/A</option>                    
		                </select>		               			  
		            </div>
		            @error('estado_civil') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>	       	 	  	       	 		       	
        	</div>        

        	<div class="form-group row">
			    <div class="col-12 col-md-6">
				    <select class="select-font-size mayus custom-select form-estilo prueba w-100" id="provincia_asegurable" name="provincia" wire:model.defer="province_id" >
	                	<option value="" selected disable> Provincia</option>
	                    	@foreach($provinces as $province)
	                        	<option value={{$province->id }} {{ old('provincia') == $province->id ? 'selected' : '' }}>{{$province->name}}</option>
	                        @endforeach
	                </select>
			    @error('province_id') <span class="pl-2 text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
			    </div> 

			    <div class="pt-3 pt-md-0 col-12 col-md-6 pt-md-0">
		 		 	<div class="ui-widget" wire:ignore>
						<input placeholder="  LOCALIDAD" value="" id="select-city-by-provincia-asegurable" class="mayus form-estilo prueba w-100" autocomplete="off">
						<input type="hidden" name="city_id" wire:model.defer="city_id" id="select-city-by-provincia-id-asegurable">
					</div>
			        @error('city_id') <span class="pl-2 text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror			 
			    </div>			           		
        	</div>

	        <div class="form-group row">
	        	<div class="col-md-6 col-12">
		            <div class="input-group  ">
		                <input class="mayus form-estilo prueba w-100" type="text" class="form-control" id="domicilio_sepelio" placeholder="  DOMICILIO" wire:model.defer="domicilio_asegurable">	             
		            </div>
	             	@error('domicilio_asegurable') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>

	        	<div class="pt-3 pt-md-0 col-md-6 col-12">
		            <div class="input-group  ">
		                <input class=" form-estilo prueba w-100" type="email" class="form-control" id="email_sep" placeholder="  CORREO" wire:model.defer="email_asegurable">	             
		            </div>
	             	@error('email_asegurable') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>	       	 
        	</div>  
 	    	         	
  		</div>
	</div>


