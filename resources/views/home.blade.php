@extends('layouts.app')

@section('content')
    <section id="inicio" class=" img-fluid bg">
        
    </section>
    <section id="seguros" class="py-5">
        
    </section>

    <section id="seguro-auto">
        
    </section>


    <section>
        
    </section>

    <section id="seguro-moto" class="img-fluid ">
        
    </section>


    <section id="caucion-alquileres" style="background-color: #EAF0FA;">
        
    </section>

    <section id="caucion-empresas" class="" style="background-color: rgba(122, 162, 214, 0.5)">
       
    </section>

    <section id="sepelio" class=" img-fluid fondo-sepelio">
        
    </section>

    <section id="sepelio" class=" img-fluid fondo-unite-equipo">
       
    </section>

@endsection

@section('scripts')

    <script>
        var numberMask = IMask(
            document.getElementById('cuit'),
            {
                mask: Number,
                min: 00000000000,
                max: 99999999999,
            });

    </script>

    <script>
        var numberMask = IMask(
            document.getElementById('valor_alquiler'),
            {
                mask: Number,
                min: 00000000000,
                max: 99999999999,
            });

    </script>

@endsection
