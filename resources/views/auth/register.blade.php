@extends('layouts.app')

@section('content')
<section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
          
              
                    <div class=" text-center">
                        @if(request()->get('state') == 'cliente')
                        <img src="{{url('/images/mobile/icnono cliente-tomador.svg')}}" class="img-fluid pt-4">
                        @else
                        <img src="{{url('/images/mobile/inmobiliaria.svg')}}" class="img-fluid pt-5">

                        @endif
                          
                     </div>    
                    <p class="pt-5 text-center comenza-operar">
                    @if(request()->get('state') == 'cliente')    
                        Registrate y comenzá a operar tus pólizas
                    @elseif(request()->get('state') == 'inmobiliaria')
                        Registrate como inmobiliaria y comenzá a operar tus pólizas
                    @else
                        Registrate y comenzá a operar tus pólizas
                    @endif

                    </p>
                    <form class="pt-md-5 mt-5" method="POST" action="{{ route('register',['state' => request()->get('state') ]) }}">
                        @csrf

                        <div class="form-group row">
                          

                            <div class="col-md-12">
                                 @if(request()->get('state') == 0)
                                <input placeholder="Nombre y Apellido / Razón Social " id="name" type="text" class="mayus form-control form-estilo @error('name') is-invalid @enderror" name="name" value="{{request()->get('name') ?? old('name')  }}" required autocomplete="name" autofocus>
                                @else
                                 <input placeholder="Razón Social " id="name" type="text" class="mayus form-control form-estilo @error('name') is-invalid @enderror" name="name" value="{{$name ?? old('name')  }}" required autocomplete="name" autofocus>
                                @endif
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          

                            <div class="col-md-6 ">
                                <input placeholder="CUIT (debe ser numérico, sin guiones ni puntos)" id="cuit" type="text" class="form-control form-estilo @error('cuit') is-invalid @enderror" name="cuit" value="{{ old('cuit') }}" required autocomplete="cuit" autofocus>

                                @error('cuit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                           
                          

                                <div class="col-md-6 pt-3 pt-md-0 ">
                                    <input placeholder="Teléfono" id="telefono" type="text" class="form-control form-estilo @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
    
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                        </div>

                        <div class="form-group row">
                          

                            <div class="col-md-12">
                                <input placeholder="Dirección de Correo Electrónico "  id="email" type="email" class="form-control form-estilo @error('email') is-invalid @enderror" name="email" value="{{request()->get('email') ?? old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          

                        
                            <div class="col-md-6  ">
                                <select class="mayus custom-select form-estilo prueba w-100" id="provincia_register" name="provincia">
                                     <option value="" selected disable> Provincia</option>
                                     @foreach($provinces as $province) 
                                        <option value={{$province->id }} {{ old('provincia') == $province->id ? 'selected' : '' }}>{{$province->name}}</option>
                                     @endforeach
                                </select>
                                @error('provincia') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                       
                        <div class="col-md-6 pt-3 pt-md-0">
                                
                                <div class="ui-widget" >
                                    <input placeholder="ESCRIBA EL NOMBRE DE LA LOCALIDAD" required name="city"  value="{{ old('city') }}" id="select-city-by-provincia-register" class="mayus form-estilo prueba w-100" autocomplete="off">
                                    <input type="hidden" name="city_id"  value="{{ old('city_id') }}" name="city_id" id="select-city-by-provincia-id-register">
                                </div>
                                

                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            
                               <div class="col-md-6 ">
                                <input placeholder="Dirección " id="direccion" type="text" class="mayus form-control form-estilo @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pt-3 pt-md-0">
                                <input placeholder="Código Postal" id="codigo_postal" type="text" class="form-control form-estilo @error('codigo_postal') is-invalid @enderror" name="codigo_postal" value="{{ old('codigo_postal') }}" required autocomplete="codigo_postal" autofocus>

                                @error('codigo_postal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          

                            <div class="col-md-6 ">
                                <input placeholder="Elige una contraseña de usuario " id="password" type="password" class="form-control form-estilo @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pt-3 pt-md-0">
                                <input placeholder="Repetir contraseña " id="password-confirm" type="password" class="form-control form-estilo" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="pt-4 mx-auto text-center text-md-left">
                                @livewire('boton-azul',['name' => 'Aceptar', 'url' => '/'])
                            </div>
                            
                          
                        </div>
                        @if(request()->get('state') == 'inmobiliaria')
                        <div class=" text-center text-md-left">
                            <p class="registrarme text-center">Estás registrandote como inmobiliaria. <u><a class="text-center registrarme" href="{{ route('register',['state' => 'cliente' ]) }}"> 
                            
                            Registrarme como particular
                            </a></u></a></p>                        
                        </div>
                        @else
                        <div class=" text-center text-md-left">
                            <p class="registrarme text-center">Estás registrandote como particular. <u><a class="text-center registrarme" href="{{ route('register',['state' => 'inmobiliaria' ]) }}"> 
                            
                            Registrarme como inmobiliaria
                            </a></u></a></p>                        
                        </div>

                        @endif
                    </form>
                
           
        </div>
    </div>
</div>
</section>
@endsection

@section('scripts')
{{-- <script>
    $(document).ready(function(){
        $('#provincia').on('change', function() {
            $('#city option').remove()
            var provincia_id = $(this).val()
            var url = '{{ route('city.get', ['city' => ":provincia_id"]) }}'

            url = url.replace(':provincia_id', provincia_id)
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(cities) {
                cities.forEach(city => {
                var o = new Option(city.name + ", " + city.department , city.id)
                $('#city').append(o)
                                })
                    }
            })
    })
    });
</script> --}}
<script>
    $(document).ready(function()
    {

        var ciudades = [];

        $('#provincia_register').on('change', function()
        {
            $('#city_inqui option').remove()
            var provincia_id = $(this).val()
            var url = '{{ route('city.get', ['city' => ":provincia_id"]) }}'

            url = url.replace(':provincia_id', provincia_id)
            $( '#select-city-by-provincia-register' ).val( '' );
            $( '#select-city-by-provincia-id-register' ).val( '' );
            $.ajax(
            {
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(cities) 
                {
                    ciudades = [];

                    cities.forEach(city => 
                    {
                        let obj = {value: city['id'], label: city['name']}
                        ciudades.push(obj)
                    })

                    ciudades.sort((ciudad_a, ciudad_b) => ciudad_a - ciudad_b)

                    $('#select-city-by-provincia-register').autocomplete({
                        minLength: 0,
                        source: ciudades,
                        focus: function( event, ui ) {
                            $( '#select-city-by-provincia-register' ).val( ui.item.label );
                            return false;
                        },
                        select: function( event, ui ) {
                            $( '#select-city-by-provincia-register' ).val( ui.item.label );
                            $( '#select-city-by-provincia-id-register' ).val( ui.item.value );
                            // $( '#select-city-by-provincia-id' ).dispatchEvent(new Event('input'));
                            return false;
                          }
                    })
                    //Este metodo renderiza cada item de la lista.
                    .autocomplete( "instance" )._renderItem = function( ul, item ) {
                        return $( "<li>" )
                            .append( "<div>" + item.label + "</div>" )
                            .appendTo( ul );
                    };
                }
            })
        })

    });
    </script>
<script>
   var numberMask = IMask(
  document.getElementById('cuit'),
  {
    mask: Number,
    min: 00000000000,
    max: 99999999999,
  }); 

</script>
@endsection