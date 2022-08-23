<div >
    <form method="POST" action={{route('estadoPoliza.create',['user' => Auth::user()])}}>
        @csrf
        
        <div class="form-group">
            @error('valor_alquiler') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  mb-3">
                <select class="form-estilo custom-select" name="valor_alquiler" id="inputGroupSelect01"  @if (Session::has('autofocus')) autofocus @endif>
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
                <select class="form-estilo custom-select" name="duracion_contrato" id="inputGroupSelect01">
                    <option value="" selected disable>Duración del contrato</option>
                  <option value="1">1 año</option>
                  <option value="2">2 años</option>
                  <option value="3">3 años</option>
                 
                </select>
               
            </div>
        </div>
      
        <div class="col-12 text-center">

                <button type="submit" class="mt-3 boton-cotiza btn btn-warning">Crear solicitud</button>
            
            
        </div>
    </form>

</div>
