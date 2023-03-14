<div class="container mt-3 form-denuncia-siniestro p-4">

    <div class="row">
        <div class="col-12">
            <span style="color:#6e4697;font-size: 24px;"><b>Paso 8 </b>de 8 | Documentos</span>
            <hr style="border:1px solid lightgray;">
        </div>
    </div>

    @livewire('siniestro.reclamo.paso8', ['reclamo' => $reclamo])

</div>


@section('scripts')
<script type="text/javascript">
</script>
@endsection
