<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
             @error('razon_social') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " style="height: 32.72px;">
                <input class="mayus form-estilo-solicitar-seguro w-100"  type="text" class="form-control" id="razon-social" placeholder="  Nombre / Razon Social" wire:model.defer="razon_social">
               
            </div>
        </div>
        
        <div class="form-group">
             @error('cuit') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " style="height: 32.72px;">
               <input class="form-estilo-solicitar-seguro w-100" type="text" class="form-control" id="cuit" placeholder="  DNI / CUIT" wire:model.defer="cuit">
            </div>
        </div>
       
        <div class="form-group">
             @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " style="height: 32.72px;">
                <input class="form-estilo-solicitar-seguro w-100" type="email" class="form-control" id="email" placeholder="  Dirección de correo electrónico" wire:model.defer="email">
               
            </div>
        </div>
        
        <div class="form-group">
             @error('responsable') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " style="height: 32.72px;">
                <input class="form-estilo-solicitar-seguro w-100" type="text" class="form-control" id="responsable" placeholder="  Responsable de contacto" wire:model.defer="responsable">
               
            </div>
        </div>
        
         <div class="form-group">
             @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " style="height: 32.72px;">
               <input class="form-estilo-solicitar-seguro w-100" type="text" class="form-control" id="telefono" placeholder="  Tel. de contacto" wire:model.defer="telefono">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
		         <div class="form-group">
		             @error('provincia') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group  " style="height: 32.72px;">
		               <input class="form-estilo-solicitar-seguro w-100" type="text" class="form-control" id="provincia" placeholder="  Provincia" wire:model.defer="provincia">
		            </div>
		        </div>        
                      
            </div>

            <div class="col-md-6">
		         <div class="form-group">
		             @error('codigo_postal') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group  " style="height: 32.72px;">
		               <input class="form-estilo-solicitar-seguro w-100" type="text" class="form-control" id="codigo_postal" placeholder="  CP" wire:model.defer="codigo_postal">
		            </div>
		        </div>                    	
            </div>
        </div>

        <div class="form-group">
            @error('cobertura_interes') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  " style="height: 32.72px;">
                <select class="custom-select form-estilo-solicitar-seguro" id="inputGroupSelect04" wire:model.defer="cobertura_interes" >
                    <option style="background-color:#EAEAEA;" value="" selected disable>Cobertura de caución de interés</option>
                    <option style="background-color:#EAEAEA;" value="Garantias Contractuales">Garantías Contractuales ( Públicas y Privadas )</option>
                    <option style="background-color:#EAEAEA;" value="Garantias Aduaneras">Garantías Aduaneras</option>
                    <option style="background-color:#EAEAEA;" value="Garantias Judiciales">Garantías Judiciales</option>
                    <option style="background-color:#EAEAEA;" value="Garantias de Actividad y/o Profesion">Garantías de actividad y/o profesión</option>
                    <option style="background-color:#EAEAEA;" value="Otras garantías">Otras Garantías</option>
         
                </select>
                
            </div>
        </div>
       
        <div class="col-12 text-center pt-5 fondo-solicitar-seguro" >
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        <div class="col-12 text-center">
            <a id="hablemos3" target="_blank" class="" href="">
                <button type="submit" class="mt-3 boton-azul btn btn-danger ">Aceptar</button>
            </a>
            <div wire:loading class="spinner-border" role="status">
                 <span class="sr-only">Cargando...</span>
                 <span class="sr-only">Cargando...</span>
            </div>
        </div>            
            <br>
            <br>
         

        </div>
        
    </form>
</div>



