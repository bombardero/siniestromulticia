<div class="pt-5">
      <div class="table-responsive">  
      <table class="table">
            <thead class="thead tabla-panel">
              <tr class="tabla-cabecera ">
              	<th class="th-padding" scope="col">N° Gestion</th>
                <th class="th-padding" scope="col">Tipo de Vehiculo</th>
                <th class="th-padding" scope="col">Marca</th>
              </tr>
            </thead>
           
            <tbody>
          
              @if($cotizaciones)
              @foreach($cotizaciones as $cotizacion)
              <tr class="borde-tabla">
                <td>{{$cotizacion->tipo}}</td>
                <td>{{$cotizacion->marca}}</td>
                <td>{{$cotizacion->modelo}}</td>          
                </div>
              </tr>
              @endforeach
              @else

              <td> No hay cotizaciones cargadas todavia </td>
            
              @endif          
            </tbody>
      </table>
      
    </div>

    {{$cotizaciones->links('partial.custom-pagination-view')}}
    

  

  </div>