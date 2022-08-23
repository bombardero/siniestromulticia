@extends('layouts.app')
@section('content')
<section style="background-color: rgba(180, 173, 187, 0.29);">
    <div class="container">
        <div class="row ">
            <div class="col-12 text-center ">
                <h2 class="pt-5 text-center es-muy-facil">Estamos para <strong class="facil">asistirte</strong></h2>                
            </div>


        </div>
            @livewire('siniestro.form-terceros')

@endsection