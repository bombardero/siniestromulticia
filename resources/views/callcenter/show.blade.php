@extends('layouts.app')
@section('content')
<section>                                                                     
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5">          
                    <p class="pt-3 panel-operaciones-subtitle">#{{$cotizacion->id}}</p>
                    <div class="container">
                      <div class="row">
                        <div class="col-9">
                          <div class="row">
                            <div class="col-3">
                              <span class="estilo-cotizacion">TIPO DE VEHICULO</span>
                              <p class="estilo-cotizacion-title">{{$cotizacion->tipo}}</p>
                            </div>
                            <div class="col-3">
                               <span class="estilo-cotizacion">MARCA</span>
                               <p class="estilo-cotizacion-title">{{$cotizacion->marca}}</p>
                            </div>
                            <div class="col-3">
                               <span class="estilo-cotizacion">MODELO</span>
                               <p class="estilo-cotizacion-title">{{$cotizacion->modelo}}</p>
                            </div>
                            <div class="col-3">
                               <span class="estilo-cotizacion">AÑO</span>      
                               <p class="estilo-cotizacion-title">{{$cotizacion->año}}</p>
                            </div>                                                                                    
                          </div>
                                              
                        </div>
                      </div>
                      <div class="row pt-4">
                        <div class="col-9">
                          <div class="row">
                            <div class="col-3">
                              <span class="estilo-cotizacion">USO</span>
                              <p class="estilo-cotizacion-title">{{$cotizacion->usos}}</p>
                            </div>
                            <div class="col-3">
                               <span class="estilo-cotizacion">CP</span>
                               <p class="estilo-cotizacion-title">{{$cotizacion->codigo_postal}}</p>
                            </div>
                            <div class="col-3">
                               <span class="estilo-cotizacion">CELULAR</span>
                               <p class="estilo-cotizacion-title">{{$cotizacion->numero}}</p>
                            </div>
                            <div class="col-3">
                               <span class="estilo-cotizacion">EMAIL</span>      
                               <p class="estilo-cotizacion-title">{{$cotizacion->email}}</p>
                            </div>                                                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="pt-5">
                            <div class="table-responsive">  
                              <table class="table">
                                    <thead class="thead tabla-panel">
                                      <tr class="tabla-cabecera ">
                                        <th class="th-padding estilo-cotizacion" scope="col">NOMBRE COBERTURA</th>
                                        <th class="th-padding estilo-cotizacion" scope="col">TARIFA</th>
                                      </tr>
                                    </thead>
                                   
                                    <tbody>    
                                      @for($i = 0; $i<sizeof(unserialize($cotizacion->coberturas)['nombres']) ; $i++)
                                        <tr class="borde-tabla">
                                        <td class="estilo-cotizacion-title">{{unserialize($cotizacion->coberturas)['nombres'][$i]}}</td>
                                        <td class="estilo-cotizacion-title">${{unserialize($cotizacion->coberturas)['cotizaciones'][$i]}}</td>
                                        </tr>
                                      @endfor
                                        </div>
                                    </tbody>
                              </table>                            
                          </div>
                                                       
                        </div>
            </div>

        </div>
    </div>
</section>


@endsection
