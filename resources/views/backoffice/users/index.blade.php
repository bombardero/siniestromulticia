@extends('layouts.super-admin')
@section('content')
    <section class="container-fluid">
        <div class="row mt-3 mb-2">
            <div class="col col-md-8">
                <form action="{{ route('admin.users.index') }}" method="get" class="row" id="buscador">
                    <div class="col col-md-4">
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" name="rol"
                                        onchange="buscar()">
                                    <option value="todos">Todos</option>
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->name }}"
                                                {{ request()->rol && request()->rol == $rol->name ? 'selected' : ''}}
                                        >{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Rol</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col col-md-4">
                @if(auth()->user()->hasRole('superadmin'))
                    <a class="btn btn-primary float-end" href="{{ route('admin.users.create') }}" role="button">Nuevo Usuario</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->implode('name',', ') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-boundary="viewport">
                                            <i class="fa-solid fa-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('admin.users.permisos.show', $user) }}"
                                                   class="dropdown-item" title="Permisos">
                                                    <i class="fa-solid fa-shield-halved"></i><span>Permisos</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                   class="dropdown-item" title="Editar">
                                                    <i class="fa-solid fa-file-pen"></i><span>Editar</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.users.destroy',$user->id) }}"
                                                   class="dropdown-item btn-eliminar" title="Borrar"
                                                   onclick="event.preventDefault();document.getElementById('form-borrar').submit();"
                                                >
                                                    <i class="fa-solid fa-file-lines text-danger"></i><span>Borrar</span>
                                                </a>
                                                <form id="form-borrar" action="{{ route('admin.users.destroy',$user->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->withQueryString()->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function buscar()
    {
        document.getElementById("buscador").submit();
    }

    $('.btn-eliminar').click(function (event) {
        let result = confirm('¿Confirma desea eliminar la denuncia?');
        if (!result) {
            event.preventDefault();
            return false;
        }
        showLoading();
    })
</script>
@endsection
