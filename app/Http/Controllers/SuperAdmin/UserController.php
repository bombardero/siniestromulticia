<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Image;
use PDF;

class UserController extends Controller
{

    public function index()
    {
        return view('super-admin.users.index');
    }



}
