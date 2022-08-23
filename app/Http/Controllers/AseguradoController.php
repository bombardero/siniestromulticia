<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AseguradoController extends Controller
{
    public function index() {
        return view('siniestros.asegurados');
    }
}
