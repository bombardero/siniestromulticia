<?php

namespace App\Http\Livewire\SiniestroSisUnico;

use Livewire\Component;

class DenunciaAsegurado extends Component
{
    public function render()
    {
        return view('livewire.siniestrosisunico.denuncia-asegurado');
    }

    public function submit(){
        dd("a");
    }
}
