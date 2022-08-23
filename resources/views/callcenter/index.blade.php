@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5">
            	
                    <h1 class="panel-operaciones-title">Call Center</h1>
                    <p class="pt-3 panel-operaciones-subtitle">Panel de Cotizaciones</p>
                   @livewire('panel-call-center-table')

            </div>

        </div>
    </div>
</section>


@endsection