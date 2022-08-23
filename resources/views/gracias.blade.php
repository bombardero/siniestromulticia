@extends('layouts.app')
@section('content')
<section style="background-color: #F8F8F8;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                 <img src="{{url('/images/Frame.svg')}}" class="img-fluid ">    
            </div>
            

        </div>
        <div class="row pt-5 mb-5">
            <div class="offset-1 col-10 offset-1 text-center" style="border-radius: 20px;background-color: rgba(229, 83, 28, 1);">
                <img src="{{url('/images/recived 1.svg')}}" class="img-fluid ">    
                <p class="pr-3 pl-3 pt-4 solicitud-enviada">
                   Tu solicitud fue enviada
                </p>
                <p class="pr-md-5 pl-md-5 pt-2 solicitud-enviada-subtitulo">
                Recibirás un email de un asesor de Finisterre. Recordá revisar tu correo no deseado 
                 </p>
               
            </div>
            <div class="col-12 text-center pt-5" >

                @livewire('boton-azul',['name' => 'Volver', 'url' => '/'])
              
             
    
            </div>
        </div>
    </div>
</section>



@endsection