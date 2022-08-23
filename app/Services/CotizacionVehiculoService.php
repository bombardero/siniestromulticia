<?php
namespace App\Services;

use App\Models\CotizacionVehiculo;
use App\Traits\CotizaVehiculoTrait;
use Exception;
use Illuminate\Support\Facades\Storage;

class CotizacionVehiculoService
{
	use CotizaVehiculoTrait;

	

    public function save($campos, $cotizacionCuotas, $coberturasNombres)
    {
    	if($campos['inlineRadioOptions'] == 24)
    	{
    		$tipo = 'MotoVehiculo';
    	} elseif($campos['inlineRadioOptions'] == 3) {
    		$tipo = 'Automotor';
    	}

 		$marca = $this->getNombre($campos['marcas']);
 		$modelo = $this->getNombre($campos['modelos']);
 		$uso = $this->getNombre($campos['usos']);


 		$coberturas = [];

 		$coberturas['nombres'] = $coberturasNombres;
 		$coberturas['cotizaciones'] = $cotizacionCuotas; 

 		$coberturas = serialize($coberturas);
		$cotizacion = CotizacionVehiculo::create([
			'tipo' => $tipo,
			'año' => $campos['año'],
			'marca' => $marca,
			'modelo' => $modelo,
			'usos' => $uso,
			'codigo_postal' => $campos['codigo_postal'],
			'email' => $campos['email'],
			'numero' => $campos['telefono'],
			'coberturas' => $coberturas,
			'provincia' => $campos['provincia']

		]);

		return $cotizacion->id;

    }
}

