<?php
namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function uploadFile($file, $documentType)
    {
        $year = Carbon::now()->format('Y');
		if(!$file)
		{
			throw new Exception("Error Processing Request - s3", 500);
		}
		$dateName = Carbon::now()->isoFormat('DD-MM-Y h:mm:ss');
		$name = $documentType.'_'.$dateName;
		$filePath = $documentType. '/' . $year . '/' . $name;

		Storage::disk('s3')->put($filePath, file_get_contents($file),'public');

		$url = Storage::disk('s3')->url($filePath);

		return $url;
    }
}