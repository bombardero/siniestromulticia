<form class="container w-75" action='{{route("asegurados-denuncias-paso2.store")}}' method="post">
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

        <div class="row">
            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 2 </b>| 12 <b>Lugar del siniestro</b></span>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="pasis">País</label>
                    <select class="custom-select form-estilo" name="paises" id="paises">
                        <option value="1">Argentina</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select class="custom-select form-estilo" name="provincia_id" id="provincias">
                        @foreach($provincias as $provincia)
                            <option  value="{{ $provincia->id }}"
                                {{ $denuncia_siniestro->province_id == $provincia->id ? 'selected' : '' }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <select class="custom-select form-estilo" name="localidad_id" id="localidades">
                        @foreach($localidades as $localidad)
                            <option value="{{$localidad->id}}"
                                {{ $denuncia_siniestro->city_id == $localidad->id ? 'selected' : '' }}
                            >{{ $localidad->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-12 col-md-4">
                <label for="dominio">Calle o Ruta</label>
                <input type="text" id="calle" name="calle"
                       class="form-control form-estilo"
                       maxlength="255"
                       value="{{ $denuncia_siniestro->calle }}">
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_calzadas">Tipo de Calzada</label>
                    <select class="custom-select form-estilo" name="calzada_id" id="tipo_calzadas">
                        @foreach($tipo_calzadas as $tipo_calzada)
                            <option value="{{ $tipo_calzada->id }}"
                                {{ $denuncia_siniestro->tipo_calzada_id == $tipo_calzada->id ? 'selected' : '' }}
                            >{{$tipo_calzada->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="calzada_detalle">Detalle de la calzada</label>
                    <input type="text" id="calzada_detalle" name="calzada_detalle"
                           class="form-control form-estilo"
                           placeholder="Describa el estado de calzada"
                           maxlength="255"
                           value="{{ $denuncia_siniestro->calzada_detalle }}">
                </div>
            </div>

            <div class="form-group col-12 col-md-8">
                <label for="calzada_detalle">Insersección de calles</label>
                <input type="text" id="interseccion" name="interseccion"
                       class="form-control form-estilo"
                       placeholder="Indique entre que calles ocurrió el siniestro"
                       maxlength="255"
                       value="{{ $denuncia_siniestro->interseccion }}">
            </div>

            <div class="form-group col-12 col-md-4 pt-2">
                <label for=""></label>
                <div class="custom-control custom-checkbox pt-2">
                    <input type="checkbox" class="custom-control-input" id="cruce_senalizado" name="cruce_senalizado"
                        {{ $denuncia_siniestro->cruce_senalizado  ? 'checked' : '' }}
                    >
                    <label class="custom-control-label" for="cruce_senalizado">Cruce Señalizado</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-4">
                <div class="input-group">
                    <label>Tren Barrera señalizado</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="input-group  ">
                    <input type="radio" wire:model.defer="tren" class="form-check-input"
                           id="checkbox_tren_si" name="tren" value="1"
                        {{$denuncia_siniestro->tren ? 'checked':''}}
                    >
                    <label>Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="input-group  ">
                    <input type="radio" wire:model.defer="tren" class="form-check-input"
                           id="checkbox_tren_no" name="tren"
                           value="0" {{ $denuncia_siniestro->tren === 0 ? 'checked' : '' }}>
                    <label>No</label>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo" name="semaforo" {{ $denuncia_siniestro->semaforo ? 'checked' : '' }}>
                    <label for="checkbox_semaforo">Semaforo</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo_funciona" name="semaforo_funciona"
                           {{ $denuncia_siniestro->semaforo_funciona  ? 'checked' : '' }} disabled>
                    <label for="checkbox_semaforo_funciona">Funciona bien</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_semaforo_intermitente" name="semaforo_intermitente"
                           {{ $denuncia_siniestro->semaforo_intermitente ? 'checked':'' }} disabled>
                    <label for="checkbox_semaforo_intermitente">Intermitente</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="semaforo_color">Color del semaforo</label>
                    <input type="text" id='semaforo_color' name="semaforo_color"
                           class="form-control form-estilo"  placeholder="en color"
                           value="{{ $denuncia_siniestro->semaforo_color }}" disabled>

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

        <a class="mt-3 boton-enviar-siniestro btn "
           style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
           href='{{route('asegurados-denuncias-paso1.create',['id'=> request('id'),'noredirect'=>true])}}'>ANTERIOR</a>
        <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE'
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

            $("#checkbox_tren_si").click(function () {
                $("#checkbox_tren_no").prop('checked', false);
            });

            $("#checkbox_tren_no").click(function () {
                $("#checkbox_tren_si").prop('checked', false);
            });

            $("#checkbox_semaforo_funciona").click(function () {
                $("#checkbox_semaforo_intermitente").prop('checked', false);
            });

            $("#checkbox_semaforo_intermitente").click(function () {
                $("#checkbox_semaforo_funciona").prop('checked', false);
            });

            $("#checkbox_semaforo").click(function () {
                if ($(this).prop("checked") == true) {
                    $("#checkbox_semaforo_funciona").prop('disabled', false);
                    $("#checkbox_semaforo_intermitente").prop('disabled', false);
                    $("#semaforo_color").prop('disabled', false);
                    if ($("#checkbox_semaforo_intermitente").prop("checked") == true) {
                    }
                } else if ($(this).prop("checked") == false) {
                    $("#checkbox_semaforo_funciona").prop('disabled', true);
                    $("#checkbox_semaforo_intermitente").prop('disabled', true);
                    $("#semaforo_color").prop('disabled', true);
                }
            });

            $("#checkbox_semaforo_funciona").click(function () {
                if ($(this).prop("checked") == true) {
                    //$( "#semaforo_color" ).prop('disabled',true);
                } else if ($(this).prop("checked") == false) {
                    //$( "#semaforo_color" ).prop('disabled',false);
                }
            });

            $("#checkbox_semaforo_intermitente").click(function () {
                if ($(this).prop("checked") == true) {
                    //$( "#semaforo_color" ).prop('disabled',false);
                } else if ($(this).prop("checked") == false) {
                    //$( "#semaforo_color" ).prop('disabled',true);
                }
            });

            if ($("#checkbox_semaforo").prop("checked") == true) {
                $("#checkbox_semaforo_funciona").prop('disabled', false);
                $("#checkbox_semaforo_intermitente").prop('disabled', false);
                $("#semaforo_color").prop('disabled', false);

                /*if($( "#checkbox_semaforo_intermitente" ).prop("checked") == true){
                }*/
            }

        });
    </script>

@endsection
