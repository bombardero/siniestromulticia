@extends('layouts.app')
@section('content')
    <section style="background-color: rgba(240, 240, 240, 0.29);">
        <div class="container w-75">
            <div class="row">
                <div class="col-12">
                    <h2 class="pt-5 6xl" style="font-family: Roboto;color:#545358;font-size: 30px;">Denuncia de Siniestros | Asegurado </h2>
                </div>
            </div>
        </div>
        @include('siniestros.denuncia-asegurados.form-paso'.$paso);
@endsection
