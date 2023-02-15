@extends('layouts.super-admin')
@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-6 my-3">
                <h3>Permisos de Usuario</h3>

                <form action="{{ route('admin.users.permisos.store', $user) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ $user->name }}" readonly
                        >
                        @error('name') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror" autocomplete="username"
                               readonly
                               value="{{ $user->email }}"
                        >
                        @error('email') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    </div>
                    @if($user->hasRole('siniestros'))
                        <div class="mb-3">
                            <label class="form-label">Siniestros</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="borrar_denuncias" value="1" id="borrar-denuncias" {{ $user->hasPermissionTo('borrar denuncias') ? 'checked' : '' }}>
                                <label class="form-check-label" for="borrar-denuncias">
                                    Borrar Denuncia
                                </label>
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script type="text/javascript">
    </script>
@endsection
