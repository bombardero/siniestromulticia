<div class="table-responsive">
    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th scope="col" colspan="3">
                {{ $orden }} - {{ $lesionado->nombre }} [{{ $tipo }}]
            </th>
        </tr>
        </thead>
        <tbody>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    DNI *
                    <p class="ambos-lados text-left">Fotos de ámbos lados</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($lesionado->documentos()->where('type', 'dl_dni')->get() as $archivo)
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
                    @error($orden.'_dni')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_dni" name="dni"
                           wire:model="dni" accept="image/png,image/jpeg">
                    <label for="{{$orden}}_dni" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            @if($lesionado->es_menor_en_siniestro)
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        DNI Tutor *
                        <p class="ambos-lados text-left">Fotos de ámbos lados</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($lesionado->documentos()->where('type', 'dl_dni_tutor')->get() as $archivo)
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
                        @error($orden.'_dni_tutor')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="{{$orden}}_dni_tutor" name="dni_tutor" wire:model="dni_tutor" accept="image/png,image/jpeg">
                        <label for="{{$orden}}_dni_tutor" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
            @endif
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    Denuncia o Exposición Policial
                    <p class="ambos-lados text-left">Foto</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($lesionado->documentos()->where('type', 'dl_denuncia_policial')->get() as $archivo)
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
                    @error($orden.'_denuncia_policial')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
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
                    Historia clínica
                    <p class="ambos-lados text-left">Foto o PDF</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($lesionado->documentos()->where('type', 'dl_historia_clinica')->get() as $archivo)
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
                    @error($orden.'_historia_clinica')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_historia_clinica" name="historia_clinica"
                           wire:model="historia_clinica" accept="image/png,image/jpeg,application/pdf">
                    <label for="{{$orden}}_historia_clinica" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    Comprobantes de gastos médicos
                    <p class="ambos-lados text-left">Foto o PDF</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($lesionado->documentos()->where('type', 'dl_gastos_medicos')->get() as $archivo)
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
                    @error($orden.'_gastos_medicos')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="{{$orden}}_gastos_medicos" name="gastos_medicos"
                           wire:model="gastos_medicos" accept="image/png,image/jpeg,application/pdf">
                    <label for="{{$orden}}_gastos_medicos" class="mt-1">
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
