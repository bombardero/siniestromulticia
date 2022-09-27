<form class="" action='{{route("asegurados-denuncias-paso1.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 1 </b>| 12</span>

        <div class="row">
            <div class="col-12 col-md-6 pt-3">
                <div class="input-group">
                    <label>Fecha de siniestro: <span
                            style="color: black;font-size:18px;"> {{ date('d/m/Y', strtotime($denuncia_siniestro->fecha)) }}</span></label>
                </div>
            </div>

            <div class="col-12 col-md-6 pt-3">
                <div class="input-group">
                    <label>Hora de siniestro: <span style="color: black;font-size:18px;">{{date('H:i', strtotime($denuncia_siniestro->hora))}} HS</span></label>
                </div>
            </div>

            <div class="col-12">
                <hr style="border:1px solid lightgray;">
            </div>

            <div class="col-12 col-md-12 pt-3">
                <label>Estado del Tiempo * (Elegir al menos una opcion)</label>
            </div>

        </div>

        <div class="row">
            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input"
                           id="checkbox_diurno" value="diurno"
                           name="momento_dia" {{$denuncia_siniestro->momento_dia == 'diurno' ? 'checked':''}}>
                    <label class="form-check-label" for="checkbox_diurno">Diurno</label>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input"
                           id="checkbox_nocturno" value="nocturno"
                           name="momento_dia" {{$denuncia_siniestro->momento_dia == 'nocturno' ? 'checked':''}}>
                    <label for="checkbox_nocturno">Nocturno</label>
                </div>
            </div>
            <div class="col-12 ">
                @error('momento_dia') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_seco"
                           name="seco" {{$denuncia_siniestro->estado_tiempo_seco ? 'checked' : '' }}>
                    <label class="form-check-label">Seco</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_niebla"
                           name="niebla" {{$denuncia_siniestro->estado_tiempo_niebla ? 'checked':''}}>
                    <label>Niebla</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_nieve"
                           name="nieve" {{$denuncia_siniestro->estado_tiempo_nieve ? 'checked':''}}>
                    <label>Nieve</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="input-group  ">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_lluvia"
                           name="lluvia" {{$denuncia_siniestro->estado_tiempo_lluvia ? 'checked':''}}>
                    <label>Lluvia</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="input-group  ">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_despejado"
                           name="despejado" {{$denuncia_siniestro->estado_tiempo_despejado ? 'checked':''}}>
                    <label>Despejado</label>
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="input-group  ">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_granizo"
                           name="granizo" {{$denuncia_siniestro->estado_tiempo_granizo ? 'checked':''}}>
                    <label>Granizo</label>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="checkbox_otros"
                           name="otros" {{$denuncia_siniestro->estado_tiempo_otros_detalles ? 'checked':''}}>
                    <label>Otros</label>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control form-estilo" id="otros_detalles"
                           placeholder="Detalle" name="otros_detalles"
                           value="{{ $denuncia_siniestro->estado_tiempo_otros_detalles ? $denuncia_siniestro->estado_tiempo_otros_detalles : ''}}"
                           maxlength="255"
                        {{ $denuncia_siniestro->estado_tiempo_otros_detalles ? '' : 'disabled'}}
                    >
                </div>
            </div>
            <div class="col-12">
                <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#checkbox_diurno").click(function () {
                $("#checkbox_nocturno").prop('checked', false);
            });

            $("#checkbox_nocturno").click(function () {
                $("#checkbox_diurno").prop('checked', false);
            });

            $("#checkbox_seco").click(function () {
                $("#checkbox_lluvia").prop('checked', false);
            });

            $("#checkbox_lluvia").click(function () {
                $("#checkbox_seco").prop('checked', false);
            });

            $("#checkbox_niebla").click(function () {
                $("#checkbox_despejado").prop('checked', false);
            });

            $("#checkbox_despejado").click(function () {
                $("#checkbox_niebla").prop('checked', false);
            });


            $("#checkbox_otros").click(function () {
                if ($(this).prop("checked") == true) {
                    $("#otros_detalles").prop('disabled', false);
                } else if ($(this).prop("checked") == false) {
                    $("#otros_detalles").prop('disabled', true);
                }
            });
        });
    </script>
@endsection
