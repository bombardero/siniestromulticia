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
        body{
            min-height: 100vh;
        }

    </style>

</head>
<body class="d-flex align-items-start flex-column">

    <main class="container py-5">
        <div class="row">
            <div class="col text-center">
                <h1 class="text-azul mb-3">¡Muchas Gracias!</h1>
                <h4 class="">Tu solicitud fue enviada</h4>
                <p>Nos contactaremos al correo  {{ $email }}</p>
                <p><a href="{{ route('home') }}">Ir a la web</a></p>
            </div>
        </div>
    </main>
    <footer class="container mt-auto">
        <div class="row">
            <div class="col text-center">
                <img src="{{ asset('images/mail-muchas-gracias.png') }}" alt="">
            </div>
        </div>
    </footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>
