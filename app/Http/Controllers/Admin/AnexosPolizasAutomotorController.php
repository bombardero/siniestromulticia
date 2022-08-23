<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosAnexos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnexosPolizasAutomotorController extends Controller
{

    public function index() 
    {
    	return view('admin.anexos-polizas-automotor',['user' => Auth::user(),'documentos' => DocumentosAnexos::where('tipo', 1)->orderBy('id', 'DESC')->paginate(15)]);
    }   
     
}
