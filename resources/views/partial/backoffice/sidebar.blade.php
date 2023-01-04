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
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <button id="btn-collapse-sidebar" class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSideBar" aria-expanded="false" aria-controls="collapseSideBar">
        <i class="fa-solid fa-less-than fa-2xs"></i>
    </button>
</div>
