<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormCotizacion extends Component
{

    protected $duraciones = [];
    public $cotizacionRuta;
    public $textFormCotizacion;
    public $comunicateNosotros;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cotizacionRuta, $textFormCotizacion,$comunicateNosotros)
    {
        $this->cotizacionRuta = $cotizacionRuta;
        $this->textFormCotizacion = $textFormCotizacion;
        $this->comunicateNosotros = $comunicateNosotros;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $this->duraciones = [
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            
            
        ];

        return view('components.form-cotizacion',['duraciones' => $this->duraciones]);
    }
}
