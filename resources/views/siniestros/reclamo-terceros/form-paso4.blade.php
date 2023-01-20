<form class="" action='{{route("siniestros.terceros.paso2.store")}}' method="post">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container mt-3 form-denuncia-siniestro p-4">

        <div class="row">

            <div class="col-12">
                <span style="color:#6e4697;font-size: 24px;"><b>Paso 4 </b>de 6 | Datos del Vehículo Asegurado</span>
                <hr style="border:1px solid lightgray;">
            </div>



        </div>

        <div class="row">
            <div class="col-12">
                <input type="submit" class="mt-3 boton-enviar-siniestro btn " value='SIGUIENTE' style="background:#6e4697;font-weight: bold;"/>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script src="{{ asset('js/pais_provincia_localidad.js')}}"></script>
<script src="{{ asset('js/marca_modelo.js')}}"></script>

<script type="text/javascript">

</script>
@endsection
