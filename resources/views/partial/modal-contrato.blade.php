@if($solicitud->estado_contrato_tres == false)
         
<div class="modal fade bd-example-modal-lg contrato" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        @livewire('contrato',['solicitud' => $solicitud, 'updateMode' => false])
      </div>
    </div>
</div>
<div type="button" data-toggle="modal" data-target=".contrato" class="datos-poliza mx-md-auto my-2 my-md-0 col-12 col-md-2">
   
        <div class="row">
                    <div class="pt-md-3 col-2 col-md-12 text-right text-md-center order-3 order-md-1">
                        <img class="pt-2 img-fluid" src="{{url('/images/mobile/alert-circle.svg')}}">
                    </div>
                    <div class="col-7 col-md-12 order-1 order-md-2">
                       <p class="pt-2 pt-md-4 informacion-dato-poliza text-left text-md-center  ">Contrato</p> 

                      


                    </div>
                    <div class="col-3 col-md-12 order-2 order-md-3">
                        <p class="pt-2 pt-md-4 estado-dato-poliza text-right text-md-center ">Incompleto</p>
                    </div>
         </div>
                
         
    
</div>
@else
 <!----------------PASO 1 : INQUILINO PARA EDITAR --------------------------->
 <div class="modal fade bd-example-modal-lg contrato" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        @livewire('contrato',['solicitud' => $solicitud, 'updateMode' => true])
      </div>
    </div>
</div>
 <div type="button" data-toggle="modal" data-target=".contrato" class="datos-poliza-ok mx-md-auto my-2 my-md-0 col-12 col-md-2">
    <div class="row">
        <div class="pt-md-3 col-2 col-md-12 text-right text-md-center order-3 order-md-1">
            <img class="pt-2 img-fluid" src="{{url('/images/mobile/done.svg')}}">
        </div>
        <div class="col-7 col-md-12 order-1 order-md-2">
           <p class="pt-2 pt-md-4 informacion-dato-poliza-ok text-left text-md-center  ">Contrato</p> 

          


        </div>
        <div class="col-3 col-md-12 order-2 order-md-3">
        <p class="pt-2 pt-md-4 estado-dato-poliza-ok text-right text-md-center ">Completo</p>
        </div>
    </div>
    
</div>



@endif