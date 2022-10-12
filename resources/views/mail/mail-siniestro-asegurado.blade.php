<style>
    @media only screen and (max-width: 600px) {
        .saludo-mail {
        font-size: 20px !important;
        padding-top:5px;
    }
    }
    .body {
       font-family: 'Lato', sans-serif;
        text-align: center !important;
    }
    .saludo-mail {
        font-family: 'Lato', sans-serif;
        font-style: normal;
        font-weight: normal;
        font-size: 30px;
        line-height: 25px;
        text-align: center;
        color: #6165D7 !important;
    }
    .recibido {
        font-family: 'Lato', sans-serif;
        font-style: normal !important;
        font-weight: normal !important;
        font-size: 17px !important;
        line-height: 25px !important;
        text-align: center !important;
        letter-spacing: -0.02em !important;
        color: #545358 !important;
    }
    .bg-mail {
        background: linear-gradient(180deg, rgba(190, 184, 242, 0.62) 0%, rgba(190, 184, 242, 0) 95.31%, rgba(85, 66, 133, 0.0104167) 99.99%, rgba(84, 65, 132, 0) 100%, rgba(84, 65, 132, 0) 100%);

    }
    .campos {
        font-family: 'Lato', sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 16px;
        line-height: 25px;
        text-align: center;
        letter-spacing: -0.02em;
        color: #6165D7;
    }
    .bg-campos {
        background-color: rgba(190, 184, 242, 0.39) !important;
    }
    p.recibido {
    margin-block-start: 0 !important;
    margin-block-end: 0 !important;
}



</style>
@component('mail::message')
    <div class="bg-mail">
    <img src="{{url('/images/mail/image.png')}}" style="text-align:center; max-width:100%;height:auto;">
    <p class="saludo-mail">Hola <img src="{{url('/images/mail/hello.png')}}" style="max-width:100%;height:auto;"> {{$data['responsable_contacto']}}</p>
    </div>
    <div>
    <p class="recibido">Hemos recibido tu información para verificar el siniestro y permitir las indagaciones necesarias (Ley 17418/46.2).</p>
    <p style="padding-top:20px; padding-bottom: 5px;" class="recibido">Los datos que nos brindaste son los siguientes:</p>
    </div>
    <div class="bg-campos">
        <p style="padding-top: 20px;" class="recibido">Dominio del vehículo</p>
        <p class="campos">{{$data['dominio']}}</p>
        <p class="recibido">Fecha del siniestro </p>
        <p class="campos">{{$data['fecha_siniestro']}}</p>
        <p class="recibido">Hora del siniestro </p>
        <p class="campos">{{$data['hora_siniestro']}}</p>
        <p class="recibido">Lugar del siniestro</p>
        <p class="campos">{{$data['lugar_siniestro']}}</p>
        <p class="recibido">Codigo Postal</p>
        <p class="campos">{{$data['codigo_postal']}}</p>
        <p class="recibido">Dirección del siniestro</p>
        <p class="campos">{{$data['direccion_siniestro']}}</p>
        <p class="recibido">Conductor del siniestro</p>
        <p class="campos">{{$data['conductor_siniestro']}}</p>
        <p class="recibido">Descripción del siniestro</p>
        <p class="campos">{{$data['descripcion_siniestro']}}</p>
        <p class="recibido">Responsable de contacto</p>
        <p class="campos">{{$data['responsable_contacto']}}</p>
        <p class="recibido">Domicilio</p>
        <p class="campos">{{$data['domicilio']}}</p>
        <p class="recibido">Email de contacto</p>
        <a style="text-decoration: none;  padding-bottom:1rem;" class="campos">{{$data['email']}}</a>
        <p style="padding-top:0.7rem;" class="recibido">Tel. de contacto</p>
        <p style="padding-bottom: 10px;" class="campos">{{$data['telefono']}}</p>
    </div>
    <p style="padding-top:5px;" class="recibido"><b>Estamos evaluando ésta información.</b></p>
    <p style="padding-top:10px;" class="recibido">Tan pronto como podamos te contactaremos por whatsapp o email para enviarte el enlace para iniciar la denuncia efectiva.</p>
    <p class="recibido" style="padding-top:20px;">Equipo de Siniestros de Finisterre Seguros</p>
@endcomponent
