@extends('layouts.app')

@section('content')

<section class="fondo-dos-productor" style="padding-top: 85px;">
    <div class="container">


    <div class="row">
        <div class="offset-md-2">

        </div>
        <div class="col-1 text-md-right">
            <img src="{{url('/images/productor/herr_im.png')}}" class="img-fluid">
        </div>
        <div class="col-9 text-left">
            <div class="texto-herramientas" >
                <p class="herramientas">Tenemos herramientas que marcan la diferencia</p>
                <p class="herramientas-subtitle">Acompañamiento y asesoría de nuestros gerentes regionales</p>
                <p class="herramientas-subtitle">Oficina virtual de gestión para P.A.S.</p>
                <p class="herramientas-subtitle">Herramientas tecnológicas exclusivas</p>
                <p class="herramientas-subtitle">Capacitación y crecimiento constante</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="offset-md-2 col-md-4 col-12">
                <div class="card card-general card-autogestion card-width">
                  <div class="card-body">
                    <h5 class="cards-autogestion-title">Sistema de Autogestión </h5>
                    <ul>
                        <li class="cards-autogestion-list text-left">Emisión online.</li>
                        <li class="cards-autogestion-list text-left">Gestión de siniestros online. </li>
                        <li class="cards-autogestion-list text-left">Mesa de ayuda 24 hs.</li>
                        <li class="cards-autogestion-list text-left">Asistencia de Grúa 24 hs.</li>
                        <li class="cards-autogestion-list text-left">Gestión desde cualquier dispositivo.</li>
                    </ul>
                  </div>
                </div>
        </div>
        <div class="col-md-5 col-12 mt-3 mt-md-0 ">

                <div class="card card-general  card-mediopago card-width">
                  <div class="card-body">
                    <h5 class="cards-autogestion-title">Medios de pago</h5>
                        <p class="cards-autogestion-list text-left">Todas las plataformas de pagos habilitadas.  Débito automático con tarjeta de débito y crédito. Débito en cuenta, Rapipago, Pago Fácil, Mercado Pago, PagoMisCuentas y efectivo por Pronto Pago</p>
                  </div>
                </div>

        </div>

        <div class="offset-md-2 col-md-4 col-12 mt-3">
                <div class="card card-general card-beneficio card-width">
                  <div class="card-body">
                    <h5 class="cards-autogestion-title">Beneficios </h5>
                    <ul>
                        <li class="cards-autogestion-list text-left">Acompañamos a nuestros productores en la capacitación de temas vinculados al seguro.</li>
                        <li class="cards-autogestion-list text-left"><strong>Incentivos y premios por cumplimiento de objetivos.</strong></li>
                        <li class="cards-autogestion-list text-left">Bonificaciones especiales por cancelaciones anticipadas</li>
                    </ul>
                  </div>
                </div>
        </div>

        <div class="mb-5 col-md-5 col-12 mt-3 mt-md-0 ">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-general  card-material card-width">
                          <div class="card-body">
                            <h5 class="cards-autogestion-title">Material gráfico de apoyo</h5>
                            <ul>
                                <li class="cards-autogestion-list text-left">Baner promocional para local o stand.</li>
                                <li class="cards-autogestion-list text-left">Contenido gráfico para tus redes sociales</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="mt-3 col-12">
                        <div class="card card-general  card-material card-width">
                          <div class="card-body">
                            <h5 class="cards-autogestion-title">Nuestros comerciales son PAS</h5>
                            <p class="cards-autogestion-list text-left">Contamos con un equipo para acompañar tu proceso de crecimiento</p>

                          </div>
                        </div>
                    </div>
                </div>

        </div>



    </div>


        <div class="row">
            <div class="col-12 text-center pt-3 pb-3">
                 <img src="{{url('/images/productor/pas_im1.png')}}" class="img-fluid ">
            </div>
        </div>
            </div>
</div>
</section>
@endsection

@section('scripts')

@endsection