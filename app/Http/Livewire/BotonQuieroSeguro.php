<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BotonQuieroSeguro extends Component
{
    public $url;

    public function render()
    {
    	//dd("asd");
        return view('livewire.boton-quiero-seguro');
}

}
