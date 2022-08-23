<?php

namespace App\Traits;

use Illuminate\Support\Str;


trait CurlTrait
{
    public function curl($url, $data)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        if(Str::contains($result, 'El token utilizado ya no es valido'))
        {
            request()->session()->forget('token');
            return 'falla';
        }
        return str_replace("\\n", "", $result);
    }
}
