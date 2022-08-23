<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Pago;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;
class SolicitudController extends Controller
{
     use HasRoles;


    public function __construct()
    {
        //$this->middleware('auth');


    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
                'valor_alquiler' => 'required',
                'tipo_alquiler' => 'required|exists:cotizacions,tipo_alquiler'
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator)->with('autofocus', true);
        }


        $cotizacion = Cotizacion::where('valor_desde', '<', $request->valor_alquiler)
                ->where('valor_hasta', '>=', $request->valor_alquiler)
                ->where('tipo_alquiler', $request->tipo_alquiler)
                ->first();
                //where('duracion',$request->duracion_contrato)


        if($cotizacion)
        {
            /*return view('solicitud.estado-poliza')->withErrors(['valor_alquiler' => 'El valor del alquiler esta fuera de nuestros parametros'])->with('autofocus', true);            */
           // $this->show($request, $solicitud);

            if(Auth::user()->hasRole('inmobiliaria'))
            {
                $id = Auth::id();
                $estado_inmobiliaria_cuatro = true;
            }
            else
            {
                $id = null;
                $estado_inmobiliaria_cuatro = false;
            }

            $solicitud = Solicitud::create([
                'user_id' => Auth::id(),
                'estado_inquilino_uno' => false,
                'estado_propietario_dos' => false,
                'estado_contrato_tres' => false,
                'estado_inmobiliaria_cuatro' => $estado_inmobiliaria_cuatro,
                'estado_aval_cinco' => false,
                'status' => 'Incompleta',
                'cotizacion_id' => $cotizacion->id,
                'inquilino_id' => null,
                'inmobiliaria_id' => $id,
                'propietario_id' => null,
            ]);

            Pago::create([
            'codigo_mp' => null,
            'referencia_externa' => null,
            'status' => null,
            'monto' => $cotizacion->precio,
            'solicitud_id' => $solicitud->id
            ]);

            return redirect()->route('estadoPoliza.show',['solicitud' => $solicitud]);

        }
        else
        {
            return back()->withErrors(['valor_alquiler' => 'Para el monto solicitado, contactarse con '.config('app.mail_cotizacion_excedida')])->with('autofocus', true);
        }




      /*  return view('solicitud.estado-poliza',['estado' =>$estado,
        'estado_informacion_texto' => $estado_informacion_texto,
        'estado_imagen' => $estado_imagen,
        'datos_poliza' => $datos_poliza,
        'texto_estado' => $texto_estado,
        'precio' => $precio]); */

    }
    public function show(Request $request, Solicitud $solicitud) {

        return view('solicitud.estado-poliza', [

            'solicitud' => $solicitud


        ]);

    }







}
