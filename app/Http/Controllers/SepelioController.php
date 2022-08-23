<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SepelioController extends Controller
{
    public function index()
    {
        
        return view('sepelio.formulario-solicitud-sepelio'); 
    } 

}
