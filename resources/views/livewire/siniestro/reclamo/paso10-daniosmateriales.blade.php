<div class="table-responsive">
    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th scope="col" colspan="3"></th>
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
                    @foreach($reclamo->documentos()->where('type', 'dm_denuncia_policial')->get() as $archivo)
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
                    <input type="file" id="denuncia_policial" name="denuncia_policial"
                           wire:change="$emit('input_denuncia_policial', $event)" accept="image/png,image/jpeg">
                    <label for="denuncia_policial" class="mt-1">
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
                        @foreach($reclamo->documentos()->where('type', 'dm_dni_propietario')->get() as $archivo)
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
                    <input type="file" id="dni_propietario" name="dni_propietario"
                           wire:change="$emit('input_dni_propietario', $event)" accept="image/png,image/jpeg">
                    <label for="dni_propietario" class="mt-1">
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
                        @foreach($reclamo->documentos()->where('type', 'dm_escritura_contrato_alquiler')->get() as $archivo)
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
                    <input type="file" id="escritura_contrato_alquiler" name="escritura_contrato_alquiler"
                           wire:change="$emit('input_escritura_contrato_alquiler', $event)" accept="application/pdf">
                    <label for="escritura_contrato_alquiler" class="mt-1">
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
                        @foreach($reclamo->documentos()->where('type', 'dm_fotos_danios')->get() as $archivo)
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
                    <input type="file" id="fotos_danios" name="fotos_danios"
                           wire:change="$emit('input_fotos_danios', $event)" accept="image/png,image/jpeg">
                    <label for="fotos_danios" class="mt-1">
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
                        @foreach($reclamo->documentos()->where('type', 'dm_presupuesto')->get() as $archivo)
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
                    <input type="file" id="presupuesto" name="presupuesto"
                           wire:change="$emit('input_presupuesto', $event)" accept="image/png,image/jpeg">
                    <label for="presupuesto" class="mt-1">
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
    window.livewire.on('input_denuncia_policial', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_denuncia_policial', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_dni_propietario', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_dni_propietario', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_escritura_contrato_alquiler', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_escritura_contrato_alquiler', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_fotos_danios', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_fotos_danios', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_presupuesto', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_presupuesto', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
</script>
@endsection
