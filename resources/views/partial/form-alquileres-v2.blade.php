<div >
    <form  method="POST" action={{route('precio-estimativo-alquileres',['precio' => $valor_alquiler])}}>
        @csrf
        <div class="form-group">
            @error('valor_alquiler') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  mb-3">
                <select class="form-estilo custom-select" id="inputGroupSelect01"  >
                    <option value="" selected disable>Valor Alquiler / Mes</option>
                    <option value="10000">0 - $10.000</option>
                    <option value="25000"> 10.001 - $25.000</option>
                    <option value="25001">$25.000+ </option>
             
                </select>
                
            </div>
        </div>
        
        <div class="form-group">
             @error('duracion_contrato') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  mb-3">
                <select class="form-estilo custom-select" id="inputGroupSelect01">
                    <option value="" selected disable>Duración del contrato</option>
                  <option value="1">1 año</option>
                  <option value="2">2 años</option>
                  <option value="3">3 años</option>
                 
                </select>
               
            </div>
        </div>
      <h4 class="text-center cotiza-segundo">Comunicate con nosotros </h2>
        <div class="col-12 text-center">
          
                <button type="submit" class="mt-3 boton-cotiza btn btn-warning">Cotizá On-Line</button>
            
            
        </div>
    </form>

</div>
