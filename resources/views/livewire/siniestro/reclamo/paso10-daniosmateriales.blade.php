<form wire:submit.prevent="submit" method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    @include('partial.archivos_simultaneos')

    <div class="row">
        <div class="text-center col-12 col-md-4 ">
            <p class="documentos-denuncia-title">Denuncia o Exposición Policial *</p>
            <p class="ambos-lados">Foto</p>
            <input type="file" id="denuncia_policial" name="denuncia_policial"
                   wire:change="$emit('input_denuncia_policial', $event)" accept="image/png,image/jpeg">
            <label for="denuncia_policial">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir denuncia</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'dm_denuncia_policial')->get() as $archivo)
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
            @error('denuncia_policial') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>
        <div class="text-center col-12 col-md-4 ">
            <p class="documentos-denuncia-title">DNI del Propietario *</p>
            <p class="ambos-lados">Foto de ambos lados</p>
            <input type="file" id="dni_propietario" name="dni_propietario"
                   wire:change="$emit('input_dni_propietario', $event)" accept="image/png,image/jpeg">
            <label for="dni_propietario">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir documento</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'dm_dni_propietario')->get() as $archivo)
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
            @error('dni_propietario') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>
        <div class="text-center col-12 col-md-4 ">
            <p class="documentos-denuncia-title">Escritura de la propiedad o Contrato de alquiler *</p>
            <p class="ambos-lados">Archivo PDF</p>
            <input type="file" id="escritura_contrato_alquiler" name="escritura_contrato_alquiler"
                   wire:change="$emit('input_escritura_contrato_alquiler', $event)" accept="application/pdf">
            <label for="escritura_contrato_alquiler">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir denuncia</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'dm_escritura_contrato_alquiler')->get() as $archivo)
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
            @error('escritura_contrato_alquiler') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
        </div>
        <div class="text-center col-12 col-md-4 ">
            <p class="documentos-denuncia-title">Fotos de los daños *</p>
            <p class="ambos-lados">Fotos</p>
            <input type="file" id="fotos_danios" name="fotos_danios"
                   wire:change="$emit('input_fotos_danios', $event)" accept="image/png,image/jpeg">
            <label for="fotos_danios">
                <div class="row">
                    <div class="col-12  subir-archivo-bg-morado py-3">
                        <i class="fa-solid fa-upload fa-xl" style="color:#636393;"></i>
                        <p class="subir-archivo-morado mb-0">Subir denuncia</p>
                    </div>
                </div>
            </label>
            @foreach($reclamo->documentos()->where('type', 'dm_fotos_danios')->get() as $archivo)
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
            @error('fotos_danios') <span class="invalid-feedback pl-2">{{ $message }}</span> @enderror
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
            @foreach($reclamo->documentos()->where('type', 'dm_presupuesto')->get() as $archivo)
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
