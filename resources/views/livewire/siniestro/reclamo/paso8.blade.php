<form action='{{ route("siniestros.terceros.paso8.store") }}' wire:submit.prevent="submit" method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    @include('partial.archivos_simultaneos')

    @if($reclamo->reclamo_vehicular)
    <div class="row">
        <div class="col-12 mt-2">
            <label><b>Reclamo Vehicular</b></label>
        </div>
    </div>
    <div class="row">
        <div class="form-group text-center col-12 col-md-4">
            <p class="documentos-denuncia-title">DNI Titular *</p>
            <p class="ambos-lados">(Foto de ambos lados)</p>
            <input type="file" id="foto_dni" name="fotos_dni" wire:change="$emit('input_dni', $event)"
                   accept="image/png,image/jpeg"
            >
            <label for="foto_dni">
                <div class="row">
                    <div class="col-12 subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir documento</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'dni')->get() as $archivo)
                <p>
                    <a target="_blank" class="documento-formato-texto pt-2"
                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                    <button style="border:none;background: none;" id="confirmacion-popupa"
                            wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                            class="fas fa-trash-alt"></i>
                    </button>
                </p>
            @endforeach
            @error('dni') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>

        <div class="form-group text-center col-12 col-md-4 ">
            <p class="documentos-denuncia-title">Cédula verde o Título *</p>
            <p class="ambos-lados">(Foto de ambos lados)</p>
            <input type="file" id="foto_cedula" name="fotos_cedula"
                   wire:change="$emit('input_cedula', $event)" accept="image/png,image/jpeg">
            <label for="foto_cedula">
                <div class="row">
                    <div class="col-12 subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir cédula</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'cedula')->get() as $archivo)
                <p>
                    <a target="_blank" class="documento-formato-texto pt-2"
                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                    <button
                        style="border:none;background: none;" id="confirmacion-popupa"
                        wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                            class="fas fa-trash-alt"></i>
                    </button>
                </p>
            @endforeach
            @error('cedula') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>

        <div class="text-center col-12 col-md-4 ">
            <p class="documentos-denuncia-title">Carnet de conducir *</p>
            <p class="ambos-lados">(Foto de ambos lados)</p>
            <input type="file" id="foto_carnet" name="foto_carnet"
                   wire:change="$emit('input_carnet', $event)" accept="image/png,image/jpeg">
            <label for="foto_carnet">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir carnet</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'carnet')->get() as $archivo)
                <p>
                    <a target="_blank" class="documento-formato-texto pt-2"
                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                    <button
                        style="border:none;background: none;" id="confirmacion-popupa"
                        wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                            class="fas fa-trash-alt"></i>
                    </button>
                </p>
            @endforeach
            @error('carnet') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>

        @if($reclamo->vehiculo && $reclamo->vehiculo->en_transferencia)
        <div class="text-center col-12 col-md-4 ">
            <p class="documentos-denuncia-title">Formulario 08 *</p>
            <p class="ambos-lados">Firmado ante escribano</p>
            <input type="file" id="formulario_08" name="formulario_08"
                   wire:change="$emit('input_formulario_08', $event)" accept="image/png,image/jpeg">
            <label for="formulario_08">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir formulario</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'formulario_08')->get() as $archivo)
                <p>
                    <a target="_blank" class="documento-formato-texto pt-2"
                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                    <button
                        style="border:none;background: none;" id="confirmacion-popupa"
                        wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                            class="fas fa-trash-alt"></i>
                    </button>
                </p>
            @endforeach
            @error('formulario_08') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>
        @endif

        @if($reclamo->vehiculo && $reclamo->vehiculo->con_seguro)
            <div class="text-center col-12 col-md-4 ">
                <p class="documentos-denuncia-title">Denuncia Administrativa *</p>
                <p class="ambos-lados">Archivo PDF</p>
                <input type="file" id="denuncia_administrativa" name="denuncia_administrativa"
                       wire:change="$emit('input_denuncia_administrativa', $event)" accept="application/pdf">
                <label for="denuncia_administrativa">
                    <div class="row">
                        <div class="col-12  subir-archivo-bg-morado py-3">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <p class="subir-archivo-morado mb-0">Subir denuncia</p>
                        </div>
                    </div>
                </label>
                @foreach($reclamo->documentos()->where('type', 'denuncia_administrativa')->get() as $archivo)
                    <p>
                        <a target="_blank" class="documento-formato-texto pt-2"
                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                        <button
                            style="border:none;background: none;" id="confirmacion-popupa"
                            wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                class="fas fa-trash-alt"></i>
                        </button>
                    </p>
                @endforeach
                @error('denuncia_administrativa') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
            <div class="text-center col-12 col-md-4 ">
                <p class="documentos-denuncia-title">Certificado de Cobertura *</p>
                <p class="ambos-lados">Archivo PDF</p>
                <input type="file" id="certificado_cobertura" name="certificado_cobertura"
                       wire:change="$emit('input_certificado_cobertura', $event)" accept="application/pdf">
                <label for="certificado_cobertura">
                    <div class="row">
                        <div class="col-12  subir-archivo-bg-morado py-3">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <p class="subir-archivo-morado mb-0">Subir certificado</p>
                        </div>
                    </div>
                </label>
                @foreach($reclamo->documentos()->where('type', 'certificado_cobertura')->get() as $archivo)
                    <p>
                        <a target="_blank" class="documento-formato-texto pt-2"
                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                        <button
                            style="border:none;background: none;" id="confirmacion-popupa"
                            wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                class="fas fa-trash-alt"></i>
                        </button>
                    </p>
                @endforeach
                @error('certificado_cobertura') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
            <div class="text-center col-12 col-md-4 ">
                <p class="documentos-denuncia-title">Carta de Franquicia *</p>
                <p class="ambos-lados">Archivo PDF</p>
                <input type="file" id="carta_franquicia" name="carta_franquicia"
                       wire:change="$emit('input_carta_franquicia', $event)" accept="application/pdf">
                <label for="carta_franquicia">
                    <div class="row">
                        <div class="col-12  subir-archivo-bg-morado py-3">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <p class="subir-archivo-morado mb-0">Subir certificado</p>
                        </div>
                    </div>
                </label>
                @foreach($reclamo->documentos()->where('type', 'carta_franquicia')->get() as $archivo)
                    <p>
                        <a target="_blank" class="documento-formato-texto pt-2"
                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                        <button
                            style="border:none;background: none;" id="confirmacion-popupa"
                            wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                class="fas fa-trash-alt"></i>
                        </button>
                    </p>
                @endforeach
                @error('carta_franquicia') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        @else
            <div class="text-center col-12 col-md-4 ">
                <p class="documentos-denuncia-title">Declaración Jurada de No Seguro *</p>
                <p class="ambos-lados">Exposición Policial dónde declare que no tiene cobertura</p>
                <input type="file" id="declaracion_jurada" name="declaracion_jurada"
                       wire:change="$emit('input_declaracion_jurada', $event)" accept="application/pdf">
                <label for="declaracion_jurada">
                    <div class="row">
                        <div class="col-12  subir-archivo-bg-morado py-3">
                            <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                            <p class="subir-archivo-morado mb-0">Subir archivo</p>
                        </div>
                    </div>
                </label>
                @foreach($reclamo->documentos()->where('type', 'declaracion_jurada')->get() as $archivo)
                    <p>
                        <a target="_blank" class="documento-formato-texto pt-2"
                           href={{$archivo->url}}>{{$archivo->nombre}}</a>
                        <button
                            style="border:none;background: none;" id="confirmacion-popupa"
                            wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                                class="fas fa-trash-alt"></i>
                        </button>
                    </p>
                @endforeach
                @error('declaracion_jurada') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
            </div>
        @endif

        <div class="col-12">
            <hr style="border:1px solid lightgray;">
        </div>

        <div class="text-center col-12 mb-2">
            <p class="documentos-denuncia-title">Fotos del Vehículo *</p>
            <p class="ambos-lados">Obligatorio 4 fotos: una de cada lateral, adelante, atrás. Dónde se vean los daños y al menos una con patente completa visible.</p>
            <input type="file" id="vehiculo" name="vehiculo"
                   wire:change="$emit('input_vehiculo', $event)" accept="image/png,image/jpeg">
            <label for="vehiculo" class="w-100">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir fotos</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'vehiculo')->get() as $archivo)
                <p>
                    <a target="_blank" class="documento-formato-texto pt-2"
                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                    <button
                        style="border:none;background: none;" id="confirmacion-popupa"
                        wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                            class="fas fa-trash-alt"></i>
                    </button>
                </p>
            @endforeach
            @error('vehiculo') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>

        <div class="text-center col-12 col-md-4">
            <p class="documentos-denuncia-title">Presupuesto *</p>
            <p class="ambos-lados">Con detalle de reparación y costo de mano de obra.</p>
            <input type="file" id="presupuesto" name="presupuesto"
                   wire:change="$emit('input_presupuesto', $event)" accept="image/png,image/jpeg">
            <label for="presupuesto">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir fotos</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'presupuesto')->get() as $archivo)
                <p>
                    <a target="_blank" class="documento-formato-texto pt-2"
                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                    <button
                        style="border:none;background: none;" id="confirmacion-popupa"
                        wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                            class="fas fa-trash-alt"></i>
                    </button>
                </p>
            @endforeach
            @error('presupuesto') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>

        <div class="text-center col-12 col-md-4">
            <p class="documentos-denuncia-title">Descripción de repuestos *</p>
            <p class="ambos-lados">En caso de necesitar cambios de piezas</p>
            <input type="file" id="descripcion_repuestos" name="descripcion_repuestos"
                   wire:change="$emit('input_descripcion_repuestos', $event)" accept="image/png,image/jpeg">
            <label for="descripcion_repuestos">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir fotos</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'descripcion_repuestos')->get() as $archivo)
                <p>
                    <a target="_blank" class="documento-formato-texto pt-2"
                       href={{$archivo->url}}>{{$archivo->nombre}}</a>
                    <button
                        style="border:none;background: none;" id="confirmacion-popupa"
                        wire:click.prevent="eliminarArchivo({{$archivo->id}})"><i
                            class="fas fa-trash-alt"></i>
                    </button>
                </p>
            @endforeach
            @error('descripcion_repuestos') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>

    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <a class="mt-3 boton-enviar-siniestro btn"
               style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
               href='{{ route('siniestros.terceros.paso7.create', ['id' => request('id')])}}'>ANTERIOR</a>
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
