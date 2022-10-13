<div class="btn-group" id="menu-authentication">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="dropdown-menu">
        @guest
            <a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a>
        @else
            <h6 class="dropdown-header"><i class="fa-solid fa-user"></i> {{ Auth::user()->name }}</h6>
            @if(Auth::user()->hasRole('cliente') || Auth::user()->hasRole('inmobiliaria'))
                <a class="dropdown-item" href="{{ route('panel',['user' => Auth::user()]) }}">
                    Panel
                </a>
            @elseif(Auth::user()->hasRole('callcenter'))
                <a class="dropdown-item" href="{{ route('panel-callcenter')}}">

                    Panel Call Center
                </a>
            @elseif(Auth::user()->hasRole('operario'))
                <a class="dropdown-item" href="{{ route('panel-operario')}}">Panel operario</a>
            @elseif(Auth::user()->hasRole('productor'))
                <a class="dropdown-item" href="{{ route('panel-productor')}}">Panel productor</a>
            @elseif(Auth::user()->hasRole('admin'))
                <a class="dropdown-item" href="{{ route('panel-admin')}}">Panel administrador</a>
            @elseif(Auth::user()->hasRole('siniestros'))
                <a class="dropdown-item" href="{{ route('panel-siniestros')}}">Panel Siniestros</a>
            @elseif(Auth::user()->hasRole('superadmin'))
                <a class="dropdown-item" href="{{ route('admin.index')}}">Panel Super Admin</a>
            @endif

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endguest

    </div>
</div>
