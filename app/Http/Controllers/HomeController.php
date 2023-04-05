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
        $cotizacionRuta = 'precio-estimativo-alquileres';
        $textFormCotizacion = 'Cotizá On-Line';
        $comunicateNosotros = 'Comunicate con nosotros';
        return view('home',
            [
                'cotizacionRuta' => $cotizacionRuta,
                'textFormCotizacion' => $textFormCotizacion,
                'comunicateNosotros' => $comunicateNosotros,
                'anexoPoliza' => DocumentosAnexos::where('tipo', 1)->latest()->first(),
                'manualSuscripcionAuto' => DocumentosAnexos::where('tipo', 2)->latest()->first(),
                'manualSuscripcionMoto' => DocumentosAnexos::where('tipo', 3)->latest()->first(),
                'condicionesUsoGrua' => DocumentosAnexos::where('tipo', 4)->latest()->first()
            ]);
    }

}
