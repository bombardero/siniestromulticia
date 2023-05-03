@extends('layouts.app')
@section('content')
<section style="background-color:#F8F8F8;">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5 text-center">
                <p class="pt-5 proteccion-adecuada">
                Impulsá tu carrera y ofrecé a tus clientes
                <br>
				coberturas confiables.

                </p>
              	<div class="col-12 pt-2" >
                	<img class="img-fluid" src="{{url('/images/trabaja-con-nosotros/trabaja-con-nosotros.svg')}}">
                </div>
            </div>
        </div>
        <div class="row text-center mt-5">
        	<div class="col-4">
        		<img class="img-fluid" src="{{url('/images/trabaja-con-nosotros/finanzas 1.png')}}">
        		<p class="pt-2 label-imagenes-produci-con-nosotros">Tentadoras condiciones <br> comerciales</p>
        	</div>

        	<div class="col-4">
        		<img class="img-fluid" src="{{url('/images/trabaja-con-nosotros/finanzas 2.png')}}">
        		<p class="pt-2 label-imagenes-produci-con-nosotros">Ejecutivo comercial <br> para P.A.S</p>
        	</div>

        	<div class="col-4">
        		<img class="img-fluid" src="{{url('/images/trabaja-con-nosotros/touch 1.png')}}">
        		<p class="pt-2 label-imagenes-produci-con-nosotros">Herramientas <br> tecnológicas exclusivas</p>
        	</div>

            <div class="col-6 pt-4">
                <img class="img-fluid" src="{{url('/images/trabaja-con-nosotros/finisterre-seguros_trabaja-con-nosotros_app-movil_icon.png')}}">
                <p class="pt-2 label-imagenes-produci-con-nosotros">App móvil <br> para tus clientes</p>
            </div>

            <div class="col-6 pt-4">
                 <img class="img-fluid" src="{{url('/images/trabaja-con-nosotros/finisterre-seguros_trabaja-con-nosotros_oficina-virtual_icon.png')}}">
                 <p class="pt-2 label-imagenes-produci-con-nosotros">Oficina virtual <br> de gestión para P.A.S</p>
            </div>

        	<div class="col-12 pt-4 ">
	            <p class="si-quieres-ser-productor-text text-center">
	            	Sumate a la experiencia Finisterre Seguros
				</p>
			</div>

			<div class="col-12 mt-4 mb-5">
				<a id="hablemos" class="" href="{{route('productores.index')}}">
		        	<button type="button" class="boton-chatear-asesor btn btn-success">
		                Gestionar alta de Productor
		            </button>
	            </a>
            </div>
            @include('partial.float-boton-whatsapp')
        </div>
    </div>
</section>



@endsection
