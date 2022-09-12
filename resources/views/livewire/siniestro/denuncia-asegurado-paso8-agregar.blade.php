<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso8agregar.store")}}'
          method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
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

            <div class="input-group  margin-bottom-en-ambos margin">

                <div class="col-12 col-md-8 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_nombre" placeholder="Nombre y Apellido"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_telefono" placeholder="Telefono"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <select class='w-100' name="lesionado_documento_id" id="tipo_documentos"
                                style="border-radius:10px; height: 33px;background: white;">
                            @foreach($tipo_documentos as $tipo_documento)
                                <option value="{{$tipo_documento->id}}">{{$tipo_documento->nombre}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_documento_numero"
                               placeholder="Documento número"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_codigo_postal" placeholder="Código Postal"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_domicilio" placeholder="Domicilio"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_estado_civil" placeholder="*Estado Civil"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="date" name="lesionado_fecha_nacimiento"
                               placeholder="*Fecha de Nacimiento)"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>


                <div class="col-12 col-md-4 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" id='asegurado_relacion' name="lesionado_relacion"
                               placeholder="Relación con el asegurado"
                               style="border-radius:10px; height: 33px;background: white;">
                    </div>
                </div>

                <div class="input-group  second-row pt-3">

                    <div class="col-6 col-md-3">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input"
                                   name="tipo" value="conductor">
                            <label>Conductor del vehículo</label>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input"
                                   name="tipo" value="pasajero_otro_vehiculo">
                            <label>Pasajero de otro vehículo</label>
                        </div>
                    </div>

                    <div class="col-6 col-md-2">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input"
                                   name="tipo" value="peaton">
                            <label>Peatón</label>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input"
                                   name="tipo" value="pasajero_vehiculo_asegurado">
                            <label>Pasajero de vehículo asegurado</label>
                        </div>
                    </div>


                </div>

                <div class="col-12 col-md-12 pt-0">
                    <hr style="border:1px solid lightgray;">
                </div>

                <div class="input-group  margin-left-en-mobile">
                    <div class="col-12 col-md-3">
                        <div class="input-group  ">
                            <label>Tipo de lesiones</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-1">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input" id="checkbox_leve" name="gravedad_lesion" value="leve">
                            <label>Leve</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-1">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input" id="checkbox_grave" name="gravedad_lesion" value="grave">
                            <label>Grave</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input" id="checkbox_mortal" name="gravedad_lesion" value="mortal">
                            <label>Mortal</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 pt-1">
                    <hr style="border:1px solid lightgray;">
                </div>

                <div class="input-group  margin-left-en-mobile">
                    <div class="col-12 col-md-3">
                        <div class="input-group  ">
                            <label>Examen de alcoholemia</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-1">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input" id="checkbox_alcoholemia_si"
                                   name="alcoholemia" value="1">
                            <label>Si</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-1">
                        <div class="input-group  ">
                            <input type="radio" class="form-check-input" id="checkbox_alcoholemia_no"
                                   name="alcoholemia" value="0">
                            <label>No</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="input-group  ">
                            <input type="checkbox" class="form-check-input" id="checkbox_alcoholemia_nego"
                                   name="alcoholemia_se_nego">
                            <label>Se negó</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  ">
                        <input class='w-100' type="text" name="lesionado_centro_asistencial"
                               placeholder="Centro asistencial"
                               style="border-radius:10px; height: 33px;background: white;">
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
               href='{{route('asegurados-denuncias-paso8.create',['id'=> request('id')])}}'>CANCELAR</a>
            <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='GUARDAR'
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
            $("#marca_id").change(function () {
                marca_id = $("#marca_id").val();
                console.log(marca_id);
                $.ajax(
                    {
                        url: '/api/marcas/' + marca_id + '/modelos',
                        type: 'get',
                        dataType: 'json',
                        success: function (modelos) {
                            $('#modelo_id').empty();
                            modelos.forEach(modelo => {
                                $('#modelo_id').append($('<option>', {
                                    value: modelo['id'],
                                    text: modelo['nombre']
                                }));
                            })

                        }
                    })
            });
        });
    </script>

@endsection
