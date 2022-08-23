<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class OperarioController extends Controller
{
     public function update(Request $request, $id)
    {
    	 $validator = Validator::make($request->all(), [
                'monto' => 'required | numeric',

            ]);
    
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator); 
            }
         $solicitud =    Solicitud::where('id', $id)->first();
    	 
    	 Pago::where('solicitud_id', $solicitud->id)->update(['monto' => $request->monto]);

    	 return redirect()->back();
    }
}
