
	<div class="container">
		<div class="row">
			<div class="col-12 pt-5">
				<ul class="nav nav-pills justify-content-center justify-content-md-start" id="pills-tab" role="tablist">
					<li class="nav-item">
					  <a class="nav-link-persona  nav-link tab persona-juridica text-uppercase" id="pills-propietario-juridico" data-toggle="pill" href="#propietario-juridico" role="tab" aria-controls="pills-home" aria-selected="false">Persona Jurídica</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link-persona nav-link tab active persona-humana text-uppercase" id="pills-propietario-humano" data-toggle="pill" href="#propietario-humano" role="tab" aria-controls="pills-profile" aria-selected="true">Persona Humana</a>
					</li>	
				  </ul>
			</div>	

		</div>
		 
		  <div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade" id="propietario-juridico" role="tabpanel" aria-labelledby="pills-propietario-juridico">@livewire('form-propietario',['solicitud' => $solicitud, 'updateMode' => $updateMode])
			</div>
			<div class="tab-pane fade show active" id="propietario-humano" role="tabpanel" aria-labelledby="pills-propietario-humano">@livewire('form-propietariohumano',['solicitud' => $solicitud, 'updateMode' => $updateMode])
			</div>
		  </div>
		 
		        
			
			
	
	</div>
