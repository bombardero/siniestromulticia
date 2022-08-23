<div class="">
	<form wire:submit.prevent="{{$formMode}}" enctype="multipart/form-data">
		@if($solicitud->pago->status == 'Pagada' || $solicitud->status == 'Aprobada')
		<fieldset disabled="disabled">
		@endif
		<div class = "bg-form">
			<p class="pt-5 pb-3 completa-datos text-center">
				Contrato
			</p>  
			<div class="form-group row ">
				<div class="text-center col-12 ">
					<input type="file"  id="contratos" wire:change="$emit('single_file_choosed_contrato')"  >
					<label for="contratos">
						<div class="row">
							<div class="col-12  subir-archivo-bg">
								<img src="{{url('/images/mobile/file-upload-outline 1.svg')}}" class="img-fluid pt-4">
								<p class="subir-archivo">Subir archivos</p>
								@if($updateMode)
								<div>

									<img src="{{url('/images/mobile/text-box-plus-outline 1.svg')}}" class="d-none d-md-inline img-fluid">
									<span class="subir-archivo" style="text-decoration: underline;">

										Agregar <span class="d-none d-md-inline">otro documento<span>	
										</span>
								</div>
									@else
									<div>
										<img src="{{url('/images/mobile/text-box-plus-outline 1.svg')}}" class="d-none d-md-inline img-fluid">

									</div>
									@endif
							</div>

						</div>
						</label>
						<p>@error('contratos') <span class="text-danger">{{ $message }}</span> @enderror</p>
						@foreach($solicitud->documentos()->where('type', 0)->get() as $archivo)
							<div class="row">
								<div class="col-12">
								<p>
									<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

									@if($solicitud->documentos()->where('type', 0)->count() > 1)
									 <button 
					                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
					                 </button>
					                @endif
								</p>

								</div>
							</div>
						@endforeach
				</div>
		</div>
			</div>           
			<div class="col-12 mt-4 text-center">
				@include('livewire.boton-azul', ['url' => '/', 'name' => '¡Listo!'])
			</div>
		</fieldset>
	</form>
</div>
