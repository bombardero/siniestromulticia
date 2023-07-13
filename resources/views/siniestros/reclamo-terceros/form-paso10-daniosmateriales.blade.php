<div class="container mt-3 form-denuncia-siniestro p-4">

<div class="row">
        <div class="col-12">
            <h4 style="color:#6e4697;"><b>Paso 10 </b>de 10 | Documentos - Daños Materiales</h4>
            <hr style="border:1px solid lightgray;">
        </div>
    </div>

    @foreach($reclamo->daniosMateriales as $key => $danio_material)
        <livewire:siniestro.reclamo.paso10-daniosmateriales :reclamo="$reclamo" :daniomaterial="$danio_material" :orden="$key+1" :wire:key="$danio_material->id">
    @endforeach

    <form action="{{ route('siniestros.terceros.paso10.daniosmateriales.store') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{request('id')}}">
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
