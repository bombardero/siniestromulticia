<form wire:submit.prevent="submit" method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

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
                        DNI Titular *
                        <p class="ambos-lados text-left">Fotos de ambos lados</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'dni')->get() as $archivo)
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
                        <input type="file" id="fotos_dni" name="fotos_dni"
                               wire:change="$emit('input_dni', $event)" accept="image/png,image/jpeg">
                        <label for="fotos_dni" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Cédula verde o Título *
                        <p class="ambos-lados text-left">Fotos de ambos lados</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'cedula')->get() as $archivo)
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
                        @error('cedula')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="foto_cedula" name="foto_cedula"
                               wire:change="$emit('input_cedula', $event)" accept="image/png,image/jpeg">
                        <label for="foto_cedula" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Carnet de conducir *
                        <p class="ambos-lados text-left">Fotos de ambos lados</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'carnet')->get() as $archivo)
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
                        @error('carnet')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="foto_carnet" name="foto_carnet"
                               wire:change="$emit('input_carnet', $event)" accept="image/png,image/jpeg">
                        <label for="foto_carnet" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
                @if($reclamo->vehiculo && $reclamo->vehiculo->en_transferencia)
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Formulario 08 *
                        <p class="ambos-lados text-left">Firmado ante escribano</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'formulario_08')->get() as $archivo)
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
                        @error('formulario_08')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="formulario_08" name="formulario_08"
                               wire:change="$emit('input_formulario_08', $event)" accept="image/png,image/jpeg">
                        <label for="formulario_08" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
                @endif
                @if($reclamo->vehiculo && $reclamo->vehiculo->con_seguro)
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Denuncia Administrativa *
                        <p class="ambos-lados text-left">Archivo PDF</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'denuncia_administrativa')->get() as $archivo)
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
                        @error('denuncia_administrativa')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="denuncia_administrativa" name="denuncia_administrativa"
                               wire:change="$emit('input_denuncia_administrativa', $event)" accept="application/pdf">
                        <label for="denuncia_administrativa" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
                @else
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Declaración Jurada de No Seguro *
                        <p class="ambos-lados text-left">Exposición Policial dónde declare que no tiene cobertura</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'declaracion_jurada')->get() as $archivo)
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
                        @error('denuncia_administrativa')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="declaracion_jurada" name="declaracion_jurada"
                               wire:change="$emit('input_declaracion_jurada', $event)" accept="application/pdf">
                        <label for="declaracion_jurada" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
                @endif
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Fotos del Vehículo *
                        <p class="ambos-lados text-left">Obligatorio 4 fotos: una de cada lateral, adelante, atrás.<br> Dónde se vean los daños y al menos una con patente completa visible.</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'vehiculo')->get() as $archivo)
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
                        @error('vehiculo')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="vehiculo" name="vehiculo"
                               wire:change="$emit('input_vehiculo', $event)" accept="image/png,image/jpeg">
                        <label for="vehiculo" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Presupuesto *
                        <p class="ambos-lados text-left">Con detalle de reparación y costo de mano de obra.</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'presupuesto')->get() as $archivo)
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
                        @error('presupuesto')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
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
                <tr style="background-color: rgba(0,0,0,.05);">
                    <td>
                        Descripción de repuestos *
                        <p class="ambos-lados text-left">En caso de necesitar cambios de piezas.</p>
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach($reclamo->documentos()->where('type', 'descripcion_repuestos')->get() as $archivo)
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
                        @error('descripcion_repuestos')<span class="invalid-feedback pl-2" style="font-size: .75rem">{{ $message }}</span> @enderror
                    </td>
                    <td class="text-center">
                        <input type="file" id="descripcion_repuestos" name="descripcion_repuestos"
                               wire:change="$emit('input_descripcion_repuestos', $event)" accept="image/png,image/jpeg">
                        <label for="descripcion_repuestos" class="mt-1">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <span class="subir-archivo-morado mb-0">Agregar</span>
                        </label>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-12">
            <a class="mt-3 boton-enviar-siniestro btn"
               style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
               href='{{ route('siniestros.terceros.paso10.create', ['id' => request('id')])}}'>ANTERIOR</a>
            <input type="submit" class="mt-3 boton-enviar-siniestro btn" value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
        </div>
    </div>

</form>

@include('components.loading')

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
    window.livewire.on('input_cedula', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_cedula', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_carnet', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_carnet', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_formulario_08', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_formulario_08', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_denuncia_administrativa', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_denuncia_administrativa', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_declaracion_jurada', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_declaracion_jurada', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_certificado_cobertura', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_certificado_cobertura', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_carta_franquicia', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_carta_franquicia', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });
    window.livewire.on('input_vehiculo', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_vehiculo', reader.result);
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
    window.livewire.on('input_descripcion_repuestos', function (event) {
        try {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('upload_descripcion_repuestos', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }
    });

</script>
@endsection
