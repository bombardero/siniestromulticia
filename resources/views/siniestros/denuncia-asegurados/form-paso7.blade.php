<form class="" action='{{route("asegurados-denuncias-paso7.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 7 </b>| 12 <b>Daños materiales a cosas</b></span>

        <div class="row mt-3">

            <div class="col-12 col-md-4">
                <label><b>Hubieron daños materiales *</b></label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_danio_si"
                           name="hubo_danios_materiales"
                           value="1"
                        {{ old('hubo_danios_materiales') == '1' || $denuncia_siniestro->hubo_danios_materiales ? 'checked' : '' }}>
                    <label>Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_danio_no"
                           name="hubo_danios_materiales"
                           value="0"
                        {{ old('hubo_danios_materiales') == '0' || $denuncia_siniestro->hubo_danios_materiales === false ? 'checked' : '' }}>
                    <label>No</label>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label style="color: #6E4697;font-size: 12px;">
                    Ejemplo: animales, inmuebles, carteles, semáforos, mobiliario público, bicicletas, etc.
                    <br>*No incluye daños a otros vehículos
                </label>
            </div>

            <div class="col-12 col-md-8 offset-sm-4">
                @error('hubo_danios_materiales') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table mb-5">
                    <tbody>
                    @if($denuncia_siniestro->danioMateriales)
                        @foreach($denuncia_siniestro->danioMateriales as $danio)
                            <tr class="borde-tabla">
                                <td>{{ $danio->propietario_nombre }}</td>
                                <td>{{ $danio->detalles }}</td>
                                <td>
                                    <a href="{{route('asegurados-denuncias-paso7.edit',['id'=> request('id'),'v'=> $danio->id])}}">
                                        <img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}">
                                    </a>
                                    <a href="{{route('asegurados-denuncias-paso7.deleteItem',['id'=> request('id'),'v'=> $danio->id])}}">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <td> No hay danos cargados todavia</td>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                    <label style="color:red;font-size: 12px;">
                        <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;">
                        En caso de haber más de un propietario damnificado cargar otro ítem
                    </label>
            </div>

            <div class="col-12 col-md-12">
                <div class="input-group  ">
                    <a href="{{route('asegurados-denuncias-paso7agregar.create',['id'=> request('id')])}}"
                       style="color:#6E4697;"><img
                            src="{{url('/images/siniestros/denuncia_asegurado/agregar.png')}}"/> Agregar ítem de
                        daños materiales</a>
                </div>
            </div>

            <div class="col-12">
                @error('danios_materiales') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-5 boton-enviar-siniestro btn "
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso6.create',['id'=> request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>


    </div>

</form>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#provincias").change(function () {
                provincia_id = $("#provincias").val();
                console.log(provincia_id);
                $.ajax({
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
    </script>
@endsection
