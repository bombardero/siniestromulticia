<?php
namespace App\Services;


use App\Models\DenunciaSiniestro;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompaniaService
{

    public static function enviarDenuncia(DenunciaSiniestro $denuncia, string $tipo_vehiculo)
    {
        $token = self::getToken();

        $data = [
            'token' => $token,
            'data' => self::setDataXML($denuncia, $tipo_vehiculo)
        ];

        $request = Http::withOptions(['curl' => [CURLOPT_POSTFIELDS => self::getCurlParams($data)]])->timeout(60)->get(config('app.compania_url'));
        $response = $request->body();
        if(Str::contains($token, 'El token utilizado ya no es valido'))
        {
            Cache::forget('token-siniestro');
            return false;
        }

        $response = str_replace("\n", '', $response);
        Log::info('CompaniaService::enviarDenuncia() response:'.$response);

        $response = "<?xml version='1.0'?><response>$response</response>";
        $response = (array)simplexml_load_string($response);

        if(array_key_exists('Den-Nro',$response))
        {
            $denuncia->nro_denuncia = $response['Den-Nro'];
            $denuncia->save();
        }

        if(array_key_exists('pdf-path',$response) && array_key_exists('pdf-doc',$response))
        {
            $url = $response['pdf-path'].$response['pdf-doc'];
            $denuncia->storeCertificadoCobertura($url);
        }

        return $response;
    }

    private function getToken()
    {
        $token = Cache::get('token-siniestro');

        if($token)
        {
            Log::info('token: '.$token);
            return $token;
        }

        $data = [
            'token' => null,
            'login' => config('app.compania_siniestro_user'),
            'passwd' => config('app.compania_siniestro_password')
        ];
        $request = Http::withOptions(['curl' => [CURLOPT_POSTFIELDS => self::getCurlParams($data)]])->get(config('app.compania_url'));
        $token = $request->body();
        if(Str::contains($token, 'El token utilizado ya no es valido'))
        {
            Cache::forget('token-siniestro');
            return false;
        }
        $token = str_replace("\n", '', $token);
        $token = str_replace('token=', '', $token);

        Cache::put('token-siniestro', $token, now()->addDays(30));
        Log::info('token: '.$token);
        return $token;
    }

    private function getCurlParams(array $data)
    {
        $params = [];
        foreach ($data as $key => $item)
        {
            $params[] = $key.'='.($item != null ? $item : 'null');
        }
        return implode('&',$params);
    }

    private function setDataXML(DenunciaSiniestro $denuncia, string $tipo_vehiculo)
    {
        $xml = '<Datos>
                    <Cod_Req>WS0090</Cod_Req>
                    <Cia-Cod>1</Cia-Cod>
                    <Cox-Nro></Cox-Nro>
                    <Pol-Nro>:nro_poliza:</Pol-Nro>
                    <End-Nro></End-Nro>
                    <Sec-Cod>:codigo_tipo:</Sec-Cod>
                    <Sin-Fec-Ocu>:fecha_ocurrencia:</Sin-Fec-Ocu>
                    <Sin-Fec-Den>:fecha_denuncia:</Sin-Fec-Den>
                    <Con-Nom>:conductor_nombre:</Con-Nom>
                    <Con-Doc-Tip>:conductor_tipo_documento:</Con-Doc-Tip>
                    <Con-Doc-Nro>:conductor_numero_docuento:</Con-Doc-Nro>
                    <Con-Dom>:conductor_domicilio:</Con-Dom>
                    <Con-Ocu>:conductor_ocupacion:</Con-Ocu>
                    <Con-Sex>:conductor_sexo:</Con-Sex>
                    <Est-Civ>:conductor_estado_civil:</Est-Civ>
                    <Con-Con-Tip>:conductor_carnet_tipo:</Con-Con-Tip>
                    <Con-Con-Nro>:conductor_carnet_numero:</Con-Con-Nro>
                    <Con-Con-Vto>:conductor_carnet_vencimiento:</Con-Con-Vto>
                    <Con-Eda>:conductor_edad:</Con-Eda>
                    <Acc-Lug>:tipo_lugar:</Acc-Lug>
                    <Acc-Lug-Ocu>:lugar:</Acc-Lug-Ocu>
                    <Dia-Gno-Det>:descripcion:</Dia-Gno-Det>
                    <Inc-Pos-Sin></Inc-Pos-Sin>
                    <Aut-Pol></Aut-Pol>
                    <Act-Pol-Ent></Act-Pol-Ent>
                    <Dan-Ter>:danios_terceros:</Dan-Ter>
                    <Les-Ter>:lesiones_terceros:</Les-Ter>
                    <Sin-Cod-Pos>:codigo_postal:</Sin-Cod-Pos>
                    <Fot-Rec-Con></Fot-Rec-Con>
                </Datos>';

        $xml = str_replace(':nro_poliza:', $denuncia->nro_poliza, $xml);
        $xml = str_replace(':codigo_tipo:', $tipo_vehiculo === 'autos' ? '3' : '24', $xml);
        $xml = str_replace(':fecha_ocurrencia:', $denuncia->fecha->format('d/m/Y'), $xml);
        $xml = str_replace(':fecha_denuncia:', $denuncia->finalized_at->format('d/m/Y'), $xml);

        if($denuncia->conductor)
        {
            $xml = str_replace(':conductor_nombre:', $denuncia->conductor->nombre, $xml);
            $xml = str_replace(':conductor_tipo_documento:', $denuncia->conductor->tipoDocumento->nombre_compania, $xml);
            $xml = str_replace(':conductor_numero_docuento:', $denuncia->conductor->documento_numero, $xml);
            $xml = str_replace(':conductor_domicilio:', $denuncia->conductor->domicilio, $xml);
            $xml = str_replace(':conductor_ocupacion:', $denuncia->conductor ? $denuncia->conductor->ocupacion : '' , $xml);
            $xml = str_replace(':conductor_carnet_tipo:', $denuncia->conductor->tipoCarnet->nombre, $xml);
            $xml = str_replace(':conductor_carnet_numero:', $denuncia->conductor->numero_registro, $xml);
            $xml = str_replace(':conductor_carnet_vencimiento:', $denuncia->conductor->carnet_vencimiento->format('d/m/Y'), $xml);
            $xml = str_replace(':conductor_edad:', $denuncia->conductor->fecha_nacimiento->diffInYears(Carbon::now()), $xml);
            if(strtoupper($denuncia->conductor->estado_civil) == 'SOLTERO')
            {
                $xml = str_replace(':conductor_estado_civil:', 'S', $xml);
            }
            if(strtoupper($denuncia->conductor->estado_civil) == 'CASADO')
            {
                $xml = str_replace(':conductor_estado_civil:', 'C', $xml);
            }
        } else {
            $xml = str_replace(':conductor_nombre:', 'Sin conductor', $xml);
            $xml = str_replace(':conductor_tipo_documento:', 'DU', $xml);
            $xml = str_replace(':conductor_numero_docuento:', 'Sin conductor', $xml);
            $xml = str_replace(':conductor_domicilio:', 'Sin conductor', $xml);
            $xml = str_replace(':conductor_ocupacion:', '', $xml);
            $xml = str_replace(':conductor_carnet_tipo:', '', $xml);
            $xml = str_replace(':conductor_carnet_numero:', '', $xml);
            $xml = str_replace(':conductor_carnet_vencimiento:', '', $xml);
            $xml = str_replace(':conductor_edad:', '', $xml);
            $xml = str_replace(':conductor_estado_civil:', '', $xml);
        }

        $xml = str_replace(':conductor_estado_civil:', '', $xml);
        $xml = str_replace(':conductor_sexo:', '', $xml);

        $xml = str_replace(':tipo_lugar:', 'XX', $xml);
        $xml = str_replace(':lugar:', $denuncia->lugar_nombre, $xml);
        $xml = str_replace(':descripcion:', $denuncia->descripcion, $xml);

        $xml = str_replace(':danios_terceros:', $denuncia->hubo_danios_materiales ? 'S' : 'N' , $xml);
        $xml = str_replace(':lesiones_terceros:', $denuncia->hubo_lesionados ? 'S' : 'N' , $xml);

        $xml = str_replace(':codigo_postal:', $denuncia->codigo_postal, $xml);

        Log::info('CompaniaService $xml '.$xml);
        return $xml;
    }

    private function getTiposDocumentos()
    {
        $token = self::getToken();

        $data = [
            'token' => $token,
            'data' => '<Datos><Cod-Req>000102</Cod-Req></Datos>'
        ];

        $request = Http::withOptions(['curl' => [CURLOPT_POSTFIELDS => self::getCurlParams($data)]])->get(env('COMPANIA_URL'));
        $response = $request->body();
        if(Str::contains($token, 'El token utilizado ya no es valido'))
        {
            return false;
        }

        $response = str_replace("\n", '', $response);
        Log::info('tipos de documentos: '.$response);
        return $response;
    }
}

