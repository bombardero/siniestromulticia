@extends('layouts.app')
@section('content')
<section style="background-color:rgba(122, 162, 214, 0.5);"> 
    <div class="container" >
        <div class="row ">
            <div class="col-12 pt-5  ">
                <h1 class="pb-5 text-center titulo-garantia">Solicitar Seguro</h1>
                <p class="cotiza-segundo">Datos de la Empresa</p>
                @livewire('form-solicitar')
               
            </div>

        </div>
    </div>    
</section>

@endsection