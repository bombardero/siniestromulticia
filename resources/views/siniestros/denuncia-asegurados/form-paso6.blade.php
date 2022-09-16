<form class="container w-75" action='{{route("asegurados-denuncias-paso6.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <label style="font-size: 12px">
        Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en
        nuestro sistema.
    </label>
    <label class="text-danger" style="font-size: 12px">
        <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se
        recomienda cargar este formulario desde una computadora</label>

    <div class="container form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 6 </b>| 12 <b>Detalles de los otros vehiculos</b></span>

        <div class="row mt-3">

            <div class="col-12 col-md-4">
                <label><b>Intervino otro/s vehiculo *</b></label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" value="1"
                           id="checkbox_intervino_si" name="intervino_otro_vehiculo"
                        {{ $denuncia_siniestro->intervino_otro_vehiculo ? 'checked' : '' }}>
                    <label>Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" value="0"
                           id="intervino_otro_vehiculo" name="intervino_otro_vehiculo"
                        {{ $denuncia_siniestro->intervino_otro_vehiculo === false ? 'checked' : ''}}>
                    <label>No</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label><b>Tengo los datos *</b></label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" value="1"
                           id="checkbox_datos_si"
                           name="intervino_otro_vehiculo_datos" {{$denuncia_siniestro->intervino_otro_vehiculo_datos ? 'checked' : ''}}>
                    <label>Si</label>
                </div>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" value="0"
                           id="checkbox_datos_no" name="intervino_otro_vehiculo_datos"
                        {{ $denuncia_siniestro->intervino_otro_vehiculo_datos === false ? 'checked' : '' }}>
                    <label>No</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table mb-5">
                    <tbody>

                    @if($denuncia_siniestro->vehiculoTerceros)
                        @foreach($denuncia_siniestro->vehiculoTerceros as $vehiculo)
                            <tr class="borde-tabla">
                                <td>{{$vehiculo->propietario_nombre}}</td>
                                <td>
                                    {{ $vehiculo->marca_id ? $vehiculo->marca->nombre : $vehiculo->otra_marca }}
                                    {{ $vehiculo->modelo_id ? $vehiculo->modelo->nombre : $vehiculo->otro_modelo }}
                                </td>
                                <td>{{$vehiculo->detalles}}</td>
                                <td>
                                    <a href="{{route('asegurados-denuncias-paso6.edit',['id'=> request('id'),'v'=> $vehiculo->id])}}"><img
                                            src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}"></a>
                                    <a href="{{route('asegurados-denuncias-paso6.deleteItem',['id'=> request('id'),'v'=> $vehiculo->id])}}"><i
                                            class="fa-solid fa-trash-can text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td> No hay vehiculos de otros cargadas todavia</td>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-12">
                <div class="input-group  ">
                    <a href="{{route('asegurados-denuncias-paso6agregar.create',['id'=> request('id')])}}"
                       style="color:#6E4697;"><img
                            src="{{url('/images/siniestros/denuncia_asegurado/agregar.png')}}"/>
                        Agregar vehiculo</a>
                </div>
            </div>
        </div>

        <span style="color:red;">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
        </span>

        <a class="mt-5 boton-enviar-siniestro btn "
           style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
           href='{{route('asegurados-denuncias-paso5.create',['id'=> request('id')])}}'>ANTERIOR</a>
        <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE'
               style="background:#6e4697;font-weight: bold;"/>
    </div>


    <div class="col-12 text-center text-md-right">
        <div wire:loading class="spinner-border" role="status">
            <span class="sr-only">Cargando...</span>
            <span class="sr-only">Cargando...</span>
        </div>
    </div>
</form>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#provincias").change(function () {
                provincia_id = $("#provincias").val();
                console.log(provincia_id);
                $.ajax(
                    {
                        url: '/api/provincias/' + provincia_id + '/localidades',
                        type: 'get',
                        dataType: 'json',
                        success: function (cities) {
                            $('#localidades').empty();
                            cities.forEach(city => {
                                $('#localidades').append($('<option>', {
                                    value: city['id'],
                                    text: city['name']
                                }));
                            })

                        }
                    })


            });

        });

        $("#checkbox_intervino_si").click(function () {
            $("#checkbox_intervino_no").prop('checked', false);
        });

        $("#checkbox_intervino_no").click(function () {
            $("#checkbox_intervino_si").prop('checked', false);
        });

        $("#checkbox_datos_si").click(function () {
            $("#checkbox_datos_no").prop('checked', false);
        });

        $("#checkbox_datos_no").click(function () {
            $("#checkbox_datos_si").prop('checked', false);
        });


    </script>

@endsection
