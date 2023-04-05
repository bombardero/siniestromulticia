<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentosAdminRequest;
use App\Models\DocumentosAnexos;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DocumentosAnexosController extends Controller
{

	public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }


  	public function store(StoreDocumentosAdminRequest $request)
    {
        $data = $request->validated();
        $documentType = '';

        // TIPO 1 : ANEXO POLIZA AUTOMOTOR, TIPO 2 : MANUAL SUSCRIPCION AUTO, TIPO 3 : MANUAL SUSCRIPCION MOTO
        if($data['tipo'] == 1) {
        	$documentType = 'anexopolizaautomotor';
        } elseif($data['tipo'] == 2) {
        	$documentType = 'manualsuscripcionauto';
        } elseif($data['tipo'] == 3) {
        	$documentType = 'manualsuscripcionmoto';
        } elseif($data['tipo'] == 4) {
            $documentType = 'condicionesusogrua';
        }
     	$url = $this->fileUploadService->uploadFile($data['file'],$documentType);

        DocumentosAnexos::create([
                'tipo' => $data['tipo'],
                'url' => $url,
        ]);
        session()->flash('success', 'Documento cargado con éxito.');
        return redirect()->route('panel-admin');
    }

    public function indexCondicionesUsoGrua()
    {
        return view('admin.condiciones-uso-grua',['user' => Auth::user(),'documentos' => DocumentosAnexos::where('tipo', 4)->orderBy('id', 'DESC')->paginate(15)]);
    }
}
