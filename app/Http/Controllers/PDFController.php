<?php

namespace App\Http\Controllers;

use App\Models\DatosPolizaSepelio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PDFController extends Controller
{
    public function generatePDF(DatosPolizaSepelio $poliza)
    {

    	$data = 
    	[
        	'titulo' => 'Siniestro',
        	'poliza' => $poliza,
        	'asegurable' => $poliza->asegurable,
        	'productor' => $poliza->productor,
        	'beneficiarios' => $poliza->beneficiarios,
        	'familia' => $poliza->asegurable->familia
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('sepelio.vista-pdf', $data);
        return $pdf->stream();
    }
}
