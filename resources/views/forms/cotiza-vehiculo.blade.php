	<div class="container">
		<div class="row">
			<div class="col-12">
				@error('inlineRadioOptions') <span class="text-danger">{{ $message }}</span> @enderror
				<div class="form-group">
					<div class="form-check form-check-inline">
					  <input onchange="renderTipoVehiculo('{{route('render-tipos')}}')" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioOptions" value="24">
					  <label class="form-check-label" for="inlineRadio1">Motocicletas</label>
					</div>
					<div class="form-check form-check-inline">
					  <input onchange="renderTipoVehiculo('{{route('render-tipos')}}')" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioOptions2" value="3">
					  <label class="form-check-label" for="inlineRadio2">Automotores</label>
					</div>			
				</div>
			</div>
			<div class="col-6">
        		<div class="form-group">
            		@error('tipos') <span class="text-danger">{{ $message }}</span> @enderror
            		<x-select tipo="tipos" id-select="tipos" name="tipos"></x-select>
        		</div>	
			</div>

			<div class="col-6">
        		<div class="form-group">
            		@error('año') <span class="text-danger">{{ $message }}</span> @enderror
            		<div class="input-group  ">
                		<select  required class=" custom-select selector-cotiza-vehiculo" id="año" name="año" >
		                    <option value="" selected disable>Año</option>
		                    @for ($i = date("Y"); $i>=date("Y")-30; $i--)	  
		                    	<option value="{{$i}}" {{ old('año') == $i ? 'selected' : '' }}>{{$i}}</option>
		                    @endfor          
                		</select>               
            		</div>
        		</div>				
			</div>				

			<div class="col-6">
        		<div class="form-group">
        			@error('marcas') <span class="text-danger">{{ $message }}</span> @enderror
					<x-select tipo="marcas"></x-select>
				</div>
			</div>
			<div class="col-6">
        		<div class="form-group">

            		@error('modelos') <span class="text-danger">{{ $message }}</span> @enderror
            		<x-select tipo="modelos" id-select="modelos" name="modelos"></x-select>
        		</div>				
			</div>

			<div class="col-6">
        		<div class="form-group">

            		@error('usos') <span class="text-danger">{{ $message }}</span> @enderror
            		<x-select tipo="usos" id-select="usos" name="usos"></x-select>
        		</div>				
			</div>


			<div class="col-6">
		        <div class="form-group">
		             @error('codigo_postal') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group  ">
		                <input type="text" required value="{{ old('codigo_postal') }}" class="selector-cotiza-vehiculo w-100" class="form-control" id="codigo_postal" placeholder="  Codigo Postal" name="codigo_postal">		               
		            </div>
		        </div>			
			</div>		

			<div class="col-12">
		        <div class="form-group">
		             @error('provincia') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group  ">
                		<select  required class=" custom-select selector-cotiza-vehiculo" id="provincia" name="provincia" >
		                    <option value="" selected disable>Provincias</option>
                             @foreach($provinces as $province)
                             	<option value='{{$province->cod }}' {{ old('provincia') == $province->cod ? 'selected' : '' }}>{{$province->name}}</option>
                             @endforeach    
                		</select>   		                   
		            </div>
		        </div>			
			</div>	

			<div class="col-12 col-md-6">
		        <div class="form-group">
		             @error('email') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group  ">
		                <input required value="{{ old('email') }}" class="selector-cotiza-vehiculo w-100" type="email" class="form-control" id="codigo_postal" placeholder="  Email" name="email">		               
		            </div>
		        </div>			
			</div>		
			<div class="col-12 col-md-6">
		        <div class="form-group">
		             @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
		            <div class="input-group  ">
		                <input type="number" maxlength="20" required value="{{ old('telefono') }}" class="selector-cotiza-vehiculo w-100" class="form-control" id="telefono" placeholder="  Número de teléfono para recibir whatsapp" name="telefono">		               
		            </div>
		        </div>			
			</div>														
		</div>
	</div>

