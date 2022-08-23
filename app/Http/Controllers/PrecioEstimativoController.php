<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrecioEstimativoController extends Controller
{

    public function showPrecio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valor_alquiler' => 'required|numeric',
            'tipo_alquiler' => 'required|exists:cotizacions,tipo_alquiler'
            // 'duracion_contrato' => 'required|numeric|min:3|max:10',
            ]);


        if($validator->fails())
        {

        	return back()->withErrors($validator)->with('autofocus', true);
        }
 /*       try {
            $cotizacion = Cotizacion::where('duracion',$request->duracion_contrato)
                ->where('valor_desde', '<', $request->valor_alquiler)
                ->where('valor_hasta', '>=', $request->valor_alquiler)
                ->firstOrFail();
            // dd($cotizacion);
        } catch (\Throwable $th) {

            return back()->withErrors(['valor_alquiler' => 'El valor del alquiler esta fuera de nuestros parametros'])->with('autofocus', true);
        } */
        $cotizacion = Cotizacion::where('valor_desde', '<', $request->valor_alquiler)
                ->where('valor_hasta', '>=', $request->valor_alquiler)
                ->where('tipo_alquiler', $request->tipo_alquiler)
                ->first();
        // where('duracion',$request->duracion_contrato)


        if($cotizacion) {
            return view('precio-estimativo-alquileres',['precio' => $cotizacion->precio]);
        }
        return back()->withErrors(['valor_alquiler' => 'Para el monto solicitado, contactarse con '.config('app.mail_cotizacion_excedida')])->with('autofocus', true);
    }


}
