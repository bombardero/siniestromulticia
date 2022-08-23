<?php

namespace App\Http\Livewire;

use App\Models\Solicitud;
use Livewire\Component;

class PanelOperario extends Component
{
    public function render()
    {
        return view('livewire.panel-operario')->extends('layouts.app')->section('content');
    }
}
