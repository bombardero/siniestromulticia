<?php

namespace App\Http\Controllers\Siniestros;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Models\City;
use App\Models\DenunciaSiniestro;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Province;
use App\Models\ReclamoTercero;
use App\Models\TipoCalzada;
use App\Models\TipoDocumento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReclamoTerceroController extends Controller
{

    public function index(Request $request)
    {
        $reclamos = ReclamoTercero::latest()->paginate(10);
        $users = User::role('siniestros')->orderBy('name')->get();

        return view('backoffice.siniestros.reclamos.index', ['reclamos' => $reclamos, 'users' => $users]);
    }

    public function show(ReclamoTercero $reclamo)
    {
        return view('backoffice.siniestros.reclamos.show', ['reclamo' => $reclamo]);
    }

}
