<div class="sidebar d-flex">
    <div class="collapse collapse-horizontal {{ array_key_exists('sidebar-hide',$_COOKIE) ? '' : 'show' }}" id="collapseSideBar">
        <div class="sidebar-content d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Sistema Unico de Siniestro</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link sb-links-heading text-white {{ Route::currentRouteName() === 'admin.index' ? 'active' : '' }}" aria-current="page">
                        <strong><i class="fas fa-th"></i>Dashboard</strong>
                    </a>
                </li>
                @if(auth()->user()->hasRole('siniestros'))
                    <li>
                        <strong class="sb-links-heading d-flex w-100 align-items-center">
                            <i class="fa-solid fa-car-burst"></i>
                            Siniestros
                        </strong>
                        <ul class="list-unstyled fw-normal pb-1 small">
                            <li>
                                <a href="{{ route('admin.siniestros.index') }}"
                                   class="sb-links-link btn btn-dark btn-sm d-inline-block rounded {{ Route::currentRouteName() === 'admin.siniestros.index' || Route::currentRouteName() === 'admin.siniestros.denuncias.show' ? 'active' : ''}}"
                                >Denuncias</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.siniestros.reclamos.index') }}"
                                   class="sb-links-link btn btn-dark btn-sm d-inline-block rounded {{str_contains(Route::currentRouteName(),'admin.siniestros.reclamos.') ? 'active' : ''}}"
                                >Reclamos</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('productor'))
                    <li>
                        <a href="{{ route('admin.productores.siniestros.denuncias.index') }}" class="nav-link text-white {{ str_contains(Route::currentRouteName(),'admin.productores.siniestros.denuncias') ? 'active' : '' }}">
                            Siniestros
                        </a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('superadmin'))
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="nav-link sb-links-heading text-white {{ str_contains(Route::currentRouteName(),'admin.users.') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i> Usuarios
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
        @if(array_key_exists('sidebar-hide',$_COOKIE))
            <i class="fa-solid fa-greater-than fa-2xs"></i>
        @else
            <i class="fa-solid fa-less-than fa-2xs"></i>
        @endif

    </button>
</div>
