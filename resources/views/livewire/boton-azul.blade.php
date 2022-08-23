<div>
	<a id="consultar" class="" href="{{$url}}">

    	<button  wire:loading.attr="disabled" type="submit" class="boton-azul btn btn-danger">{{$name}}
    	
  
    	</button>
		    <div wire:loading class="spinner-border" role="status">
		 		 <span class="sr-only">Cargando...</span>
			</div>
    </a>
</div>