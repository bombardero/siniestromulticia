<?php

namespace App\Http\Controllers\DenunciaSiniestro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DenunciaSiniestro;
use App\Models\Province;
use App\Models\City;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoCalzada;
use App\Models\TipoDocumento;
use App\Models\TipoCarnet;
use Carbon\Carbon;
use Exception;
use PDF;
use Image;

class DenunciaSiniestroAseguradoController extends Controller
{

    public function show(string $id)
    {
        $denuncia = DenunciaSiniestro::where('identificador',$id)->firstOrFail();
        return view('siniestros.show',["denuncia" => $denuncia]);
    }



}
