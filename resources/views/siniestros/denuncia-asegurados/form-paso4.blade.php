<form class="container w-75" action='{{route("asegurados-denuncias-paso4.store")}}' method="post">
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
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 4 </b>| 12 <b>Datos del asegurado</b></span>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_nombre">Nombre y Apellido *</label>
                    <input type="text" name="asegurado_nombre" placeholder="Nombre completo"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->nombre : '' }}"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento *</label>
                    <select name="asegurado_documento_id" id="tipo_documentos"
                            class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option
                                value="{{$tipo_documento->id}}" {{ $denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>{{ $tipo_documento->nombre }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_documento_numero">Número de Documento *</label>
                    <input type="text" name="asegurado_documento_numero" id="asegurado_documento_numero"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->documento_numero : '' }}">
                </div>
            </div>

            <div class="col-12 col-md-8">
                <label for="asegurado_domicilio">Domicilio *</label>
                <div class="form-group">
                    <input type="text" name="asegurado_domicilio" id="asegurado_domicilio"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->domicilio : '' }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <label for="asegurado_codigo_postal">Código Postal *</label>
                <div class="form-group">
                    <input type="text" name="asegurado_codigo_postal" id="asegurado_codigo_postal"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->codigo_postal : '' }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="paises">País *</label>
                    <select name="asegurado_pais_id" id="paises" class="custom-select form-estilo">
                        <option value="1">Argentina</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="provincias">Provincia *</label>
                    <select name="asegurado_provincia_id" id="provincias" class="custom-select form-estilo">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ $denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->province_id == $provincia->id ? 'selected' : '' }}
                            >{{ $provincia->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="localidades">Localidad *</label>
                    <select name="asegurado_localidad_id" id="localidades" class="custom-select form-estilo">
                        @foreach($localidades as $localidad)
                            <option value="{{ $localidad->id }}"
                                {{$denuncia_siniestro->asegurado && $denuncia_siniestro->asegurado->city_id == $localidad->id ? 'selected' : '' }}
                            >{{ $localidad->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="asegurado_ocupacion">Ocupación *</label>
                    <input type="text" id="asegurado_ocupacion" name="asegurado_ocupacion"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->ocupacion : '' }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_telefono">Teléfono *</label>
                    <input type="text" id="asegurado_telefono" name="asegurado_telefono"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->asegurado ? $denuncia_siniestro->asegurado->telefono : '' }}">
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

        <a class="mt-5 boton-enviar-siniestro btn"
           style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
           href='{{route('asegurados-denuncias-paso3.create',['id'=> request('id')])}}'>ANTERIOR</a>
        <input type="submit" class="mt-5 boton-enviar-siniestro btn" value='SIGUIENTE'
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
    </script>

@endsection
