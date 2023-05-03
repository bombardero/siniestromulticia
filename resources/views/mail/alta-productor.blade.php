@extends('layouts.mail')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <p class="conoce-nuestros-productos ">Tienes una nueva solicitud de alta de productor de {{$nombre_apellido}} para analizar.</p>
            <p class="completa-datos">Datos de contacto:</p>
            <ul>
                <li>Nombre y Apellido: {{$nombre_apellido}}</li>
                <li>Email: {{$email}}</li>
                <li>Telefono: {{$telefono != null ? $telefono : 'No proporcionado'}}</li>
                <li>Provincia: {{$provincia->name}}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
