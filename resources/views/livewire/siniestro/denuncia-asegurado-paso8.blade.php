<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso8.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <input type="hidden" name="v" value="{{request('v')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1"
                   style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un
                asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro
                sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img
                    src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se
                recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom"
             style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat;min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 8 </b>| 12 <b>Lesiones a terceros transportados y no transportados</b></span>

            <div class="input-group  ">

                <div class="input-group  margin-left-en-mobile">
                    <div class="col-12 col-md-4">
                        <div class="input-group  ">
                            <label><b>*Personas lesionadas</b></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-1">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input" id="checkbox_lesionados_si"
                                name="lesionados" value="1"
                                {{ $denuncia_siniestro->hubo_lesionados ? 'checked' : '' }}>
                            <label>Si</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-1">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input" id="checkbox_lesionados_no"
                                name="lesionados" value="0"
                                {{$denuncia_siniestro->hubo_lesionados === false ? 'checked' : '' }}>
                            <label>No</label>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="input-group  ">
                            <label style="color: #E51C00;font-size: 12px;"><img
                                    src="/images/siniestros/denuncia_asegurado/informacion_rojo.png"
                                    style="margin-bottom: 2px;"/>No incluye al conductor del vehículo asegurado</label>
                        </div>
                    </div>

                </div>


                {{-- INICIO TABLE*********************************  --}}
                <div class="table-responsive">

                    <table class="table" style="margin-bottom: 120px;">
                        <tbody>
                        @if($denuncia_siniestro->lesionados)
                            @foreach($denuncia_siniestro->lesionados as $lesionado)
                                <tr class="borde-tabla">
                                    <td><b>Lesiones a</b> {{$lesionado->nombre}}</td>
                                    <td>{{$lesionado->relacion}}</td>
                                    <td>
                                        <a href="{{route('asegurados-denuncias-paso8.edit',['id'=> request('id'),'v'=> $lesionado->id])}}">
                                            <img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}">
                                        </a>
                                        <a href="{{route('asegurados-denuncias-paso8.deleteItem',['id'=> request('id'),'v'=> $lesionado->id])}}">
                                            <i class="fa-solid fa-trash-can text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td> No hay lesionados cargados todavia</td>
                        @endif
                        </tbody>

                    </table>
                </div>
                {{-- FIN TABLE*********************************  --}}


                <div class="col-12 col-md-12">
                    <div class="input-group  ">
                        <a href="{{route('asegurados-denuncias-paso8agregar.create',['id'=> request('id')])}}"
                           style="color:#6E4697;"><img
                                src="{{url('/images/siniestros/denuncia_asegurado/agregar.png')}}"/> Agregar ítem de
                            persona lesionada</a>
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
               href='{{route('asegurados-denuncias-paso7.create',['id'=> request('id')])}}'>ANTERIOR</a>
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
</div>
<br>
<br>
<br>

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

        $("#checkbox_lesionados_si").click(function () {
            $("#checkbox_lesionados_no").prop('checked', false);
        });

        $("#checkbox_lesionados_no").click(function () {
            $("#checkbox_lesionados_si").prop('checked', false);
        });
    </script>

@endsection
