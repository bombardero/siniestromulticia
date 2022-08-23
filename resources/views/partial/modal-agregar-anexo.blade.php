@php
    $randomKey = uniqid().time();
    $references = uniqid();

@endphp
<div>
<div class="mt-5 modal anexo modal-rechazar fade bd-example-modal-sm" name="modal" id="uniqueid{{$references}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">				
        	   <div class="container">
        	   		<div class="row">
        	   			<div class="col-12 text-center">
        	   				<form method="POST"action="{{ route('documentoanexo.store')}}" class="w-100" enctype="multipart/form-data">
        	   				@csrf
        	   				<div class="form-group row ">
					        	<div class="text-center col-12">
					        		<label for="file">
					        			<div class="row">
					        				<div class="col-12">
        	   									<img id="imagen_seleccionada" src="{{url('/images/admin/cloud-computing 1.svg')}}" class="pt-5 img-fluid ">					        					
					        					<p class="titulo-subir-archivo pt-4"><u>Seleccionar Archivo PDF</u> </p>
					        				</div>
					        			</div>
					        		</label>
                                    <p class="panel-admin-table-title" id="file-name"></p>
					        		<input type="file" id="file" name="file" />

					        		<input type="hidden" value="1" id="tipo" name="tipo">
					        		<span></span>
					        	</div>
        	   				</div>
        	   				<button type="submit" class="boton-azul btn btn-danger">Adjuntar</button>
        	   				</form>

        	   			</div>
        	   		</div>
        	   </div>
        </div>
  	</div>
</div>
<a type="button" data-toggle="modal" data-target="#uniqueid{{$references}}" style="border:none;background: none;" >
	<img src="{{url('/images/admin/plus 3.svg')}}" class="img-fluid ">
</a>
</div>
