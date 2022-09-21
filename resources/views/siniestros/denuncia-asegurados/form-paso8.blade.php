<form class="container w-75" action='{{route("asegurados-denuncias-paso8.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">
    <input type="hidden" name="v" value="{{request('v')}}">

    <label style="font-size: 12px">
        Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados automaticamente en
        nuestro sistema.
    </label>
    <label class="text-danger" style="font-size: 12px">
        <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;"> Se
        recomienda cargar este formulario desde una computadora</label>

    <div class="container form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 8 </b>| 12 <b>Lesiones a terceros transportados y no transportados</b></span>

        <div class="row mt-3">

            <div class="col-12 col-md-4">
                <label><b>Personas lesionadas *</b></label>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_lesionados_si"
                           name="hubo_lesionados" value="1"
                        {{ old('hubo_lesionados') == '1' || $denuncia_siniestro->hubo_lesionados ? 'checked' : '' }}>
                    <label for="checkbox_lesionados_si">Si</label>
                </div>
            </div>

            <div class="col-12 col-md-1">
                <div class="custom-control custom-radio">
                    <input type="radio" class="form-check-input" id="checkbox_lesionados_no"
                           name="hubo_lesionados" value="0"
                        {{ old('hubo_lesionados') == '0' || $denuncia_siniestro->hubo_lesionados === false ? 'checked' : '' }}>
                    <label for="checkbox_lesionados_no">No</label>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label style="color: #E51C00;font-size: 12px;">
                    <img src="/images/siniestros/denuncia_asegurado/informacion_rojo.png" style="margin-bottom: 2px;">
                    No incluye al conductor del vehículo asegurado
                </label>
            </div>

            <div class="col-12 col-md-8 offset-sm-4">
                @error('hubo_lesionados') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="row">

            <div class="table-responsive">

                <table class="table mb-5">
                    <tbody>
                    @if($denuncia_siniestro->lesionados)
                        @foreach($denuncia_siniestro->lesionados as $lesionado)
                            <tr class="borde-tabla">
                                <td><b>Lesiones a</b> {{$lesionado->nombre}}</td>
                                <td>{{$lesionado->relacion}}</td>
                                <td>
                                    <a href="{{route('asegurados-denuncias-paso8.edit',['id'=> request('id'),'v'=> $lesionado->id])}}">
                                        <img src="{{url('/images/siniestros/denuncia_asegurado/editar.png')}}">
                                    </a>
                                    <a href="{{route('asegurados-denuncias-paso8.deleteItem',['id'=> request('id'),'v'=> $lesionado->id])}}">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td> No hay lesionados cargados todavia</td>
                    @endif
                    </tbody>

                </table>
            </div>

            <div class="col-12 col-md-12">
                <div class="input-group  ">
                    <a href="{{route('asegurados-denuncias-paso8agregar.create',['id'=> request('id')])}}"
                       style="color:#6E4697;"><img
                            src="{{url('/images/siniestros/denuncia_asegurado/agregar.png')}}"/> Agregar ítem de
                        persona lesionada</a>
                </div>
            </div>

            <div class="col-12">
                @error('lesionados') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <a class="mt-5 boton-enviar-siniestro btn "
                   style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
                   href='{{route('asegurados-denuncias-paso7.create',['id'=> request('id')])}}'>ANTERIOR</a>
                <input type="submit" class="mt-5 boton-enviar-siniestro btn " value='SIGUIENTE'
                       style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>

    </div>

</form>

@section('scripts')
@endsection
