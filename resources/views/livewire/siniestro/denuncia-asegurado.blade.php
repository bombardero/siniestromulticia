<div>
    <form class="w-75 mx-auto container-page" action='{{route("asegurados-denuncias-paso1.store")}}' method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
        <div class="form-check">
            <label class="terminos-condiciones-entiendo" for="exampleCheck1" style="font-family: Roboto;font-size: 12px;margin-bottom: 0px !important;">Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en nuestro sistema. </label>
            <label class="terminos-condiciones-entiendo" style="color:red;"><img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se recomienda cargar este formulario desde una computadora</label>
        </div>
        <div class="container w-100 pt-3 contenedor-custom" style="background-image:url('/images/background_siniestro_stepper.png') !important;background-size: cover; background-repeat: no-repeat; min-height: 400px;border-radius: 30px;padding-left: 48px;padding-top: 32px;">
            <span style="color:#6e4697;font-size: 24px;margin-left: 18px;"><b>Paso 1 </b>| 12</span>

            <div class="input-group  ">

                <div class="col-12 col-md-6 pt-3">
                    <div class="input-group  ">
                        <label>Fecha de siniestro: <span style="color: black;font-size:18px;"> {{ date('d-m-Y', strtotime($denuncia_siniestro->precarga_fecha_siniestro)) }}</span></label>
                    </div>
                </div>

                <div class="col-12 col-md-6 pt-3">
                    <div class="input-group  ">
                        <label>Hora de siniestro: <span style="color: black;font-size:18px;">{{date('H:i', strtotime($denuncia_siniestro->precarga_hora_siniestro))}}hs</span></label>
                    </div>
                </div>


                <div class="col-12 col-md-12 pt-3" >
                        <hr style="border:1px solid lightgray;">
                </div>


                <div class="col-12 col-md-12 pt-3">
                    <div class="input-group  margin-left-en-mobile">
                        <label style="margin-left:-18px;">*Estado del Tiempo (Elegir al menos una opcion)</label>
                    </div>
                </div>
            </div>
            <div class="input-group margin-bottom-en-desktop margin-left-en-mobile">
                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_diurno" name="diurno" {{$denuncia_siniestro->carga_paso_1_diurno == 'on' ? 'checked':''}}>
                        <label>*Diurno</label>
                    </div>
                </div>

                 <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_seco" name="seco"  {{$denuncia_siniestro->carga_paso_1_seco == 'on' ? 'checked':''}}>
                        <label>Seco</label>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_niebla" name="niebla" {{$denuncia_siniestro->carga_paso_1_niebla == 'on' ? 'checked':''}}>
                        <label>Niebla</label>
                    </div>
                </div>

                 <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_nieve" name="nieve" {{$denuncia_siniestro->carga_paso_1_nieve == 'on' ? 'checked':''}}>
                        <label>Nieve</label>
                    </div>
                </div>

                  <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_otros" name="otros" {{$denuncia_siniestro->carga_paso_1_otros == 'on' ? 'checked':''}}>
                        <label>Otros</label>
                    </div>
                </div>


            </div>

            <div class="input-group margin-bottom-en-desktop margin-left-en-mobile">
                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_nocturno" name="nocturno" {{$denuncia_siniestro->carga_paso_1_nocturno == 'on' ? 'checked':''}}>
                        <label>*Nocturno</label>
                    </div>
                </div>

                 <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_lluvia" name="lluvia" {{$denuncia_siniestro->carga_paso_1_lluvia == 'on' ? 'checked':''}}>
                        <label>Lluvia</label>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_despejado" name="despejado" {{$denuncia_siniestro->carga_paso_1_despejado == 'on' ? 'checked':''}}>
                        <label>Despejado</label>
                    </div>
                </div>

                 <div class="col-12 col-md-2">
                    <div class="input-group  ">
                        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input" id="checkbox_granizo" name="granizo" {{$denuncia_siniestro->carga_paso_1_granizo == 'on' ? 'checked':''}}>
                        <label>Granizo</label>
                    </div>
                </div>
                  <div class="col-12 col-md-2 padding-right-en-mobile">
                    <div class="input-group  ">
                        <input class="form-estilo prueba w-100" type="text" class="form-control" id="otros_detalles" placeholder="  Detalle" wire:model.defer="detalle" name="otros_detalle" value="{{$denuncia_siniestro->carga_paso_1_otros_detalle}}" @if($denuncia_siniestro->carga_paso_1_otros!='on'){{'disabled'}}@endif>

                    </div>
                </div>
            </div>


                <div style="position:relative;width: 100%;">
                    {{--<div class="pull-right">--}}
                    <div>
                        <span style="color:red;">
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                        </span>
                        <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
                    </div>
                </div>
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
$( document ).ready(function() {

    $( "#checkbox_diurno" ).click(function() {
        $( "#checkbox_nocturno" ).prop('checked', false);
    });

    $( "#checkbox_nocturno" ).click(function() {
        $( "#checkbox_diurno" ).prop('checked', false);
    });

    $( "#checkbox_seco" ).click(function() {
        $( "#checkbox_lluvia" ).prop('checked', false);
    });

    $( "#checkbox_lluvia" ).click(function() {
        $( "#checkbox_seco" ).prop('checked', false);
    });

    $( "#checkbox_niebla" ).click(function() {
        $( "#checkbox_despejado" ).prop('checked', false);
    });

    $( "#checkbox_despejado" ).click(function() {
        $( "#checkbox_niebla" ).prop('checked', false);
    });


    $( "#checkbox_otros" ).click(function() {
        if($(this).prop("checked") == true){
            $( "#otros_detalles" ).prop('disabled',false);
        }else if($(this).prop("checked") == false){
            $( "#otros_detalles" ).prop('disabled',true);
        }
    });





});
</script>
@endsection

