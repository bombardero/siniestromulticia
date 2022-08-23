<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductorController extends Controller
{
    public function index()
    {
        return view('productor.index'); 
    } 
}