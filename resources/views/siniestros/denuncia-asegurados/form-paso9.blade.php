<form class="container w-75" action='{{route("asegurados-denuncias-paso9.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <label style="font-size: 12px">
        Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en
        nuestro sistema.
    </label>
    <label class="text-danger" style="font-size: 12px">
        <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se
        recomienda cargar este formulario desde una computadora</label>

    <div class="container form-denuncia-siniestro mt-3 p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 9 </b>| 12 <b>Tipo de accidente</b></span>

        <div class="row mt-3">

            <div class="col-12">
                <label><b>Tipo de accidente</b></label>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_frontal" id="tipo_accidente_frontal"
                        {{ $denuncia_siniestro->tipo_accidente_frontal ? 'checked' : '' }}>
                    <label for="tipo_accidente_frontal">Frontal</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_posterior" id="tipo_accidente_posterior"
                        {{ $denuncia_siniestro->tipo_accidente_posterior ? 'checked' : '' }}>
                    <label for="tipo_accidente_posterior">Posterior</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_cadena" id="tipo_accidente_cadena"
                        {{ $denuncia_siniestro->tipo_accidente_cadena ? 'checked' : '' }}>
                    <label for="tipo_accidente_cadena">En cadena</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_lateral" id="tipo_accidente_lateral"
                        {{ $denuncia_siniestro->tipo_accidente_lateral ? 'checked' : '' }}>
                    <label for="tipo_accidente_lateral">Lateral</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_vuelco" id="tipo_accidente_vuelco"
                        {{ $denuncia_siniestro->tipo_accidente_vuelco ? 'checked' : '' }}>
                    <label for="tipo_accidente_vuelco">Vuelco</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_desplaza" id="tipo_accidente_desplaza"
                        {{ $denuncia_siniestro->tipo_accidente_desplaza ? 'checked' : '' }}>
                    <label for="tipo_accidente_desplaza">Desplaza</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_incendio" id="tipo_accidente_incendio"
                        {{ $denuncia_siniestro->tipo_accidente_incendio ? 'checked' : '' }}>
                    <label for="tipo_accidente_incendio">Incendio</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_inmersion" id="tipo_accidente_inmersion"
                        {{ $denuncia_siniestro->tipo_accidente_inmersion ? 'checked' : '' }}>
                    <label for="tipo_accidente_inmersion">Inmersión</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_explosion" id="tipo_accidente_explosion"
                        {{ $denuncia_siniestro->tipo_accidente_explosion ? 'checked' : '' }}>
                    <label for="tipo_accidente_explosion">Explosión</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_carga" id="tipo_accidente_carga"
                        {{ $denuncia_siniestro->tipo_accidente_carga ? 'checked' : '' }}>
                    <label for="tipo_accidente_carga">Daños a la carga</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="tipo_accidente_otros" id="tipo_accidente_otros"
                        {{ $denuncia_siniestro->tipo_accidente_otros ? 'checked' : '' }}>
                    <label for="tipo_accidente_otros">Otros</label>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid lightgray;margin-top: 0px;margin-bottom: 8px;">
            </div>

        </div>

        <div class="row">

            <div class="col-12">
                <label><b>Lugar</b></label>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_autopista" id="lugar_autopista"
                        {{ $denuncia_siniestro->lugar_autopista ? 'checked' : '' }}>
                    <label for="lugar_autopista">En autopista</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_calle" id="lugar_calle"
                        {{ $denuncia_siniestro->lugar_calle ? 'checked' : '' }}>
                    <label for="lugar_calle">En calle</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_avenida" id="lugar_avenida"
                        {{ $denuncia_siniestro->lugar_avenida ? 'checked' : '' }}>
                    <label for="lugar_avenida">En avenida</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_curva" id="lugar_curva"
                        {{ $denuncia_siniestro->lugar_curva ? 'checked' : '' }}>
                    <label for="lugar_curva">En curva</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_pendiente" id="lugar_pendiente"
                        {{ $denuncia_siniestro->lugar_pendiente ? 'checked' : '' }}>
                    <label for="lugar_pendiente">En pendiente</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_tunel" id="lugar_tunel"
                        {{ $denuncia_siniestro->lugar_tunel ? 'checked' : '' }}>
                    <label for="lugar_tunel">En túnel</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_sobrepuente" id="lugar_sobrepuente"
                        {{ $denuncia_siniestro->lugar_puente ? 'checked' : '' }}>
                    <label for="lugar_sobrepuente">Sobre puente</label>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="lugar_otros" id="lugar_otros"
                        {{ $denuncia_siniestro->lugar_otros ? 'checked' : '' }}>
                    <label for="lugar_otros">Otros</label>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

        </div>

        <div class="row">

            <div class="col-12">
                <label><b>Colisión con</b></label>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="colision_peaton" id="colision_peaton"
                        {{ $denuncia_siniestro->colision_peaton ? 'checked' : '' }}>
                    <label for="colision_peaton">Peatón</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="colision_vehiculo" id="colision_peaton"
                        {{ $denuncia_siniestro->colision_vehiculo ? 'checked' : '' }}>
                    <label for="colision_peaton">Vehículo</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="colision_edificio" id="colision_edificio"
                        {{ $denuncia_siniestro->colision_edificio ? 'checked' : '' }}>
                    <label for="colision_edificio">Edificio</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="colision_columna" id="colision_columna"
                        {{ $denuncia_siniestro->colision_columna ? 'checked' : '' }}>
                    <label for="colision_columna">Columna</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="colision_animal" id="colision_animal"
                        {{ $denuncia_siniestro->colision_animal ? 'checked' : '' }}>
                    <label for="colision_animal">Animal</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="colision_transporte" id="colision_transporte"
                        {{ $denuncia_siniestro->colision_transporte_publico ? 'checked' : '' }}>
                    <label for="colision_transporte">Transporte público</label>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="colision_otros" id="colision_otros"
                        {{ $denuncia_siniestro->colision_otros ? 'checked' : '' }}>
                    <label for="colision_otros">Otros</label>
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
           href='{{route('asegurados-denuncias-paso8.create',['id'=> request('id')])}}'>ANTERIOR</a>
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

@section('scripts')
@endsection
