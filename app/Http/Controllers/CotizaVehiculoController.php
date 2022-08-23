<?php

namespace App\Http\Controllers;

use App\Http\Requests\CotizacionVehiculoRequest;
use App\Mail\MailCotizacionVehiculo;
use App\Models\Province;
use App\Services\CotizacionVehiculoService;
use App\Services\TextoCoberturaService;
use App\Traits\CotizaVehiculoTrait;
use App\Traits\CurlTrait;
use App\Traits\XMLToJSONTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CotizaVehiculoController extends Controller
{
	use CotizaVehiculoTrait;

	protected $texto, $cotizacionService;

  public function __construct(TextoCoberturaService $textoCobertura, CotizacionVehiculoService $cotizacionService) 
  {
    $this->texto = $textoCobertura;
    $this->cotizacionService = $cotizacionService;
  }

  public function index()
  {
    return view('cotizacion-vehiculo.index', ['provinces' => Province::all()]); 
  } 

	public function mail(CotizacionVehiculoRequest $request)
	{	
        $plan = $this->getPlan($request->inlineRadioOptions)->{'Pla-Cod'};		   
        $provincia = $this->getCodigoProvincia($request->provincia);     
		    $cotizacion = $this->getCotizacion($request->tipos, $this->getId($request->marcas), $this->getId($request->modelos),$request->inlineRadioOptions, $plan, $request->año, $provincia, $request->codigo_postal, $this->getId($request->usos));

        if(!@$cotizacion->Vigencias) return redirect()->route('muchas-gracias')->withErrors(['error', 'error']);
        // 3 = auto
        //24 = moto
        if($request->inlineRadioOptions == 24) {
            //En Moto la vigencia mensual (la que se debe mostrar) esta en posicion 1 del array o sea tercera posicion de array que empieza en 0
            //Trae varias coberturas por eso son arrays cuotas,nombres y sumas aseguradas
		    $coberturaMensual = $cotizacion->Vigencias->Coberturas[1]; //CHECK THIS
            $cotizacionCuotas = [];
            array_push($cotizacionCuotas,$coberturaMensual->{'Pre-Tot'});
            $coberturaNombres = [];
            array_push($coberturaNombres, $coberturaMensual->{'Rie-Nom'});
            $coberturaSumasAseguradas = [];
            array_push($coberturaSumasAseguradas, $coberturaMensual->{'Sum-Ase'});
        } else {         
            //En Automotor la vigencia mensual (la que se debe mostrar) esta en posicion 2 del array o sea tercera posicion de array que empieza en 0
            //Trae varias coberturas por eso son arrays cuotas,nombres y sumas aseguradas
          $coberturaMensual = $cotizacion->Vigencias->Coberturas[2];
          $cotizacionCuotas = $coberturaMensual->{'Pre-Tot'};
          $coberturaNombres = $coberturaMensual->{'Rie-Nom'};
          $coberturaSumasAseguradas = $coberturaMensual->{'Sum-Ase'};
        }

		    $campos = $request->validated();
        if ($campos)  { 
             /*if (($key = array_search('COBERTURA "B1" CON ADICIONAL POR 10% AJUSTE AUTOMATICO', $coberturaNombres)) !== false) {
                unset($coberturaNombres[$key]);
                unset($cotizacionCuotas[$key]);

                $cotizacionCuotas = array_values($cotizacionCuotas);
                $coberturaNombres = array_values($coberturaNombres);
              }*/
            $gestion = $this->cotizacionService->save($campos, $cotizacionCuotas, $coberturaNombres);
            Mail::to($campos['email'])->send(new MailCotizacionVehiculo($campos,$cotizacionCuotas, $coberturaNombres, $coberturaSumasAseguradas, $this->getNombre($request->marcas),$this->getNombre($request->modelos), $this->texto->getTextoCobertura($coberturaNombres), $gestion));
        }
		return redirect()->route('muchas-gracias', ['email' => $campos['email']]);
	}

	public function renderMarcas(Request $request)
    {
        $marcas = $this->getMarcas($request->tipoVehiculo, $request->checked);
        return (View::make("components.select")
		->with(['tipo' => 'marcas' ,'idSelect' => 'marcas','collection'=>$marcas])
        ->render());
    }	

	public function renderModelos(Request $request)
    {
        $modelos = $this->getModelos($this->getId($request->marca), $request->tipoVehiculo,$request->checked, $request->año);
        return (View::make("components.select")
		->with(['tipo' => 'modelos', 'idSelect' => 'modelos','collection' => $modelos])
        ->render());
    }

	public function renderUsos(Request $request)
    {
        $usos = $this->getUso($request->tipoVehiculo,$request->checked);
        return (View::make("components.select")
		->with(['tipo' => 'usos' ,'idSelect' => 'usos','collection'=>$usos])
        ->render());
    }	

	public function renderTipos(Request $request)
    {
        $tipos = $this->getTipoVehiculo($request->checked);
        return (View::make("components.select")
		->with(['tipo' => 'tipos' ,'idSelect' => 'tipos','collection'=>$tipos])
        ->render());
    }	
} 