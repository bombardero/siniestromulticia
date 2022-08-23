<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;

class PanelInmobiliaria extends Component
{
  
    
    public function render()
    {


    	$cotizacionRuta = "estadoPoliza.create";

        $textFormCotizacion = "Crear solicitud";

        $comunicateNosotros = "";
        $solicitudes = Auth::user()->solicitudes;
       
        if($solicitudes->isNotEmpty()) {

          
            return view('livewire.panel-inmobiliaria',

            [
            'solicitudes' => $solicitudes, 
            'cotizacionRuta'     =>  $cotizacionRuta,
            'textFormCotizacion' =>  $textFormCotizacion,
            'comunicateNosotros' => $comunicateNosotros,
            

        ])
              ->extends('layouts.app')
              ->section('content');
        }
        
        return view('livewire.panel-inmobiliaria',

            [
            'solicitudes' => null,
            'cotizacionRuta'     =>  $cotizacionRuta,
            'textFormCotizacion' =>  $textFormCotizacion,
            'comunicateNosotros' => $comunicateNosotros,


        ])
              ->extends('layouts.app')
              ->section('content');



    

    
}
}
