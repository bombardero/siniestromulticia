<div class="pt-5">
    <div clas="col-12 col-md-6">
      <input class="form-control w-100 form-estilo mb-3 " wire:model.debounce.900ms="search" type="search" placeholder="Buscar asegurado por nombre,apellido o DNI">
    </div>
      <div class="table-responsive">  
      <table class="table">
  
            <thead class="thead tabla-panel">
              <tr class="tabla-cabecera ">
                <th class="th-padding" scope="col">ID</th>
                <th class="th-padding" scope="col">Cotizacion</th>
                <th class="th-padding" scope="col">Asegurado/Propietario</th>
                <th class="th-padding" scope="col">Acciones</th>
                <th class="th-padding" scope="col">Estado</th>
  
              </tr>
            </thead>
           
            <tbody>
          
              @if($solicitudes)
              @foreach($solicitudes as $solicitud)
              <tr class="borde-tabla">
                <td ><a class="tabla-contrato-texto" href="{{route('estadoPoliza.show',['solicitud' => $solicitud])}}">{{$solicitud->id}}</a></td>
                <td class="tabla-texto">{{$solicitud->cotizacion->precio}}</td>
                <td class="tabla-texto">
                  @if($solicitud->propietario)
                  {{$solicitud->propietario->nombre}}
                  @else
                  A completar
                  @endif
                </td>
                <td>
                   <div class="d-inline">
                    <a href="{{route('estadoPoliza.show',['solicitud' => $solicitud])}}" data-toggle="tooltip" data-placement="top" title="Ver el estado de tu poliza y editarla"><img src="{{url('/images/editar.svg')}}" class="img-fluid "></a>
                  </div>
                </td>
                <td class="tabla-texto">
                  <div class="d-inline">
                    @if($solicitud->pago->status == 'Pagada')
                     <a href="#" data-toggle="completa" data-placement="top" title="Estado de tu poliza: {{$solicitud->pago->status}}"><img src="{{url('/images/mobile/done.svg')}}" class="img-fluid "></a>
                    @elseif($solicitud->status == "Incompleta" || $solicitud->status == "Rechazada")
                    <a href="#" data-toggle="incompleta" data-placement="top" title="Estado de tu solicitud: {{$solicitud->status}}"><img src="{{url('/images/pendiente.svg')}}" class="img-fluid "></a>
                    @elseif($solicitud->status == 'Completa' || $solicitud->status == 'Aprobada')
                    <a href="#" data-toggle="completa" data-placement="top" title="Estado de tu solicitud: {{$solicitud->status}}"><img src="{{url('/images/mobile/done.svg')}}" class="img-fluid "></a>

                    @endif
                   
                  </div>
                </td>
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