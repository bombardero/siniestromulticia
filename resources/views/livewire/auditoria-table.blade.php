<div class="pt-5">
      <div class="table-responsive">  
      <table class="table">
  			
            <thead class="thead tabla-panel">
              <tr class="tabla-cabecera ">
                <th class="th-padding" scope="col">Fecha de creación</th>
                <th class="th-padding" scope="col">Usuario</th>
                <th class="th-padding" scope="col">Accion</th>
              </tr>
            </thead>
           
            <tbody>
              <!-- IF($AUDITORIAS) --> 
            
      
            @foreach ($auditorias as $audit)

              <tr class="borde-tabla">
                <td>{{$audit->created_at}}</td>
                <td class="tabla-texto">
                	{{$audit->user->name}}
                </td>
                <td class="tabla-texto">
                 @if($audit->event == 'created' && $audit->auditable_type == 'App\Models\Propietario')
      			     <p>Creacion de propietario</p>
      			     @elseif($audit->event == 'created' && $audit->auditable_type == 'App\Models\Inquilino')
      			     <p>Creacion de inquilino</p>
			           @else
                 @foreach ($audit->getModified() as $attribute => $modified)
      			     @if($audit->auditable_type == 'App\Models\Propietario')
        			     @lang('propietario.'.$audit->event.'.modified.'.$attribute, $modified)
        			     @else
        			     @lang('inquilino.'.$audit->event.'.modified.'.$attribute, $modified)
      			     @endif
			       <br>
			     
			           @endforeach	
			           @endif

                </td>

              </tr>
              <!-- endforeach -->
            @endforeach

            
                 <!-- else --> 

              <!-- No hay auditorias --> 
            
                 <!-- endif-->     
            </tbody>
      </table>
      
    </div>


         <!--  $auditorias->links('partial.custom-pagination-view')}} --> 
    
 

  

  </div>