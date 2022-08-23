<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $idSelect;
    public $collection;
    public $tipo;
    public function __construct($tipo, $idSelect = 'marcas', $collection = null)
    {
        $this->tipo = $tipo;
        $this->idSelect = $idSelect;        
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.select');
    }
}
