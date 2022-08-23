<footer id="footer" class="text-md-left" style="background-color:#4F4F4F;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 text-center text-md-left pt-4">
                    <img src="{{url('/images/mobile/logo finisterre blanco_footer.png')}}" class="img-fluid ">
                    <br>
                    <!--
                        <a href="" target="_blank"><img src="{{url('/images/logo facebook.svg')}}" class="img-fluid pr-4 pr-md-3  pr-lg-4 px-md-auto pt-4"></a>
                        <a href="" target="_blank"><img src="{{url('/images/logo insta.svg')}}" class="img-fluid pr-4 pr-md-3 pr-lg-4 px-md-auto pt-4 "></a>
                    -->
                    <p class="texto-footer pt-5">info@finisterreseguros.com
                        <br>
                        Reconquista 522 - Piso 7 
                        <br>
                        C1003ABL - C.A.B.A.
                    </p>
                    <div class="d-inline d-md-none">
                        <a target="_blank" href="http://qr.afip.gob.ar/?qr=BWNG6tVO4f7PLYPQB4n8hw,,">
                          <img class="pt-3 pb-2 text-left" src="{{url('/images/afip.png')}}" class="img-fluid ">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-3 pt-4 text-center text-md-left" >
                    <a class = "enlace-footer" href="{{ route('home') }}"><p class = "lista-footer">• Home</p></a>
                    <a class = "enlace-footer" href="{{ route('home') }}#seguros"><p class = "lista-footer">• Seguros</p></a>
                    <a class = "enlace-footer" href="{{ route('somos-finisterre') }}"><p class = "lista-footer">• Quiénes somos</p></a>
                    <a class = "enlace-footer" href="http://insuransys.finisterreseguros.com/" target="_blank"><p class = "lista-footer">• Productor</p></a>
                    <a class = "enlace-footer" href="{{ route('contacto') }}"><p class = "lista-footer">• Contacto</p></a>
                    <a class = "enlace-footer" href="{{ route('login', ['state' => 'cliente']) }}"><p class = "lista-footer">• Alquileres</p></a>
                    <a class = "enlace-footer" href="{{ route('preguntas-frecuentes') }}"><p class = "lista-footer">• Preguntas Frecuentes</p></a>
                    <a class = "enlace-footer" href="{{route('productor.alta',['state' => 'productor'])}}" ><p class = "lista-footer">• Producí con nosotros</p></a>
                </div>
                <div class="col-12 col-md-3 pt-4 text-center text-md-left">
                        <p class="siniestro-footer"><span style="font-weight: bold;">- Mesa de ayuda</span>
                        <br>
                        <span class="horario-footer">Las 24 hs<span>
                        <br>
                        <span style="font-size: 22px;font-weight: bold;">0810 362 0700</span> <span style="color:white!important;"></span>
                        </p>
                        <p class="siniestro-footer"><span style="font-weight: bold;">- Siniestros</span><br><br>
                        <a href="https://api.whatsapp.com/send?phone=5491158134014&text=Hola%20me%20contacto%20de%20la%20p&aacute;gina%20finisterre.%20Mi%20consulta%20es:&source=&data=&app_absent=" target="_blank" style="background:#398852;border-radius: 20px;border-color:#398852;color:white;padding-top:10px;padding-bottom:10px;padding-left:24px;padding-right:24px;text-decoration: none;"><img src="{{url('/images/icono_whatapp.svg')}}" class="mr-2">Chat de 9 a 13hs</a>

                        <br>
                        <br>
                  <h3 class ="legales">Legales</h3>
                  <a class ="enlace-footer" href="{{ route('legales') }}"><p class="subtitulo-footer lista-footer">• Privacidad y Legales</p></a>
                  <a class ="enlace-footer" href=""><p class="subtitulo-footer lista-footer">• Protección de datos</p></a>
                </div>
                <div class="col-12 col-md-3 pt-4 text-center text-md-left">
                    <h3 class="titulo-footer"><span style="font-weight: bold;">Atención al Asegurado</span></h3>
                    <p class="subtitulo-footer"><strong>Mesa de ayuda</strong> <br class="d-none d-md-block">0810 362 0700</p>

 {{--                     <h5 class ="pt-3 pt-md-5 telefono-footer mt-auto d-block d-md-none">54 011 43262833</h5> --}}
                </div>
                <div class="d-none d-md-inline col-md-3 ">
                    <a target="_blank" href="http://qr.afip.gob.ar/?qr=BWNG6tVO4f7PLYPQB4n8hw,,">
                      <img class="text-left" src="{{url('/images/afip.png')}}" class="img-fluid ">
                    </a>
                </div>
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
            </div>


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
        </div>
    </footer>