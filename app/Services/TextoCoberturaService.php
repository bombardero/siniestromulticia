<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;

class TextoCoberturaService
{
    public function getTextoCobertura($coberturaNombres)
    {
    	$textoCoberturas = array();
    	foreach($coberturaNombres as $coberturaNombre)
    	{
			switch ($coberturaNombre) {
			  case 'COBERTURA "A"':
			    array_push($textoCoberturas, 'RESPONSABILIDAD CIVIL por lesiones y/o muerte de terceros transportados y no transportados y por daños materiales a cosas de terceros no transportados, hasta la suma máxima por acontecimiento establecida a continuación (Incluye seguro de Responsabilidad Civil Obligatoria).');
			    break;
			  case 'COBERTURA "A" CON ADICIONAL POR AUXILIO MECANICO':
			    array_push($textoCoberturas, '-');
			    break;			    
			  case 'COBERTURA "B1"':
			    array_push($textoCoberturas,'RESPONSABILIDAD CIVIL hacia Terceros Transportados y No Transportados, Pérdida Total por Incendio, Robo o Hurto.');
			    break;
			  case 'COBERTURA "B"':
			   	array_push($textoCoberturas,'RESPONSABILIDAD CIVIL hacia Terceros Transportados y No Transportados, Pérdidas Totales por Accidente, Incendio y Robo o Hurto.'); 
			    break;
			  case 'COBERTURA "B" CON ADICIONAL POR 10% AJUSTE AUTOMATICO':
			    array_push($textoCoberturas, '-');
			    break;				    
			  case 'COBERTURA "C1"':
			    array_push($textoCoberturas,"RESPONSABILIDAD CIVIL hacia Terceros Transportados y No Transportados, Pérdidas Totales y Parciales por Incendio, Robo o Hurto.");
			    break;
			  case 'COBERTURA "C1" CON ADICIONAL POR 20% AJUSTE AUTOMATICO':
			    array_push($textoCoberturas, '-');
			    break;				    
			  case 'COBERTURA "CarTop"':
			    array_push($textoCoberturas,"RESPONSABILIDAD CIVIL hacia Terceros Transportados y No Transportados, Pérdida Total por Accidente y Pérdidas Totales Parciales por Incendio y Robo o Hurto. La presente cobertura indemniza la rotura de cristales laterales, parabrisas, luneta y cerraduras como consecuencia de Robo o Intento de Robo.");
			    break;	
			  case 'COBERTURA "C"':
			    array_push($textoCoberturas,"RESPONSABILIDAD CIVIL hacia Terceros Transportados y No Transportados, Pérdida Total por Accidente y Pérdidas Totales y Parciales por Incendio y Robo o Hurto.");
			    break;		    	
			  case 'COBERTURA "C" CON ADICIONAL POR 20% AJUSTE AUTOMATICO':
			    array_push($textoCoberturas, '-');
			    break;		
			  case 'COBERTURA "C" CON ADICIONAL POR GRANIZO':
			    array_push($textoCoberturas, '-');
			    break;				    		        		    
			  default:
			    array_push($textoCoberturas,"No disponible");
			}        
		}
		return $textoCoberturas;

    }
}
