@extends('layouts.new-layout')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="pt-5 col-12 text-center">
                    <h1 class="siniestros-title">Siniestros</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray">
        <div class="container">
            <div class="row ">
                <div class="col-12 text-center ">
                    <h2 class="pt-5 text-center es-muy-facil">Estamos para <strong class="facil">asistirte</strong></h2>
                    <img src="{{url('/images/siniestros/post-contacto.svg')}}" class="pt-4 img-fluid">
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-8 ">
                    <div class="bg-black-siniestro">
                        <p class="pt-3 align-self-center text-center que-hacer-siniestro">¿Qué hacer ante un
                            siniestro?</p>
                    </div>
                </div>

            </div>
            <div class="row pt-5 ">
                <div class="col-12 col-md-6 d-flex justify-content-md-end">
                    <div class=" card mx-auto mx-md-1 " style="width: 20rem;">
                        <div class="card-body text-center">
                            <h5 class="card-siniestro-title card-title soy-asegurado">Soy un asegurado</h5>
                            <h6 class="card-subtitle mb-2 pt-2 soy-asegurado">Brinde todos sus datos al tercero.</h6>
                            <p class="card-text">Si tuviste un siniestro y sos asegurado
                                de Finisterre</p>
                            <a href="{{route('asegurados.index')}}" type="button"
                               class="boton-siniestro-asegurado btn btn-success text-uppercase">Comenzar tramite</a>
                        </div>
                    </div>
                </div>
                <div class="pt-3 pt-md-0 col-12 col-md-6 d-flex justify-content-md-start">
                    <div class="card mx-auto mx-md-1" style="width: 20rem;">
                        <div class="card-body text-center">
                            <h5 class="card-siniestro-title card-title soy-tercero">Soy un tercero</h5>
                            <h6 class="card-subtitle mb-2 pt-2 soy-tercero">Obtenga los datos de nuestro asegurado.</h6>
                            <p class="card-text">Si tuviste un siniestro con un asegurado
                                de Finisterre</p>
                            <a href="{{route('terceros.index')}}" type="button"
                               class="boton-siniestro-tercero btn  text-uppercase">Presentar reclamo</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-5 row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <p class="legal-siniestro">El tomador o derechohabiente, comunica al asegurador el acaecimiento del
                        siniestro dentro de los tres dias (Ley 17418/46.1)
                        El asegurado esta obligado a suministrar al asegurador, a su pedido, la informacion necesaria
                        para verificar el siniestro y permitir las indagaciones necesarias a tal fin (Ley 17418/46.2)
                    </p>
                </div>

                <div class="pt-5 col-12 col-md-7 mx-auto text-center">
                    <p class="no-califica-denuncia">*El trámite de reclamo en cualquiera de los casos es una
                        notificación a la compañía y no califica como Denuncia.
                        Es un primer contacto online para comenzar con el tramite para iniciar la denuncia pertinente a
                        un siniestro.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection






