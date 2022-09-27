<form class="" action='{{route("asegurados-denuncias-paso7agregar.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container form-denuncia-siniestro p-4">
        <span style="color:#6e4697;font-size: 24px;"><b>Paso 7 </b>| 12 <b>Daños materiales a cosas</b></span>

        <div class="row mt-3">

            <div class="col-12">
                <label><b>Item de daños</b></label>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="Detalles">Detalle los daños *</label>
                    <textarea type="text" name="detalles" id="detalles"
                              placeholder="Describa los daños"
                              class="form-control form-estilo @error('detalles') is-invalid @enderror"
                    ></textarea>
                    @error('detalles') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="propietario_nombre">Nombre y Apellido del Propietario</label>
                    <input type="text" name="propietario_nombre" id="propietario_nombre"
                           placeholder="Nombre completo" class="form-control form-estilo"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="tipo_documentos">Tipo de Documento</label>
                    <select name="propietario_documento_id" id="tipo_documentos"
                            class="custom-select form-estilo">
                        @foreach($tipo_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}">{{$tipo_documento->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="propietario_documento_numero">Número de Documento</label>
                    <input type="text" name="propietario_documento_numero" id="propietario_documento_numero"
                           class="form-control form-estilo" maxlength="8"
                    >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="propietario_codigo_postal">Código Postal</label>
                    <input type="text" name="propietario_codigo_postal" id="propietario_codigo_postal"
                           class="form-control form-estilo" maxlength="8"
                    >
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="propietario_domicilio">Domicilio</label>
                    <input type="text" name="propietario_domicilio" id="propietario_domicilio"
                           class="form-control form-estilo" maxlength="255">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a class="mt-5 boton-enviar-siniestro btn "
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso7.create',['id'=> request('id')])}}'>CANCELAR</a>
                <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='GUARDAR'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>


    </div>

</form>

@section('scripts')
@endsection
