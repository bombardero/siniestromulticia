<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PanelAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.panel-admin',['user' => Auth::user()])->extends('layouts.app')->section('content');
    }
}
