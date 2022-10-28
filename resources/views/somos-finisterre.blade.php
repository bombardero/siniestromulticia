@extends('layouts.app')

@section('content')
<section id="inicio" class=" img-fluid somos-nosotros-bg" >
    <div class="container" >
        <div class="row">
            <div class="text-center col-md-6 pt-3 order-2 order-md-1">

                <div>

                    <img class="img-fluid d-none d-md-inline" src="{{url('/images/somos-finisterre/quienes omos.svg')}}">
                 </div>

                 <img class="img-fluid d-md-none" src="{{url('/images/mobile/grafica_somos finisterre.png')}}">
            </div>
            <div class="col-md-6 mt-5 order-1 ">
                  <h2 class="bienvenidos-nueva-era text-center text-md-left ">Bienvenidos a la nueva era.</h2>
                    <h1 class="mas-digital text-center text-md-left">
                        Más digital.
                        <br>
                        Más conveniente.
                    </h1>

            </div>

         </div>
    </div>
</section>

<section id="somos-finisterre">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="somos-finisterre">Somos Finisterre</h1>
                <p class="compañia-experta pt-4">Una compañía de Seguros experta en el desarrollo y comercialización de seguros apoyados en las nuevas tecnologías.
                    <br>
                    Nuestro modelo de gestión desarrolla coberturas de seguros que se adaptan a los nuevos estilos de vida desde el año 2013.
                    <br>
                    Contamos con profesionales capacitados y comprometidos para asistir las reales necesidades de nuestros asegurados.
                </p>
                <h2 class="protegemos pt-5">Protegemos lo que más importa:
                    <strong>tu hogar, tu familia y tu Trabajo.</strong>
                    <br>
                    Creemos que todos merecen la tranquilidad
                    de saber que su mayor inversión está asegurada.
                    <br>
                    <strong>Te tenemos cubierto. </strong>
                </h2>

            </div>
        </div>
            <div class="row pt-5 ">
                <div class="col-12 col-md-4  text-center">
                    <img class="img-fluid pt-5 pt-md-3" src="{{url('/images/somos-finisterre/medio ambiente.svg')}}">
                    <p class="pt-5 pt-md-5 titulo-iconos">MEDIO AMBIENTE</p>
	                <p class=" subtitulo-iconos">
                        Nuestra compañía está comprometida con el
                        desarrollo de una política medioambiental.
                        <br>
                        Por eso optamos por
                        las emisiones tanto de
                        nuestras pólizas como también de las credenciales para circular en formato digital.

                        </p>
                </div>
                <div class="col-12 col-md-4  text-center">
                    <img class="imagen-compromiso img-fluid pt-5 pt-md-3" src="{{url('/images/somos-finisterre/compromiso 1.svg')}}" >
                    <p class="pt-5 pt-md-5 titulo-iconos">COMPROMISO</p>
	                <p class=" subtitulo-iconos">
                        Ofrecemos productos de seguros que generen
                        bienestar en las personas y competitividad a las empresas.
                        <br>
                        Respondemos con soluciones efectivas a quienes confían en nosotros con un sólido soporte y precios razonables.

                        </p>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <img class="img-fluid pt-5 pt-md-3" src="{{url('/images/somos-finisterre/internet.svg')}}">
                    <p class="pt-5 pt-md-5 titulo-iconos">INTERNET</p>
	                <p class=" subtitulo-iconos">
                        Una decidida apuesta por Internet nos permite mejorar cada día nuestros canales de comunicación, contratación y capacidad de respuesta.
                        <br>
                        La competitividad de nuestros precios y atención personalizada nos diferencian de otras aseguradoras del mercado.

                        </p>
                </div>
            </div>
            <div class="row pt-5 mb-5">
                <div class="offset-1 col-10 offset-1 text-center" style="border-radius: 20px; background-color: rgba(122, 162, 214, 0.5);">
                    <p class="pr-3 pl-3 pt-4 proteccion-adecuada">
                        Obtené la protección adecuada para seguir avanzando
                    </p>
                    <p class="pr-md-5 pl-md-5 pt-2 proteccion-adecuada-subtitulo">
                        Desde un seguro de moto hasta un servicio de reclamos superior, nuestra gente y
                nuestra tecnología te apoyarán en cada paso del camino.
                     </p>

                </div>
            </div>


    </div>


</section>


@endsection
