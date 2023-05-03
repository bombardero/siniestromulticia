<div class="card card-datos-sepelio w-75 mx-auto mb-4">
  		<div class="card-body">
    		<p class="sepelios-title">DATOS DEL PRODUCTOR</p>
	        <div class="form-group row">
	        	<div class="col-md-6 col-12">
		            <div class="input-group  ">
		                <input class="form-estilo prueba w-100" type="text" class="form-control" id="nombre_productor" placeholder="  APELLIDO Y NOMBRES / RAZÓN SOCIAL" wire:model.defer="nombre_productor">
		            </div>
		            @error('nombre_productor') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-3 col-12">
		            <div class="input-group  ">
		                <input class="form-estilo prueba w-100" type="text" class="form-control" id="codigo_compania" placeholder="  CODIGO CIA." wire:model.defer="codigo">
		            </div>
	             	@error('codigo') <span class="text-danger mensaje-error-sepelio">{{ $message }}</span> @enderror
	       	 	</div>

	       	 	<div class="pt-3 pt-md-0 col-md-3 col-12">
		        	<a class="solicitar-alta-productor" href="{{route('productores.index')}}">Solicitar Alta Productor</a>
	       	 	</div>
        	</div>
        </div>
 </div>
