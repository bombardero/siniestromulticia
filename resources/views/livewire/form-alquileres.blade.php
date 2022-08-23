<div >
    <form method="POST" action={{route('precio-estimativo-alquileres')}}>
        @csrf

        <div class="form-group">
            @error('valor_alquiler') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  mb-3">
               
                  
                   <div class="input-group  ">
                       <input class="form-estilo w-100" type="text" class="form-control" id="valor_alquiler" name="valor_alquiler"  @if (Session::has('autofocus')) autofocus @endif placeholder="  Valor Alquiler">
                      
                   </div>
               
                
            </div>
        </div>
        
        <div class="form-group">
             @error('duracion_contrato') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  mb-3">
                <select class="form-estilo custom-select" name="duracion_contrato" id="inputGroupSelect01">
                    <option value="" selected disable>Duración del contrato</option>
                @foreach($duraciones as $duracion)
                    <option value={{$duracion}}>{{$duracion}}</option>
                @endforeach
                 
                </select>
               
            </div>
        </div>
      <h4 class="text-center cotiza-segundo">Comunicate con nosotros </h2>
        <div class="col-12 text-center">
          
                <button type="submit" class="mt-3 boton-cotiza btn btn-warning">Cotizá On-Line</button>
            
            
        </div>
    </form>

</div>
