<form class="" action='{{route("asegurados-denuncias-paso6.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

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
                        {{ old('intervino_otro_vehiculo') == "1" || $denuncia_siniestro->intervino_otro_vehiculo ? 'checked' : '' }}>
                    <label for="checkbox_intervino_si">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" value="0"
                           id="checkbox_intervino_no" name="intervino_otro_vehiculo"
                        {{ old('intervino_otro_vehiculo') == "0" || $denuncia_siniestro->intervino_otro_vehiculo === false ? 'checked' : ''}}>
                    <label for="checkbox_intervino_no">No</label>
                </div>
            </div>

            <div class="col-12 col-md-8 offset-md-4">
                @error('intervino_otro_vehiculo') <span class="invalid-feedback pl-2 mt-0">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 col-md-4">
                <label><b>Tengo los datos *</b></label>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" value="1"
                           id="checkbox_datos_si"
                           name="intervino_otro_vehiculo_datos"
                        {{ old('intervino_otro_vehiculo_datos') == "1" || $denuncia_siniestro->intervino_otro_vehiculo_datos ? 'checked' : ''}}>
                    <label for="checkbox_datos_si">Si</label>
                </div>
            </div>
            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" value="0"
                           id="checkbox_datos_no" name="intervino_otro_vehiculo_datos"
                        {{ old('intervino_otro_vehiculo_datos') == "0" || $denuncia_siniestro->intervino_otro_vehiculo_datos === false ? 'checked' : '' }}>
                    <label for="checkbox_datos_no">No</label>
                </div>
            </div>

            <div class="col-12 col-md-8 offset-md-4">
                @error('intervino_otro_vehiculo_datos') <span class="invalid-feedback pl-2 mt-0">{{ $message }}</span> @enderror
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
            <div class="col-12">
                <div class="input-group">
                    <a href="{{route('asegurados-denuncias-paso6agregar.create',['id'=> request('id')])}}"
                       style="color:#6E4697;"><img
                            src="{{url('/images/siniestros/denuncia_asegurado/agregar.png')}}"/>
                        Agregar vehiculo</a>
                </div>
            </div>

            <div class="col-12">
                @error('vehiculos') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-5 boton-enviar-siniestro btn "
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso5.create',['id'=> request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>

    </div>
</form>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $("#provincias").change(function () {
                provincia_id = $("#provincias").val();
                //console.log(provincia_id);
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

            $('input[name="intervino_otro_vehiculo"]').change(function (event) {
                let intervino = $(this).val();
                //console.log(intervino);
                actualizarDenuncia('intervino_otro_vehiculo',intervino);
            });

            $('input[name="intervino_otro_vehiculo_datos"]').change(function (event) {
                let intervino_datos = $(this).val();
                actualizarDenuncia('intervino_otro_vehiculo_datos',intervino_datos);
            });

            function actualizarDenuncia(field, value)
            {
                let url = '{{ route('panel-siniestros.denuncia.update-field', ['denuncia' =>  $denuncia_siniestro->id]) }}';
                $.ajax(
                    {
                        url: url,
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "field_name": field,
                            "field_value": value
                        },
                        success: function (result) {
                            //console.log(result);
                        },
                        error: function (error) {
                            //console.log(error);
                            alert('Hubo un error.');
                        }
                    })
            }

        });
    </script>

@endsection
