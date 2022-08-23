<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;


class PagoController extends Controller
{
    //
    public function store(Pago $pago)

    {
    

		SDK::setAccessToken("APP_USR-1349056557221820-040818-9a1196b185c0bea8fef47703b8bb3f2a-303826122");

		 $preference = new Preference();
		 
		$item = new Item();
		$item->title = 'Pagar Poliza';
		$item->quantity = 1;
		$item->unit_price = $pago->monto;
		 
		$preference->items = array($item);

		$payer = new Payer();
		$payer->email = Auth::user()->email;
        $preference->back_urls = array(
		    "success" => route('estadoPoliza.show',['solicitud' => $pago->solicitud]),
		    "failure" => route('estadoPoliza.show',['solicitud' => $pago->solicitud]),
		    "pending" => route('estadoPoliza.show',['solicitud' => $pago->solicitud]),
		);
        $preference->external_reference  = $pago->id;
        $preference->notification_url = route('notificacion.pago');
        $preference->payer = $payer;
		$preference->save();

		 return redirect()->to($preference->init_point);


    }

    public function ipnNotificacion()

    {
    		
    	SDK::setAccessToken("APP_USR-1349056557221820-040818-9a1196b185c0bea8fef47703b8bb3f2a-303826122");

    switch($_GET["type"]) {
        case "payment":
            $payment = Payment::find_by_id($_GET["data_id"]);


            Log::debug("pagado totalmente");

		             $pago_id = $payment->external_reference;
		             $pago=Pago::find($pago_id);
		             $pago->update(['status'=>'Pagada','codigo_mp'=>$payment->id]);
		             


            break;
        
    }



	}
}


