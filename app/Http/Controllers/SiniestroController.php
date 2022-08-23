<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiniestroController extends Controller
{
    public function index()
    {
        return view('siniestros.index'); 
    } 
}
