<?php

namespace App\View\Components;

use App\Models\Solicitud;
use Illuminate\View\Component;

class DatosPolizaCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $solicitud;
    public $nombre;
    public $dni;
    public $email;
    public $domicilio;
    public $telefono;
    public $provincia;
    public $localidad;
    public $archivos= [];
    public function __construct($title, Solicitud $solicitud, $nombre, $dni, $email, $domicilio, $telefono, $provincia, $localidad, $archivos)
    {
        $this->title = $title;
        $this->solicitud = $solicitud;
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->email = $email;
        $this->domicilio = $domicilio;
        $this->telefono = $telefono;
        $this->provincia = $provincia;
        $this->localidad = $localidad;
        $this->archivos = $archivos;
        

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.datos-poliza-card');
    }

    public function boot()
    {
        Blade::component('datos-poliza-card', DatosPolizaCardComponent::class);
    }   

   
}
