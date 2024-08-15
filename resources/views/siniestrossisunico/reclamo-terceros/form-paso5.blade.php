    <form class="" action='{{route("siniestros.terceros.paso5.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="reclamo_vehicular" value="{{ $reclamo->reclamo_vehicular ? '1' : '0' }}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">
            <div class="col-12">
                <h4 style="color:#6e4697;"><b>Paso 5 </b>de 10 | Lesionados</h4>
                <hr style="border:1px solid lightgray;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @if($reclamo->conductor && $reclamo->conductor->lesiones)
                    <tr style="background-color: rgba(0,0,0,.05);">
                        <td>{{ $reclamo->conductor->nombre }}</td>
                        <td>{{ $reclamo->conductor->documento_numero }}</td>
                        <td>Conductor</td>
                        <td class="text-right">
                            <a title="Editar" class="mr-1" href="{{ route('siniestros.terceros.paso4.create',['id'=> request('id')]) }}"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                        </td>
                    </tr>
                @endif
                @foreach($reclamo->lesionados as $lesionado)
                    <tr style="background-color: rgba(0,0,0,.05);">
                        <td>{{ $lesionado->nombre }}</td>
                        <td>{{ $lesionado->documento_numero }}</td>
                        <td>{{ $lesionado->tipo }}</td>
                        <td class="text-right">
                            <a title="Editar" class="mr-1" href="{{ route('siniestros.terceros.paso5.lesionado.edit',['id'=> request('id'),'lesionado'=> $lesionado->id]) }}"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                            <a title="Borrar" href="{{ route('siniestros.terceros.paso5.lesionado.delete',['id'=> request('id'),'lesionado'=> $lesionado->id]) }}"><i class="fa-solid fa-trash-can text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                @error('lesionados') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('siniestros.terceros.paso5.lesionado.create', ['id' => request('id')] )}}"
                   class="btn {{ !$reclamo->reclamo_lesiones ? 'disabled' : '' }}"
                   style="color:#6E4697;">
                    <i class="fa-solid fa-circle-plus fa-xl mr-2"></i>Agregar lesionado
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-3 boton-enviar-siniestro btn"
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('siniestros.terceros.paso4.create',['id' => request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script src="{{ asset('js/pais_provincia_localidad.js')}}"></script>

<script type="text/javascript">


</script>
@endsection
