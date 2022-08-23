<?php
namespace App\Services;

use App\Events\EstadoSolicitudCambio;
use App\Models\DocumentoPoliza;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DocumentoService
{
    public function createPoliza($url, $documentType, $solicitud,$type)
    {

		$dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
		$name = $documentType.'_'.$dateName;
		DocumentoPoliza::create([
			'type' =>  $type,
			'nombre' => $name,
			'url' => $url,
			'solicitud_id' => $solicitud->id,
		]);  
    }

    public function checkDocumentNumber($solicitud,$type)
    {
	
	}

    public function updateDocument($solicitud,$estado)
    {
    	return $solicitud->update([$estado => true]);
    }

    public function dispatchSolicitudCambio($solicitud,$estado)
    {
	   EstadoSolicitudCambio::dispatch($solicitud,$estado);

	   if($solicitud->status == 'Rechazada'){
	  		$solicitud->update(['status' => 'Completa']);
	  		EstadoSolicitudCambio::dispatch($this->solicitud);
	  	}    	
    }
}