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
        *{
            font-family: 'Roboto', sans-serif;
        }
        h1,h2,h3,h4,h5{
            font-weight: bold;
        }
        .bg-azul{
            background: #184071;
        }
        .bg-azul-2{
            background: #2D55FB;
        }
        .bg-morado{
            background: rgba(71, 99, 228, 0.12);
        }
        .text-azul{
            color: #4763E4;
        }

    </style>

</head>
<body>
<div>
    <header class="mb-5">
        <div class="container-fluid text-center mt-3 position-absolute">
            <div class="row justify-content-center">
                <div class="col-3">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/finisterre_logo_blanco.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
        <img src="{{ asset('images/productor/header-form-productores.png') }}" class="img-fluid w-100" alt="">
        <h2 class="text-center bg-azul text-white py-3">Tenemos herramientas que marcan la diferencia</h2>
    </header>
    <main class="container px-5">
        <div class="row">
            <div class="col-12 col-md-6 my-3">
                <h4 class="text-azul">Sistema de Autogestión</h4>
                <ul>
                    <li>Emisión online.</li>
                    <li>Gestión de siniestros online. </li>
                    <li>Mesa de ayuda 24 hs.</li>
                    <li>Asistencia de Grúa 24 hs.</li>
                    <li>Gestión desde cualquier dispositivo.</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 my-3">
                <h4 class="text-azul">Medios de pago</h4>
                <ul>
                    <li>Todas las plataformas de pagos habilitados.</li>
                    <li>Débito automático con tarjeta de débito y crédito.</li>
                    <li>Débito en cuenta, Rapipago, Pago Fácil, Mercado Pago, PagoMisCuentas y efectivo por Pronto Pago.</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 my-3">
                <h4 class="text-azul">Beneficios</h4>
                <ul>
                    <li>Acompañamos a nuestros productores en la capacitación de temas vinculados al seguro.</li>
                    <li>Incentivos y premios por cumplimiento de objetivos.</li>
                    <li>Bonificaciones especiales por cancelaciones anticipadas.</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 my-3">
                <h4 class="text-azul">Material gráfico de apoyo</h4>
                <ul>
                    <li>Baner promocional para local o stand.</li>
                    <li>Contenido gráfico para tus redes sociales.</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 my-3">
                <h4 class="text-azul">Chatbot</h4>
                <ul>
                    <li>Soporte automatizado de Mesa de ayuda.</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 my-3">
                <h4 class="text-azul">Nuestros comeciales son PAS</h4>
                <ul>
                    <li>Contamos con un equipo para acompañar tu proceso de crecimiento.</li>
                </ul>
            </div>
        </div>
        <div class="card bg-morado border-0 py-3 px-4 mt-5 mb-5">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="card-title text-azul">Formá parte de nuestro equipo</h1>
                    <p>Somos una compañia jóven formada por un equipo con más de 40 años de experiencia.
                        <br><span class="fw-bold">Llegamos para acompañarte</span></p>
                </div>
                <form action="{{ route('productores.mail') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nombre_apellido" class="form-label">Nombre y Apellido *</label>
                            <input type="text" class="form-control @error('nombre_apellido') is-invalid @enderror" id="nombre_apellido" name="nombre_apellido">
                            @error('nombre_apellido') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="provincia" class="form-label">Provincia *</label>
                            <select class="form-select @error('provincia') is-invalid @enderror" id="provincia" name="provincia">
                                <option></option>
                                @foreach($provincias as $provincia)
                                    <option value="{{ $provincia->id }}"
                                        {{ old('provincia') && old('provincia') == $provincia->id ? 'selected' : '' }}
                                    >{{ $provincia->name }}</option>
                                @endforeach
                            </select>
                            @error('provincia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono">
                            @error('telefono') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="email" class="form-label">Correo electrónico *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                            @error('email') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-azul fst-italic float-end">* Campos obligatorios</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg float-end bg-azul-2 ms-auto">Enviar</button>
                </form>
            </div>
        </div>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>
