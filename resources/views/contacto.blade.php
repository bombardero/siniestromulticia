@extends('layouts.app')
@section('content')
<section style="background-color:#F8F8F8;">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5 text-center">
                
                <p class="pt-5 titulo-garantia ">
                Contacto
                </p>
                <p class="pt-3 texto-general ">Asegurate de visitar nuestra sección de <a class="preguntas-frecuentes-href" style="color:#E95E2A; "href="/preguntas-frecuentes">preguntas frecuentes</a>
                <br>
				y si te quedan dudas, llamanos.
				</p>
				<p class="pt-4 texto-general ">Las 24 hs</p>
              	<p class="pt-3 atencion-asegurado">Atención al Asegurado</p>
                <p class="mesa-ayuda pt-2">Mesa de Ayuda</p>
                <p class="telefono-contacto">Tel: 0810 362 0700 </p>
                @if($time < $start && $time > $end)
                <div class="pb-4 pt-md-5 pb-md-5 col-12">
                    <div class="card card-formulario mx-auto">
                        <div class="card-body">
                            <h4 class="card-title text-center chat-no-disponible">Chat no disponible momentaneamente</h4>
                            <h4 class="card-subtitle mb-2 text-center dejanos-telefono">Dejanos tu nro de teléfono y nos pondremos en contacto a la brevedad</h4>
                            <form id="form-cotizacion" method="POST" action={{route('contacto.mail')}}>
                            @csrf
                                <input class="form-estilo w-100 " type="text"  id="telefono" name="telefono" class="form-control " placeholder=" Nro Telefónico">
                                <div class="pt-3 col-12 text-center">
                                  <button id="btn-cotizacion" type="submit" class="mt-3 boton-cotiza btn btn-warning">Enviar</button>
                                </div>
                               
                        </div>
                    </div>
             
                </div>       
                @endif         
				<div class="mb-5" style="height:500px;" id="map"></div>
            </div>

        </div>

    </div>
</section>



@endsection