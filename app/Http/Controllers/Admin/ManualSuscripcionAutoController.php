<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosAnexos;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ManualSuscripcionAutoController extends Controller
{
	
    public function index() 
    {
    	return view('admin.manual-suscripcion-auto',['user' => Auth::user(),'documentos' => DocumentosAnexos::where('tipo', 2)->orderBy('id', 'DESC')->paginate(15)]);
    }

}
