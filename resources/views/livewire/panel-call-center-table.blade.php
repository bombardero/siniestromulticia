<div class="pt-5">
    <div clas="col-12 col-md-6">
      <input class="form-control w-100 form-estilo mb-3 " wire:model.debounce.600ms="search" type="search" placeholder="Buscar cotizacion por numero de gestion">

    </div>
      <div class="table-responsive">  
      <table class="table">
  			
            <thead class="thead tabla-panel">
              <tr class="tabla-cabecera ">
              	<th class="th-padding" scope="col">N° Gestion</th>
                <th class="th-padding" scope="col">Tipo de Vehiculo</th>
                <th class="th-padding" scope="col">Marca</th>
                <th class="th-padding" scope="col">Modelo</th>
                <th class="th-padding" scope="col">Año</th>
                <th class="th-padding" scope="col">Uso</th>
  				<th class="th-padding" scope="col">CP</th>
  				<th class="th-padding" scope="col">CELULAR</th>
          <th class="th-padding" scope="col">PROVINCIA</th>
              </tr>
            </thead>
           
            <tbody>
          
              @if($cotizaciones)
              @foreach($cotizaciones as $cotizacion)
              <tr class="borde-tabla">
                <td><a href="{{route('panel-callcenter.show',['cotizacion' => $cotizacion])}}" style="color:#3366BB; font-weight: bold; " data-toggle="tooltip" data-placement="top" title="Ver mas informacion">{{$cotizacion->id}}</a></td>
                <td>{{$cotizacion->tipo}}</td>
                <td>{{$cotizacion->marca}}</td>
                <td>{{$cotizacion->modelo}}</td>
                <td>{{$cotizacion->año}}</td>
                <td>{{$cotizacion->usos}}</td>
                <td>{{$cotizacion->codigo_postal}}</td>
                <td>{{$cotizacion->numero}}</td>
                <td>{{$cotizacion->provincia}}</td>
            	
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