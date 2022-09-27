@extends('layouts.app')
@section('content')
    <section style="background-color: rgba(240, 240, 240, 0.29);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h2 class="pt-5 6xl" style="font-family: Roboto;color:#545358;font-size: 30px;">Denuncia de Siniestros | Asegurado </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <label class="" style="font-size: 12px">
                        Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en
                        nuestro sistema.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <label class="text-danger" style="font-size: 12px">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Se recomienda cargar este formulario desde una computadora
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <label class="text-danger" style="font-size: 12px">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Tenga en cuenta que una vez completados todos los pasos no podrá editar la denuncia.
                    </label>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-10 offset-md-1 px-0">
                @include('siniestros.denuncia-asegurados.form-paso'.$paso);
            </div>
        </div>
@endsection
