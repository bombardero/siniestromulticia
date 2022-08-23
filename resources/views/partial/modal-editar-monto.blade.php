 <div class="modal fade bd-example-modal-lg editar-monto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form method="POST" action="{{route('monto.update',['id' => $solicitud->id])}}">
           
            @csrf

            <div class="form-group">
                @error('monto') <span class="text-danger">{{ $message }}</span> @enderror
                <div class="input-group mt-3 mb-3">
                   
                      
                       <div class="input-group  ">
                           <input class="form-estilo w-100" type="text" class="form-control" id="monto" name="monto"  placeholder="  Editar Monto">
                          
                       </div>
                   
                    
                </div>
            </div>
    
     
          
            <button type="submit" class="mt-3 boton-cotiza btn btn-warning">Actualizar monto</button>
            
            
        
        </form>
      </div>
    </div>
</div>

 <div type="button" data-toggle="modal" data-target=".editar-monto"><p class="monto-estimado">Monto : ${{$monto}} <img src="{{url('/images/editar.svg')}}" class="img-fluid "> </p></div>

