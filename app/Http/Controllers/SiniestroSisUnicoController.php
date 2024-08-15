<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiniestroSisUnicoController extends Controller
{
    public function index()
    {
        return view('siniestrossisunico.index'); 
    } 
}
