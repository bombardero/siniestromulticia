<style>
.footer{
	visibility: hidden !important;
}
@media only screen and (max-width: 800px){
        .noPadding {
            padding-top:0px !important;
        }
        .saludo-mail {
        font-size: 18px !important;
        padding-top:5px;
        }
        #templateColumns{
            width:100% !important;
        }

        .templateColumnContainer{
            display:block !important;
            width:100% !important;
        }

        .columnImage{
            width:12.83;
            height:16;
            width:100% !important;
        }

        .leftColumnContent{
            font-size:16px !important;
            line-height:125% !important;
        }

        .rightColumnContent{
            font-size:16px !important;
            line-height:125% !important;
        }
        .caja {
            height:auto !important;
        }
        .caja-destacada {
            height:auto !important;
        }
        .mobile-desaparece {
            display:none !important;
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
        font-size: 43px !important;
        margin-top: 88px !important;
        line-height: 50px;
        text-align: left;
        color: #606060 !important;
    }
    .recibido {
    	margin-top: 32px !important;
        font-family: 'Lato', sans-serif;
        font-style: normal !important;
        font-weight: normal !important;
        font-size: 27px !important;
        line-height: 31px !important;
        text-align: left !important;
        letter-spacing: -0.02em !important;
        color: #222222 !important;
    }
    .datos {
    	padding-top: 16px !important;
        font-family: 'Lato', sans-serif;
        font-style: normal !important;
        font-weight: normal !important;
        font-size: 14px !important;
        line-height: 25px !important;
        text-align: center !important;
        letter-spacing: -0.02em !important;
        color: #545358 !important;
        margin-top: 95px !important;
    }
    .bg-mail {
        background: linear-gradient(180deg, rgba(190, 184, 242, 0.62) 0%, rgba(190, 184, 242, 0) 95.31%, rgba(85, 66, 133, 0.0104167) 99.99%, rgba(84, 65, 132, 0) 100%, rgba(84, 65, 132, 0) 100%);
    }
    .titulo {
        font-family: 'Lato', sans-serif;
        font-style: normal;
        font-weight: 700;
        font-size: 18px;
        line-height: 25px;
        text-transform: uppercase;
        text-align: center;
        color: #2D2D7B;
    }

    .gestion {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 20px;
        text-align: center;
        color: #BF4019;
    }

    p.recibido {
    margin-block-start: 0 !important;
    margin-block-end: 0 !important;
}


    .suma-asegurada {
        font-family: 'Lato';
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 25px;
        text-align: center;
        color: #545358 !important;
    }
    .mensual {
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        line-height: 20px;
        letter-spacing: -0.02em;
        color: #545358;
    }
    .caja-style {
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 20px;
        letter-spacing: -0.02em;
        color: #545358;
    }
    .title-caja {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 20px;
        text-align: left;
        letter-spacing: -0.02em;
        color: #545358;
    }
    .caja {
        background: #E6E3FA;
        height: 150px;
    }
    .caja-destacada {
        background: #A5A8FA;
        height: 183px;
    }
    .planes-coberturas {
        padding-top:15px;
        padding-bottom: 15px;
    }
    .planes {
        font-family: Lato;
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        line-height: 25px;
        text-align: center;
        color: #545358;
    }
    .solicitar-asesor {
        font-family: Lato;
        font-style: normal;
        font-weight: 500;
        font-size: 15px;
        line-height: 18px;
        text-align: center;
        color: #FFFFFF;
    }
 .button {
    border-radius: 20px;
}

.button a {
    padding: 8px 12px;
    border: 1px solid #ED2939;
    border-radius: 2px;
    font-family: Lato;
    font-size: 14px;
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
}
.interesa {
        font-family: Lato;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 25px;
        text-align: center;
        color: #545358;
}
.recomendado {
    font-family: Lato;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 25px;
    text-align: center;
    text-transform: uppercase;
    color: #FF9400;
    padding: 0px !important;
}
.noPadding {
    padding-top:11.8px;
}
.precio-caja
{
    padding-top: 15px;
    color:#2D2D7B;
    font-style: normal;
    font-weight: bold;
    font-size: 18px;
    line-height: 12px;
}
</style>
@component('mail::message')
    <div style="text-align: left !important; background:#1C3A6B;height: 105px;"><img style="margin-left: 80px !important; margin-top:20px;" src="{{url('/images/mobile/logo finisterre blanco_footer.png')}}"/></div>
    <p class="saludo-mail">¡Hola {{$productorNombre}}!  </p>
    </div>
    <div>
    <p class="recibido">Recibimos tu solicitud de contacto, estamos agradecidos por tu interés, en breves nuestro gerente regional se pondrá en contacto con vos.</p>

<center>
    <p style="color:white !important;background:#2187C9;height:68px;font-size:34px!important;font-weight: bold;" class="datos">Aumentá tus ganancias, protegé tu cartera</p>
</center>

<center>
	<img style='margin-top: 34px!important;' src="{{url('/images/mail/logo_compania_footer.png')}}">
</center>

<center>
	<img style='margin-top: 20px!important;' src="{{url('/images/mail/logo_ssn_footer.png')}}">
</center>

<center>
	<p class="recibido" style='margin-top: 19px!important;text-align: center !important;'>Seguinos en nuestras redes sociales</p>
</center>
<center>
	<div style="margin-top:21px;">
		<a href="https://www.facebook.com/finisterre.seguros.ok"><img src="{{url('/images/mail/logo_fb_footer.png')}}"></a>
		<a href="https://www.instagram.com/finisterre.seguros.ok"><img src="{{url('/images/mail/logo_ig_footer.png')}}"></a>
	</div>

</center>

<center>
	<p class="recibido" style='margin-top: 25px!important;font-weight: bold !important;text-align: center !important;'>www.finisterreseguros.com</p>
</center>


@endcomponent

