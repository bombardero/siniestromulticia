<section>
    <div class="container pb-5">
        <div class="row">
            <div class="col-12 pt-5">

            @if (\Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! \Session::get('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

                    <h1 class="panel-operaciones-title">Hola {{$user->name}}</h1>
                    <p class="pt-3 panel-admin-title">Panel de Administración de documentos y anexos</p>
                     @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                     @error('tipo') <span class="text-danger">{{ $message }}</span> @enderror
                  	<div class="pt-4 container">
                        <div class="row">
                            <div class="col-8 col-md-10">
                                <a class="panel-admin-subtitle" href="{{ route('panel-admin.condiciones-uso-grua') }}">Condiciones uso de Grúa</a>
                            </div>
                            <div class="col-4 col-md-2 d-flex justify-content-end">
                                <a href="{{ route('panel-admin.condiciones-uso-grua') }}"><img src="{{url('/images/admin/view-details 4.svg')}}" class="pr-md-3 img-fluid "></a>
                                @include('partial.modal-agregar-condiciones-uso-grua')
                            </div>
                        </div>
                        <hr style="border: 1px solid rgba(45, 45, 123, 0.5);">
                        <div class="row">
                  		 	<div class="col-8 col-md-10">
                  		 		<a class="panel-admin-subtitle" href="{{route('anexos-polizas-automotor')}}">Anexos pólizas de automotor</a>
                  		 	</div>
                  		 	<div class="col-4 col-md-2 d-flex justify-content-end">
                  		 		<a href="{{route('anexos-polizas-automotor')}}"><img src="{{url('/images/admin/view-details 4.svg')}}" class="pr-md-3 img-fluid "></a>
                                @include('partial.modal-agregar-anexo')
                            </div>
                  		 </div>
                        <hr style="border: 1px solid rgba(45, 45, 123, 0.5);">
                        <div class="row">
                            <div class="col-8 col-md-10">
                                <a class="panel-admin-subtitle" href="{{route('manual-suscripcion-automotor')}}">Manual de suscripción autos</a>
                            </div>
                  		 	<div class="col-4 col-md-2 d-flex justify-content-end">
                  		 		<a href="{{route('manual-suscripcion-automotor')}}"><img src="{{url('/images/admin/view-details 4.svg')}}" class="pr-md-3 img-fluid "></a>
                                 @include('partial.modal-agregar-manual-suscripcion-auto')
                            </div>
                       </div>
                        <hr style="border: 1px solid rgba(45, 45, 123, 0.5);">
                        <div class="row">
                            <div class="col-8 col-md-10">
                                <a class="panel-admin-subtitle" href="{{route('manual-suscripcion-moto')}}">Manual de suscripción motos</a>
                            </div>
                  		 	<div class="col-4 col-md-2 d-flex justify-content-end">
                  		 		<a href="{{route('manual-suscripcion-moto')}}"><img src="{{url('/images/admin/view-details 4.svg')}}" class="pr-md-3 img-fluid "></a>
                                @include('partial.modal-agregar-manual-suscripcion-moto')
                            </div>
                       </div>
                    </div>

        </div>
    </div>
</section>



@section('scripts')

  <script>
    document.querySelector("#file").onchange = function(){
        document.querySelector("#file-name").textContent = this.files[0].name;
    }
    document.querySelector("#file-two").onchange = function(){
        document.querySelector("#file-manual-suscripcion-auto").textContent = this.files[0].name;
    }
    document.querySelector("#file-three").onchange = function(){
        document.querySelector("#file-suscripcion-moto").textContent = this.files[0].name;
    }
    document.querySelector("#file-condiciones-uso-grua").onchange = function(){
        document.querySelector("#file-name-condiciones-uso-grua").textContent = this.files[0].name;
    }
  </script>
@endsection

}
