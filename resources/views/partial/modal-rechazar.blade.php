@php
    $randomKey = uniqid().time();
    $references = uniqid();

@endphp
<div class="modal modal-rechazar fade bd-example-modal-sm" id="uniqueid{{$references}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div class="modal-dialog modal-sm">

		<div class="modal-content">				
        	     <livewire:rechazo-livewire 
			        :solicitud="$solicitud"
			        :key="'runner-' . $randomKey" />
        </div>
  	</div>
</div>
<button type="button" data-toggle="modal" data-target="#uniqueid{{$references}}" style="border:none;background: none;" >
	<img src="{{url('/images/rechazado.svg')}}" class="img-fluid ">
</button>

