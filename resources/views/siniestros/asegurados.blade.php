@extends('layouts.app')
@section('content')
    <div class="bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h2 class="pt-5 text-center es-muy-facil">Estamos para <strong class="facil">asistirte</strong></h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-10 offset-md-1 px-0 pb-5">
                @livewire('siniestro.form-asegurados')
            </div>
        </div>
    </div>
@endsection
