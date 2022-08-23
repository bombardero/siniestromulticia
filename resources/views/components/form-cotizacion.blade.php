<div >
    <form id="form-cotizacion" method="POST" action={{route($cotizacionRuta)}}>
        @csrf

        <div class="form-group">
            @error('valor_alquiler') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group mb-3 ">
               
                  
                   <div class="input-group  ">
                       <input class="form-estilo w-100 mayus" type="text"  class="form-control " id="valor_alquiler" name="valor_alquiler"  @if (Session::has('autofocus')) autofocus @endif placeholder="  Valor Alquiler / mes">
                      
                   </div>
               
                
            </div>
        </div>

        <div class="form-group ">
             @error('tipo_alquiler') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group mb-3">
                <select class="form-estilo custom-select" name="tipo_alquiler" id="tipo_alquiler">
                    <option value="" selected disable>Tipo de alquiler</option>
                    <option value='vivienda'>VIVIENDA</option>
                    <option value='comercial'>COMERCIAL</option>
                 
                </select>
        
            </div>
        </div>
        
        {{-- <div class="form-group">
             @error('duracion_contrato') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="input-group  mb-3">
                <select class="form-estilo custom-select" name="duracion_contrato" id="inputGroupSelect01">
                    <option value="" selected disable>Duración del contrato</option>
                @foreach($duraciones as $duracion)
                    <option value={{$duracion}}>{{$duracion}}</option>
                @endforeach
                 
                </select>
        
            </div>
        </div> --}}
      <h2 class="text-center cotiza-segundo">{{$comunicateNosotros}}</h2>
        <div class="col-12 text-center">
          
                <button id="btn-cotizacion" type="submit" class="mt-3 boton-cotiza btn btn-warning">{{$textFormCotizacion}}</button>
                
            
        </div>
    </form>

</div>