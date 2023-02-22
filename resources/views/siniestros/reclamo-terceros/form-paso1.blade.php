<form class="" action='{{route("siniestros.terceros.paso1.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 1 </b>de 8 | Datos del Asegurado</span>
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 mt-3">
                <label><b>Titular</b></label>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') ? old('nombre') : $reclamo->asegurado_nombre != null ? $reclamo->asegurado_nombre : '' }}"
                    >
                    @error('nombre') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 mt-3">
                <label><b>Vehículo</b></label>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="vehiculo_dominio">Dominio</label>
                    <input type="text" id="vehiculo_dominio" name="vehiculo_dominio"
                           class="form-control text-uppercase @error('vehiculo_dominio') is-invalid @enderror"
                           readonly
                           value="{{ $reclamo->vehiculo_asegurado_dominio }}">
                    @error('vehiculo_dominio') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <div class="input-group">
                        <select name="marca_id" id="marca-select" class="custom-select {{ old('otra_marca') || $reclamo->vehiculo_asegurado_otra_marca ? 'd-none' : '' }} @error('marca_id') is-invalid @enderror">
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}"
                                    {{ old('marca_id') == $marca->id || $reclamo->vehiculo_asegurado_marca_id == $marca->id ? 'selected' : '' }}
                                >{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="marca-text" name="marca"
                               class="form-control {{ old('otra_marca') || $reclamo->vehiculo_asegurado_otra_marca ? '' : 'd-none' }} @error('marca') is-invalid @enderror"
                               value="{{ old('marca') ? old('marca') : ($reclamo->vehiculo_asegurado_otra_marca != null ? $reclamo->vehiculo_asegurado_otra_marca : '') }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otra_marca" id="otra-marca"
                                       class="mr-1"
                                        {{ old('otra_marca') || $reclamo->vehiculo_asegurado_otra_marca != null ? 'checked' : '' }}
                                >Otra
                            </div>
                        </div>
                        @error('marca_id') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        @error('marca') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <div class="input-group">
                        <select name="modelo_id" id="modelo-select" class="custom-select {{ old('otro_modelo') || $reclamo->vehiculo_asegurado_otro_modelo != null ? 'd-none' : '' }} @error('modelo_id') is-invalid @enderror">
                            @foreach($modelos as $modelo)
                                <option value="{{ $modelo->id }}"
                                    {{  old('modelo_id') == $marca->id || ($reclamo->vehiculo_asegurado_modelo_id == $modelo->id) ? 'selected' : '' }}
                                >{{ $modelo->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="modelo-text" name="modelo"
                               class="form-control {{ old('otro_modelo') || $reclamo->vehiculo_asegurado_otro_modelo != null ? '' : 'd-none' }} @error('modelo') is-invalid @enderror"
                               value="{{ old('modelo') ? old('modelo') : ($reclamo->vehiculo_asegurado_otro_modelo != null ? $reclamo->vehiculo_asegurado_otro_modelo : '') }}"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="checkbox" name="otro_modelo" id="otro-modelo" class="mr-1" {{ old('otro_modelo') || $reclamo->vehiculo_asegurado_otro_modelo != null ? 'checked' : '' }}>Otro
                            </div>
                        </div>
                        @error('modelo_id') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                        @error('modelo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script src="{{ asset('js/marca_modelo.js')}}"></script>

<script type="text/javascript">

</script>
@endsection
