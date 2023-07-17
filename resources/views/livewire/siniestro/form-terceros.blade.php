<form class="container-fluid" wire:submit.prevent="submit">

    <div class="row mt-3">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="lugar_siniestro">Lugar del Siniestro (*)</label>
                <input type="text" id="lugar_siniestro" class="form-control form-estilo"
                       wire:model.defer="lugar_siniestro">
                @error('lugar_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="fecha_tercero">Fecha del Siniestro (*)</label>
                <input type="date" id="fecha_tercero" class="form-control form-estilo"
                       wire:model.defer="fecha_siniestro">
                @error('fecha_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="hora_tercero">Hora del Siniestro (*)</label>
                <input type="time" id="hora_tercero" class="form-control form-estilo"
                       wire:model.defer="hora_siniestro">
                @error('hora_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="dominio">Dominio del vehículo propio (*)</label>
                <input type="text" id="dominio" class="form-control form-estilo text-uppercase"
                       maxlength="7" wire:model.defer="dominio">
                @error('dominio') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="dominio">Dominio del vehículo asegurado (*)</label>
                <input type="text" id="dominio_asegurado" class="form-control form-estilo text-uppercase"
                       wire:model.defer="dominio_asegurado" maxlength="7">
                @error('dominio_asegurado') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="direccion_siniestro">Dirección del Siniestro</label>
                <input type="text" id="direccion_siniestro" class="form-control form-estilo"
                       wire:model.defer="direccion_siniestro">
                @error('direccion_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="descripcion_siniestro">Descripción del Siniestro</label>
                <textarea id="descripcion_siniestro" class="form-control form-estilo" style="resize: none;height: 100px;"
                          maxlength="65535" wire:model.defer="descripcion_siniestro"></textarea>
                @error('descripcion_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 mb-2">
            <label class="form-check-label">Tipos de reclamos (*)</label>
        </div>

        <div class="col-12 col-md-4 mb-2">
            <div class="form-group mb-0 form-check">
                <input type="checkbox" class="form-check-input"
                       id="reclamo_vehicular" name="reclamo_vehicular"
                       wire:model.defer="reclamo_vehicular"
                >
                <label class="form-check-label" for="reclamo_vehicular">Daño Vehicular</label>
            </div>
        </div>
        <div class="col-12 mb-2 col-md-4">
            <div class="form-group mb-0 form-check">
                <input type="checkbox" class="form-check-input"
                       id="reclamo_danios_materiales" name="reclamo_danios_materiales"
                       wire:model.defer="reclamo_danios_materiales"
                >
                <label class="form-check-label" for="reclamo_danios_materiales">Daños a cosas materiales<br><span style="font-size: .85rem;">Cualquier daño a la propiedad sin considerar un vehículo</span></span></label>
            </div>
        </div>
        <div class="col-12 mb-2 col-md-4">
            <div class="form-group mb-0 form-check">
                <input type="checkbox" class="form-check-input"
                       id="reclamo_lesiones" name="reclamo_lesiones"
                       wire:model.defer="reclamo_lesiones"
                >
                <label class="form-check-label" for="reclamo_lesiones">Lesiones</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                @error('reclamo_tipos') <span class="pl-3 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="responsable_contacto">Responsable de contacto (*)</label>
                <input type="text" id="responsable_contacto" class="form-control form-estilo"
                       placeholder="Nombre completo" maxlength="255"
                       wire:model.defer="responsable_contacto">
                @error('responsable_contacto') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="telefono">Teléfono móvil (*)</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text form-estilo">+54</span>
                    </div>
                    <input type="tel" class="form-control form-estilo"
                           id="telefono" maxlength="10"
                           wire:model.defer="telefono"
                           placeholder="Sin 0 y sin 15">
                </div>
                @error('telefono') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="telefono">Confirmar teléfono móvil (*)</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text form-estilo">+54</span>
                    </div>
                    <input type="tel" class="form-control form-estilo" wire:model.defer="telefono_confirmation"
                           placeholder="Sin 0 y sin 15" maxlength="10"
                    >
                </div>
                @error('telefono_confirmation') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email">Email (*)</label>
                <input type="text" class="form-control form-estilo" id="email"
                       placeholder="Email de contacto" wire:model.defer="email">
                @error('email') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email">Confirmar Email (*)</label>
                <input type="email" class="form-control form-estilo" id="email_confirmation"
                       placeholder="  Repetir email de contacto*" wire:model.defer="email_confirmation">
                @error('email_confirmation') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-check mt-3">
                <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input"
                       id="checkTerminosCondiciones">
                <label class="form-check-label" for="checkTerminosCondiciones">Entiendo que estoy iniciando <b>proceso de
                        reclamo,</b> un primer contacto con la compañía y <b>no califica como Denuncia</b> propiamente dicha.
                </label>
                @error('terminos_condiciones') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 text-right">
            <p class="campos-obligatorios pt-3">(*) Campos son obligatorios.</p>
        </div>

        <div class="col-12 text-center text-md-right">
            <div wire:loading class="spinner-border" role="status">
                <span class="sr-only">Cargando...</span>
                <span class="sr-only">Cargando...</span>
            </div>
            <button type="submit" class="boton-enviar-siniestro btn">Enviar</button>
        </div>
    </div>

</form>

