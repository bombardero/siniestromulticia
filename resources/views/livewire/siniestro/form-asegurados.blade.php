<div>
    <form class="w-75 mx-auto" wire:submit.prevent="submit">
        <div class="pt-5 col-12">
            <p class="datos-asegurado-title">Datos del asegurado</p>
        </div>
        <div class="form-check">
            <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="exampleCheck1">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1">Entiendo que esto y realizando una <b>notificacion para INICIAR tramite de denuncia,</b>  un primer contacto con la compañía y no califica como Denuncia propiamente dicha. </label>
            @error('terminos_condiciones') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="pt-3 form-group row">
            <div class="col-12 col-md-6">
               @error('dominio') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
               <div class="input-group  ">
                  <input maxlength="7" class="form-estilo prueba w-100" type="text" class="form-control" id="dominio" placeholder=" Dominio del vehiculo*" wire:model.defer="dominio">
               </div>	
           </div>
           <div class="col-12 col-md-3 pt-3 pt-md-0">
               @error('fecha_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
               <div class="input-group input_container ">
                   <input                        
                    class="form-estilo form-control prueba w-100"  
                    id="fecha_asegurado" 
                    type="text" 
                    placeholder="Fecha del siniestro(dd.mm.año)*"
                    wire:model.defer="fecha_siniestro">  
               </div>	
                
           </div>

           <div class="col-12 col-md-3 pt-3 pt-md-0">
               @error('hora_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
               <div class="input-group input_container ">
                   <input
                    class="form-estilo form-control prueba w-100"
                    id="hora_asegurado"
                    type="text"
                    placeholder="Hora del siniestro(HH:mm)"
                    wire:model.defer="hora_siniestro">
               </div>

           </div>


           <div class="col-12 col-md-6 pt-3">
                @error('lugar_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="lugar_siniestro" placeholder="  Lugar del siniestro*" wire:model.defer="lugar_siniestro">           
                </div>	
            </div>
            
            <div class="col-12 col-md-6 pt-3">
                @error('codigo_postal') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="codigo_postal" placeholder="  CP*" wire:model.defer="codigo_postal">           
                </div>	
            </div>

            <div class="col-12 col-md-12 pt-3">
                @error('direccion_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="direccion_siniestro" placeholder="  Dirección del siniestro" wire:model.defer="direccion_siniestro">
                </div>
            </div>

            <div class="col-12 col-md-12 pt-3">
                @error('conductor_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="conductor_siniestro" placeholder="  Conductor del vehículo al momento del siniestro" wire:model.defer="conductor_siniestro">
                </div>
            </div>
            
            <div class="col-12 col-md-12 pt-3">
                @error('descripcion_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <textarea class="form-estilo prueba w-100" style="resize: none;height: 100px;" class="form-control" id="descripcion_siniestro" placeholder="  Descripción del siniestro (max: 1500 caracteres)" maxlength="1500" wire:model.defer="descripcion_siniestro"></textarea>
                </div>
            </div>

            <div class="col-12 col-md-6 pt-3 pt-md-5 ">
                @error('responsable_contacto') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="responsable_contacto" placeholder="  Responsable de contacto:* Nombre y apellido" wire:model.defer="responsable_contacto">           
                </div>	
            </div>   
            
            
            <div class="col-12 col-md-6 pt-3 pt-md-5">
                @error('domicilio') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="domicilio" placeholder="  Domicilio*" wire:model.defer="domicilio">           
                </div>	
            </div>  

            <div class="col-12 pt-3">
                @error('telefono') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="telefono" placeholder="  Tel. de contacto*" wire:model.defer="telefono">           
                </div>	
            </div>  

            <div class="col-12 col-md-6 pt-3">
                @error('email') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="email" placeholder="  Email de contacto*" wire:model.defer="email">           
                </div>	
            </div>  

            <div class="col-12 col-md-6 pt-3">
                @error('email_confirmation') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <input class="form-estilo prueba w-100" type="text" class="form-control" id="email_confirmation" placeholder="  Repetir email de contacto*" wire:model.defer="email_confirmation">           
                </div>	
            </div>  
            <div class="col-12 text-right">
                <p class="campos-obligatorios pt-3">*Campos son obligatorios.</p>
            </div>
       </div>

        <div class="col-12 text-center text-md-right">
            <a id="hablemos3" target="_blank" class="" href="">
                <button type="submit" class="mt-3 boton-enviar-siniestro btn ">Enviar</button>
            </a>
            <div wire:loading class="spinner-border" role="status">
                 <span class="sr-only">Cargando...</span>
                 <span class="sr-only">Cargando...</span>
            </div>
        </div>
    </form>
</div>


<script>
    document.addEventListener('livewire:load', function () {

        $(document).ready(function()
        {
          const date = new Date();
          IMask(
            document.getElementById('fecha_asegurado'),
            {

              mask: Date,
              min: new Date(1990, 0, 1),
              max: new Date(date.getFullYear(), date.getMonth() + 1,date.getDate()),
              lazy: true
            });            
        })

    })

</script>