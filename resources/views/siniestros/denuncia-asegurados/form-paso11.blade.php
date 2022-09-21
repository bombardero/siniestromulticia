@extends('layouts.app')
@section('content')
<section style="background-color: rgba(240, 240, 240, 0.29);">
    <div class="container">
        <div class="row ">
            <div class="col-12 ">
                <div class="container w-75 container-page">

                <h2 class="pt-5 6xl" style="font-family: Roboto;color:#545358;font-size: 30px;">Denuncia de Siniestros | Asegurado </h2>
                </div>
            </div>
        </div>

        @livewire('siniestro.denuncia-asegurado-paso11', ['denuncia_siniestro' => $denuncia_siniestro, 'identificador' => $denuncia_siniestro->identificador])


@endsection

@section('scripts')

<script>
    window.livewire.on('single_file_choosed_dni', function() {
        console.log("test");
                try {

                    let file = event.target.files[0];
                    if(file){
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

     </script>

<script>
    window.livewire.on('single_file_choosed_cedula', function() {
        console.log("test");
                try {

                    let file = event.target.files[0];
                    if(file){
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

</script>

<script>
    window.livewire.on('single_file_choosed_carnet', function() {
        console.log("test");
                try {

                    let file = event.target.files[0];
                    if(file){
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

</script>

<script>
    window.livewire.on('single_file_choosed_vehiculo', function() {
        console.log("test");
                try {

                    let file = event.target.files[0];
                    if(file){
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

</script>
<script>
    window.livewire.on('single_file_choosed_recibo', function() {
        console.log("test");
                try {

                    let file = event.target.files[0];
                    if(file){
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

</script>
<script>
    window.livewire.on('single_file_choosed_policial', function() {
        console.log("test");
                try {

                    let file = event.target.files[0];
                    if(file){
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

</script>
<script>
    window.livewire.on('single_file_choosed_habilitacion', function() {
        console.log("test");
                try {

                    let file = event.target.files[0];
                    if(file){
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
