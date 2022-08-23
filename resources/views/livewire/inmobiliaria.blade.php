<div class="">

    <form wire:submit.prevent={{$formMode}}>
    	
    	<div class = "bg-form">
		    <p class="pt-5 pb-3 completa-datos text-center">
		      Datos Inmobiliaria  
		    </p>  
		   	
		    
		        <div class="form-group row ">
		        
		        	<div class="text-center col-12 mx-auto m-4 ">
		        		

		        		@error('inmobiliaria') <span class="pl-2 text-danger">{{ $message }}</span> @enderror

		        		@role('inmobiliaria')
						    <select selected disabled class="custom-select form-estilo prueba w-100" id="inputGroupSelect01dsa4" name="inmobiliaria" wire:model.defer="inmobiliaria">
                             <option value={{Auth::id()}}>{{Auth::user()->name}}</option>
                        	</select>

						@else
							
						    <select class=" custom-select form-estilo prueba w-100" id="inmobiliaria" name="inmobiliaria" wire:model.defer="inmobiliaria">
                             <option value="" >Buscar Inmobiliaria</option>
                             @foreach($inmobiliarias as $inmobiliaria)            
                             	<option value={{$inmobiliaria->id }} {{ old('inmobiliaria') == $inmobiliaria->id ? 'selected' : '' }}>{{$inmobiliaria->name}}</option>
                             @endforeach

                             

                        	</select>
                        	@if($updateMode)
							<p class="completa-datos pt-4">Tu inmobiliaria: {{$solicitud->inmobiliaria->name}}</p>
							@endif
						@endrole

		        	</div>

		        </div>

		</div>  
				@role('cliente')
		        <div class="col-12 mt-4 text-center">
		            @include('livewire.boton-azul', ['url' => '/', 'name' => '¡Listo!'])
		        </div>
		        @endrole
		     
    </form>

</div>
