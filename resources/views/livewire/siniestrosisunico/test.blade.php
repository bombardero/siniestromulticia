<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso11.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 11 </b>| 12 <b>Carga de documentos</b></span>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Documentación  necesaria para finalizar el trámite de Denuncia Administrativa.


            </label>

            <div class="input-group  ">
		        <div class="form-group row ">

		        
		        	<div class="text-center col-6 ">
		 
		        		<p class="titulo-subir-archivo">Foto DNI frente y reverso </p>
		        		
		        		<input type="file"  id="foto_dni"  name="foto_dni" wire:change="$emit('single_file_choosed_dni')">
		        		<label for="foto_dni">
		        			<div class="row">
		        				<div class="col-12  subir-archivo-bg">
		        					<img src="{{url('/images/mobile/file-upload-outline 1.svg')}}" class="img-fluid pt-4">
		        					<p class="subir-archivo">Subir archivo</p>
		        					<div>
		        						<img src="{{url('/images/mobile/text-box-plus-outline 1.svg')}}" class="d-none d-md-inline img-fluid">
			        					<span class="subir-archivo" style="text-decoration: underline;">
			        					Agregar <span class="d-none d-md-inline">otro documento<span>	
			        					</span>
		        					</div>
		        				</div>
		        			</div>		        			
		        		</label>

		        		<p>@error('fotos_dni') <span class="text-danger">{{ $message }}</span> @enderror</p>
		        		<div>
			        		@if(count($denuncia_siniestro->documentosDenuncia) > 0)
                                    {{-- TIPO 1 = DNI --}}
					        		@foreach($denuncia_siniestro->documentosDenuncia()->where('type', 1)->get() as $archivo)
										<div class="row">
											<div class="col-12">
											<p>
												<a target="_blank" class="documento-formato-texto pt-2" href={{$archivo->url}}>{{$archivo->nombre}}</a><i class="pl-2 fas fa-check"></i>

												@if($denuncia_siniestro->documentosDenuncia()->where('type', 1)->count() > 1)
												 <button 
								                  style="border:none;background: none;" id="confirmacion-popupa" wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i class="fas fa-trash-alt"></i>
								                 </button>
								                @endif
											</p>

											</div>
										</div>
									@endforeach
			        		@endif
		        		</div>

		        	</div>
		        	@include('partial.archivos_simultaneos')

                    <span style="color:red;">
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                        </span>

                     <a class="mt-5 boton-enviar-siniestro btn " style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;" href='{{route('asegurados-denuncias-paso10.create',['id'=> request('id')])}}'>ANTERIOR</a>
                     <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
        </div>


        <div class="col-12 text-center text-md-right">
            <div wire:loading class="spinner-border" role="status">
                 <span class="sr-only">Cargando...</span>
                 <span class="sr-only">Cargando...</span>
            </div>
        </div>
    </form>
</div>
<br>
<br>
<br>

@section('scripts')
<script type="text/javascript">

function getFileData(myFile){

    var file = myFile.files[0];  
    var filename = file.name;  
    document.getElementById('subidaReciente').innerHTML = filename; 
    document.getElementById('iconoReciente').style.display = "block"; // hide        
    if($("#databaseIMG") != null) {
    $("#databaseIMG").remove();
    }
}
$( document ).ready(function() {
    
});
</script>

@endsection