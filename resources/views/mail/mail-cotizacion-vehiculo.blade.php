<style>

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
        font-size: 30px;
        line-height: 25px;
        text-align: center;
        color: #6165D7 !important;
    }
    .recibido {
        font-family: 'Lato', sans-serif;
        font-style: normal !important;
        font-weight: normal !important;
        font-size: 18px !important;
        line-height: 25px !important;
        text-align: center !important;
        letter-spacing: -0.02em !important;
        color: #545358 !important;
    }
    .datos {
        font-family: 'Lato', sans-serif;
        font-style: normal !important;
        font-weight: normal !important;
        font-size: 14px !important;
        line-height: 25px !important;
        text-align: center !important;
        letter-spacing: -0.02em !important;
        color: #545358 !important;
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
    <img src="{{url('/images/mail/Group493.png')}}" style="text-align:center; max-width:100%;height:auto;">
    <p class="saludo-mail">Hola <img src="{{url('/images/mail/hello.png')}}" style="max-width:100%;height:auto;"> {{$data['email']}} </p>
    </div>
    <div>
    <p class="recibido">Hemos recibido tu pedido de cotización.</p>
    <p style="padding-top:20px; padding-bottom: 5px;" class="datos">Los datos que nos brindaste son los siguientes:</p>
    <p style="padding-top: 20px;" class="titulo">{{$marcaNombre}} {{$modeloNombre}}, Año {{$data['año']}}</p>
    <center><p style="width: 50%; border: 2px solid #BF4019; padding-top: 20px;" class="gestion">NRO. DE GESTIÓN
    <br>
    <span class="gestion" style="font-weight: bold;">{{$gestion}}</span>
    </p>
    </center>
    <p class="datos planes-coberturas">Los Planes de cobertura que te recomendamos son:</p>
    @for( $i = 0; $i<sizeof($coberturaNombres); $i++)
        <table style="margin-top:15px;" border="0" cellpadding="0" cellspacing="0" width="100%" id="templateColumns">
            @if(!(strpos(strtolower($coberturaNombres[$i]), 'adicional') || strpos(strtolower($coberturaNombres[$i]), 'auxilio')))
            <tr>
                <td align="center" valign="top" width="70%" class="templateColumnContainer">
                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                        <tr>
                            <td class="caja" valign="top" class="leftColumnContent">
                                <h1 class="title-caja">{{$coberturaNombres[$i]}} Suma Asegurada: {{$coberturaSumaAsegurada[$i]}}</h1>
                                <span style="padding-top:5px;" class="caja-style">{!!$textos[$i]!!}</span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td align="center" valign="top" width="30%" class="templateColumnContainer">
                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                        <tr>
                            <td class="caja" valign="top" class="leftColumnContent">
                                <h1 class="precio-caja">${{$cotizacion[$i]}} Mensual</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @endif
        </table>
    @endfor
<center>
     <p style="padding-top:40px;" class="planes">Para tomar alguno de éstos planes, o si querés consultar sobre algún aspecto no mencionado, podés solicitar un asesor en tu zona, al comunicarte brindales el siguente <span class="gestion" style="font-weight: bold;">Nro. de Gestión: {{$gestion}}</span></p>
</center>
<center>
 <table style="padding-top:20px;" align="center" cellspacing="0" cellpadding="0" width="100%">
   <tr>
     <td align="center" style="padding: 10px;">
       <table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
         <tr>
           <td align="center" bgcolor="#6165d7" style="background-color: #6165d7; margin: auto; max-width: 600px; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding: 5px 20px; " width="100%">
           <!--[if mso]>&nbsp;<![endif]-->
               <a href="{{route('contacto')}}" target="_blank" style="font-size:16px; font-family: Lato; color: #ffffff; font-weight:normal; text-align:center; background-color: #6165d7; text-decoration: none; border: none; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; display: inline-block;">
                   <span style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; line-height:1.5em; text-align:center;">Solicitar Asesor</span>
                </a>
           <!--[if mso]>&nbsp;<![endif]-->
           </td>
         </tr>
       </table>
       <table style="margin-top:22px;" border="0" class="mobile-button" cellspacing="0" cellpadding="0">
         <tr>
           <td align="center" bgcolor="#E6E3FA" style="background-color: #E6E3FA; margin: auto; max-width: 600px; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding: 5px 20px; " width="100%">
           <!--[if mso]>&nbsp;<![endif]-->
               <a href="{{route('productores.index')}}" target="_blank" style="font-size:16px; font-family: Lato; color:#6165D7; font-weight:normal; text-align:center; background-color: #E6E3FA; text-decoration: none; border: none; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; display: inline-block;">
                   <span style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #6165D7; font-weight:normal; line-height:1.5em; text-align:center;">Unirse como PAS</span>
                </a>
           <!--[if mso]>&nbsp;<![endif]-->
           </td>
         </tr>
       </table>
     </td>
   </tr>
 </table>
</center>
@endcomponent

