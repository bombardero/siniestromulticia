@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="pt-5 6xl" style="font-family: Roboto;color:#545358;font-size: 30px;">Denuncia de Siniestros |
                    Asegurado </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <label class="" style="font-size: 12px">
                    Los campos marcados con un asterisco son obligatorios. Los datos ingresados seran guardados
                    automaticamente en
                    nuestro sistema.
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <label class="text-danger" style="font-size: 12px">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Se recomienda cargar este formulario desde una computadora
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <label class="text-danger" style="font-size: 12px">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Tenga en cuenta que una vez completados todos los pasos no podrá editar la denuncia.
                </label>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-10 offset-md-1 px-0">
            @livewire('siniestro.denuncia-asegurado-paso11', ['denuncia_siniestro' => $denuncia_siniestro,
            'identificador' => $denuncia_siniestro->identificador])
        </div>
    </div>

@endsection

@section('scripts')
<script>
    window.livewire.on('single_file_choosed_dni', function () {
        console.log("test");
        try {

            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onloadend = () => {
                    console.log(reader.result);
                    window.livewire.emit('upload_dni', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }

    });

    window.livewire.on('single_file_choosed_cedula', function () {
        console.log("test");
        try {

            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onloadend = () => {
                    console.log(reader.result);
                    window.livewire.emit('upload_cedula', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }

    });

    window.livewire.on('single_file_choosed_carnet', function () {
        console.log("test");
        try {

            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onloadend = () => {
                    console.log(reader.result);
                    window.livewire.emit('upload_carnet', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }

    });


    window.livewire.on('single_file_choosed_vehiculo', function () {
        console.log("test");
        try {

            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onloadend = () => {
                    console.log(reader.result);
                    window.livewire.emit('upload_vehiculo', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }

    });


    window.livewire.on('single_file_choosed_recibo', function () {
        console.log("test");
        try {

            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onloadend = () => {
                    console.log(reader.result);
                    window.livewire.emit('upload_recibo', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }

    });

    window.livewire.on('single_file_choosed_policial', function () {
        console.log("test");
        try {

            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onloadend = () => {
                    console.log(reader.result);
                    window.livewire.emit('upload_policial', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }

    });

    window.livewire.on('single_file_choosed_habilitacion', function () {
        console.log("test");
        try {

            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();

                reader.onloadend = () => {
                    console.log(reader.result);
                    window.livewire.emit('upload_habilitacion', reader.result);
                }
                reader.readAsDataURL(file);
            }
        } catch (error) {
            console.log(error);
        }

    });

</script>
@endsection
