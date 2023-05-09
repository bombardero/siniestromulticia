<div class="container mt-3 form-denuncia-siniestro p-4">

<div class="row">
        <div class="col-12">
            <span style="color:#6e4697;font-size: 24px;"><b>Paso 10 </b>de 10 | Documentos - Lesionados</span>
            <hr style="border:1px solid lightgray;">
        </div>
    </div>

    @if($reclamo->conductor->lesiones)
        <livewire:siniestro.reclamo.paso10-lesionados :reclamo="$reclamo" :lesionado="$reclamo->conductor" :orden="1" :wire:key="Illuminate\Support\Str::uuid()">
    @endif

    @foreach($reclamo->lesionados as $key => $lesionado)
        <livewire:siniestro.reclamo.paso10-lesionados :reclamo="$reclamo" :lesionado="$lesionado" :orden="$key + ($reclamo->conductor->lesiones ? 2 : 1)" :wire:key="Illuminate\Support\Str::uuid()">
    @endforeach

    <form action="{{ route('siniestros.terceros.paso10.lesionados.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{ route('siniestros.terceros.paso10.create', ['id' => request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn" value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </form>

</div>


@section('scripts')
<script type="text/javascript">
</script>
@endsection
