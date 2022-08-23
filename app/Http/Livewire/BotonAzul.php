<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BotonAzul extends Component
{
    public $name;
    public $url;
    public function render()
    {

        return view('livewire.boton-azul');
    }
}
