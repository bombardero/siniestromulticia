@extends('layouts.app')
@section('content')
<section style="background-color: rgba(240, 240, 240, 0.29);">
    <div class="container">
        <div class="row ">
            <div class="col-12 ">
                <div class="container w-75 container-page">

                <h2 class="pt-5 6xl" style="font-family: Roboto;color:#545358;font-size: 30px;">Denuncia de Siniestros | Asegurado </h2>
                </div>
            </div>
        </div>
            <div>
    <form class="w-75 mx-auto" action="{{route('panel-siniestros.denuncia.observaciones.store',['denuncia'=>$denuncia])}}" method="post">
    	@csrf
        <div class="pt-5 col-12">
            <p class="datos-asegurado-title">Observaciones</p>
        </div>

        <div class="pt-3 form-group row">

            <div class="col-12 col-md-12 pt-3">
                @error('descripcion_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
                <div class="input-group  ">
                    <textarea class="form-estilo prueba w-100" style="resize: none;height: 100px;" class="form-control" id="descripcion_siniestro" placeholder="  Observaciones (max: 1500 caracteres)" maxlength="1500" name="descripcion_siniestro"></textarea>
                </div>
            </div>

            <div class="col-12 text-right">
                <p class="campos-obligatorios pt-3">*Campos son obligatorios.</p>
            </div>
       </div>

        <div class="col-12 text-center text-md-right">
            <a id="hablemos3" target="_blank" class="" href="">
                <button type="submit" class="mt-3 boton-enviar-siniestro btn ">Enviar</button>
            </a>
            <div wire:loading class="spinner-border" role="status">
                 <span class="sr-only">Cargando...</span>
                 <span class="sr-only">Cargando...</span>
            </div>
        </div>
    </form>
</div>

@endsection