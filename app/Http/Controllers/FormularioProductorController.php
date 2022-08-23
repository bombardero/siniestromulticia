<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductorRequest;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormularioProductorController extends Controller
{

	public function index()
	{

	    $provinces = Province::with('cities')->get();

	    return view('alta-productor',['provinces' => $provinces]);
	}

	public function mail(StoreProductorRequest $request)
	{

		// $array = $request->all();

		// $array['provincia'] = Province::find($array['provincia']);
		// $array['city_id'] = City::find($array['city_id']);
		
		// Mail::send('mail.mail-alta-productor', $array, function ($mail)
		// {
		// 	$mail->to(config('app.mail_alta_productor'))->subject('Solicitud de alta de productor');
	   	// });

		// return redirect()->to('/gracias');
	}
}
