<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentosAdminRequest;
use App\Models\DocumentosAnexos;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        }
     	$url = $this->fileUploadService->uploadFile($data['file'],$documentType);

        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
    
        DocumentosAnexos::create([
                'tipo' => $data['tipo'],
                'url' => $url,
        ]);
        session()->flash('success', 'Documento cargado con éxito.');
        return redirect()->route('panel-admin');

        // $documents_number = DocumentosAnexos::where('type', $data->tipo)->count();
        // if(!$documents_number >0){
        //     $this->validate();
        // }
        

    }
}
