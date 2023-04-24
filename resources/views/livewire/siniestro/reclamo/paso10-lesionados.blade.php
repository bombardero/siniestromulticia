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
                    DNI *
                    <p class="ambos-lados text-left">Fotos de ámbos lados</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($reclamo->documentos()->where('type', 'dl_dni')->get() as $archivo)
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
                    @error('dl_dni')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="dni" name="dni"
                           wire:change="$emit('input_dni', $event)" accept="image/png,image/jpeg">
                    <label for="dni" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    DNI Tutor *
                    <p class="ambos-lados text-left">Fotos de ámbos lados</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($reclamo->documentos()->where('type', 'dl_dni_tutor')->get() as $archivo)
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
                    @error('dl_dni_tutor')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="dni_tutor" name="dni_tutor"
                           wire:change="$emit('input_dni_tutor', $event)" accept="image/png,image/jpeg">
                    <label for="dni_tutor" class="mt-1">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <span class="subir-archivo-morado mb-0">Agregar</span>
                    </label>
                </td>
            </tr>
            <tr style="background-color: rgba(0,0,0,.05);">
                <td>
                    Denuncia o Exposición Policial
                    <p class="ambos-lados text-left">Foto</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($reclamo->documentos()->where('type', 'dl_denuncia_policial')->get() as $archivo)
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
                    @error('dl_denuncia_policial')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
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
                    Historia clínica
                    <p class="ambos-lados text-left">Foto o PDF</p>
                </td>
                <td>
                    <ul class="list-group">
                        @foreach($reclamo->documentos()->where('type', 'dl_historia_clinica')->get() as $archivo)
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
                    @error('dl_historia_clinica')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="historia_clinica" name="historia_clinica"
                           wire:change="$emit('input_historia_clinica', $event)" accept="image/png,image/jpeg,application/pdf">
                    <label for="historia_clinica" class="mt-1">
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
                        @foreach($reclamo->documentos()->where('type', 'dl_gastos_medicos')->get() as $archivo)
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
                    @error('dl_gastos_medicos')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                </td>
                <td class="text-center">
                    <input type="file" id="gastos_medicos" name="gastos_medicos"
                           wire:change="$emit('input_gastos_medicos', $event)" accept="image/png,image/jpeg,application/pdf">
                    <label for="gastos_medicos" class="mt-1">
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
    window.livewire.on('input_dni', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_dni', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_dni_tutor', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_dni_tutor', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
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
    window.livewire.on('input_historia_clinica', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_historia_clinica', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_gastos_medicos', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_gastos_medicos', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
</script>
@endsection
