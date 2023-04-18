<div class="container mt-3 form-denuncia-siniestro p-4">

    <div class="row">
        <div class="col-12">
            <span style="color:#6e4697;font-size: 24px;"><b>Paso 10 </b>de 10 | Documentos</span>
            <hr style="border:1px solid lightgray;">
        </div>
    </div>

    @if($reclamo->reclamo_vehicular)
    <div class="row mt-3">
        <div class="col-12 col-md-4">
            <label><b>Daño Vehicular</b></label>
        </div>
        <div class="col-12 col-md-4">
            {{ $vehicular_completo ? 'Completo' : 'Incompleto' }}   
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('siniestros.terceros.paso10.vehicular.create', ['id' => request('id')] )}}"
               style="color:#6E4697;">
                <i class="fa-solid fa-circle-plus fa-xl mr-2"></i>Ver
            </a>
        </div>
    </div>
    @endif

    @if($reclamo->reclamo_danios_materiales)
    <div class="row mt-3">
        <div class="col-12 col-md-4">
            <label><b>Daños Materiales</b></label>
        </div>
        <div class="col-12 col-md-4">

        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('siniestros.terceros.paso10.daniosmateriales.create', ['id' => request('id')] )}}"
               style="color:#6E4697;">
                <i class="fa-solid fa-circle-plus fa-xl mr-2"></i>Ver
            </a>
        </div>
    </div>
    @endif

    @if($reclamo->reclamo_lesiones)
    <div class="row mt-3">
        <div class="col-12 col-md-4">
            <label><b>Lesionados</b></label>
        </div>
        <div class="col-12 col-md-4">

        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('siniestros.terceros.paso10.lesionados.create', ['id' => request('id')] )}}"
               style="color:#6E4697;">
                <i class="fa-solid fa-circle-plus fa-xl mr-2"></i>Ver
            </a>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <a class="mt-3 boton-enviar-siniestro btn"
               style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
               href='{{route('siniestros.terceros.paso8.create',['id' => request('id')])}}'>ANTERIOR</a>
            <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE'
                   style="background:#6e4697;font-weight: bold;"/>
        </div>
    </div>

</div>


@section('scripts')
<script type="text/javascript">
</script>
@endsection
