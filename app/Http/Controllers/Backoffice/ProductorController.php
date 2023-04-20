<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\DenunciaSiniestro;
use Illuminate\Http\Request;

class ProductorController extends Controller
{
    public function index(Request $request)
    {
        if($request->tipo == 'id' && $request->busqueda)
        {
            $denuncias = DenunciaSiniestro::where('id',$request->busqueda)->get();
        } else if ($request->tipo == 'dominio' && $request->busqueda) {
            $denuncias = DenunciaSiniestro::where('dominio_vehiculo_asegurado',$request->busqueda)->get();
        } else {
            $denuncias = collect([]);
        }
        return view('backoffice.productores.siniestros.denuncias.index', ['denuncias' => $denuncias]);
    }

    public function show(Request $request, DenunciaSiniestro $denuncia)
    {
        return view('backoffice.productores.siniestros.denuncias.show', ['denuncia' => $denuncia]);
    }
}
