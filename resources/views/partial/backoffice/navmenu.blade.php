<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'admin.index' ? 'active' : '' }}"
                   aria-current="page" href="{{ route('admin.index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            @if(auth()->user()->hasRole('siniestros'))
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(Route::currentRouteName(),'admin.siniestros.') ? 'active' : '' }}"
                       href="{{ route('admin.siniestros.index') }}">
                        <span data-feather="users" class="align-text-bottom"></span>
                        Siniestros
                    </a>
                </li>
            @endif
            @if(auth()->user()->hasRole('superadmin'))
            <li class="nav-item">
                <a class="nav-link {{ str_contains(Route::currentRouteName(),'admin.users.') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Usuarios
                </a>
            </li>
            @endif
        </ul>


    </div>
</nav>
