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
            $denuncia = DenunciaSiniestro::find($request->busqueda);
        } else if ($request->tipo == 'dominio' && $request->busqueda) {
            $denuncia = DenunciaSiniestro::where('dominio_vehiculo_asegurado',$request->busqueda)->first();
        } else {
            $denuncia = null;
        }
        return view('backoffice.productores.siniestros.denuncias.index', ['denuncia' => $denuncia]);
    }

    public function show(Request $request, DenunciaSiniestro $denuncia)
    {
        return view('backoffice.productores.siniestros.denuncias.show', ['denuncia' => $denuncia]);
    }
}
