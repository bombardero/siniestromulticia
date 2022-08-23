
@component('mail::message')

    <p class="conoce-nuestros-productos ">Proceso de reclamo de {{$data['email']}}</p>

    <p class="completa-datos">Datos del siniestro:</p>
        <ul>
            <li>Numero de denuncia: {{$data['numero_denuncia']}}</li>
            <li>Email: {{$data['email']}}</li>
            <li>Dominio propio: {{$data['dominio']}}</li>
            <li>Dominio asegurado: {{$data['dominio_asegurado']}}</li>
            <li>Lugar de siniestro: {{$data['lugar_siniestro']}}</li>
            <li>Fecha de siniestro: {{$data['fecha_siniestro']}}</li>
            <li>Responsable de contacto: {{$data['responsable_contacto']}}</li>
            <li>Telefono: {{$data['telefono']}}</li>
        </ul>



Gracias,<br>
{{ config('app.name') }}

@endcomponent
