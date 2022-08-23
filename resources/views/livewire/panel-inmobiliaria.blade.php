<section>
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5">
                    <h1 class="panel-operaciones-title">Bienvenido, {{Auth::user()->name}}</h1>
                    <p class="pt-3 panel-operaciones-subtitle">Panel de operaciones</p>
                   @livewire('panel-inmobiliaria-table')
                   

                    <div class="pb-4 pt-md-5 pb-md-5 col-12  order-md-3">
                        <div class="card card-formulario mx-auto">
                            <div class="card-body">
                                <h4 class="text-center cotiza-segundo">Nueva solicitud</h4>
                               <x-form-cotizacion :cotizacionRuta="$cotizacionRuta" :textFormCotizacion="$textFormCotizacion" :comunicateNosotros="$comunicateNosotros"/>                                         
                            </div>
                        </div>    
    
                    </div>
                   
            </div>

        </div>
    </div>
</section>

@section('scripts')

<script type="text/javascript">
   
    $(document).ready(function () {
    
        $("#form-cotizacion").submit(function (e) {
   
            $("#btn-cotizacion").attr("disabled", true);
   
            return true;
    
        });
    });
    
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="incompleta"]').tooltip();   
});
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="completa"]').tooltip();   
});
</script>
@endsection