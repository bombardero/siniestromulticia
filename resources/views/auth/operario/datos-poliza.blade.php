@extends('layouts.app')

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<p class="panel-operaciones-title pt-5">Poliza N° {{$solicitud->id}}</p>
				

				<div class="card card-datos-poliza w-75 mx-auto mb-4">
					<div class="card-body">
						<p class="panel-operaciones-title">
						
							<p class="panel-operaciones-subtitle "> Tipo de Alquiler: 
								<span class="text-capitalize ">{{$solicitud->cotizacion->tipo_alquiler}}</span>
							</p>
							@include('partial.modal-editar-monto',['monto' => $solicitud->pago->monto])
						</p>
					</div>
				</div>
					<x-datos-poliza-card :solicitud="$solicitud" title="Propietario." :nombre="$solicitud->propietario->nombre" 
					:dni="$solicitud->propietario->dni" :email="$solicitud->propietario->email" :domicilio="$solicitud->propietario->domicilio"
					:telefono="$solicitud->propietario->telefono" :provincia="$solicitud->propietario->province->name" :localidad="$solicitud->propietario->city->name" :archivos='null'                                                        

					/>


					<x-datos-poliza-card :solicitud="$solicitud" title="Inquilino." :nombre="$solicitud->inquilino->nombre" 
					:dni="$solicitud->inquilino->dni" :email="$solicitud->inquilino->email" :domicilio="$solicitud->inquilino->domicilio"
					:telefono="$solicitud->inquilino->telefono" :provincia="$solicitud->inquilino->province->name" :localidad="$solicitud->inquilino->city->name" :archivos="$solicitud->inquilino->documentos" :cod_postal="null"

					/>

					<x-datos-poliza-card :solicitud="$solicitud" title="Contrato." :nombre="null" 
					:dni="null" :email="null" :domicilio="null"
					:telefono="null" :provincia="null" :localidad="null" :archivos="$solicitud->documentos->where('type',0)"
					

					/>

					<x-datos-poliza-card :solicitud="$solicitud" title="Inmobiliaria." :nombre="$solicitud->inmobiliaria->name" 
					:dni="$solicitud->inmobiliaria->cuit" :email="$solicitud->inmobiliaria->email" :domicilio="$solicitud->inmobiliaria->direccion"
					:telefono="$solicitud->inmobiliaria->telefono" :provincia="$solicitud->inmobiliaria->province->name" :localidad="$solicitud->inmobiliaria->city->name" :archivos="null"


					/>

					<x-datos-poliza-card :solicitud="$solicitud" title="Avales." :nombre="null" 
					:dni="null" :email="null" :domicilio="null"
					:telefono="null" :provincia="null" :localidad="null" :archivos="$solicitud->documentos->where('type',1)"
					

					/>

					 @livewire('boton-azul',['name' => 'Volver', 'url' => '/panel-operario'])
			</div>
			
		</div>

	</div>
</section>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
    @if(Session::has('errors'))
    $('.editar-monto').modal('show');
    @else
    $('.editar-monto').modal('hide');
    @endif
});
</script>

@endsection