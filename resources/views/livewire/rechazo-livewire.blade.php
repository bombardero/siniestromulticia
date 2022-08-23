<div class="">
<p class="panel-operaciones-subtitle">Rechazar Solicitud</p>
<form wire:submit.prevent="submit">
	<div class="form-group">
            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " >
                <select class="custom-select form-estilo-solicitar-seguro" name="type"  wire:model.defer="type" >
                    <option value="" selected disable>Documento</option>
                    <option value="inquilino">Inquilino</option>
                    <option value="propietario">Propietario</option>
                    <option value="contrato">Contrato</option>
                    <option value="inmobiliaria">Inmobiliaria</option>
                    <option value="aval">Avales</option>
         
                </select>
                
            </div>
        </div>	

	 <div class="form-group">
             @error('motivo') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " >
                <textarea class="form-estilo-solicitar-seguro w-100" type="text" class="form-control" :id="$key" placeholder=" Motivo " wire:model.defer="motivo"></textarea>
               
            </div>
        </div>        
		      
		        

		        
<div   class="col-12 mt-4 text-center">
	@include('livewire.boton-azul', ['url' => '/', 'name' => 'Rechazar Solicitud'])

</div>
</form>
</div>
