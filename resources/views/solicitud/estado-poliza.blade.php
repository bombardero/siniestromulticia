@extends('layouts.app')
@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h1 class="pt-4 estado-poliza-titulo">
					Estado de tu póliza
				</h1>
				<p class="pt-4 precio-estimativo-poliza">
					Precio sugerido: <span class="monto">${{$solicitud->cotizacion->precio}}</span>
				</p>
				<p class="pt-5 pb-3 completa-datos">
					Completá los siguientes datos
				</p>
			</div>

		</div>
		@if(Session::has('mensaje'))
		<div class=" alert alert-info alert-dismissible fade show" role="alert">
		{{ Session::get('mensaje') }}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>

		@endif
		<div class="row text-center">

		 <!-------------------- MODAL INQUILINO------------------------- -->
		 @include('partial.modal-inquilino')

		 @include('partial.modal-propietario')

		 @include('partial.modal-contrato')

		 @include('partial.modal-inmobiliaria')

		 @include('partial.modal-aval')




		</div>

		<div class="row">
			<div class="col-12 text-center pt-5 mb-3">


				@if($solicitud->status == 'Incompleta')
				<img class="pt-2 img-fluid" src="{{url('/images/mobile/alert-circle.svg')}}">
				<p class="estado-solicitud pb-5">
				Solicitud incompleta. Estado: Restan datos por completar.
				</p>
				@endif

				@if($solicitud->status == 'Completa')
				<img class="pt-2 img-fluid" src="{{url('/images/mobile/clock-check-outline 1.svg')}}">
				<p class="estado-solicitud pb-5">
				Solicitud enviada. Estado: Pendiente de aprobación.
				</p>
				@endif
				@if($solicitud->pago->status == 'Pagada')
				<p class="estado-solicitud-ok pb-5">
				<img class="pt-2 img-fluid" src="{{url('/images/mobile/done.svg')}}">
				Póliza pagada</p>
				@elseif($solicitud->status == 'Aprobada')
				<p class="estado-solicitud-ok pb-5">
				<img class="pt-2 img-fluid" src="{{url('/images/mobile/done.svg')}}">
				Documentación completa y aprobada</p>

				@endif
				@if($solicitud->status == 'Rechazada')
				<img class="pt-2 img-fluid" src="{{url('/images/mobile/alert-circle.svg')}}">
				<p class="estado-solicitud pb-5">
				Solicitud desaprobada.
				<br>
				Documento rechazado: <span class="text-capitalize">{{$solicitud->rechazos->sortDesc()->first()->type}}</span>
				<br>
				Motivos :
				{{$solicitud->rechazos->sortDesc()->first()->motivo}}
				</p>
				@endif



				@livewire('boton-azul',['name' => 'Volver al Panel', 'url' => '/panel/'.Auth::id()])

				<p class="pt-5 formas-pago">Todas las formas de pago</p>
				<img class="img-fluid" src="{{url('/images/mobile/medios-pago 1.svg')}}">
			</div>

			@if($solicitud->status == 'Completa' || $solicitud->status == 'Aprobada' || $solicitud->status == 'Incompleta' || $solicitud->status == 'Rechazada')
			<div class="col-12 mt-3 text-center">
				@if($solicitud->status == 'Aprobada')
			 <p class="text-center pt-4 precio-estimativo-poliza">
					Precio exacto: <span class="monto">${{$solicitud->pago->monto}}</span>
			</p>
			@endif
					<form method="POST" action="{{route('pago.store', ['pago' => $solicitud->pago->id])}}">
					@csrf
					<button type="submit"
					@if($solicitud->status == 'Incompleta' || $solicitud->status == 'Completa' || $solicitud->status == 'Rechazada' || $solicitud->pago->status == 'Pagada')
					 disabled
					@endif
					 class="mt-3 boton-cotiza btn btn-warning">Pagar</button>
					</form>
				</a>

			</div>

			@endif

		</div>

	</div>
</section>

@endsection

@section('scripts')
<script>
   var numberMask = IMask(
  document.getElementById('cuil'),
  {
	mask: Number,
	min: 00000000000,
	max: 99999999999,
  });

</script>

<script>
   var numberMask = IMask(
  document.getElementById('dni'),
  {
	mask: Number,
	min: 00000000,
	max: 99999999,
  });

</script>

<script>
   var numberMask = IMask(
  document.getElementById('dni_prop'),
  {
	mask: Number,
	min: 00000000,
	max: 99999999,
  });

</script>
<script>
   var numberMask = IMask(
  document.getElementById('cuil_prop'),
  {
	mask: Number,
	min: 00000000000,
	max: 99999999999,
  });

</script>

<script>
   var numberMask = IMask(
  document.getElementById('sueldo_uno'),
  {
	mask: Number,
	min: 00000000000,
	max: 99999999999,
  });

</script>

<script>
   var numberMask = IMask(
  document.getElementById('sueldo_dos'),
  {
	mask: Number,
	min: 00000000000,
	max: 99999999999,
  });

</script>

<script>
   var numberMask = IMask(
  document.getElementById('sueldo_tres'),
  {
	mask: Number,
	min: 00000000000,
	max: 99999999999,
  });

</script>


 <script>
window.livewire.on('single_file_choosed_contrato', function() {
            try {

                let file = event.target.files[0];
                if(file){
                    let reader = new FileReader();

                    reader.onloadend = () => {
                    	console.log(reader.result);
                        window.livewire.emit('upload_contrato', reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            } catch (error) {
                console.log(error);
            }

        });

 </script>

  <script>
window.livewire.on('single_file_choosed_aval', function() {
            try {

                let file = event.target.files[0];
                if(file){
                    let reader = new FileReader();

                    reader.onloadend = () => {
                    	console.log(reader.result);
                        window.livewire.emit('upload_aval', reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            } catch (error) {
                console.log(error);
            }

        });

 </script>


  <script>
window.livewire.on('single_file_choosed_sueldo', function() {
            try {

                let file = event.target.files[0];
                if(file){
                    let reader = new FileReader();

                    reader.onloadend = () => {
                    	console.log(reader.result);
                        window.livewire.emit('upload_sueldo', reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            } catch (error) {
                console.log(error);
            }

        });

 </script>


   <script>
	window.livewire.on('single_file_choosed_dni', function() {
	            try {

	                let file = event.target.files[0];
	                if(file){
	                    let reader = new FileReader();

	                    reader.onloadend = () => {
	                    	console.log(reader.result);
	                        window.livewire.emit('upload_dni', reader.result);
	                    }
	                    reader.readAsDataURL(file);
	                }
	            } catch (error) {
	                console.log(error);
	            }

	        });

 </script>


  <script>
	window.livewire.on('single_file_choosed_constancia', function() {
	            try {

	                let file = event.target.files[0];
	                if(file){
	                    let reader = new FileReader();

	                    reader.onloadend = () => {
	                    	console.log(reader.result);
	                        window.livewire.emit('upload_constancia', reader.result);
	                    }
	                    reader.readAsDataURL(file);
	                }
	            } catch (error) {
	                console.log(error);
	            }

	        });

 </script>

  <script>
	window.livewire.on('single_file_choosed_balance', function() {
	            try {

	                let file = event.target.files[0];
	                if(file){
	                    let reader = new FileReader();

	                    reader.onloadend = () => {
	                    	console.log(reader.result);
	                        window.livewire.emit('upload_balance', reader.result);
	                    }
	                    reader.readAsDataURL(file);
	                }
	            } catch (error) {
	                console.log(error);
	            }

	        });

 </script>


@endsection