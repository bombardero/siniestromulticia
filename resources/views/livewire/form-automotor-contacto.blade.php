<div >
    <form wire:submit.prevent="submit">
        @csrf

        <div class="pt-3 form-group">
        	<div class="row">
        		<div class="col-12">
		            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group mb-3 ">                                
		                   <div class="input-group  ">
		                       <input class="form-estilo-automotor-contacto w-100 mayus" type="text"  required class="form-control " id="nombre" name="nombre" placeholder="  Nombre y Apellido" wire:model.defer="nombre">   
		                   </div>               
		            </div>
        		</div>

        		<div class="col-12 col-md-6">
		            @error('codigo_postal') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group mb-3 ">                                
		                   <div class="input-group  ">
		                       <input class="form-estilo-automotor-contacto w-100 mayus" type="text"  required class="form-control " id="codigo_postal" name="codigo_postal"  placeholder="  Codigo Postal" wire:model.defer="codigo_postal">   
		                   </div>               
		            </div>        			
        		</div>

        		<div class="col-12 col-md-6">
		            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group mb-3 ">                                
		                   <div class="input-group  ">
		                       <input class="form-estilo-automotor-contacto w-100 " type="email" required class="form-control " id="email" name="email" placeholder="  Email" wire:model.defer="email">   
		                   </div>               
		            </div>        			
        		</div>

        		<div class="col-12 col-md-6">
		            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group mb-3 ">                                
		                   <div class="input-group  ">
		                       <input class="form-estilo-automotor-contacto w-100 mayus" type="text" required  class="form-control " id="telefono" name="telefono" placeholder="  Teléfono de contacto" wire:model.defer="telefono">   
		                   </div>               
		            </div>        			
        		</div>

        		<div class="col-12 col-md-6">
		            @error('horario') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group mb-3 ">                                
		                   <div class="input-group  ">
		                       <input class="form-estilo-automotor-contacto w-100 mayus" required  class="form-control " id="horario" name="horario"  placeholder="  Horario disponibilidad" wire:model.defer="horario_disponibilidad">   
		                   </div>               
		            </div>        			
        		</div>        		

        	</div>

        </div>


        <div class="text-center col-12">
                <button type="submit" class=" mt-3 boton-contacto-automotor btn btn-warning">Quiero que me contacten</button>
            <div wire:loading class="spinner-border" role="status">
                 <span class="sr-only">Cargando...</span>
                 <span class="sr-only">Cargando...</span>
            </div>        	
        </div>

    </form>

</div>