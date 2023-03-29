<form class="" action='{{route("siniestros.terceros.paso6.daniomaterial.update")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="daniomaterial" value="{{ $danioMaterial->id }}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">
            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 6</b> de 10 | Daños Materiales</span>
                <hr style="border:1px solid lightgray;">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <div class="input-group">
                        <select name="tipo" id="tipo"
                                class="custom-select {{ old('check_otro_tipo') || !in_array($danioMaterial->tipo, $tipos) ? 'd-none' :  '' }} @error('tipo') is-invalid @enderror">
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo }}"
                                    {{ (old('tipo') && old('tipo') == $tipo) || $danioMaterial->tipo == $tipo ? 'selected' : '' }}
                                >{{ $tipo }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="otro_tipo" id="otro_tipo" maxlength="255"
                               class="form-control {{ old('check_otro_tipo') || !in_array($danioMaterial->tipo, $tipos) ? '' : 'd-none' }} @error('otro_tipo') is-invalid @enderror"
                               value="{{ old('otro_tipo') ? old('otro_tipo') : $danioMaterial->tipo }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" id="check_otro_tipo" name="check_otro_tipo"
                                       class="mr-1" {{ old('check_otro_tipo') || !in_array($danioMaterial->tipo, $tipos) ? 'checked' : '' }}>Otro
                            </div>
                        </div>
                    </div>
                    @error('tipo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    @error('otro_tipo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="detalles">Detalles de los daños</label>
                    <textarea name="detalles" id="detalles" rows="4"
                              class="form-control @error('detalles') is-invalid @enderror"
                    >{{ old('detalles') ? old('detalles') : $danioMaterial->detalles }}</textarea>
                    @error('detalles') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('siniestros.terceros.paso9.create',['id' => request('id')])}}'>VOLVER</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='AGREGAR'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    <script type="text/javascript">
        $("#check_otro_tipo").click(function () {
            if ($(this).prop("checked")) {
                $('#tipo').addClass('d-none');
                $("#tipo").prop('disabled', true);
                $('#otro_tipo').removeClass('d-none');
                $("#otro_tipo").prop('disabled', false);
            } else {
                $('#tipo').removeClass('d-none');
                $("#tipo").prop('disabled', false);
                $('#otro_tipo').addClass('d-none');
                $("#otro_tipo").prop('disabled', true);
            }
        });
    </script>
@endsection
