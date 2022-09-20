<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/mobiscroll.javascript.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"/>
    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/somos-nosotros.css') }}">
    <link rel="stylesheet" href="{{ asset('css/garantias.css') }}">
    <link rel="stylesheet" href="{{ asset('css/legales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preguntas-frecuentes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{asset('css/siniestro.css')}}" >
    <link rel="stylesheet" href="{{ asset('css/precio-estimativo-alquileres.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estado-poliza.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sepelio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobiscroll.javascript.min.css') }}">
    <link rel="icon" href="{{ asset('images/finisterre-favicon.ico') }}">
    <!--<script src="https://kit.fontawesome.com/89abc6e7c2.js" crossorigin="anonymous"></script>-->




    @livewireStyles
    <style>
        textarea {resize: none;}
        .first-row{margin-bottom: 50px;}
        .second-row{margin-left:0px;}
        @media only screen and (max-width: 768px) {
            .container-page{width: 100% !important;}
            .contenedor-custom{padding-left: 2px !important;padding-right: 2px !important;}
            .first-row{margin-bottom: 20px;}
            .second-row{margin-left:30px;}
            .margin-bottom-en-desktop{margin-bottom: 0px!important;}
            .margin-left-en-mobile{margin-left: 20px !important;}
            .padding-right-en-mobile{padding-right: 50px !important;}
        }
        .margin-bottom-en-desktop{margin-bottom: 20px;}
        .margin-left-en-mobile{margin-left: 0px;}
        .padding-right-en-mobile{padding-right: 0px;}

        .margin-bottom-en-ambos{margin-bottom: 30px;}

    </style>

    @if(env('APP_ENV') == 'test')
        <style>
            main {
                background-image: url('/images/sitio_de_prueba.png');
                background-repeat: repeat-x;
            }
        </style>
    @endif

</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img-fluid" src="/images/finisterre logo 5.svg" style="">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                          <a class="nav-link header-class" href="{{ route('somos-finisterre')}}">QUIENES SOMOS</a>
                        </li>
                        <li class="nav-item dropdown seguros">
                            <a id="navbarDropdown2 " class="header-class nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                SEGUROS
                            </a>

                            <div class="dropdown-menu categoria-seguros" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item header-estilo-dropdown" href="{{ route('home')}}#seguro-auto">
                                   Seguro de autos
                                </a>

                                <a class="dropdown-item header-estilo-dropdown" href="{{ route('home')}}#seguro-moto">
                                   Seguro de motos

                                </a>
                                <a class="dropdown-item header-estilo-dropdown" href="{{ route('home')}}#caucion-alquileres">
                                   Seguro alquileres
                                </a>

                                <a class="dropdown-item header-estilo-dropdown" href="{{ route('home') }}#caucion-empresas">
                                   Seguro de caución
                                </a>

                                <a class="dropdown-item header-estilo-dropdown" href="{{ route('home') }}#sepelio">
                                   Seguro de sepelio
                                </a>
                            </div>
                        </li>
                        <li class="nav-item ">
                          <a class="nav-link header-class" href="{{ route('cotiza-vehiculo')}}">COTIZADOR</a>
                        </li>
                           <li class="nav-item ">
                            <a class="nav-link header-class" href="{{ route('siniestro.index') }}">SINIESTROS</a>
                          </li>
                          <li class="nav-item ">
                            <a class="nav-link header-class" href="http://insuransys.finisterreseguros.com/" target="_blank">PRODUCTORES</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link header-class" href="{{ route('contacto') }}">CONTACTO</a>
                          </li>

                        <!-- Authentication Links -->
                        @include('partial.menu-authentication')
                    </ul>
                </div>
            </div>

        </nav>

        <main class="">
            @yield('content')
        </main>

    </div>
    @include('partial.footer-backoffice')
    @include('partial.loading')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap" async defer></script>
    <script src="https://unpkg.com/imask"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/konva@8.3.2/konva.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireScripts

    @yield('scripts')

</body>



<script>
    var map;
     function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.6029924, lng: -58.3730815},
          zoom: 20,
        });
        var marker = new google.maps.Marker({
          position: {lat: -34.6029924, lng: -58.3730815},
          map: map,
          title: 'Finisterre'
        });
      }
    </script>

<call-us
     style="position: fixed; right: 20px; bottom: 20px;
         font-family: Arial;
         z-index: 99999;
         --call-us-form-header-background:#373737;
         --call-us-main-button-background:#0596d4;
         --call-us-client-text-color:#d4d4d4;
         --call-us-agent-text-color:#eeeeee;
         --call-us-form-height:330px;"
     id="wp-live-chat-by-3CX"
     channel-url="https://finisterreseguros.3cx.lat:5001"
     files-url="https://finisterreseguros.3cx.lat:5001"
     minimized="false"
     animation-style="none"
     party="callcenter"
     minimized-style="BubbleRight"
     allow-call="true"
     allow-video="true"
     allow-soundnotifications="true"
     enable-onmobile="true"
     offline-enabled="true"
     enable="true"
     ignore-queueownership="false"
     authentication="both"
     operator-name="Support"
     show-operator-actual-name="true"
     channel="phone"
     aknowledge-received="true"
     gdpr-enabled="false"
     gdpr-message="Acepto el uso de cookies."
     message-userinfo-format="both"
     message-dateformat="both"
     start-chat-button-text="Chatear"
     window-title="Chat Finisterre Seguros"
     button-icon-type="Default"
     invite-message="IMPORTANTE: Por favor no cierre esta ventana hasta tanto no termine la conversación o concluya su trámite. Caso contrario la sesión se cierra y la comunicación finaliza. Bienvenido, en que podemos ayudarte?"
     authentication-message="Ingresa por favor tu nombre y tu email"
     unavailable-message="No estamos disponibles, escribe tu mensaje y te estaremos contactando"
     offline-finish-message="Mensaje recibido, te contactaremos"
     ending-message="Sesion terminada"
     greeting-visibility="none"
     greeting-offline-visibility="none"
     chat-delay="2000"
     offline-name-message="Hola me podes decir tu nombre"
     offline-email-message="Me podrias pasar tu email"
     offline-form-invalid-name="Nombre no valido intente de nuevo"
     offline-form-maximum-characters-reached="Cantidad caracteres maximo"
     offline-form-invalid-email="Tu email no es valido intenta de nuevo"
     >
</call-us>


<script defer src="https://cdn.3cx.com/livechat/v1/callus.js" id="tcx-callus-js"></script>

</html>
