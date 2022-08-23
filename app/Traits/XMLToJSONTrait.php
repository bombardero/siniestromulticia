<?php

namespace App\Traits;


trait XMLToJSONTrait
{
    public function convertXMLToJSON($xml)
    {
    	//info('INICIO-----------------------------');
    	//info($xml);
    	$xml=str_replace("<Veh-Mar-Cod>5054</Veh-Mar-Cod><Veh-Mar-Nom></Veh-Mar-Nom>", "",$xml);
    	//info('REMPLAZADO-----------------------------');
    	//info($xml);
        if($xml != 'falla'){
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');
            info('************** XMLTOJSONTRAIT DISTINTO FALLA  **********************************************************************************');
            info($xml);
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');

    	   $jsonData = json_encode(simplexml_load_string(utf8_encode($xml)));
           info('JSON-----------------------------');
            info($jsonData);
            info('END JSON-----------------------------');
            return json_decode($jsonData);
        }else{
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');
            info('************** XMLTOJSONTRAIT RETORNA FALLA  **********************************************************************************');
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');
            info('*******************************************************************************************************************************');
            return 'falla';
        }

    }
}
