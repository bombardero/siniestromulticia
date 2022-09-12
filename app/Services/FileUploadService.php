<?php
namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    // TODO: Reemplzar por nueva funcion
    public function uploadFile($file, $documentType)
    {
        $year = Carbon::now()->format('Y');
		if(!$file)
		{
			throw new Exception("Error Processing Request - s3", 500);
		}
		$filesize = strlen(file_get_contents($file));
		if($filesize > 50000000 ) {
			throw new Exception("El archivo excede la capacidad maxima (50 mb)", 500);
		}

		$dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
		$name = $documentType.'_'.$dateName;
		$filePath = $documentType. '/' . $year . '/' . $name;

		Storage::disk('s3')->put($filePath, file_get_contents($file),'public');

		$url = Storage::disk('s3')->url($filePath);

		return $url;
    }

    static public function upload($file, $filePath)
    {
        $filesize = strlen(file_get_contents($file));
        if($filesize > 50000000 )
        {
            throw new Exception("El archivo excede la capacidad máxima (50 mb)", 500);
        }

        Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
        $url = Storage::disk('s3')->url($filePath);
        return $url;
    }

    static public function delete($path)
    {
        Storage::disk('s3')->delete($path);
    }
}
