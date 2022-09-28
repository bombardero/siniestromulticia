<form class="container-fluid" wire:submit.prevent="submit">
    <div class="row">
        <p class="col-12 mt-5 datos-asegurado-title">Datos del asegurado</p>
    </div>

    <div class="form-check">
        <input type="checkbox" wire:model.defer="terminos_condiciones" class="form-check-input"
               id="checkTerminosCondiciones">
        <label class="form-check-label" for="checkTerminosCondiciones">Entiendo que estoy realizando una <b>notificacion
                para INICIAR el trámite de denuncia,</b> un primer contacto con la compañía y no califica como
            denuncia propiamente dicha. </label>
        @error('terminos_condiciones') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="row mt-3">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="dominio">Dominio (*)</label>
                <input type="text" maxlength="7" class="form-control form-estilo" id="dominio"
                       wire:model.defer="dominio">
                @error('dominio') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="fecha">Fecha del Siniestro (*)</label>
                <input type="date" id="fecha" name="fecha" class="form-control form-estilo"
                       wire:model.defer="fecha">
                @error('fecha') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="fecha">Hora del Siniestro (*)</label>
                <input type="time" id="hora" name="hora" class="form-control form-estilo"
                       wire:model.defer="hora">
                @error('hora') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="lugar_siniestro">Lugar del Siniestro (*)</label>
                <input type="text" id="lugar_siniestro" class="form-control form-estilo"
                       wire:model.defer="lugar_siniestro">
                @error('lugar_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="codigo_postal">Código Postal (*)</label>
                <input type="tel" id="codigo_postal" class="form-control form-estilo"
                       wire:model.defer="codigo_postal">
                @error('codigo_postal') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group">
                <label for="direccion_siniestro">Dirección del Siniestro</label>
                <input type="text" id="direccion_siniestro" class="form-control form-estilo"
                       wire:model.defer="direccion_siniestro">
                @error('direccion_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group">
                <label for="conductor_siniestro">Nombre del conductor</label>
                <input type="text" id="conductor_siniestro" name="conductor_siniestro" class="form-control form-estilo"
                       placeholder="Nombre completo"
                       wire:model.defer="conductor_siniestro">
                @error('conductor_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-12 pt-3">
            <div class="form-group">
                <label for="descripcion_siniestro">Descripción del Siniestro</label>
                <textarea id="descripcion_siniestro" class="form-control form-estilo" maxlength="65535"
                          style="resize: none;height: 100px;"
                          wire:model.defer="descripcion_siniestro"></textarea>
                @error('descripcion_siniestro') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="responsable_contacto">Responsable de contacto (*)</label>
                <input type="text" id="responsable_contacto" class="form-control form-estilo"
                       placeholder="Nombre completo"
                       wire:model.defer="responsable_contacto">
                @error('responsable_contacto') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="domicilio">Domicilio (*)</label>
                <input type="text" id="domicilio" class="form-control form-estilo" maxlength="255"
                       placeholder="Domicilio del contacto" wire:model.defer="domicilio">
                @error('domicilio') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
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
                           id="telefono"
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
                           placeholder="Sin 0 y sin 15"
                    >
                </div>
                @error('telefono_confirmation') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email">Email (*)</label>
                <input type="email" id="email" class="form-control form-estilo"
                       placeholder="Email de contacto" wire:model.defer="email">
                @error('email') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email_confirmation">Confirmar Email (*)</label>
                <input type="email" id="email_confirmation" class="form-control form-estilo"
                       placeholder="Repetir email de contacto" wire:model.defer="email_confirmation">
                @error('email_confirmation') <span class="pl-2 text-danger">{{ $message }}</span> @enderror
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
