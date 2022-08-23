<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosAnexos;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ManualSuscripcionMotoController extends Controller
{

    public function index() 
    {
    	return view('admin.manual-suscripcion-moto',['user' => Auth::user(),'documentos' => DocumentosAnexos::where('tipo', 3)->orderBy('id', 'DESC')->paginate(15)]);
    }

}
