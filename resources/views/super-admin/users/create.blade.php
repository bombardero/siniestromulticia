@extends('layouts.super-admin')
@section('content')
    <h3>Crear nuevo usuario</h3>
    <div class="row mt-3">
        <div class="col-md-6">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                    >
                    @error('name') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="username"
                           value="{{ old('email') }}"
                    >
                    @error('email') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">
                    @error('password') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono') }}"
                    >
                    @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="cuit" class="form-label">CUIT</label>
                    <input type="text" id="cuit" name="cuit" class="form-control @error('cuit') is-invalid @enderror"
                           value="{{ old('cuit') }}"
                    >
                    @error('cuit') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="codigo_postal" class="form-label">Código Postal</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror"
                           value="{{ old('codigo_postal') }}"
                    >
                    @error('codigo_postal') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="provincia" class="form-label">Provincia</label>
                    <select class="form-select @error('province_id') is-invalid @enderror" name="province_id" id="provincia">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ old('province_id') && old('province_id') == $provincia->id ? 'selected' : '' }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>
                    @error('province_id') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="localidad" class="form-label">Localidad</label>
                    <select class="form-select @error('city_id') is-invalid @enderror" name="city_id" id="localidad">
                        @foreach($localidades as $localidad)
                            <option value="{{ $localidad->id }}"
                                {{ old('city_id') && old('city_id') == $localidad->id ? 'selected' : '' }}
                            >{{ $localidad->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select class="form-select @error('role') is-invalid @enderror" name="role" id="role">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ old('role') && old('role') == $role->name ? 'selected' : '' }}
                            >{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $("#provincia").change(function () {
                province_id = $("#provincia").val();
                $.ajax(
                    {
                        url: '/api/provincias/' + province_id + '/localidades',
                        type: 'get',
                        dataType: 'json',
                        success: function (cities) {
                            $('#localidad').empty();
                            cities.forEach(city => {
                                $('#localidad').append($('<option>', {
                                    value: city['id'],
                                    text: city['name']
                                }));
                            })

                        }
                    })
            });
        });
    </script>
@endsection
