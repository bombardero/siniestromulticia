<div wire:ignore class="card card-datos-sepelio w-75 mx-auto mb-4">
  		<div class="card-body">
    		<p class="sepelios-title">FIRMA DEL ASEGURADO TITULAR</p>
	        <div class="form-group row">
	        		<div class="col-12">
	        			<div class="js-signature canvas" data-height="200" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="true"></div>
	        		</div>
	        	<div class="col-12 pt-5 pt-md-0">
					<p><button id="clearBtn" class="btn btn-default" onclick="clearCanvas(event);">Borrar firma</button>&nbsp
						<button disabled id="saveBtn" class="btn btn-default" onclick="saveSignature(event);" >Confirmar Firma</button>
					</p>

	        	</div>
				<div class="col-12" id="signature">
				</div> 	
        	</div>
        	      	
        </div>        	    	         	
 </div>

 <script>
 	

 </script>

<style>
	 @media (min-width: 0px) and (max-width: 767px) {
		
		.canvas {

		  	width: 100% !important;
		  	height: 20vh !important;
		}
		
	 }
	 .canvas {		 
		  	width: 100%;
		}
</style>