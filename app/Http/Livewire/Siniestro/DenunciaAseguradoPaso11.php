<?php

namespace App\Http\Livewire\Siniestro;

use App\Models\DenunciaSiniestro;
use App\Models\DocumentosDenuncia;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class DenunciaAseguradoPaso11 extends Component
{
    use WithFileUploads;
    
    public $denuncia_siniestro;
    public $archivos_dni = [] ; // equivalente a archivo_sueldos
    public $fotos_dni = [] ; // equivalente a sueldos []
    public $identificador;
    protected $fileUploadService;


    public $listeners = [
        "upload_cedula" => 'uploadFileCedula',
         "upload_dni" => 'uploadFileDNI',
         "upload_carnet" => 'uploadFileCarnet',
         "upload_vehiculo" => 'uploadFileVehiculo',
         "upload_recibo" => 'uploadFileRecibo',
         "upload_policial" => 'uploadFilePolicial',
         "upload_habilitacion" => 'uploadFileHabilitacion',         
         'staffDirectoryRefresh' => '$refresh'
    ];

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }
    
    public function mount($denuncia_siniestro, $identificador) 
    {
        $this->denuncia_siniestro = $denuncia_siniestro;
        $this->archivos_dni = $denuncia_siniestro->documentosDenuncia()->where('type', 1)->get(); 
        $this->identificador = $identificador;
    }
    

    public function render()
    {
        return view('livewire.siniestro.denuncia-asegurado-paso11');
    }

    public function submit()
    {
        
        if($this->denuncia_siniestro->documentosDenuncia->where('type', 1)->count() < 2 ) {  
            $this->addError('fotos', 'Tienes que cargar 2 fotos del dni (frente y reverso)');        
            return ;         
        }


        
        if($this->denuncia_siniestro->documentosDenuncia->where('type',2)->count() < 2 ) {  
            $this->addError('cedulas', 'Tienes que cargar 2 fotos de tu cedula(frente y reverso)');        
            return ;         
        }

     

        if($this->denuncia_siniestro->documentosDenuncia->where('type',3)->count() < 2 ) {  
            $this->addError('carnet', 'Tienes que cargar 2 fotos de tu carnet(frente y reverso)');        
            return ;         
        }



        if($this->denuncia_siniestro->documentosDenuncia->where('type',4)->count() < 4 ) {  
            $this->addError('vehiculo', 'Tienes que cargar 4 fotos(1 de cada lateral, arriba, abajo)');        
            return ;         
        }


       

        $denuncia_siniestro = DenunciaSiniestro::where("identificador",$this->identificador)->firstOrFail();
            
        if($denuncia_siniestro->state < "11"){
            $denuncia_siniestro->state='11';
        }  

        $denuncia_siniestro->save();

        return redirect()->route("asegurados-denuncias-paso12.create",['id'=> $this->identificador]);
    }        

    public function uploadFileDNI($file)
    {

        if($this->denuncia_siniestro->documentosDenuncia->where('type', 1)->count() >= 2 ) {  
            $this->addError('fotos', 'No puedes cargar mas de 2 fotos');        
            return ;         
        }
        $year = Carbon::now()->format('Y');
     
        $documentType = "dni";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        ////// TYPE 1 = DNI;
        DocumentosDenuncia::create([
                'type' => 1,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'denuncia_siniestro_id' => $this->denuncia_siniestro->id,
        ]);

        $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', 1)->count();
        if(!$documents_number > 0){
            $this->validate();
        }        
    }    


    public function uploadFileCedula($file)
    {

        if($this->denuncia_siniestro->documentosDenuncia->where('type',2)->count() >= 2 ) {  
            $this->addError('cedulas', 'No puedes cargar mas de 2 fotos de tu cedula');        
            return ;         
        }        
        $year = Carbon::now()->format('Y');
        
        $documentType = "cedula";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        ////// TYPE 2 = CEDULA;
        DocumentosDenuncia::create([
                'type' => 2,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'denuncia_siniestro_id' => $this->denuncia_siniestro->id,
        ]);

        $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', 2)->count();
        if(!$documents_number > 0){
            $this->validate();
        }        
    }

    public function uploadFileCarnet($file)
    {

        if($this->denuncia_siniestro->documentosDenuncia->where('type',3)->count() >= 2 ) {  
            $this->addError('carnet', 'No puedes cargar mas de 2 fotos de tu carnet');        
            return ;         
        }         
        $year = Carbon::now()->format('Y');
        
        $documentType = "carnet";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        ////// TYPE 3 = CARNET;
        DocumentosDenuncia::create([
                'type' => 3,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'denuncia_siniestro_id' => $this->denuncia_siniestro->id,
        ]);

        $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', 3)->count();
        if(!$documents_number > 0){
            $this->validate();
        }        
    }    

    public function uploadFileVehiculo($file)
    {

        if($this->denuncia_siniestro->documentosDenuncia->where('type',4)->count() >= 4 ) {  
            $this->addError('vehiculo', 'No puedes cargar mas de 4 fotos');        
            return ;         
        }  

        $year = Carbon::now()->format('Y');
        
        $documentType = "vehiculo";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        ////// TYPE 4 = VEHICULO;
        DocumentosDenuncia::create([
                'type' => 4,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'denuncia_siniestro_id' => $this->denuncia_siniestro->id,
        ]);

        $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', 4)->count();
        if(!$documents_number > 0){
            $this->validate();
        }        
    }      

    public function uploadFileRecibo($file)
    {

   
        if($this->denuncia_siniestro->documentosDenuncia->where('type',5)->count() >= 1 ) {  

            $this->addError('recibo', 'No puedes cargar más de 1 documento!');        
            return ;         
        }         


        $year = Carbon::now()->format('Y');
        
        $documentType = "recibo";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        ////// TYPE 5 = Recibo;
        DocumentosDenuncia::create([
                'type' => 5,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'denuncia_siniestro_id' => $this->denuncia_siniestro->id,
        ]);

        $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', 5)->count();
        if(!$documents_number > 0){
            $this->validate();
        }        
    }    

    public function uploadFilePolicial($file)
    {

           
        if($this->denuncia_siniestro->documentosDenuncia->where('type',6)->count() >= 1 ) {  

            $this->addError('recibo', 'No puedes cargar más de 1 documento!');        
            return ;         
        }         

        $year = Carbon::now()->format('Y');
        
        $documentType = "exposicion policial";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        ////// TYPE 6 = EXPOSICION POLICIAL;
        DocumentosDenuncia::create([
                'type' => 6,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'denuncia_siniestro_id' => $this->denuncia_siniestro->id,
        ]);

        $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', 6)->count();
        if(!$documents_number > 0){
            $this->validate();
        }        
    }    

    public function uploadFileHabilitacion($file)
    {

           
        if($this->denuncia_siniestro->documentosDenuncia->where('type',7)->count() >= 1 ) {  

            $this->addError('recibo', 'No puedes cargar más de 1 documento!');        
            return ;         
        }         

        $year = Carbon::now()->format('Y');
        
        $documentType = "habilitacion_municipal";
        $dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');

        $url = $this->fileUploadService->uploadFile($file,$documentType);

        ////// TYPE 7 = Habilitacion municipal;
        DocumentosDenuncia::create([
                'type' => 7,
                'nombre' => $documentType.'_'.$dateName,
                'url' => $url,
                'denuncia_siniestro_id' => $this->denuncia_siniestro->id,
        ]);

        $documents_number = $this->denuncia_siniestro->documentosDenuncia()->where('type', 7)->count();
        if(!$documents_number > 0){
            $this->validate();
        }        
    }    

    public function eliminarArchivo($id)
    {
        $archivo = DocumentosDenuncia::find($id);
        $archivo->delete();      
        return redirect()->route("asegurados-denuncias-paso11.create",['id'=> $this->identificador]);
    }    
}
