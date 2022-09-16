<form class="container w-75" action='{{route("asegurados-denuncias-paso12.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <label style="font-size: 12px">
        Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en
        nuestro sistema.
    </label>
    <label class="text-danger" style="font-size: 12px">
        <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se
        recomienda cargar este formulario desde una computadora</label>
    <div class="container mt-3 form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 12 </b>| 12 <b>datos del denunciante</b></span>
        <span style="color:#6E4697; font-size:16px;">(Persona que está complentando este formulario)</span>

        <div class="row">

            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-3">
                <label><b>Es el propio asegurado *</b></label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="asegurado_si" name="asegurado" value="1"
                        {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->asegurado ? 'checked' : '' }}>
                    <label for="asegurado_si">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="asegurado_no" name="asegurado" value="0"
                        {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->asegurado === false ? 'checked' : '' }}>
                    <label for="asegurado_no">No</label>
                </div>
            </div>

            <div class="col-12 col-md-7"></div>

            <div class="col-12 col-md-3 pt-2">
                <label for="asegurado_relacion">Relación con el asegurado</label>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <input type="text" id='asegurado_relacion' name="asegurado_relacion"
                           class="form-control form-estilo"
                           value="{{$denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->asegurado_relacion : '' }}"
                           disabled>
                </div>
            </div>

            <div class="col-12 pt-3">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre completo"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->nombre : '' }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="tipo_documento_id" id="tipo_documentos" class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}"
                                {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->tipo_documento_id == $tipo_documento->id ? 'selected' : ''}}
                            >{{$tipo_documento->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="documento_numero">Número de Documento</label>
                    <input type="text" id="documento_numero" name="documento_numero" maxlength="8"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denunciante  ? $denuncia_siniestro->denunciante->documento_numero : ''}}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" maxlength="15"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->telefono : ''}}">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="provincias">Provincia</label>
                    <select id="provincias" name="provincia_id" class="custom-select form-estilo">
                        @foreach($provincias as $provincia)
                            <option value="{{$provincia->id}}"
                                {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->province_id == $provincia->id ? 'selected' : '' }}
                            >{{$provincia->name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="localidades">Localidad</label>
                    <select name="localidad_id" id="localidades" class="custom-select form-estilo">
                        @foreach($localidades as $localidad)
                            <option value="{{$localidad->id}}"
                                {{ $denuncia_siniestro->denunciante && $denuncia_siniestro->denunciante->city_id == $localidad->id ? 'selected' : '' }}
                            >{{$localidad->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante-> domicilio : ''}}"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" name="codigo_postal" id="codigo_postal"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denunciante ? $denuncia_siniestro->denunciante->codigo_postal : '' }}">
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
           href='{{route('asegurados-denuncias-paso11.create',['id'=> request('id')])}}'>ANTERIOR</a>
        <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='FINALIZAR'
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

        $("#asegurado_si").click(function () {
            $("#asegurado_relacion").prop('disabled', true);
            $("#nombre").prop('disabled', true);
            $('input[name="nombre"]').prop('disabled', true);
            $('select[name="tipo_documento_id"]').prop('disabled', true);
            $('input[name="documento_numero"]').prop('disabled', true);
            $('input[name="telefono"]').prop('disabled', true);
            $('select[name="provincia_id"]').prop('disabled', true);
            $('select[name="localidad_id"]').prop('disabled', true);
            $('input[name="domicilio"]').prop('disabled', true);
            $('input[name="codigo_postal"]').prop('disabled', true);

        });

        $("#asegurado_no").click(function () {
            $("#asegurado_relacion").prop('disabled', false);
            $("#nombre").prop('disabled', false);
            $('input[name="nombre"]').prop('disabled', false);
            $('select[name="tipo_documento_id"]').prop('disabled', false);
            $('input[name="documento_numero"]').prop('disabled', false);
            $('input[name="telefono"]').prop('disabled', false);
            $('select[name="provincia_id"]').prop('disabled', false);
            $('select[name="localidad_id"]').prop('disabled', false);
            $('input[name="domicilio"]').prop('disabled', false);
            $('input[name="codigo_postal"]').prop('disabled', false);
        });

    </script>

@endsection
