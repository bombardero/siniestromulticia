@extends('layouts.super-admin')
@section('content')
    <h2>
        Usuarios
        <a class="btn btn-primary float-end" href="{{ route('admin.users.create') }}" role="button">Nuevo Usuario</a>
    </h2>
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
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-boundary="viewport">
                                    <i class="fa-solid fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                           class="dropdown-item" title="Editar">
                                            <i class="fa-solid fa-file-pen"></i><span>Editar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.users.destroy',$user->id)}}"
                                           class="dropdown-item disabled" title="Ver">
                                            <i class="fa-solid fa-file-lines"></i><span>Borrar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links('vendor.pagination.bootstrap-4') }}
@endsection
