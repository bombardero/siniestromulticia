<?php

namespace App\Http\Controllers;

use App\Mail\MailContacto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{

	public function index()
	{
		$start = '09:00:00'; // LLEVAR AL ENV
		$end   = '22:00:00';
		$now   = Carbon::now('UTC');
		$time  = $now->format('H:i:s');
		return view('contacto', [
			'start' =>  $start,
			'end' => $end,
			'time' => $time,
		]);
	}
    public function mail(Request $request)
    {

    	$validator = $this->validateContacto();

		Mail::to(config('app.mail_alta_productor'))->send(new MailContacto($request->telefono));

		return redirect()->route('gracias-contacto');
    }


    protected function validateContacto() {
        return Validator::make(request()->all(), [
            'telefono' => 'required|max:11',
        ]);
    }	    
}
