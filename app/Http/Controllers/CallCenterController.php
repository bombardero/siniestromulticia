<?php

namespace App\Http\Controllers;

use App\Models\CotizacionVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CallCenterController extends Controller
{
    public function index()
    {
    	// DATOS HARDCODEADOS
 	// 	$coberturas = [];
 	// 	$coberturasNombres = ['COTIZACION A', 'COTIZACION B', 'COTIZACION C'];
 	// 	$cotizacionCuotas = ['1000', '2000', '3000'];
 		
 	// 	$coberturas['nombres'] = $coberturasNombres;
 	// 	$coberturas['cotizaciones'] = $cotizacionCuotas; 

		// $coberturas = serialize($coberturas);
		// $cotizacion = CotizacionVehiculo::create([
		// 	'tipo' => 'Automotor',
		// 	'año' => '2017',
		// 	'marca' => 'FIAT',
		// 	'modelo' => 'ARGOS 1.6',
		// 	'usos' => 'PARTICULAR',
		// 	'codigo_postal' => '4000',
		// 	'email' => 'patricioivan1999@gmail.com',
		// 	'numero' => '3815860461',
		// 	'coberturas' => $coberturas,

		// ]);
    	$cotizaciones = CotizacionVehiculo::paginate(20);

    	return view('callcenter.index', ['cotizaciones' => $cotizaciones]);
    }

    public function show(CotizacionVehiculo $cotizacion)
    {

    	return view('callcenter.show', ['cotizacion' => $cotizacion]);	
    }
}
