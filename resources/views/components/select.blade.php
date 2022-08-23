@if($tipo == 'tipos')
	<div class="input-group">
		<select required onchange="renderMarcas('{{route('render-marcas')}}');" class=" custom-select selector-cotiza-vehiculo" id="tipos" name="tipos"  >
            <option value="" selected disable>Tipo de vehículo</></option>
	         @if(!isset($collection->{'Veh-Tip-Cod'})) 
	         	<option  value="" disable >No hay opciones para este tipo</option>
	         @else    		                    
            @for ($i = 0; $i < count($collection->{'Veh-Tip-Cod'}) ; $i++)	                    	               			                    
                	<option value={{ $collection->{'Veh-Tip-Cod'}[$i] }} {{ old('tipo') == $collection->{'Veh-Tip-Cod'}[$i] ? 'selected' : '' }}>{{$collection->{'Veh-Tip-Nom'}[$i]}}</option>      
            @endfor
            @endif
		</select>               
	</div>

@endif

@if($tipo == 'marcas')
	<div class="input-group  ">
		<select  required onchange="renderModelos('{{route('render-modelos')}}')" class=" custom-select selector-cotiza-vehiculo" id="{{$idSelect}}" name={{$idSelect}} >

	        <option value="" selected disable >Marca</option>
		         @if(!isset($collection->{'Veh-Mar-Cod'})) 
		         	<option  value="" disable >No hay opciones para este tipo</option>
		         @else            	
			        @for ($i = 0; $i < count($collection->{'Veh-Mar-Cod'}) ; $i++)	                    	               			                    
			            	<option value="{{ $collection->{'Veh-Mar-Cod'}[$i] }}:{{ $collection->{'Veh-Mar-Nom'}[$i] }} {{ old($tipo) == $collection->{'Veh-Mar-Cod'}[$i] ? 'selected' : '' }}">{{$collection->{'Veh-Mar-Nom'}[$i]}}</option> 
			        @endfor      
		        @endif 
		</select>               
	</div>

@elseif($tipo == 'modelos')
	<div class="input-group">
		<select required class=" custom-select selector-cotiza-vehiculo" id="{{$idSelect}}" name={{$idSelect}} >
	        <option value="" selected disable >Modelo</option>
		         @if(!isset($collection->{'Veh-Mod-Cod'})) 
		         	<option value="" disable> No hay opciones para este tipo</option>
		         @else            	
			        @for ($i = 0; $i < count($collection->{'Veh-Mod-Cod'}) ; $i++)	                    	               			                    
			            	<option value="{{ $collection->{'Veh-Mod-Cod'}[$i] }}:{{ $collection->{'Veh-Mod-Nom'}[$i] }} {{ old($tipo) == $collection->{'Veh-Mod-Cod'}[$i] ? 'selected' : '' }}">{{$collection->{'Veh-Mod-Nom'}[$i]}}</option> 
			        @endfor      
		        @endif 
		</select>               
	</div>
@endif


@if($tipo == 'usos')

	<div class="input-group  ">
		<select required class=" custom-select selector-cotiza-vehiculo" id="{{$idSelect}}" name={{$idSelect}} >
	        <option value="" selected disable >Usos</option>
		         @if(!isset($collection->{'Veh-Uso-Cod'})) 
		         	<option  value="" disable >No hay opciones para este tipo</option>
		         @else            	
			        @for ($i = 0; $i < count($collection->{'Veh-Uso-Cod'}) ; $i++)	                    	               			                    
			            	<option value="{{ $collection->{'Veh-Uso-Cod'}[$i] }}:{{ $collection->{'Veh-Uso-Nom'}[$i] }} {{ old($tipo) == $collection->{'Veh-Uso-Cod'}[$i] ? 'selected' : '' }}">{{$collection->{'Veh-Uso-Nom'}[$i]}}</option> 
			        @endfor      
		        @endif 
			}
		</select>               
	</div>	

@endif