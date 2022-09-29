<footer id="footer" class="text-md-left" style="background-color:#4F4F4F;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 text-center text-md-left pt-4">
                <img src="{{url('/images/mobile/logo finisterre blanco_footer.png')}}" class="img-fluid ">
                <!--
                        <a href="" target="_blank"><img src="{{url('/images/logo facebook.svg')}}" class="img-fluid pr-4 pr-md-3  pr-lg-4 px-md-auto pt-4"></a>
                        <a href="" target="_blank"><img src="{{url('/images/logo insta.svg')}}" class="img-fluid pr-4 pr-md-3 pr-lg-4 px-md-auto pt-4 "></a>
                    -->
                <!--
                <p class="texto-footer pt-5">info@finisterreseguros.com
                    <br>
                    Reconquista 522 - Piso 7 
                    <br>
                    C1003ABL - C.A.B.A.
                </p>
                -->
                <
                <div class="d-inline text-center">
                    <a target="_blank" href="http://qr.afip.gob.ar/?qr=BWNG6tVO4f7PLYPQB4n8hw">
                        <img class="pt-3 pb-2 text-left" src="{{url('/images/afip.png')}}" class="img-fluid ">
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-3 pt-4 text-center text-md-left">
                <a class="enlace-footer" href="{{ route('home') }}"><p class="lista-footer">• Home</p></a>
                <a class="enlace-footer" href="{{ route('home') }}#seguros"><p class="lista-footer">• Seguros</p></a>
                <a class="enlace-footer" href="{{ route('somos-finisterre') }}"><p class="lista-footer">• Quiénes
                        somos</p></a>
                <a class="enlace-footer" href="http://insuransys.finisterreseguros.com/cot01/cotizador.html"
                   target="_blank"><p class="lista-footer">• Productor</p></a>
                <a class="enlace-footer" href="{{ route('contacto') }}"><p class="lista-footer">• Contacto</p></a>
                <a class="enlace-footer" href="{{ route('login', ['state' => 'cliente']) }}"><p class="lista-footer">•
                        Alquileres</p></a>
                <a class="enlace-footer" href="{{ route('preguntas-frecuentes') }}"><p class="lista-footer">• Preguntas
                        Frecuentes</p></a>
                <a class="enlace-footer" href="{{route('productor.alta',['state' => 'productor'])}}"><p
                        class="lista-footer">• Producí con nosotros</p></a>
            </div>
            <div class="col-12 col-md-3 pt-4 text-center text-md-left">
                <p class="siniestro-footer">
                    <span style="font-weight: bold;">- Siniestros Denuncia</span>
                <div
                    style="width:fit-content;background:#398852;border-radius: 20px;border-color:#398852;padding-top:10px;padding-bottom:10px;padding-left:24px;padding-right:24px;">
                    <a href="https://api.whatsapp.com/send?phone=5491158134014&text=Hola%20me%20contacto%20de%20la%20p&aacute;gina%20finisterre.%20Mi%20consulta%20es:&source=&data=&app_absent="
                       target="_blank" style="color:white;text-decoration: none;"><img
                            src="{{url('/images/icono_whatapp.svg')}}" class="mr-2"><span
                            style="text-decoration:underline;"><span
                                style="font-size:20px;">Asegurados</span></span><br> Chat de 9 a 13hs</a></div>
                </p>
                <p class="siniestro-footer">
                    <span style="font-weight: bold;">- Siniestros Reclamos</span>
                <div
                    style="width:fit-content;background:#398852;border-radius: 20px;border-color:#398852;padding-top:10px;padding-bottom:10px;padding-left:24px;padding-right:24px;">
                    <a href="https://api.whatsapp.com/send?phone=5491133536309&text=Hola%20me%20contacto%20de%20la%20p&aacute;gina%20finisterre.%20Mi%20consulta%20es:&source=&data=&app_absent="
                       target="_blank" style="color:white;text-decoration: none;"><img
                            src="{{url('/images/icono_whatapp.svg')}}" class="mr-2"><span
                            style="text-decoration:underline;"><span style="font-size:20px;">Terceros</span></span><br>
                        Chat de 9 a 13hs</a></div>
                </p>
                <h3 class="legales">Legales</h3>
                <a class="enlace-footer" href="{{ route('legales') }}"><p class="subtitulo-footer lista-footer">•
                        Privacidad y Legales</p></a>
                <a class="enlace-footer" href=""><p class="subtitulo-footer lista-footer">• Protección de datos</p></a>
            </div>
            <div class="col-12 col-md-3 pt-4 text-center text-md-left">
                <h3 class="titulo-footer"><span style="font-weight: bold;">Mesa de Ayuda</span></h3>
                {{--
                <p class="subtitulo-footer"><strong>RESPONSABLE: ALDAZABAL FLORENCIA</strong> <br class="d-none d-md-block">0810 362 0700, INT 501, email: faldazabal@finisterreseguros.com</p>
                <p class="subtitulo-footer"><strong>SUPLENTE: BUSTOS MARIA JIMENA</strong> <br class="d-none d-md-block">0810 362 0700, INT 526, email: jbustos@finisterreseguros.com</p>
                --}}
                <p class="subtitulo-footer"><strong>24Hs.</strong> <br class="d-none d-md-block">
                <p style="font-size:22px;color:white;">0810 362 0700</p></p>
                <p class="texto-footer pt-5">info@finisterreseguros.com
                    <br>
                    Reconquista 522 - Piso 7
                    <br>
                    C1003ABL - C.A.B.A.
                </p>
            </div>
            {{--
            <div class="col-12 col-md-9  text-center text-md-left pt-4">
                <hr style="border-top:1px solid white;">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center text-md-left">
                             <a href="https://www.argentina.gob.ar/superintendencia-de-seguros" target="_blank"><img src="{{url('/images/SSN-landscape.svg')}}" class="img-fluid "></a>
                        </div>

                        <div class="col-12 col-md-6 mt-auto text-center text-md-left pt-5 pt-md-2 pr-5 pl-5">
                            <p class="organismo-control">
                               <strong> Organismo de control <br class="d-md-none">
                                www.argentina.gob.ar/ssn <br class="d-md-none">
                            2018-{{ now()->year }}. Todos los derechos reservados. </strong>
                            </p>
                        </div>
                    </div>
                <hr style="border-top:1px solid white;">
            </div>
            --}}
        </div>

        {{--
        <div class="row pt-3 pt-md-5">
            <div class="col-12 text-center text-md-left compañia-seguro">
                <p>La compañía de seguros dispone de un Servicio de Atención al Asegurado que atenderá las consultas y reclamos que presenten los
                tomadores de seguros, asegurados, beneficiarios y/o derechohabientes.
                En caso de que el reclamo no haya sido resuelto o que haya sido denegada su admisión o desestimado, total o parcialmente, podrá
                comunicarse con la Superintendencia de Seguros de la Nación por teléfono al 0800 666 8400, correo electrónico a denuncias@ssn.gob.ar
                o por formulario web de un Servicio de Atención al Asegurado que atenderá las consultas y reclamos que presenten los
                tomadores de seguros, asegurados, beneficiarios y/o derechohabientes.
                </p>
            </div>
        </div>
        --}}
        <div style="background: white;" class="mt-4">
            <div class="row" style="padding-left:25px;padding-top:25px;padding-bottom:25px;">
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12 col-md-3" style="border-right: 1px solid #4A4A49;">
                            N° de inscripción SSN
                            <br><strong>0857</strong>
                        </div>
                        <div class="col-12 col-md-3">
                            Departamento de Orientación y Asistencia al Asegurado
                        </div>
                        <div class="col-12 col-md-3"
                             style="color:#009FE3;border-right: 1px solid #4A4A49;font-size: 20px;">
                            <strong>0800-666-8400</strong>
                        </div>
                        <div class="col-12 col-md-3" style="color:#009FE3;font-size: 20px;">
                            <strong>www.argentina.gob.ar/ssn</strong>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-4 justify-content-end">
                    <div class="row">
                        <div class="col-12 col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <img src="{{url('/images/logo_ssn.png')}}" style="height:30px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-left:25px;margin-right:5px;">
                <div class="col-12 col-md-8"
                     style="background:#F1F1F1;padding-left: 60px;padding-top: 33px;padding-right: 55px;padding-bottom: 33px;margin-bottom: 33px;">
                    La entidad <b>Aseguradora del Finisterre Cia. Argentina de Seguros</b> dispone de un <strong>Servicio
                        de Atención al Asegurado</strong> que atenderá las consultas y reclamos que presenten los
                    tomadores de seguros, asegurados, beneficiarios y/o derechohabientes. En caso de que existiera un
                    reclamo ante la entidad aseguradora y que el mismo no haya sido resuelto o haya sido desestimado,
                    total o parcialmente, o que haya sido denegada su admisión, podrá comunicarse con la
                    Superintendencia de Seguros de la Nación por telefono al 0800-666-8400, correo electrónico a
                    <strong>consultas@ssn.gob.ar</strong> o formulario disponible en la página <strong>argentina.gob.ar/ssn</strong>
                </div>
                <div class="col-12 col-md-4">
                    <strong>El servicio de Atención al Asegurado está integrado por:</strong><br><br>

                    RESPONSABLE: <strong>ALDAZABAL, FLORENCIA</strong><br>
                    Teléfono: 0810-362-0700 - Int: 501<br>
                    faldazabal@finisterreseguros.com<br><br>

                    SUPLENTE: <strong>BUSTOS, MARIA JIMENA</strong><br>
                    Teléfono: 0810-362-0700 - Int: 526<br>
                    jbustos@finisterreseguros.com<br><br>

                </div>
            </div>
        </div>
    </div>
</footer>
