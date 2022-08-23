
    <p>Notificacion de inicio tramite de denuncia de {{$data['email']}}</p>
    <p><u>Datos del siniestro</u></p>
    <ul>    
        <li>Dominio del vehículo: {{$data['dominio']}}</li> 
        <li>Fecha del siniestro: {{$data['fecha_siniestro']}} </li>
        <li>Hora del siniestro: {{$data['hora_siniestro']}} </li>
        <li>Lugar del siniestro: {{$data['lugar_siniestro']}}</li>    
        <li>Codigo Postal: {{$data['codigo_postal']}}</li>
        <li>Dirección del siniestro: {{$data['direccion_siniestro']}}</li>
        <li>Conductor del siniestro: {{$data['conductor_siniestro']}}</li>
        <li>Descripción del siniestro: {{$data['descripcion_siniestro']}}</li>
        <li>Responsable de contacto: {{$data['responsable_contacto']}}</li>        
        <li>Domicilio: {{$data['domicilio']}}</li>
        <li>Tel. de contacto: {{$data['telefono']}}</li>
        <li>Email de contacto: <a>{{$data['email']}}</a></li>        
    </ul>
