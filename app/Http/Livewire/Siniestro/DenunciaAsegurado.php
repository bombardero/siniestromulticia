<?php

namespace App\Http\Livewire\Siniestro;

use Livewire\Component;

class DenunciaAsegurado extends Component
{
    public function render()
    {
        return view('livewire.siniestro.denuncia-asegurado');
    }

    public function submit(){
        dd("a");
    }
}
