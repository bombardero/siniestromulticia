<?php

namespace App\Http\Livewire;

use App\Models\Solicitud;
use Livewire\Component;

class Auditoria extends Component
{
	public $solicitud;
	public function mount(Solicitud $solicitud)
	{
		$this->solicitud = $solicitud;
	}
    public function render()
    {
        return view('livewire.auditoria')->extends('layouts.app')->section('content');;
    }
}
