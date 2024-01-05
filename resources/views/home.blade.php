@extends('layouts.app')

@section('content')
    <section id="inicio" class=" img-fluid bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 order-md-2 pt-md-5 my-auto">
                    <h1 class="pt-3 text-center es-muy-facil">¡Es muy <strong class="facil">fácil!</strong></h1>
                    <p class="encontra-el-seguro pt-5 d-none d-md-block">
                        Encontrá aquí
                        el seguro
                        que necesitás
                        <span class="mejor-precio"> al mejor precio. </span>

                    </p>

                </div>
                <div class="col-6 order-md-1 d-flex align-items-end">
                    <img class="img-fluid pt-5" src="{{url('/images/graphic1 home.svg')}}">
                </div>
                <div class="col-6 col-md order-md-3 d-md-none my-auto">
                    <p class="encontra-el-seguro pr-1 ">
                        Encontrá aquí
                        el seguro
                        que necesitás
                        <span class="mejor-precio"> al mejor precio. </span>

                    </p>
                </div>


            </div>
        </div>
    </section>
    <section id="seguros" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center ">
                    <h2 class="conoce-nuestros-productos ">
                        Conocé nuestros productos y coberturas
                    </h2>
                    <p class="finisterre-pensamos pt-5">
                        En Finisterre pensamos en lo que más te importa proteger
                        y te ofrecemos productos de seguros para necesidades específicas.
                    </p>

                    <h1 class="porque-elegirnos d-none d-md-block pt-2 pb-5">
                        Por qué elegirnos
                    </h1>
                </div>
                <div class="col-12 col-md-3  text-center pt-4 pt-md-0">
                    <img src="{{url('/images/sin letra chica 1.svg')}}" class="pb-4">
                    <h3 class="encabezado-texto-imagenes">Sin letra chica</h3>
                    <p class="subencabezado-texto-imagenes">
                        Tu seguro tiene que ser fácil de entender.
                        Si algo no es claro, preguntanos.
                    </p>
                </div>
                <div class="col-12 col-md-3   text-center pt-4 pt-md-0">
                    <img src="{{url('/images/estamos  siempre.svg')}}" class="pb-4">
                    <h3 class="encabezado-texto-imagenes">Estamos siempre</h3>
                    <p class="subencabezado-texto-imagenes pr-5 pl-5 pr-md-0 pl-md-0">Encontranos por medio
                        de nuestra app, por teléfono, chat, mail y redes sociales.
                    </p>
                </div>
                <div class="col-12 col-md-3   text-center pt-4 pt-md-0">
                    <img src="{{url('/images/celular 1.svg')}}" class="pb-4">
                    <h3 class="encabezado-texto-imagenes">Todo en tu celular</h3>
                    <p class="subencabezado-texto-imagenes">Gestioná todo desde tu teléfono.</p>
                </div>
                <div class="col-12 col-md-3  text-center pt-4 pt-md-0">
                    <img src="{{url('/images/planes 1.svg')}}" class="pb-4" style="height:93px">
                    <h3 class="encabezado-texto-imagenes">Planes insuperables</h3>
                    <p class="subencabezado-texto-imagenes">Coberturas y servicios
                        únicos a precios imperdibles.
                    </p>
                </div>


            </div>

        </div>
    </section>

    <section id="seguro-auto">
        <div class="productos-coberturas">
            <p class="text-center productos-coberturas-title">Productos y coberturas</p>

        </div>
    </section>


    <section>
        <div class="seguro-auto">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1 class="seguro-para-motos pt-5 text-center text-md-left">
                            Seguro del automotor
                        </h1>
                        <p class="pt-3 pt-md-1 pb-1 pb-md-5 font-weight-bold seguro-auto-title text-center text-md-left">
                            Automóviles particulares, taxis, pickups, trailers y batans
                        </p>
                    </div>
                    <div class="col-12 col-md-6 text-center  pb-3 pb-md-0 pt-md-5 text-md-right">
                        <a href="tel:08103620700"><img src="{{url('/images/llamargrua.svg')}}" class=" img-fluid"></a>
                    </div>

                </div>
                <div class="row mx-auto">
                    <div class="col-12">
                        @if($condicionesUsoGrua)
                            @include('partial.cards.card-uno-automotor', ['condicionesUsoGrua' => $condicionesUsoGrua])
                        @endif
                    </div>
                    <div class="mt-4 col-12">
                        @include('partial.cards.card-seis-automotor')
                    </div>
                    <!-- <div class="mt-4 col-12">
                        @include('partial.cards.card-automotor-ao-sepelio')
                    </div> -->
                    <div class="mt-4 col-12">
                        @include('partial.cards.card-automotor-ao-sepelio-plus')
                    </div>
                    <div class="mt-4 col-12">
                        @include('partial.cards.card-dos-automotor')
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="mt-4 col-12">
                        @include('partial.cards.card-tres-automotor')
                    </div>

                    <div class="mt-4  col-12">
                        @include('partial.cards.card-cuatro-automotor')
                    </div>

                    <div class="mt-4  col-12">
                        @include('partial.cards.card-cinco-automotor')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if($anexoPoliza)
                            <p class="pt-5 text-center text-uppercase anexos-automotor"><a class="anexos-automotor"
                                                                                           target="_blank" href="{{$anexoPoliza->url}}
                        ">ver anexos pólizas del automotor (Actualizado
                                    el {{\Carbon\Carbon::parse($anexoPoliza->updated_at)->format('d/m/Y')}})</a></p>
                        @endif
                        @if($manualSuscripcionAuto)
                            <p class="pt-1 text-center text-uppercase anexos-automotor"><a class="anexos-automotor"
                                                                                           target="_blank" href="{{$manualSuscripcionAuto->url}}
                        ">VER MANUAL DE SUSCRIPCIÓN (Actualizado
                                    el {{\Carbon\Carbon::parse($manualSuscripcionAuto->updated_at)->format('d/m/Y')}}
                                    ). Los cambios entran en vigencia a partir del 01/01/2024</a></p>
                        @endif
                    </div>
                </div>

                <div class="pt-5 row ">
                    <div class="col-12 text-center">
                        <p class="formas-pago-text-home">Todas las formas de pago</p>
                        <img src="{{url('/images/medios-pago 1.svg')}}" class=" img-fluid">
                    </div>
                </div>

                <div class="pt-5 row">
                    <div class="container">
                        <div class="card card-contact-automotor mx-auto w-100">
                            <div class="card-body">
                                @livewire('form-automotor-contacto')
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pt-5 row ">
                    <div class="col-12 text-center">
                        <img src="{{url('/images/automotor/Finisterre.com_seguro-automotores_image.svg')}}"
                             class=" img-fluid">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="seguro-moto" class="img-fluid ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9 order-md-1">
                    <h1 class="pt-5 text-center text-md-left seguro-para-motos">
                        Seguros para motos
                    </h1>
                    <p class="pt-3 text-md-left text-center circula-tranquilo-text ">Circulá tranquilo con tu póliza en
                        formato digital en tu celular</p>
                    <p class="text-center text-md-left pt-4 seguro-terceros">
                        SEGURO DE RESPONSABILIDAD CIVIL LIMITADA
                    </p>
                    <p class="text-md-left subencabezado-texto-imagenes"><b>• COBERTURA “A” </b>RESPONSABILIDAD CIVIL
                        por lesiones y/o muerte de terceros transportados y no transportados, y por daños materiales a
                        cosas de terceros no transportados, hasta la suma máxima de $80.000.000 (incluye seguro de
                        Responsabilidad Civil Obligatorio)</p>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 d-sm-none d-md-block"></div>
                            <div class="col-md-6 col-sm-12">

                                <div class="mb-5 card-seguro-moto">
                                    <div class="card-body text-center">
                                        <img
                                            src="{{url('/images/automotor/Finisterre.com_seguro-motos_servicio-de-grua.svg')}}"
                                            class="text-center img-fluid">
                                        <br>
                                        <span class="card-seguro-moto-title">Servicio de grúa</span>
                                        <br>
                                        <span class="card-seguro-moto-subtitle">Hasta 100 Km. opcional con tu seguro de motos </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-sm-none d-md-block"></div>
                        </div>
                    </div>
                    <p class="text-md-left subencabezado-texto-imagenes"><b>• COBERTURA AO RESPONSABILIDAD CIVIL LIMITADA </b>
                    Protege al titular o conductor autorizado por los daños que pudiera producir el vehículo a personas 
                    transportadas y no transportadas.
                    </p>
                    <ul style="list-style: none">
                        <li class="text-md-left subencabezado-texto-imagenes">• Responsabilidad Civil</li>
                        <li class="text-md-left subencabezado-texto-imagenes">• Lesiones a personas transportadas y no transportadas</li>
                        <li class="text-md-left subencabezado-texto-imagenes">• Límite de Responsabilidad Civil $8.000.000</li>
                    </ul>
                    <div class="card-body text-center">
                        <img
                        src="{{url('/images/automotor/finisterre_no_grua_gris.svg')}}"
                        class="img-fluid">
                    </div>
                </div>
                <div class="col-12 col-md-3 pt-2 pt-md-5  text-center text-md-right order-md-2">
                    <a href="tel:08103620700"><img src="{{url('/images/llamargrua.svg')}}" class="text-right img-fluid"></a>
                </div>
                <div class="col-12 col-md-6 text-center order-md-3 ">

                    {{--
                    <img src="{{url('/images/celu-segumotos-nueva.png')}}"
                         class="text-center img-fluid d-block d-md-none w-100">
                    <p class="pt-5 text-md-left">
                        <span class="por-mes-text">desde</span> <span class="precio-por-mes"> $320*</span> <span
                            class="por-mes-text">x mes</span>
                    </p>

                    <p class="texto-zona text-md-left">
                        <b>ZONA 1: $600 x mes.</b> C.A.B.A - A.M.B.A.
                        <br>
                        <b>ZONA 2: $370 x mes.</b> Córdoba y Gran Córdoba
                        <br>
                        <b>ZONA 3: $325 x mes.</b> Resto de Buenos Aires, resto de Córdoba, Catamarca, Chubut, Entre Ríos, La Pampa, La Rioja, Mendoza,Neuquén, Río Negro, San Juan, San Luis, Santa Cruz, Santa Fe, Tierra del Fuego.
                        <br>
                        <b>ZONA 7: $320 x mes.</b> Corrientes, Chaco, Formosa, Jujuy, Misiones, Salta, Santiago del Estero, Tucumán.
                    </p>
                    --}}
                    {{--           <a href="https://segumotos.com.ar/">
                                <button class="mt-5 mb-5 boton-personalizado-seccion-moto">Solicitar Mi Seguro de Moto</button>
                              </a> --}}
                    {{--                     <div class="text-md-left pt-5 text-center d-none d-md-block">
                                            <p class="desde-tu-celular">¡100% desde tu celular estés donde estés!</p>
                                            <div>
                                                <a href="https://apps.apple.com/ar/app/segumotos-seguros/id1541380154" target="_blank">
                                                    <img src="{{url('/images/apple store 1.svg')}}" class="mr-3 img-fluid">
                                                </a>
                                                <a href="https://play.google.com/store/apps/details?id=com.segumotos.segumotos&hl=es_AR" target="_blank">
                                                    <img src="{{url('/images/disponible-en-google-play-badge 1.svg')}}" class="img-fluid">
                                                </a>
                                             </div>

                                            <a target="_blank" href="https://api.whatsapp.com/send?phone={{env('WHATSAPP_NUMBER')}}&text=&source=&data=&app_absent=">
                                                <img src="{{url('/images/whatsappeanos.svg')}}" class="mt-4 ml-5 img-fluid">
                                            </a>
                                        </div>     --}}
                    {{--
                    <div class="mb-5 card-seguro-moto">
                        <div class="card-body text-center">
                            <img src="{{url('/images/automotor/Finisterre.com_seguro-motos_servicio-de-grua.svg')}}"
                                 class="text-center img-fluid">
                            <br>
                            <span class="card-seguro-moto-title">Servicio de grúa</span>
                            <br>
                            <span class="card-seguro-moto-subtitle">opcional con tu seguro de motos </span>
                        </div>
                    </div>
                    --}}
                    <div class="col-12">
                        @if($manualSuscripcionMoto)
                            <br>
                            <p class="pt-1 text-center text-uppercase anexos-automotor"><a  class="anexos-automotor" target="_blank" href="{{$manualSuscripcionMoto->url}}">
                                VER MANUAL DE SUSCRIPCIóN (Actualizado el {{\Carbon\Carbon::parse($manualSuscripcionMoto->updated_at)->format('d/m/Y')}}). Los cambios entran en vigencia a partir del 01/01/2024</a>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 order-md-4 align-self-end">
                    <img src="{{url('/images/celu-segumotos-nueva.png')}}"
                         class="d-none d-md-block text-center img-fluid  w-100">
                </div>

            </div>
        </div>
    </section>


    <section id="caucion-alquileres" style="background-color: #EAF0FA;">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-md-1  col-md-10 offset-md-1 text-center order-md-1">
                    <h1 class="pt-5 pb-5 pb-md-0 caucion-alquileres">Seguro de caución de alquileres</h1>
                </div>
                <div class="col-12 text-center col-md-6 order-md-4 align-self-end ">
                    <img src="{{url('/images/Group 290.svg')}}" class="img-fluid d-none d-md-block">
                    <img src="{{url('/images/mobile/fondo-alquileres-home.svg')}}" class="img-fluid d-md-none">
                </div>
                <div class="col-12 text-center order-md-2">
                    <div class="d-flex justify-content-center">
                        <a id="hablemos" class="mr-md-5" href="{{route('garantias')}}#requisitos">
                            <button type="button" class="mt-5 mb-5 imagen-boton-chateamos btn btn-success">REQUISITOS
                                PARA CONTRATARLO
                            </button>
                        </a>
                    </div>
                </div>
                <div class="pb-4 pt-md-5 pb-md-5 col-12 col-md-6 order-md-3">
                    <div class="card card-formulario mx-auto">
                        <div class="card-body">
                            <span class="badge badge-purple ">AUTOGESTIÓN</span>
                            <h4 class="card-title text-center text-md-left cotiza-segundo">Cotizás y pre-aprobás en
                                segundos.</h4>
                            <h4 class="card-subtitle mb-2  text-center text-md-left cotiza-subtitulo">Mejor que una
                                garantía propietaria</h4>
                            <x-form-cotizacion :cotizacionRuta="$cotizacionRuta"
                                               :textFormCotizacion="$textFormCotizacion" :comunicateNosotros="''"/>
                        </div>
                    </div>
                    <p class="text-center pt-5">
                        <a class="como-funciona" href="{{route('garantias')}}">¿Cómo funciona?</a>
                    </p>
                </div>


            </div>
        </div>
    </section>

    <section id="caucion-empresas" class="" style="background-color: rgba(122, 162, 214, 0.5)">
        <div class="container">
            <div class="row ">
                <div class="col-12 col-md-6 text-center text-md-left">
                    <h1 class="pt-5 caucion-alquileres">Seguro de caución para empresas</h1>
                    <p class="pt-3 caucion-empresas-subtitulo">
                        Garantizamos el cumplimiento de los compromisos asumidos por tu empresa.
                    </p>
                    <div class="pt-md-5">
                        <a id="hablemos" class="" href="{{route('garantias')}}#garantias-obras-servicios">
                            <button type="button" class="imagen-boton-chateamos btn btn-success">Garantías de Obra y/o
                                Servicios
                            </button>
                        </a>
                        <a id="hablemos" class="" href="{{route('garantias')}}#garantias-aduaneras">
                            <button type="button" class="imagen-boton-chateamos btn btn-success">Garantías Aduaneras
                            </button>
                        </a>
                        <a id="hablemos" class="" href="{{route('garantias')}}#garantias-judiciales">
                            <button type="button" class="imagen-boton-chateamos btn btn-success">Garantías Judiciales
                            </button>
                        </a>
                        <a id="hablemos" class="" href="{{route('garantias')}}#garantias-actividades">
                            <button type="button" class="imagen-boton-chateamos btn btn-success">Garantías de Actividad
                                y/o Profesión
                            </button>
                        </a>

                    </div>

                </div>
                <div class="col-12 col-md-6 pt-md-5 pb-5 pb-md-0">
                    <div class="card card-formulario mx-auto">
                        <div class="card-body">
                            <h4 class="card-title text-center text-md-left cotiza-segundo">Datos de la Empresa</h4>

                            @livewire('form-empresas')

                        </div>
                    </div>
                </div>
                <div class="d-none d-md-block  col-12 text-center">
                    <img src="{{url('/images/image.png')}}" class="img-fluid ">
                </div>


            </div>
        </div>
    </section>

    <section id="sepelio" class=" img-fluid fondo-sepelio">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="pt-5 pb-4 sepelio-titulo">Seguro de Sepelio</h1>
                    <p class="sepelio-subtitulo">
                        Asistencia ante una situación inesperada <br>
                        Brindamos respuesta económica y administrativa ante el fallecimiento de un integrante del grupo
                        familiar primario por un capital determinado.
                    </p>
                    <p class="sepelio-subtitulo">
                        Es un beneficio adicional conveniente para empleados y/o familiares.
                    </p>
                    <table class="mx-auto table-sepelio table-striped-sepelio table-hover-sepelio">
                        <thead>
                        <tr>
                            <th class="thead-uno-purple">SUMA ASEGURADA</th>
                            <th class="thead-dos-purple">INDIVIDUAL</th>
                            <th class="thead-tres-purple">INCLUIDO GRUPO FAMILIAR</th>
                        </tr>
                        </thead>
                        <tbody class="tbody-purple">
                        <tr>
                            <td class="texto-columnas-tabla">$ 50.000</td>
                            <td class="texto-columnas-tabla">$ 690/mes</td>
                            <td class="texto-columnas-tabla">$ 1380/mes</td>
                        </tr>
                        <tr>
                            <td class="texto-columnas-tabla">$ 90.000</td>
                            <td class="texto-columnas-tabla">$ 690/mes</td>
                            <td class="texto-columnas-tabla">$ 1920/mes</td>
                        </tr>

                        </tbody>
                    </table>
                    <a id="boton-sepelio" class="" href="{{route('sepelio.index')}}">
                        <button type="button" class="mt-5 boton-solicitar-asesoramiento btn btn-secondary">Formulario de
                            Solicitud
                        </button>
                    </a>
                </div>


            </div>
        </div>
    </section>

    <section id="sepelio" class=" img-fluid fondo-unite-equipo">
        <div class="container">
            <div class="row">
                <div class="col-12 pt-md-5 pt-2 text-center">
                    <h1 class="pt-md-5 pt-2 pb-5 potencia-tu-carrera-titulo">¡Unite a nuestro equipo!</h1>
                    <p class="potencia-tu-carrera-subtitulo">
                        Si sos PAS, potenciá tu carrera
                        <br>
                        sumándote a nuestra red de productores asesores de Seguros Finisterre.
                    </p>
                    <div class="d-none d-md-block  col-12 text-center position-relative">
                        <img src="{{url('/images/finisterre-seguros_home_Unite-a-nuestro-equipo.png')}}"
                             class="img-fluid ">
                        <a id="hablemos" class="d-none d-md-block position-absolute"
                           href="{{route('productores.index')}}">
                            <button type="button" class="imagen-boton-chateamos btn btn-produci-con-nosotros">Producí
                                con nosotros
                            </button>
                        </a>
                    </div>
                    <a id="hablemosw" class="d-md-none" href="{{route('productores.index')}}">
                        <button type="button" class="imagen-boton-chateamos btn btn-produci-con-nosotros">Producí con
                            nosotros
                        </button>
                    </a>


                </div>


            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>
        var numberMask = IMask(
            document.getElementById('cuit'),
            {
                mask: Number,
                min: 00000000000,
                max: 99999999999,
            });

    </script>

    <script>
        var numberMask = IMask(
            document.getElementById('valor_alquiler'),
            {
                mask: Number,
                min: 00000000000,
                max: 99999999999,
            });

    </script>

@endsection
