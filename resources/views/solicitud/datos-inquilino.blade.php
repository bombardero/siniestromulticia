
	<div class="container">
		<div class="row">
			<div class="col-12 pt-5">
				<ul class="nav nav-pills justify-content-center justify-content-md-start" id="pills-tab" role="tablist">
					<li class="nav-item">
					  <a class="nav-link-persona  nav-link tab  persona-juridica text-uppercase" id="pills-home-tab" data-toggle="pill" href="#persona-juridica" role="tab" aria-controls="pills-home" aria-selected="false">Persona Jurídica</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link-persona nav-link tab active persona-humana text-uppercase" id="pills-profile-tab" data-toggle="pill" href="#persona-humana" role="tab" aria-controls="pills-profile" aria-selected="true">Persona Humana</a>
					</li>	
				  </ul>
			</div>	

		</div>
		 
		  <div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade" id="persona-juridica" role="tabpanel" aria-labelledby="pills-home-tab">@livewire('form-inquilino',['solicitud' => $solicitud, 'updateModeJur' => $updateMode])
			</div>
			<div class="tab-pane fade show active" id="persona-humana" role="tabpanel" aria-labelledby="pills-profile-tab">@livewire('form-inquilinohumano',['solicitud' => $solicitud, 'updateModeHum' => $updateMode])
			</div>
		  </div>
		 
		        
			
			
	
	</div>
