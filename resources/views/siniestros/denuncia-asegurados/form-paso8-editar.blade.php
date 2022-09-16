<form class="container w-75" action='{{route("asegurados-denuncias-paso8.update")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="v" value="{{request('v')}}">

    <label style="font-size: 12px">
        Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en
        nuestro sistema.
    </label>
    <label class="text-danger" style="font-size: 12px">
        <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se
        recomienda cargar este formulario desde una computadora</label>

    <div class="container form-denuncia-siniestro mt-3 p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 8 </b>| 12 <b>Lesiones a terceros transportados y no transportados</b></span>

        <div class="row mt-3">

            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label for="lesionado_nombre">Nombre y Apellido</label>
                    <input type="text" name="lesionado_nombre" id="lesionado_nombre" placeholder="Nombre completo"
                           class="form-control form-estilo" value="{{ $lesionado->nombre }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_telefono">Teléfono</label>
                    <input type="text" name="lesionado_telefono" id="lesionado_telefono" maxlength="15"
                           class="form-control form-estilo" value="{{ $lesionado->telefono }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="lesionado_documento_id" id="tipo_documentos"
                            class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}"
                                {{ $lesionado->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}
                            >{{$tipo_documento->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_documento_numero">Número de Documento</label>
                    <input type="text" name="lesionado_documento_numero" id="lesionado_documento_numero"
                           class="form-control form-estilo" maxlength="8"
                           value="{{$lesionado->documento_numero}}"
                    >
                </div>
            </div>


            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_codigo_postal">Código Postal</label>
                    <input type="text" name="lesionado_codigo_postal" id="lesionado_codigo_postal"
                           class="form-control form-estilo" maxlength="8"
                           value="{{$lesionado->codigo_postal}}"
                    >
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="lesionado_domicilio">Domicilio</label>
                    <input type="text" name="lesionado_domicilio" id="lesionado_domicilio"
                           class="form-control form-estilo" maxlength="255"
                           value="{{$lesionado->domicilio}}"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_estado_civil">Estado Civil</label>
                    <input type="text" name="lesionado_estado_civil" id="lesionado_estado_civil"
                           class="form-control form-estilo" maxlength="50"
                           value="{{ $lesionado->estado_civil }}"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="lesionado_fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="lesionado_fecha_nacimiento" id="lesionado_fecha_nacimiento"
                           class="form-control form-estilo" value="{{ $lesionado->fecha_nacimiento }}"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="asegurado_relacion">Relación con el asegurado</label>
                    <input type="text" id="asegurado_relacion" name="lesionado_relacion"
                           class="form-control form-estilo" value="{{ $lesionado->relacion }}"
                    >
                </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="conductor"
                           name="tipo" value="conductor"
                        {{$lesionado->tipo == 'conductor' ? 'checked':''}}
                    >
                    <label for="conductor">Conductor del vehículo</label>
                </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="pasajero_otro_vehiculo"
                           name="tipo" value="pasajero_otro_vehiculo"
                        {{$lesionado->tipo == 'pasajero_otro_vehiculo' ? 'checked':''}}
                    >
                    <label for="pasajero_otro_vehiculo">Pasajero de otro vehículo</label>
                </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="pasajero_vehiculo_asegurado"
                           name="tipo" value="pasajero_vehiculo_asegurado"
                        {{$lesionado->tipo == 'pasajero_vehiculo_asegurado' ? 'checked':''}}
                    >
                    <label for="pasajero_vehiculo_asegurado">Pasajero de vehículo asegurado</label>
                </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="peaton"
                           name="tipo" value="peaton"
                        {{$lesionado->tipo == 'peaton' ? 'checked':''}}
                    >
                    <label for="peaton">Peatón</label>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

        </div>
        <div class="row">

            <div class="col-12 col-md-4">
                <label>Tipo de lesiones</label>
            </div>

            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_leve" name="gravedad_lesion"
                           value="leve" {{$lesionado->gravedad_lesion == 'leve' ? 'checked':''}}
                    >
                    <label for="checkbox_leve">Leve</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_grave" name="gravedad_lesion"
                           value="grave" {{$lesionado->gravedad_lesion == 'grave' ? 'checked':''}}
                    >
                    <label for="checkbox_grave">Grave</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_mortal" name="gravedad_lesion"
                           value="mortal" {{$lesionado->gravedad_lesion == 'mortal' ? 'checked':''}}
                    >
                    <label for="checkbox_mortal">Mortal</label>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

        </div>
        <div class="row">

            <div class="col-12 col-md-4">
                <label>Examen de alcoholemia</label>
            </div>

            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_si"
                           name="alcoholemia" value="1" {{$lesionado->alcoholemia ? 'checked':''}}
                    >
                    <label>Si</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_alcoholemia_no"
                           name="alcoholemia" value="0" {{$lesionado->alcoholemia === false ? 'checked':''}}
                    >
                    <label>No</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox_alcoholemia_nego"
                           name="alcoholemia_se_nego" {{$lesionado->alcoholemia_se_nego ? 'checked':''}}
                    >
                    <label for="checkbox_alcoholemia_nego">Se negó</label>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="form-group">
                    <label for="lesionado_centro_asistencial">Centro Asistencial</label>
                    <input type="text" name="lesionado_centro_asistencial" id="lesionado_centro_asistencial"
                           class="form-control form-estilo" value="{{$lesionado->centro_asistencial}}"
                    >
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

@section('scripts')
@endsection
