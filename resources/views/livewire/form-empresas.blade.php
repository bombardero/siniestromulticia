<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
             @error('razon_social') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  ">
                <input class="mayus form-estilo w-100" type="text" class="form-control" id="razon-social" placeholder="  Razon Social" wire:model.defer="razon_social">
               
            </div>
        </div>
        
        <div class="form-group">
             @error('cuit') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  ">
               <input class="form-estilo w-100" type="text" class="form-control" id="cuit" placeholder="  CUIT" wire:model.defer="cuit">
            </div>
        </div>
       
        <div class="form-group">
             @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  ">
                <input class="form-estilo w-100" type="email" class="form-control" id="email" placeholder="  Dirección de correo electrónico" wire:model.defer="email">
               
            </div>
        </div>
        
        <div class="form-group">
             @error('responsable') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  ">
                <input class="mayus form-estilo w-100" type="text" class="form-control" id="responsable" placeholder="  Responsable de contacto" wire:model.defer="responsable">
               
            </div>
        </div>
        
         <div class="form-group">
             @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group">
               <input class="mayus form-estilo w-100" type="text" class="form-control" id="telefono" placeholder="  Tel. de contacto" wire:model.defer="telefono">
            </div>
        </div>
       
        <div class="form-group">
            @error('cobertura_interes') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  ">
                <select class=" custom-select form-estilo" id="inputGroupSelect04" wire:model.defer="cobertura_interes" >
                    <option value="" selected disable>Cobertura de Caución de interés</></option>
                    <option value="Garantias Contractuales">Garantías Contractuales ( Públicas y Privadas )</></option>
                    <option value="Garantias Aduaneras">Garantías Aduaneras</></option>
                    <option value="Garantias Judiciales">Garantías Judiciales</></option>
                    <option value="Garantias de Actividad y/o Profesion">Garantías de actividad y/o profesión</></option>
                    <option value="Otras garantías">Otras Garantías</></option>
             
                </select>
                
            </div>
        </div>
        
        <div class="col-12 text-center">
            <a id="hablemos3" target="_blank" class="" href="">
                <button type="submit" class="mt-3 boton-cotiza btn btn-warning ">Consultar Seguro</button>
            </a>
            <div wire:loading class="spinner-border" role="status">
                 <span class="sr-only">Cargando...</span>
                 <span class="sr-only">Cargando...</span>
            </div>
        </div>
    </form>
</div>
