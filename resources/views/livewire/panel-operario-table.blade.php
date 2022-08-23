<div class="pt-5">
    <div clas="col-12 col-md-6">
      <input class="form-control w-100 form-estilo mb-3 " wire:model.debounce.900ms="search" type="search" placeholder="Buscar asegurado por nombre o apellido o DNI/CUIT">

    </div>
      <div class="table-responsive">  
      <table class="table">
  			
            <thead class="thead tabla-panel">
              <tr class="tabla-cabecera ">
                <th class="th-padding" scope="col">Fecha de creación</th>
                <th class="th-padding" scope="col">Estado</th>
                <th class="th-padding" scope="col">Inquilino</th>
                <th class="th-padding" scope="col">Propietario</th>
                <th class="th-padding" scope="col">Operaciones</th>
  
              </tr>
            </thead>
           
            <tbody>
          
              @if($solicitudes)
              @foreach($solicitudes as $solicitud)
              <tr class="borde-tabla">
                <td>{{$solicitud->created_at}}</td>
                <td class="tabla-texto">
                @if($solicitud->pago->status == 'Pagada')
                Pagada
                @else
                @if($solicitud->status == 'Completa')
                Pendiente de aprobación
                @elseif($solicitud->status == 'Aprobada')
                Aprobada (pendiente de pago)
                @elseif($solicitud->status == 'Rechazada')
                Rechazada
                @endif
                @endif</td>
                <td class="tabla-texto">{{$solicitud->inquilino->nombre}}</td>                
                <td class="tabla-texto">{{$solicitud->propietario->nombre}}</td>
                <td class="tabla-texto">
                    <a href="{{route('auditoria',['solicitud' => $solicitud])}}"><img src="{{url('/images/auditoria.svg')}}" class="img-fluid "></a>

                    <a href="{{route('datos-poliza',['solicitud' => $solicitud])}}"><img src="{{url('/images/ver_datos_op.svg')}}" class="img-fluid "></a>
                    <div class="d-inline" wire:key="{{uniqid().time().$solicitud->id}}">                                                              
                     @if($solicitud->status == 'Incompleta' || $solicitud->status == 'Completa')
                     <button 
                     onclick="confirm('¿Estas seguro de la aceptacion de la solicitud de {{$solicitud->user->name}}?') || event.stopImmediatePropagation()" style="border:none; background: none;" id="confirmacion-popup" wire:click="aprobar({{$solicitud->id}})"><img src="{{url('/images/aprobado.svg')}}" class="img-fluid">
                     </button>                      
                     @include('partial.modal-rechazar')
                      @endif
                    </div>
                </td>
                </div>
              </tr>
              @endforeach
              @else

              <td> No hay polizas cargadas todavia </td>
            
              @endif          
            </tbody>
      </table>
      
    </div>

    {{$solicitudes->links('partial.custom-pagination-view')}}
    

  

  </div>