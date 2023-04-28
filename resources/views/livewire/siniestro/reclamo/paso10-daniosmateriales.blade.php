<div class="table-responsive">
    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th scope="col" colspan="3">
                {{ $orden }} - {{ $danio_material->tipo }}
            </th>
        </tr>
        </thead>
        <tbody>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    Denuncia o Exposición Policial
                    <p class="ambos-lados text-left">Foto</p>
                </td>
                <td>
                    <ul class="list-group">
                    @foreach($danio_material->documentos()->where('type', 'dm_denuncia_policial')->get() as $archivo)
                        <li class="list-group-item border-0 bg-transparent p-0">
                            <a target="_blank" class="documento-formato-texto pt-2"
                               href={{$archivo->url}}>{{$archivo->nombre}}</a>
                            <button
                                style="border:none;background: none;" id="confirmacion-popupa"
                                wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                    class="fas fa-trash-alt"></i>
                            </button>
                        </li>
                    @endforeach
                    </ul>
                    @error('dm_denuncia_policial')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_denuncia_policial" name="denuncia_policial"
                           wire:model="denuncia_policial" accept="image/png,image/jpeg">
                    <label for="{{$orden}}_denuncia_policial" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    DNI del Propietario
                    <p class="ambos-lados text-left">Foto de ámbos lados</p>
                </td>
                <td>
                    <ul class="list-group list-group-flush">
                        @foreach($danio_material->documentos()->where('type', 'dm_dni_propietario')->get() as $archivo)
                            <li class="list-group-item border-0 bg-transparent p-0">
                                <a target="_blank" class="documento-formato-texto pt-2"
                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                <button
                                    style="border:none;background: none;" id="confirmacion-popupa"
                                    wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                        class="fas fa-trash-alt"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @error('dm_dni_propietario') <span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_dni_propietario" name="dni_propietario"
                           wire:model="dni_propietario" accept="image/png,image/jpeg">
                    <label for="{{$orden}}_dni_propietario" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    Escritura de la propiedad o Contrato de alquiler *
                    <p class="ambos-lados text-left">Archivo PDF</p>
                </td>
                <td>
                    <ul class="list-group list-group-flush">
                        @foreach($danio_material->documentos()->where('type', 'dm_escritura_contrato_alquiler')->get() as $archivo)
                            <li class="list-group-item border-0 bg-transparent p-0">
                                <a target="_blank" class="documento-formato-texto pt-2"
                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                <button
                                    style="border:none;background: none;" id="confirmacion-popupa"
                                    wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                        class="fas fa-trash-alt"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @error('dm_escritura_contrato_alquiler') <span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_escritura_contrato_alquiler" name="escritura_contrato_alquiler"
                           wire:model="escritura_contrato_alquiler" accept="application/pdf">
                    <label for="{{$orden}}_escritura_contrato_alquiler" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    Fotos de los daños
                    <p class="ambos-lados text-left"></p>
                </td>
                <td>
                    <ul class="list-group list-group-flush">
                        @foreach($danio_material->documentos()->where('type', 'dm_fotos_danios')->get() as $archivo)
                            <li class="list-group-item border-0 bg-transparent p-0">
                                <a target="_blank" class="documento-formato-texto pt-2"
                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                <button
                                    style="border:none;background: none;" id="confirmacion-popupa"
                                    wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                        class="fas fa-trash-alt"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @error('dm_fotos_danios') <span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_fotos_danios" name="fotos_danios"
                           wire:model="fotos_danios" accept="image/png,image/jpeg">
                    <label for="{{$orden}}_fotos_danios" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    Presupuesto *
                    <p class="ambos-lados text-left">Foto. Con detalle de reparación y costo de mano de obra.</p>
                </td>
                <td>
                    <ul class="list-group list-group-flush">
                        @foreach($danio_material->documentos()->where('type', 'dm_presupuesto')->get() as $archivo)
                            <li class="list-group-item border-0 bg-transparent p-0">
                                <a target="_blank" class="documento-formato-texto pt-2"
                                   href={{$archivo->url}}>{{$archivo->nombre}}</a>
                                <button
                                    style="border:none;background: none;" id="confirmacion-popupa"
                                    wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                        class="fas fa-trash-alt"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @error('dm_presupuesto') <span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_presupuesto" name="presupuesto"
                           wire:model="presupuesto" accept="image/png,image/jpeg">
                    <label for="{{$orden}}_presupuesto" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@section('scripts')
<script>
</script>
@endsection
