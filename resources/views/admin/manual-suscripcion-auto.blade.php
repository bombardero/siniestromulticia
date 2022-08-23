@extends('layouts.app')
	@section('content')
		<section>
		    <div class="container">
		        <div class="row">
		            <div class="col-12 pt-5">
		            	<h1 class="panel-operaciones-title">Hola {{$user->name}}</h1>
		            	<a href="{{route('panel-admin')}}" class="pt-3 panel-admin-volver">Volver al panel</a>
		            	<p class="pt-4 panel-admin-table-title">Historial de carga: Manual suscripción autos</p>
		            	<div class="table-responsive">  
		      			<table class="table">
		  			
		            		<thead class="thead tabla-panel">
		              			<tr class="tabla-cabecera ">
		                			<th class="th-padding" scope="col">Fecha de creación</th>
					                <th class="th-padding" scope="col">ID</th>
					                <th class="th-padding" scope="col">LINK</th>
		  
		              			</tr>
		            		</thead>           
		            		<tbody>
		            		@if($documentos->isEmpty()) 	
		            			<td class="borde-tabla">No hay un manual de suscripción de autos cargados aún.</td>
		            		@else	 	           		
			            		@foreach($documentos as $documento)    
				            		@if($loop->first && $documentos->onFirstPage())
					              		<tr class="borde-tabla ultimo-documento">
					                		<td>{{$documento->created_at}}</td>
					                		<td>{{$documento->id}}</td>
							                <td><a class="ultimo-documento" target="_blank" href="{{$documento->url}}">{{$documento->url}}<img src="{{url('/images/admin/verificado.svg')}}" class="pl-md-3 img-fluid "></a></td>            
					              		</tr>
					              	@else
					              			<tr class="borde-tabla ">
					                		<td>{{$documento->created_at}}</td>
					                		<td>{{$documento->id}}</td>
							                <td><a style="color:black;" target="_blank" href="{{$documento->url}}">{{$documento->url}}</a></td>                
					              		</tr>
				              		@endif
			            		@endforeach
			            	</tbody>
		            		@endif
		      		</table>    
		      		</div>        	                    
	     {{$documentos->links('vendor.pagination.bootstrap-4')}}
		    </div>

		</section>
	@endsection