<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bootstrap/4.6.2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <link rel="icon" href="{{ asset('images/finisterre-favicon.ico') }}">

    @if(env('APP_ENV') == 'test')
        <style>
            main {
                background-image: url('/images/sitio_de_prueba.png');
                background-repeat: repeat-x;
            }
        </style>
    @endif

</head>
<body class="bg-gray-light d-flex flex-column min-vh-100">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <!--<img class="img-fluid" src="/images/finisterre logo 5.svg" style="">-->
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                        <a id="navbarDropdown2 " class="header-class nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            SEGUROS
                        </a>

                        <div class="dropdown-menu categoria-seguros" aria-labelledby="navbarDropdown2">
                            <a class="dropdown-item header-estilo-dropdown" href="{{ route('home')}}#seguro-auto">
                                Seguro de autos
                            </a>

                            <a class="dropdown-item header-estilo-dropdown" href="{{ route('home')}}#seguro-moto">
                                Seguro de motos

                            </a>
                            <a class="dropdown-item header-estilo-dropdown"
                               href="{{ route('home')}}#caucion-alquileres">
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
                        <a class="nav-link header-class" href="http://insuransys.finisterreseguros.com/"
                           target="_blank">PRODUCTORES</a>
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
@include('partial.backoffice.footer')
@include('partial.loading')


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>-->
<script type="text/javascript" src="{{ asset('bootstrap/4.6.2/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://unpkg.com/imask"></script>

@yield('scripts')

</body>
</html>
