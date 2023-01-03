<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/finisterre-favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"/>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <!-- Sidebar Style -->
    <style>
        body {
            min-height: 100vh;
        }
        body > div{
            height: 100vh;
            max-height: 100vh;
            overflow-y: hidden;
        }
        main{
            overflow-y: auto;
            width: 100%;
        }
        .sidebar, .sidebar-content {
            height: 100vh;
            max-height: 100vh;
        }
        .sidebar-content{
            min-width: 270px;
        }
        #btn-collapse-sidebar{
            border-radius: 0px;
            --bs-btn-padding-x: 0.25rem;
        }
        .dropdown-toggle { outline: 0; }

        .btn-toggle {
            padding: .25rem .5rem;
            font-weight: 600;
            color: rgba(0, 0, 0, .65);
            background-color: transparent;
        }
        .btn-toggle:hover,
        .btn-toggle:focus {
            color: rgba(0, 0, 0, .85);
            background-color: #d2f4ea;
        }
        .btn-toggle::before {
            width: 1.25em;
            line-height: 0;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transition: transform .35s ease;
            transform-origin: .5em 50%;
        }
        .btn-toggle[aria-expanded="true"] {
            color: rgba(0, 0, 0, .85);
        }
        .btn-toggle[aria-expanded="true"]::before {
            transform: rotate(90deg);
        }
        .btn-toggle-nav a {
            padding: .1875rem .5rem;
            margin-top: .125rem;
            margin-left: 1.25rem;
        }
        .btn-toggle-nav a:hover,
        .btn-toggle-nav a:focus {
            background-color: #d2f4ea;
        }
        .scrollarea {
            overflow-y: auto;
        }
    </style>

    {{--<link rel="stylesheet" href="{{ asset('plugins/bootstrap/5.2/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">--}}

</head>
<body>
 <div class="d-flex">
     <div class="sidebar d-flex">
         <div class="collapse collapse-horizontal show" id="collapseSideBar">
            <div class="sidebar-content d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
             <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                 <span class="fs-4">Finisterre Seguros</span>
             </a>
             <hr>
             <ul class="nav nav-pills flex-column mb-auto">
                 <li class="nav-item">
                     <a href="{{ route('admin.index') }}" class="nav-link text-white {{ Route::currentRouteName() === 'admin.index' ? 'active' : '' }}" aria-current="page">
                         Dashboard
                     </a>
                 </li>
                 @if(auth()->user()->hasRole('siniestros'))
                 <li>
                     <a href="{{ route('admin.siniestros.index') }}" class="nav-link text-white {{ str_contains(Route::currentRouteName(),'admin.siniestros.') ? 'active' : '' }}">
                        Siniestros
                     </a>
                 </li>
                 @endif
                 @if(auth()->user()->hasRole('superadmin'))
                 <li>
                     <a href="{{ route('admin.users.index') }}" class="nav-link text-white {{ str_contains(Route::currentRouteName(),'admin.users.') ? 'active' : '' }}">
                         Usuarios
                     </a>
                 </li>
                 @endif
             </ul>
             <hr>
             <div class="dropdown">
                 <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="fa-solid fa-user me-2"></i>
                     <strong>{{ auth()->user()->name }}</strong>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                     <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                 </ul>
             </div>
         </div>
         </div>
         <button id="btn-collapse-sidebar" class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSideBar" aria-expanded="false" aria-controls="collapseSideBar">
             <i class="fa-solid fa-less-than fa-2xs"></i>
         </button>
     </div>
     <main>
         @yield('content')
     </main>
 </div>
{{--
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-2 col-lg-2 me-0 px-3 fs-6"
       href="{{ env('APP_URL', 'Laravel') }}">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-welcome w-100 rounded-0">
        Bienvenido
    </div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            >Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        @include('partial.backoffice.navmenu')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container-fluid py-3 px-0">
                @yield('content')
            </div>
        </main>
    </div>
    @include('partial.loading')
</div>
--}}

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

 <script>
     const collapseSideBar = document.getElementById('collapseSideBar')
     collapseSideBar.addEventListener('hidden.bs.collapse', event => {
         document.getElementById('btn-collapse-sidebar').innerHTML = '<i class="fa-solid fa-greater-than fa-2xs"></i>'
     })
     collapseSideBar.addEventListener('shown.bs.collapse', event => {
         document.getElementById('btn-collapse-sidebar').innerHTML = '</i><i class="fa-solid fa-less-than fa-2xs"></i>'
     })
 </script>

@yield('scripts')

</body>
</html>
