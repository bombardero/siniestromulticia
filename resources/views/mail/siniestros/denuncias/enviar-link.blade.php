<style>
    p {
        font-family: 'Lato', sans-serif !important;
        font-style: normal !important;
        font-weight: normal !important;
        font-size: 1.2rem !important;
        line-height: 25px !important;
        color: #545358 !important;
    }
    .saludo-mail {
        font-size: 2rem !important;
        line-height: 25px !important;
        color: #6165D7 !important;
    }
    .bg-mail {
        background: linear-gradient(180deg, rgba(190, 184, 242, 0.62) 0%, rgba(190, 184, 242, 0) 95.31%, rgba(85, 66, 133, 0.0104167) 99.99%, rgba(84, 65, 132, 0) 100%, rgba(84, 65, 132, 0) 100%) !important;
    }
    .bg-campos {
        background-color: rgba(190, 184, 242, 0.39) !important;
    }
    .mail-body {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        padding-left: .75rem;
        padding-right: .75rem;
    }
    .text-center{
        text-align: center;
    }
    .text-center p{
        text-align: center;
    }
    .btn {
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        border-radius: 0.375rem;
        display: inline-block;
        text-decoration: none;
        color: #FFF;
        background-color: #6165D7;
    }
    pre{
        font-size: 1rem;
        font-family: Consolas, monospace;
        color: #545358;
    }
    .mt-1{
        margin-top: .5rem;
    }
    .mt-2{
        margin-top: 1rem;
    }
    .mt-3{
        margin-top: 1.5rem;
    }
    .mb-1{
        margin-bottom: .5rem;
    }
    .mb-2{
        margin-bottom: 1rem ;
    }
    .mb-3{
        margin-bottom: 1.5rem;
    }
    .pb-1{
        padding-bottom: .5rem;
    }
    .pt-2{
        padding-top: 1rem;
    }
    .pt-3{
        padding-top: 1.5rem;
    }
    .pb-1{
        padding-bottom: .5rem;
    }
    .pb-2{
        padding-bottom: 1rem;
    }
    .pb-3{
        padding-bottom: 1.5rem;
    }
</style>

@component('mail::message')
    <div class="bg-mail mail-header text-center pt-2 pb-2">
        <img src="{{url('/images/mail/image.png')}}">
        <p class="saludo-mail">Hola <img src="{{url('/images/mail/hello.png')}}"> {{$data['nombre']}}</p>    </div>
    <div>
    <div class="text-center">
        <p class="mb-2">Te acercamos el link para continuar con la carga de tu denuncia.</p>
    </div>
    <div class="bg-campos mail-body text-center">
        <p>Haz click en el siguiente botón:</p>
        <p class="pb-2">
            <a href="{{ $data['link_denuncia'] }}" class="btn">LINK</a>
        </p>
        <p class="mt-3">Si tienes problemas con el link anterior, prueba copiando y pegando el siguinte enlace</p>
        <p><pre>{{ url($data['link_denuncia']) }}</pre></p>
    </div>
    <p class="text-center" style="padding-top:20px;">Equipo de Siniestros de Finisterre Seguros</p>
@endcomponent
