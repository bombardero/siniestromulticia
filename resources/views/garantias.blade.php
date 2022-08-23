@extends('layouts.app')

@section('content')

<section id="alquileres-seguros" style="background-color:rgba(206, 223, 244, 1);">
    <div class="container" >
        <div class="row">
            <div class="img-fluid imagen-caucion-alquileres-fondo">
                <div class="col-12">
                    <h1 class="pt-5 titulo-garantia">Alquileres seguros</h1>
                    <p class="subtitulo-garantia pt-4">La mejor solución para alquilar tu próxima propiedad</p>
                    <p class="pt-2 texto-general">
                        Fácil de contratar y tiene la ventaja de que no figura como una deuda, 
                        <br>
                        algo importante si estás pensando en pedir un crédito. 
                    </p>
                    <h1 id="requisitos" class="pt-4 requisitos-necesarios">                    
                        Requisitos necesarios para sacarlo
                    </h1>
                    <ul class="pl-3 texto-general">
                                            
                        <li class="pt-3"> 18 a 70 años.</li>
                    
                        <li class="pt-3"> Antigüedad laboral de 12 meses.</li>
                        
                        <li class="pt-3"> La relación alquiler/ingreso sobre el monto del alquiler mensual no puede exceder el 50% de los ingresos.</li>
                        
                        <li class="pt-3"> Ser empleado en relación de dependencia, trabajador independiente (monotributistas y autónomos), jubilados o--- pensionados.</li>
                    </ul>
                     <div class="pt-5 d-flex justify-content-center">
                    <a id="hablemos2" class="d-none d-md-block" href="{{route('preguntas-frecuentes')}}">
                            <button type="button" class="imagen-boton-chateamos btn btn-success">Preguntas Frecuentes</button>
                    </a>
                    </div>
                    <div class="pt-4 d-flex justify-content-center">

                        <a id="hablemos3" class="" href="{{route('home')}}#caucion-alquileres">
                            <button type="submit" class="boton-cotiza-celeste btn btn-light">Cotizá On-Line</button>
                        </a>
                    </div>
                    
                    <br class="d-none d-md-block">
                    <br class="d-none d-md-block">
                    <br class="d-none d-md-block">
                    <br class="d-none d-md-block">
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="garantias-obras-servicios" class="fondo-garantias-contractuales">
        <div class="container my-auto" >
            <div class="row">
                <div class="img-fluid ">
                    <div class="col-12">
                        <h1 class="pt-5 titulo-garantia">Garantías de Obra y/o Servicios</h1>
                       
                        <p class="pt-3 texto-general">
                            Seguros diseñados para atender las necesidades que se presentan en los contratos públicos y privados, de obras, suministros o servicios.
                            <br>    
                            Incluimos las siguientes coberturas:
                        </p>
                        <p class="texto-general pt-4">
                            <strong>Mantenimiento de la oferta</strong>: se garantizan las tres obligaciones básicas de mantenimiento de la oferta, suscripción del respectivo contrato en caso de adjudicación y la presentación de la garantía del fiel cumplimiento de éste.
                        </p>
                        <p class="texto-general pt-4">
                            <strong>Cumplimiento de contrato</strong>: se garantiza el fiel cumplimiento del contrato en tiempo y forma.
                            Anticipos: se garantiza el buen uso que el contratista haga de ellos.
                        </p>
                        <p class="texto-general pt-4">
                            <strong>Sustitución de fondo de reparo</strong>: se garantiza la obligación del contratista de concurrir a subsanar las deficiencias que pudieran aparecer.
                        </p>
                        <p class="texto-general pt-4">
                        <strong>Tenencia de bienes y materiales</strong>: se garantiza la tenencia y posterior devolución de los bienes de propiedad del asegurado.
                        </p>
                        <div class="pt-4 mb-5 d-flex justify-content-center">
                             @livewire('boton-quiero-seguro',['url' => '/solicitar-seguro']) 
                        </div>
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="garantias-aduaneras" class="fondo-garantias-aduaneras">
        <div class="container" >
            <div class="row">
                <div class="img-fluid ">
                    <div class="col-12">
                        <h1 class="pt-5 titulo-garantia">Garantías Aduaneras</h1>
                        <p class="requisitos-necesarios pt-3">Garantías legales obligatorias para despachos de aduanas</p>
                        <p class="pt-3 texto-general">
                           Servicio a importadores y exportadores en todo el territorio nacional. Son pólizas orientadas a garantizar diferentes obligaciones derivadas del Código Aduanero y otras normas vinculadas al comercio exterior. 
                        </p>
                        <p class="pt-3 texto-general">      
                            Los seguros de caución aduaneros están diseñados para atender las necesidades de las empresas importadoras y/o exportadoras en función de las obligaciones establecidas en el Código Aduanero.
                            <br>
                            Sus principales coberturas incluyen:

                        </p>
                        <p class="texto-general pt-4">
                            <strong>Importación temporaria</strong>: Se garantizan los derechos de importación correspondientes a bienes que ingresan al país con permiso por un lapso determinado.
                        </p>
                        <p class="texto-general pt-4">
                            <strong>Tránsito terrestre</strong>: Se garantiza el monto de los derechos de importación correspondientes a las mercaderías que ingresan por cualquiera de las Aduanas.
                        </p>
                        <p class="texto-general pt-4">
                            <strong>Diferencia de derechos</strong>: Estas garantías son utilizables cuando se presentan controversias entre el importador y la Aduana sobre las tasas aplicables a una determinada importación.
                        </p>
                        <p class="texto-general pt-4">
                        <strong> Falta de documentación</strong>: Se garantizan montos fijos por las reglamentaciones cuando se despachan mercaderías a plaza y el importador adeuda la presentación de algún documento original necesario para completar el despacho.
                        </p>
                         <p class="texto-general pt-4">
                        <strong> Habilitación de depósitos fiscales</strong>: Se garantiza el funcionamiento de los depósitos aduaneros en lugares autorizados por la Dirección General de Aduanas.
                        </p>
                        <div class="pt-4 mb-5 d-flex justify-content-center">
                               @livewire('boton-quiero-seguro',['url' => '/solicitar-seguro'])
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>



        <section id="garantias-judiciales"  class="fondo-garantias-judiciales">
        <div class="container" >
            <div class="row">
                
                    <div class="col-12">
                        <h1 class="pt-5 titulo-garantia">Garantía Judiciales</h1>
                   
                        <p class="texto-general pt-4">
                            <strong>Contracautelas</strong>

                        </p>
                        <p class="texto-general">Se garantiza los posibles perjuicios que pudiera causar la medida cautelar solicitada por la parte demandante en caso de haberla pedido sin derecho.</p>

                        <p class="texto-general pt-4"> 
                        <strong>Sustitución de medidas cautelares</strong>
                        </p>
                        <p class="texto-general">
                        Se garantiza la sustitución de la medida cautelar en el caso que el juez o autoridad
                        interviniente haya ordenado contra el demandado.
                        </p>

                    <div class="pt-4 d-flex justify-content-center">
                        @livewire('boton-quiero-seguro',['url' => '/solicitar-seguro'])
                    </div>   
                        
                        
                    </div>

                
            </div>

        </div>
        
    </section>

    <section id="garantias-actividades"  style="background-color:rgba(201, 198, 217, 0.6);" class="fondo-garantias-actividades">






        <div class="container" >
            <div class="row">
                <div class="img-fluid ">
                    <div class="col-12">
                        <h1 class="pt-5 titulo-garantia">Garantía de Actividades y/o Profesión</h1>
                        <p class="pt-3 texto-general">
                           Es un seguro que sirve para garantizar el pago de multas en caso de incumplir reglamentaciones específicas de determinada actividad o profesión. Impositiva(DGI).
                        </p>
                      
                        <p class="texto-general" >
                         <strong>
                            * Almacenadores y Comercializadores de Combustibles Líquidos y/o GNC.
                         </strong>   
                        </p>
                         <p class="texto-general" >
                         <strong>
                            * Importadores/Exportadores.
                         </strong>   
                        </p>
                         <p class="texto-general" >
                         <strong>
                            * Agencias de Turismo.
                         </strong>   
                        </p>
                         <p class="texto-general" >
                         <strong>
                             * Martilleros y Corredores Inmobiliarios.
                         </strong>   
                        </p>
                         <p class="texto-general" >
                         <strong>
                            * Distribuidores/Comercializadores de Combustibles
                         </strong>   
                        </p>
                         <h1 class="pt-5 titulo-garantia">Garantías de directores y gerentes</h1>
                         <p class="texto-general pt-3">
                             Este seguro da respuesta al requisito previsto en las resoluciones 20 y 21/04 de la Inspección General de Justicia (IGJ) exigido a Directores y Socios Gerentes de sociedades para asegurar el cumplimiento de sus obligaciones.
                        </p>
                        <p class="texto-general">   
                        Un trámite sencillo y rápido que le garantíza contar con su póliza On-line en minutos, si necesita iniciar su trámite, contactesé con nosotros.
                         </p>
                        <div class="pt-4 mb-5 d-flex justify-content-center">
                               @livewire('boton-quiero-seguro',['url' => '/solicitar-seguro'])
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection