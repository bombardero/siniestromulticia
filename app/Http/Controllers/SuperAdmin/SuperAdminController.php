<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Image;
use PDF;

class SuperAdminController extends Controller
{

    public function index()
    {
        return view('super-admin.index');
    }



}
