<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\DocumentosAnexos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
    public function index()
    {
        
        $cotizacionRuta = "precio-estimativo-alquileres";

        $textFormCotizacion = "Cotizá On-Line";

        $comunicateNosotros ="Comunicate con nosotros";
        return view('home', 
          [

            'cotizacionRuta'     =>  $cotizacionRuta,
            'textFormCotizacion' =>  $textFormCotizacion,
            'comunicateNosotros' => $comunicateNosotros,
            'anexoPoliza' => DocumentosAnexos::where('tipo',1)->latest()->first(),
            'manualSuscripcionAuto' => DocumentosAnexos::where('tipo',2)->latest()->first(),
            'manualSuscripcionMoto' => DocumentosAnexos::where('tipo',3)->latest()->first()
          ]);
    }

   /*
   ------------------ COTIZACIONES------------------
   Duracion desde 0 - X
   Duracion hasta X - Y

   Valor desde 0 - X
   Valor hasta X - Y

   OPCIONES
   TABLA DURACION
   TABLA VALOR

   PRECIO = CALCULO TABLA DURACION + TABLA VALOR

   
   */
    
}
