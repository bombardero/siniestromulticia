@extends('layouts.app')
@section('content')
    <section style="background-color: #F8F8F8;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center pt-5">
                    <img src="{{url('/images/Frame.svg')}}" class="img-fluid ">
                </div>


            </div>
            <div class="row pt-5 mb-5">
                <div class="offset-1 col-10 offset-1 text-center"
                     style="border-radius: 20px;background-color: rgba(229, 83, 28, 1);">
                    <img src="{{url('/images/recived 1.svg')}}" class="img-fluid ">
                    <p class="px-3 pt-4 solicitud-enviada">
                        Formulario registrado en nuestro sistema exitosamente
                    </p>
                    <p class="pr-md-5 pl-md-5 pt-2 solicitud-enviada-subtitulo">
                        Hemos enviado tu trámite. Ante cualquier consulta puedes comunicarte al 0810 362 0700.
                    </p>

                </div>
                <div class="col-12 text-center pt-5">
                    <span class="btn btn-danger boton-azul-full">
                        <i class="fas fa-spinner fa-pulse"></i>
                        Redirigiendo en <span id="timer">5</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <script>
        function descargarFile(url)
        {
            window.open(url, '_blank').focus();
        }

        /*setTimeout(function () {
            window.location.replace('{{ route('denuncia-siniestros.asegurado.show', ['id' => request()->get('id')]) }}');
        }, 5000);
        setInterval(function () {
            let counter = parseInt(document.getElementById('timer').textContent);
            if(counter>0)
            {
                document.getElementById('timer').innerHTML = --counter;
            }

        }, 1000);*/
    </script>

@endsection
