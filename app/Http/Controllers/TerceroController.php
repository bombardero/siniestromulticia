<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerceroController extends Controller
{
    public function index() {
        return view('siniestros.terceros');
    }
}
