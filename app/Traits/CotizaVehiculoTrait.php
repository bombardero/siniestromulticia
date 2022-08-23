<?php

namespace App\Traits;

use App\Traits\CurlTrait;
use App\Traits\XMLToJSONTrait;
use Illuminate\Http\Request;


trait CotizaVehiculoTrait
{
    use CurlTrait, XMLToJSONTrait;

    public function getToken()
    {        
        if (request()->session()->exists('token')) {
            return request()->session()->get('token');
            info('TOKEN: '. request()->session()->get('token'));
        } else {
        $curl = $this->curl(config('app.compania_url'), "token=null&login=".config('app.compania_user')."&passwd=".config('app.compania_password'));
        $token = nl2br(str_replace(array("token=", "\r", "\n"), "", $curl));        
        session(['token' => $token]);
        info('TOKEN: '. $token);
        return $token;
        }

        /*$curl = $this->curl(config('app.compania_url'), "token=null&login=".config('app.compania_user')."&passwd=".config('app.compania_password'));
        $token = nl2br(str_replace(array("token=", "\r", "\n"), "", $curl));
        return $token;*/


    }

    public function getCotizacion($tipoVehiculo, $marca, $modelo, $secCod, $plan,$año, $provincia, $codigoPostal, $uso) 
    {
        $req= "<Datos><Cod-Req>10500C</Cod-Req><Cia-Cod>1</Cia-Cod><sec-cod>".$secCod."</sec-cod><pla-cod>".$plan."</pla-cod><org-gru-cod>12</org-gru-cod><org-cod>76</org-cod><pro-cod>98</pro-cod><adm-cod>19</adm-cod><ase-cpo>".$codigoPostal."</ase-cpo><ase-iva-cod>4</ase-iva-cod><ase-pia-cod>".$provincia."</ase-pia-cod><Items><Ite-Det><veh-tip-cod>".$tipoVehiculo."</veh-tip-cod><veh-uso-cod>".$uso."</veh-uso-cod><veh-mar-cod>".$marca."</veh-mar-cod><veh-mod-cod>".$modelo."</veh-mod-cod><veh-ano-fab>".$año."</veh-ano-fab><veh-ant-ano>1</veh-ant-ano></Ite-Det></Items></Datos>";

        $curl = $this->curl(config('app.compania_url_cotizacion'),"token=".$this->getToken()."&mensaje=\'".$req."\'");


         if($curl == 'falla') $this->getCotizacion($tipoVehiculo, $marca, $modelo, $secCod, $plan,$año, $provincia, $codigoPostal);

         info('REQUEST *********************** inicio getCotizacion - curl ------------------------------');
         info($req);
         info('REQUEST *********************** fin getCotizacion - curl ------------------------------');
        return $this->convertXMLToJSON($curl);
    }

    public function getPlan($secCod)
    {
        /*$curl = $this->curl(config('app.compania_url'), "token=".$this->getToken()."&mensaje=\'<Cod_Req>21710</Cod_Req><Cia-Cod>1</Cia-Cod><Sec-Cod>".$secCod."</Sec-Cod><Org-Gru-Cod>12</Org-Gru-Cod><Org-Cod>76</Org-Cod><Pro-Cod>98</Pro-Cod><Adm-Cod>19</Adm-Cod>'");
         if($curl == 'falla') $this->getPlan($secCod);

         info('secCod: '.$secCod);
         info("INICIO CURL----------------");
         info($curl);
         info("FIN CURL----------------");*/
         if($secCod=='24'){
            $curl="<Planes><Pla-Cod>1</Pla-Cod><Pla-Nom>PLAN MOTOVEHICULOS FACT=VIGE</Pla-Nom><Mon-Cod>1</Mon-Cod><Mon-Nom>$</Mon-Nom></Planes>";
         }else if($secCod=='3'){
            $curl="<Planes><Pla-Cod>3</Pla-Cod><Pla-Nom>PLAN AUTOMOTORES-FACT=VIGENC</Pla-Nom><Mon-Cod>1</Mon-Cod><Mon-Nom>$</Mon-Nom></Planes>";

         }

        return $this->convertXMLToJSON($curl);
    }


    public function getMarcas($tipoVehiculo, $secCod) 
    {        
        /*$curl = $this->curl(config('app.compania_url'),"token=".$this->getToken().
                                                        "&mensaje=\'<Cod_Req>204104</Cod_Req><Cia-Cod>1</Cia-Cod><Sec-Cod>".$secCod."</Sec-Cod><Veh-Tip-Cod>".$tipoVehiculo."</Veh-Tip-Cod><Veh-Uso-Cod>2</Veh-Uso-Cod>'");
        info('tipoVehiculo:'.$tipoVehiculo);
        info('secCod:'.$secCod);



         if($curl == 'falla') $this->getMarcas($tipoVehiculo, $secCod);
         info('inicio curl ---------------------------');
         info($curl);
         info('fin curl ---------------------------');*/

         //24 = motocicletas
         if($secCod=='24'){
            switch($tipoVehiculo){
                //MARCAS PARA MOTOCICLETA
                case '1':
                    $curl="<Marcas><Veh-Mar-Cod>600</Veh-Mar-Cod><Veh-Mar-Nom>VOGE</Veh-Mar-Nom><Veh-Mar-Cod>601</Veh-Mar-Cod><Veh-Mar-Nom>SUNRA</Veh-Mar-Nom><Veh-Mar-Cod>836</Veh-Mar-Cod><Veh-Mar-Nom>PEUGEOT MOTOS</Veh-Mar-Nom><Veh-Mar-Cod>837</Veh-Mar-Cod><Veh-Mar-Nom>BLACKSTONE</Veh-Mar-Nom><Veh-Mar-Cod>838</Veh-Mar-Cod><Veh-Mar-Nom>TIBO</Veh-Mar-Nom><Veh-Mar-Cod>839</Veh-Mar-Cod><Veh-Mar-Nom>GAMMA</Veh-Mar-Nom><Veh-Mar-Cod>840</Veh-Mar-Cod><Veh-Mar-Nom>SKYGO</Veh-Mar-Nom><Veh-Mar-Cod>841</Veh-Mar-Cod><Veh-Mar-Nom>PIAGGIO</Veh-Mar-Nom><Veh-Mar-Cod>842</Veh-Mar-Cod><Veh-Mar-Nom>LEGNANO</Veh-Mar-Nom><Veh-Mar-Cod>843</Veh-Mar-Cod><Veh-Mar-Nom>IMSA</Veh-Mar-Nom><Veh-Mar-Cod>844</Veh-Mar-Cod><Veh-Mar-Nom>LIFAN</Veh-Mar-Nom><Veh-Mar-Cod>845</Veh-Mar-Cod><Veh-Mar-Nom>RAFTER</Veh-Mar-Nom><Veh-Mar-Cod>846</Veh-Mar-Cod><Veh-Mar-Nom>DAYAMA</Veh-Mar-Nom><Veh-Mar-Cod>847</Veh-Mar-Cod><Veh-Mar-Nom>POLARIS</Veh-Mar-Nom><Veh-Mar-Cod>848</Veh-Mar-Cod><Veh-Mar-Nom>HYOSUNG</Veh-Mar-Nom><Veh-Mar-Cod>849</Veh-Mar-Cod><Veh-Mar-Nom>KTM</Veh-Mar-Nom><Veh-Mar-Cod>850</Veh-Mar-Cod><Veh-Mar-Nom>GAS GAS</Veh-Mar-Nom><Veh-Mar-Cod>851</Veh-Mar-Cod><Veh-Mar-Nom>PIT BIKE</Veh-Mar-Nom><Veh-Mar-Cod>852</Veh-Mar-Cod><Veh-Mar-Nom>BLOOWER</Veh-Mar-Nom><Veh-Mar-Cod>853</Veh-Mar-Cod><Veh-Mar-Nom>SYM</Veh-Mar-Nom><Veh-Mar-Cod>854</Veh-Mar-Cod><Veh-Mar-Nom>TVS</Veh-Mar-Nom><Veh-Mar-Cod>855</Veh-Mar-Cod><Veh-Mar-Nom>HUSQVARNA</Veh-Mar-Nom><Veh-Mar-Cod>881</Veh-Mar-Cod><Veh-Mar-Nom>HONDA</Veh-Mar-Nom><Veh-Mar-Cod>883</Veh-Mar-Cod><Veh-Mar-Nom>KONISA</Veh-Mar-Nom><Veh-Mar-Cod>884</Veh-Mar-Cod><Veh-Mar-Nom>BAJAJ</Veh-Mar-Nom><Veh-Mar-Cod>885</Veh-Mar-Cod><Veh-Mar-Nom>BABOON</Veh-Mar-Nom><Veh-Mar-Cod>886</Veh-Mar-Cod><Veh-Mar-Nom>JAWA</Veh-Mar-Nom><Veh-Mar-Cod>887</Veh-Mar-Cod><Veh-Mar-Nom>CAGIVA</Veh-Mar-Nom><Veh-Mar-Cod>888</Veh-Mar-Cod><Veh-Mar-Nom>JUKI</Veh-Mar-Nom><Veh-Mar-Cod>889</Veh-Mar-Cod><Veh-Mar-Nom>OLMO</Veh-Mar-Nom><Veh-Mar-Cod>890</Veh-Mar-Cod><Veh-Mar-Nom>BENELLI</Veh-Mar-Nom><Veh-Mar-Cod>910</Veh-Mar-Cod><Veh-Mar-Nom>MONDIAL</Veh-Mar-Nom><Veh-Mar-Cod>911</Veh-Mar-Cod><Veh-Mar-Nom>YAMAHA</Veh-Mar-Nom><Veh-Mar-Cod>912</Veh-Mar-Cod><Veh-Mar-Nom>JIANSHE</Veh-Mar-Nom><Veh-Mar-Cod>913</Veh-Mar-Cod><Veh-Mar-Nom>BETA</Veh-Mar-Nom><Veh-Mar-Cod>914</Veh-Mar-Cod><Veh-Mar-Nom>BMW</Veh-Mar-Nom><Veh-Mar-Cod>915</Veh-Mar-Cod><Veh-Mar-Nom>CERRO</Veh-Mar-Nom><Veh-Mar-Cod>916</Veh-Mar-Cod><Veh-Mar-Nom>SUZUKI</Veh-Mar-Nom><Veh-Mar-Cod>917</Veh-Mar-Cod><Veh-Mar-Nom>FAMSA</Veh-Mar-Nom><Veh-Mar-Cod>918</Veh-Mar-Cod><Veh-Mar-Nom>KIKAI</Veh-Mar-Nom><Veh-Mar-Cod>919</Veh-Mar-Cod><Veh-Mar-Nom>MINARELLI</Veh-Mar-Nom><Veh-Mar-Cod>920</Veh-Mar-Cod><Veh-Mar-Nom>MOTOMEL</Veh-Mar-Nom><Veh-Mar-Cod>921</Veh-Mar-Cod><Veh-Mar-Nom>PANTHER</Veh-Mar-Nom><Veh-Mar-Cod>922</Veh-Mar-Cod><Veh-Mar-Nom>VENTO</Veh-Mar-Nom><Veh-Mar-Cod>923</Veh-Mar-Cod><Veh-Mar-Nom>JINCHENG</Veh-Mar-Nom><Veh-Mar-Cod>924</Veh-Mar-Cod><Veh-Mar-Nom>DAELIM</Veh-Mar-Nom><Veh-Mar-Cod>925</Veh-Mar-Cod><Veh-Mar-Nom>CHIRETTE</Veh-Mar-Nom><Veh-Mar-Cod>926</Veh-Mar-Cod><Veh-Mar-Nom>HARLEY DAVI</Veh-Mar-Nom><Veh-Mar-Cod>927</Veh-Mar-Cod><Veh-Mar-Nom>XQUAD</Veh-Mar-Nom><Veh-Mar-Cod>928</Veh-Mar-Cod><Veh-Mar-Nom>BRAVA</Veh-Mar-Nom><Veh-Mar-Cod>929</Veh-Mar-Cod><Veh-Mar-Nom>VELIMOTOR</Veh-Mar-Nom><Veh-Mar-Cod>930</Veh-Mar-Cod><Veh-Mar-Nom>GUERRERO</Veh-Mar-Nom><Veh-Mar-Cod>931</Veh-Mar-Cod><Veh-Mar-Nom>HAMATSU</Veh-Mar-Nom><Veh-Mar-Cod>932</Veh-Mar-Cod><Veh-Mar-Nom>SUMO</Veh-Mar-Nom><Veh-Mar-Cod>934</Veh-Mar-Cod><Veh-Mar-Nom>OKINOI</Veh-Mar-Nom><Veh-Mar-Cod>935</Veh-Mar-Cod><Veh-Mar-Nom>DUCATI</Veh-Mar-Nom><Veh-Mar-Cod>936</Veh-Mar-Cod><Veh-Mar-Nom>DAYANG</Veh-Mar-Nom><Veh-Mar-Cod>937</Veh-Mar-Cod><Veh-Mar-Nom>KELLER</Veh-Mar-Nom><Veh-Mar-Cod>939</Veh-Mar-Cod><Veh-Mar-Nom>CORVEN</Veh-Mar-Nom><Veh-Mar-Cod>940</Veh-Mar-Cod><Veh-Mar-Nom>GILERA</Veh-Mar-Nom><Veh-Mar-Cod>941</Veh-Mar-Cod><Veh-Mar-Nom>GOES</Veh-Mar-Nom><Veh-Mar-Cod>942</Veh-Mar-Cod><Veh-Mar-Nom>APRILIA</Veh-Mar-Nom><Veh-Mar-Cod>943</Veh-Mar-Cod><Veh-Mar-Nom>XSCREEMS</Veh-Mar-Nom><Veh-Mar-Cod>944</Veh-Mar-Cod><Veh-Mar-Nom>EUROMOT</Veh-Mar-Nom><Veh-Mar-Cod>946</Veh-Mar-Cod><Veh-Mar-Nom>CAN AM</Veh-Mar-Nom><Veh-Mar-Cod>950</Veh-Mar-Cod><Veh-Mar-Nom>KYMCO</Veh-Mar-Nom><Veh-Mar-Cod>951</Veh-Mar-Cod><Veh-Mar-Nom>DYNAMIC</Veh-Mar-Nom><Veh-Mar-Cod>960</Veh-Mar-Cod><Veh-Mar-Nom>KAWASAKI</Veh-Mar-Nom><Veh-Mar-Cod>961</Veh-Mar-Cod><Veh-Mar-Nom>HERO</Veh-Mar-Nom><Veh-Mar-Cod>966</Veh-Mar-Cod><Veh-Mar-Nom>JIALING</Veh-Mar-Nom><Veh-Mar-Cod>970</Veh-Mar-Cod><Veh-Mar-Nom>MAVERICK</Veh-Mar-Nom><Veh-Mar-Cod>972</Veh-Mar-Cod><Veh-Mar-Nom>JINLING</Veh-Mar-Nom><Veh-Mar-Cod>973</Veh-Mar-Cod><Veh-Mar-Nom>DA DALT</Veh-Mar-Nom><Veh-Mar-Cod>980</Veh-Mar-Cod><Veh-Mar-Nom>APPIA</Veh-Mar-Nom><Veh-Mar-Cod>982</Veh-Mar-Cod><Veh-Mar-Nom>MV AGUSTA</Veh-Mar-Nom><Veh-Mar-Cod>990</Veh-Mar-Cod><Veh-Mar-Nom>ZANELLA MOTOS</Veh-Mar-Nom><Veh-Mar-Cod>991</Veh-Mar-Cod><Veh-Mar-Nom>ROYAL ENFIELD</Veh-Mar-Nom><Veh-Mar-Cod>992</Veh-Mar-Cod><Veh-Mar-Nom>TRIUMPH</Veh-Mar-Nom><Veh-Mar-Cod>993</Veh-Mar-Cod><Veh-Mar-Nom>VESPA</Veh-Mar-Nom><Veh-Mar-Cod>994</Veh-Mar-Cod><Veh-Mar-Nom>GUZZI</Veh-Mar-Nom><Veh-Mar-Cod>995</Veh-Mar-Cod><Veh-Mar-Nom>CF MOTO</Veh-Mar-Nom><Veh-Mar-Cod>997</Veh-Mar-Cod><Veh-Mar-Nom>GHIGGERI</Veh-Mar-Nom><Veh-Mar-Cod>998</Veh-Mar-Cod><Veh-Mar-Nom>JAGUAR ATV</Veh-Mar-Nom></Marcas>";
                break;

                 //MARCAS PARA SCOOTER
                case '2':
                    $curl="<Marcas><Veh-Mar-Cod>600</Veh-Mar-Cod><Veh-Mar-Nom>VOGE</Veh-Mar-Nom><Veh-Mar-Cod>601</Veh-Mar-Cod><Veh-Mar-Nom>SUNRA</Veh-Mar-Nom><Veh-Mar-Cod>836</Veh-Mar-Cod><Veh-Mar-Nom>PEUGEOT MOTOS</Veh-Mar-Nom><Veh-Mar-Cod>837</Veh-Mar-Cod><Veh-Mar-Nom>BLACKSTONE</Veh-Mar-Nom><Veh-Mar-Cod>838</Veh-Mar-Cod><Veh-Mar-Nom>TIBO</Veh-Mar-Nom><Veh-Mar-Cod>839</Veh-Mar-Cod><Veh-Mar-Nom>GAMMA</Veh-Mar-Nom><Veh-Mar-Cod>840</Veh-Mar-Cod><Veh-Mar-Nom>SKYGO</Veh-Mar-Nom><Veh-Mar-Cod>841</Veh-Mar-Cod><Veh-Mar-Nom>PIAGGIO</Veh-Mar-Nom><Veh-Mar-Cod>842</Veh-Mar-Cod><Veh-Mar-Nom>LEGNANO</Veh-Mar-Nom><Veh-Mar-Cod>843</Veh-Mar-Cod><Veh-Mar-Nom>IMSA</Veh-Mar-Nom><Veh-Mar-Cod>844</Veh-Mar-Cod><Veh-Mar-Nom>LIFAN</Veh-Mar-Nom><Veh-Mar-Cod>845</Veh-Mar-Cod><Veh-Mar-Nom>RAFTER</Veh-Mar-Nom><Veh-Mar-Cod>846</Veh-Mar-Cod><Veh-Mar-Nom>DAYAMA</Veh-Mar-Nom><Veh-Mar-Cod>847</Veh-Mar-Cod><Veh-Mar-Nom>POLARIS</Veh-Mar-Nom><Veh-Mar-Cod>848</Veh-Mar-Cod><Veh-Mar-Nom>HYOSUNG</Veh-Mar-Nom><Veh-Mar-Cod>849</Veh-Mar-Cod><Veh-Mar-Nom>KTM</Veh-Mar-Nom><Veh-Mar-Cod>850</Veh-Mar-Cod><Veh-Mar-Nom>GAS GAS</Veh-Mar-Nom><Veh-Mar-Cod>851</Veh-Mar-Cod><Veh-Mar-Nom>PIT BIKE</Veh-Mar-Nom><Veh-Mar-Cod>852</Veh-Mar-Cod><Veh-Mar-Nom>BLOOWER</Veh-Mar-Nom><Veh-Mar-Cod>853</Veh-Mar-Cod><Veh-Mar-Nom>SYM</Veh-Mar-Nom><Veh-Mar-Cod>854</Veh-Mar-Cod><Veh-Mar-Nom>TVS</Veh-Mar-Nom><Veh-Mar-Cod>855</Veh-Mar-Cod><Veh-Mar-Nom>HUSQVARNA</Veh-Mar-Nom><Veh-Mar-Cod>881</Veh-Mar-Cod><Veh-Mar-Nom>HONDA</Veh-Mar-Nom><Veh-Mar-Cod>883</Veh-Mar-Cod><Veh-Mar-Nom>KONISA</Veh-Mar-Nom><Veh-Mar-Cod>884</Veh-Mar-Cod><Veh-Mar-Nom>BAJAJ</Veh-Mar-Nom><Veh-Mar-Cod>885</Veh-Mar-Cod><Veh-Mar-Nom>BABOON</Veh-Mar-Nom><Veh-Mar-Cod>886</Veh-Mar-Cod><Veh-Mar-Nom>JAWA</Veh-Mar-Nom><Veh-Mar-Cod>887</Veh-Mar-Cod><Veh-Mar-Nom>CAGIVA</Veh-Mar-Nom><Veh-Mar-Cod>888</Veh-Mar-Cod><Veh-Mar-Nom>JUKI</Veh-Mar-Nom><Veh-Mar-Cod>889</Veh-Mar-Cod><Veh-Mar-Nom>OLMO</Veh-Mar-Nom><Veh-Mar-Cod>890</Veh-Mar-Cod><Veh-Mar-Nom>BENELLI</Veh-Mar-Nom><Veh-Mar-Cod>910</Veh-Mar-Cod><Veh-Mar-Nom>MONDIAL</Veh-Mar-Nom><Veh-Mar-Cod>911</Veh-Mar-Cod><Veh-Mar-Nom>YAMAHA</Veh-Mar-Nom><Veh-Mar-Cod>912</Veh-Mar-Cod><Veh-Mar-Nom>JIANSHE</Veh-Mar-Nom><Veh-Mar-Cod>913</Veh-Mar-Cod><Veh-Mar-Nom>BETA</Veh-Mar-Nom><Veh-Mar-Cod>914</Veh-Mar-Cod><Veh-Mar-Nom>BMW</Veh-Mar-Nom><Veh-Mar-Cod>915</Veh-Mar-Cod><Veh-Mar-Nom>CERRO</Veh-Mar-Nom><Veh-Mar-Cod>916</Veh-Mar-Cod><Veh-Mar-Nom>SUZUKI</Veh-Mar-Nom><Veh-Mar-Cod>917</Veh-Mar-Cod><Veh-Mar-Nom>FAMSA</Veh-Mar-Nom><Veh-Mar-Cod>918</Veh-Mar-Cod><Veh-Mar-Nom>KIKAI</Veh-Mar-Nom><Veh-Mar-Cod>919</Veh-Mar-Cod><Veh-Mar-Nom>MINARELLI</Veh-Mar-Nom><Veh-Mar-Cod>920</Veh-Mar-Cod><Veh-Mar-Nom>MOTOMEL</Veh-Mar-Nom><Veh-Mar-Cod>921</Veh-Mar-Cod><Veh-Mar-Nom>PANTHER</Veh-Mar-Nom><Veh-Mar-Cod>922</Veh-Mar-Cod><Veh-Mar-Nom>VENTO</Veh-Mar-Nom><Veh-Mar-Cod>923</Veh-Mar-Cod><Veh-Mar-Nom>JINCHENG</Veh-Mar-Nom><Veh-Mar-Cod>924</Veh-Mar-Cod><Veh-Mar-Nom>DAELIM</Veh-Mar-Nom><Veh-Mar-Cod>925</Veh-Mar-Cod><Veh-Mar-Nom>CHIRETTE</Veh-Mar-Nom><Veh-Mar-Cod>926</Veh-Mar-Cod><Veh-Mar-Nom>HARLEY DAVI</Veh-Mar-Nom><Veh-Mar-Cod>927</Veh-Mar-Cod><Veh-Mar-Nom>XQUAD</Veh-Mar-Nom><Veh-Mar-Cod>928</Veh-Mar-Cod><Veh-Mar-Nom>BRAVA</Veh-Mar-Nom><Veh-Mar-Cod>929</Veh-Mar-Cod><Veh-Mar-Nom>VELIMOTOR</Veh-Mar-Nom><Veh-Mar-Cod>930</Veh-Mar-Cod><Veh-Mar-Nom>GUERRERO</Veh-Mar-Nom><Veh-Mar-Cod>931</Veh-Mar-Cod><Veh-Mar-Nom>HAMATSU</Veh-Mar-Nom><Veh-Mar-Cod>932</Veh-Mar-Cod><Veh-Mar-Nom>SUMO</Veh-Mar-Nom><Veh-Mar-Cod>934</Veh-Mar-Cod><Veh-Mar-Nom>OKINOI</Veh-Mar-Nom><Veh-Mar-Cod>935</Veh-Mar-Cod><Veh-Mar-Nom>DUCATI</Veh-Mar-Nom><Veh-Mar-Cod>936</Veh-Mar-Cod><Veh-Mar-Nom>DAYANG</Veh-Mar-Nom><Veh-Mar-Cod>937</Veh-Mar-Cod><Veh-Mar-Nom>KELLER</Veh-Mar-Nom><Veh-Mar-Cod>939</Veh-Mar-Cod><Veh-Mar-Nom>CORVEN</Veh-Mar-Nom><Veh-Mar-Cod>940</Veh-Mar-Cod><Veh-Mar-Nom>GILERA</Veh-Mar-Nom><Veh-Mar-Cod>941</Veh-Mar-Cod><Veh-Mar-Nom>GOES</Veh-Mar-Nom><Veh-Mar-Cod>942</Veh-Mar-Cod><Veh-Mar-Nom>APRILIA</Veh-Mar-Nom><Veh-Mar-Cod>943</Veh-Mar-Cod><Veh-Mar-Nom>XSCREEMS</Veh-Mar-Nom><Veh-Mar-Cod>944</Veh-Mar-Cod><Veh-Mar-Nom>EUROMOT</Veh-Mar-Nom><Veh-Mar-Cod>946</Veh-Mar-Cod><Veh-Mar-Nom>CAN AM</Veh-Mar-Nom><Veh-Mar-Cod>950</Veh-Mar-Cod><Veh-Mar-Nom>KYMCO</Veh-Mar-Nom><Veh-Mar-Cod>951</Veh-Mar-Cod><Veh-Mar-Nom>DYNAMIC</Veh-Mar-Nom><Veh-Mar-Cod>960</Veh-Mar-Cod><Veh-Mar-Nom>KAWASAKI</Veh-Mar-Nom><Veh-Mar-Cod>961</Veh-Mar-Cod><Veh-Mar-Nom>HERO</Veh-Mar-Nom><Veh-Mar-Cod>966</Veh-Mar-Cod><Veh-Mar-Nom>JIALING</Veh-Mar-Nom><Veh-Mar-Cod>970</Veh-Mar-Cod><Veh-Mar-Nom>MAVERICK</Veh-Mar-Nom><Veh-Mar-Cod>972</Veh-Mar-Cod><Veh-Mar-Nom>JINLING</Veh-Mar-Nom><Veh-Mar-Cod>973</Veh-Mar-Cod><Veh-Mar-Nom>DA DALT</Veh-Mar-Nom><Veh-Mar-Cod>980</Veh-Mar-Cod><Veh-Mar-Nom>APPIA</Veh-Mar-Nom><Veh-Mar-Cod>982</Veh-Mar-Cod><Veh-Mar-Nom>MV AGUSTA</Veh-Mar-Nom><Veh-Mar-Cod>990</Veh-Mar-Cod><Veh-Mar-Nom>ZANELLA MOTOS</Veh-Mar-Nom><Veh-Mar-Cod>991</Veh-Mar-Cod><Veh-Mar-Nom>ROYAL ENFIELD</Veh-Mar-Nom><Veh-Mar-Cod>992</Veh-Mar-Cod><Veh-Mar-Nom>TRIUMPH</Veh-Mar-Nom><Veh-Mar-Cod>993</Veh-Mar-Cod><Veh-Mar-Nom>VESPA</Veh-Mar-Nom><Veh-Mar-Cod>994</Veh-Mar-Cod><Veh-Mar-Nom>GUZZI</Veh-Mar-Nom><Veh-Mar-Cod>995</Veh-Mar-Cod><Veh-Mar-Nom>CF MOTO</Veh-Mar-Nom><Veh-Mar-Cod>997</Veh-Mar-Cod><Veh-Mar-Nom>GHIGGERI</Veh-Mar-Nom><Veh-Mar-Cod>998</Veh-Mar-Cod><Veh-Mar-Nom>JAGUAR ATV</Veh-Mar-Nom></Marcas>";
                break;

                 //MARCAS PARA CUATRICICLO
                case '3':
                    $curl="<Marcas><Veh-Mar-Cod>600</Veh-Mar-Cod><Veh-Mar-Nom>VOGE</Veh-Mar-Nom><Veh-Mar-Cod>601</Veh-Mar-Cod><Veh-Mar-Nom>SUNRA</Veh-Mar-Nom><Veh-Mar-Cod>836</Veh-Mar-Cod><Veh-Mar-Nom>PEUGEOT MOTOS</Veh-Mar-Nom><Veh-Mar-Cod>837</Veh-Mar-Cod><Veh-Mar-Nom>BLACKSTONE</Veh-Mar-Nom><Veh-Mar-Cod>838</Veh-Mar-Cod><Veh-Mar-Nom>TIBO</Veh-Mar-Nom><Veh-Mar-Cod>839</Veh-Mar-Cod><Veh-Mar-Nom>GAMMA</Veh-Mar-Nom><Veh-Mar-Cod>840</Veh-Mar-Cod><Veh-Mar-Nom>SKYGO</Veh-Mar-Nom><Veh-Mar-Cod>841</Veh-Mar-Cod><Veh-Mar-Nom>PIAGGIO</Veh-Mar-Nom><Veh-Mar-Cod>842</Veh-Mar-Cod><Veh-Mar-Nom>LEGNANO</Veh-Mar-Nom><Veh-Mar-Cod>843</Veh-Mar-Cod><Veh-Mar-Nom>IMSA</Veh-Mar-Nom><Veh-Mar-Cod>844</Veh-Mar-Cod><Veh-Mar-Nom>LIFAN</Veh-Mar-Nom><Veh-Mar-Cod>845</Veh-Mar-Cod><Veh-Mar-Nom>RAFTER</Veh-Mar-Nom><Veh-Mar-Cod>846</Veh-Mar-Cod><Veh-Mar-Nom>DAYAMA</Veh-Mar-Nom><Veh-Mar-Cod>847</Veh-Mar-Cod><Veh-Mar-Nom>POLARIS</Veh-Mar-Nom><Veh-Mar-Cod>848</Veh-Mar-Cod><Veh-Mar-Nom>HYOSUNG</Veh-Mar-Nom><Veh-Mar-Cod>849</Veh-Mar-Cod><Veh-Mar-Nom>KTM</Veh-Mar-Nom><Veh-Mar-Cod>850</Veh-Mar-Cod><Veh-Mar-Nom>GAS GAS</Veh-Mar-Nom><Veh-Mar-Cod>851</Veh-Mar-Cod><Veh-Mar-Nom>PIT BIKE</Veh-Mar-Nom><Veh-Mar-Cod>852</Veh-Mar-Cod><Veh-Mar-Nom>BLOOWER</Veh-Mar-Nom><Veh-Mar-Cod>853</Veh-Mar-Cod><Veh-Mar-Nom>SYM</Veh-Mar-Nom><Veh-Mar-Cod>854</Veh-Mar-Cod><Veh-Mar-Nom>TVS</Veh-Mar-Nom><Veh-Mar-Cod>855</Veh-Mar-Cod><Veh-Mar-Nom>HUSQVARNA</Veh-Mar-Nom><Veh-Mar-Cod>881</Veh-Mar-Cod><Veh-Mar-Nom>HONDA</Veh-Mar-Nom><Veh-Mar-Cod>883</Veh-Mar-Cod><Veh-Mar-Nom>KONISA</Veh-Mar-Nom><Veh-Mar-Cod>884</Veh-Mar-Cod><Veh-Mar-Nom>BAJAJ</Veh-Mar-Nom><Veh-Mar-Cod>885</Veh-Mar-Cod><Veh-Mar-Nom>BABOON</Veh-Mar-Nom><Veh-Mar-Cod>886</Veh-Mar-Cod><Veh-Mar-Nom>JAWA</Veh-Mar-Nom><Veh-Mar-Cod>887</Veh-Mar-Cod><Veh-Mar-Nom>CAGIVA</Veh-Mar-Nom><Veh-Mar-Cod>888</Veh-Mar-Cod><Veh-Mar-Nom>JUKI</Veh-Mar-Nom><Veh-Mar-Cod>889</Veh-Mar-Cod><Veh-Mar-Nom>OLMO</Veh-Mar-Nom><Veh-Mar-Cod>890</Veh-Mar-Cod><Veh-Mar-Nom>BENELLI</Veh-Mar-Nom><Veh-Mar-Cod>910</Veh-Mar-Cod><Veh-Mar-Nom>MONDIAL</Veh-Mar-Nom><Veh-Mar-Cod>911</Veh-Mar-Cod><Veh-Mar-Nom>YAMAHA</Veh-Mar-Nom><Veh-Mar-Cod>912</Veh-Mar-Cod><Veh-Mar-Nom>JIANSHE</Veh-Mar-Nom><Veh-Mar-Cod>913</Veh-Mar-Cod><Veh-Mar-Nom>BETA</Veh-Mar-Nom><Veh-Mar-Cod>914</Veh-Mar-Cod><Veh-Mar-Nom>BMW</Veh-Mar-Nom><Veh-Mar-Cod>915</Veh-Mar-Cod><Veh-Mar-Nom>CERRO</Veh-Mar-Nom><Veh-Mar-Cod>916</Veh-Mar-Cod><Veh-Mar-Nom>SUZUKI</Veh-Mar-Nom><Veh-Mar-Cod>917</Veh-Mar-Cod><Veh-Mar-Nom>FAMSA</Veh-Mar-Nom><Veh-Mar-Cod>918</Veh-Mar-Cod><Veh-Mar-Nom>KIKAI</Veh-Mar-Nom><Veh-Mar-Cod>919</Veh-Mar-Cod><Veh-Mar-Nom>MINARELLI</Veh-Mar-Nom><Veh-Mar-Cod>920</Veh-Mar-Cod><Veh-Mar-Nom>MOTOMEL</Veh-Mar-Nom><Veh-Mar-Cod>921</Veh-Mar-Cod><Veh-Mar-Nom>PANTHER</Veh-Mar-Nom><Veh-Mar-Cod>922</Veh-Mar-Cod><Veh-Mar-Nom>VENTO</Veh-Mar-Nom><Veh-Mar-Cod>923</Veh-Mar-Cod><Veh-Mar-Nom>JINCHENG</Veh-Mar-Nom><Veh-Mar-Cod>924</Veh-Mar-Cod><Veh-Mar-Nom>DAELIM</Veh-Mar-Nom><Veh-Mar-Cod>925</Veh-Mar-Cod><Veh-Mar-Nom>CHIRETTE</Veh-Mar-Nom><Veh-Mar-Cod>926</Veh-Mar-Cod><Veh-Mar-Nom>HARLEY DAVI</Veh-Mar-Nom><Veh-Mar-Cod>927</Veh-Mar-Cod><Veh-Mar-Nom>XQUAD</Veh-Mar-Nom><Veh-Mar-Cod>928</Veh-Mar-Cod><Veh-Mar-Nom>BRAVA</Veh-Mar-Nom><Veh-Mar-Cod>929</Veh-Mar-Cod><Veh-Mar-Nom>VELIMOTOR</Veh-Mar-Nom><Veh-Mar-Cod>930</Veh-Mar-Cod><Veh-Mar-Nom>GUERRERO</Veh-Mar-Nom><Veh-Mar-Cod>931</Veh-Mar-Cod><Veh-Mar-Nom>HAMATSU</Veh-Mar-Nom><Veh-Mar-Cod>932</Veh-Mar-Cod><Veh-Mar-Nom>SUMO</Veh-Mar-Nom><Veh-Mar-Cod>934</Veh-Mar-Cod><Veh-Mar-Nom>OKINOI</Veh-Mar-Nom><Veh-Mar-Cod>935</Veh-Mar-Cod><Veh-Mar-Nom>DUCATI</Veh-Mar-Nom><Veh-Mar-Cod>936</Veh-Mar-Cod><Veh-Mar-Nom>DAYANG</Veh-Mar-Nom><Veh-Mar-Cod>937</Veh-Mar-Cod><Veh-Mar-Nom>KELLER</Veh-Mar-Nom><Veh-Mar-Cod>939</Veh-Mar-Cod><Veh-Mar-Nom>CORVEN</Veh-Mar-Nom><Veh-Mar-Cod>940</Veh-Mar-Cod><Veh-Mar-Nom>GILERA</Veh-Mar-Nom><Veh-Mar-Cod>941</Veh-Mar-Cod><Veh-Mar-Nom>GOES</Veh-Mar-Nom><Veh-Mar-Cod>942</Veh-Mar-Cod><Veh-Mar-Nom>APRILIA</Veh-Mar-Nom><Veh-Mar-Cod>943</Veh-Mar-Cod><Veh-Mar-Nom>XSCREEMS</Veh-Mar-Nom><Veh-Mar-Cod>944</Veh-Mar-Cod><Veh-Mar-Nom>EUROMOT</Veh-Mar-Nom><Veh-Mar-Cod>946</Veh-Mar-Cod><Veh-Mar-Nom>CAN AM</Veh-Mar-Nom><Veh-Mar-Cod>950</Veh-Mar-Cod><Veh-Mar-Nom>KYMCO</Veh-Mar-Nom><Veh-Mar-Cod>951</Veh-Mar-Cod><Veh-Mar-Nom>DYNAMIC</Veh-Mar-Nom><Veh-Mar-Cod>960</Veh-Mar-Cod><Veh-Mar-Nom>KAWASAKI</Veh-Mar-Nom><Veh-Mar-Cod>961</Veh-Mar-Cod><Veh-Mar-Nom>HERO</Veh-Mar-Nom><Veh-Mar-Cod>966</Veh-Mar-Cod><Veh-Mar-Nom>JIALING</Veh-Mar-Nom><Veh-Mar-Cod>970</Veh-Mar-Cod><Veh-Mar-Nom>MAVERICK</Veh-Mar-Nom><Veh-Mar-Cod>972</Veh-Mar-Cod><Veh-Mar-Nom>JINLING</Veh-Mar-Nom><Veh-Mar-Cod>973</Veh-Mar-Cod><Veh-Mar-Nom>DA DALT</Veh-Mar-Nom><Veh-Mar-Cod>980</Veh-Mar-Cod><Veh-Mar-Nom>APPIA</Veh-Mar-Nom><Veh-Mar-Cod>982</Veh-Mar-Cod><Veh-Mar-Nom>MV AGUSTA</Veh-Mar-Nom><Veh-Mar-Cod>990</Veh-Mar-Cod><Veh-Mar-Nom>ZANELLA MOTOS</Veh-Mar-Nom><Veh-Mar-Cod>991</Veh-Mar-Cod><Veh-Mar-Nom>ROYAL ENFIELD</Veh-Mar-Nom><Veh-Mar-Cod>992</Veh-Mar-Cod><Veh-Mar-Nom>TRIUMPH</Veh-Mar-Nom><Veh-Mar-Cod>993</Veh-Mar-Cod><Veh-Mar-Nom>VESPA</Veh-Mar-Nom><Veh-Mar-Cod>994</Veh-Mar-Cod><Veh-Mar-Nom>GUZZI</Veh-Mar-Nom><Veh-Mar-Cod>995</Veh-Mar-Cod><Veh-Mar-Nom>CF MOTO</Veh-Mar-Nom><Veh-Mar-Cod>997</Veh-Mar-Cod><Veh-Mar-Nom>GHIGGERI</Veh-Mar-Nom><Veh-Mar-Cod>998</Veh-Mar-Cod><Veh-Mar-Nom>JAGUAR ATV</Veh-Mar-Nom></Marcas>";
                break;

                default:

                $curl='';
                break;
            }
            //3 = automotor
         }else if($secCod=='3'){
            switch($tipoVehiculo){
                //MARCAS PARA AUTOS NACIONALES
                case '1':
                    $curl="<Marcas><Veh-Mar-Cod>1</Veh-Mar-Cod><Veh-Mar-Nom>ACURA</Veh-Mar-Nom><Veh-Mar-Cod>2</Veh-Mar-Cod><Veh-Mar-Nom>ALEKO</Veh-Mar-Nom><Veh-Mar-Cod>3</Veh-Mar-Cod><Veh-Mar-Nom>ALFA ROMEO</Veh-Mar-Nom><Veh-Mar-Cod>4</Veh-Mar-Cod><Veh-Mar-Nom>ARO</Veh-Mar-Nom><Veh-Mar-Cod>5</Veh-Mar-Cod><Veh-Mar-Nom>ASIA</Veh-Mar-Nom><Veh-Mar-Cod>6</Veh-Mar-Cod><Veh-Mar-Nom>AUDI</Veh-Mar-Nom><Veh-Mar-Cod>7</Veh-Mar-Cod><Veh-Mar-Nom>AUTOBIANCHI</Veh-Mar-Nom><Veh-Mar-Cod>8</Veh-Mar-Cod><Veh-Mar-Nom>BMW</Veh-Mar-Nom><Veh-Mar-Cod>9</Veh-Mar-Cod><Veh-Mar-Nom>BUIK</Veh-Mar-Nom><Veh-Mar-Cod>10</Veh-Mar-Cod><Veh-Mar-Nom>CADILLAC</Veh-Mar-Nom><Veh-Mar-Cod>11</Veh-Mar-Cod><Veh-Mar-Nom>CITROEN</Veh-Mar-Nom><Veh-Mar-Cod>12</Veh-Mar-Cod><Veh-Mar-Nom>CHEVROLET</Veh-Mar-Nom><Veh-Mar-Cod>13</Veh-Mar-Cod><Veh-Mar-Nom>CHRYSLER</Veh-Mar-Nom><Veh-Mar-Cod>14</Veh-Mar-Cod><Veh-Mar-Nom>DACIA</Veh-Mar-Nom><Veh-Mar-Cod>15</Veh-Mar-Cod><Veh-Mar-Nom>DAEWOO</Veh-Mar-Nom><Veh-Mar-Cod>16</Veh-Mar-Cod><Veh-Mar-Nom>DAIHATSU</Veh-Mar-Nom><Veh-Mar-Cod>17</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>18</Veh-Mar-Cod><Veh-Mar-Nom>FORD</Veh-Mar-Nom><Veh-Mar-Cod>19</Veh-Mar-Cod><Veh-Mar-Nom>HONDA</Veh-Mar-Nom><Veh-Mar-Cod>20</Veh-Mar-Cod><Veh-Mar-Nom>HYUNDAI</Veh-Mar-Nom><Veh-Mar-Cod>22</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU</Veh-Mar-Nom><Veh-Mar-Cod>23</Veh-Mar-Cod><Veh-Mar-Nom>JAGUAR</Veh-Mar-Nom><Veh-Mar-Cod>24</Veh-Mar-Cod><Veh-Mar-Nom>KIA</Veh-Mar-Nom><Veh-Mar-Cod>25</Veh-Mar-Cod><Veh-Mar-Nom>LADA</Veh-Mar-Nom><Veh-Mar-Cod>26</Veh-Mar-Cod><Veh-Mar-Nom>MAZDA</Veh-Mar-Nom><Veh-Mar-Cod>27</Veh-Mar-Cod><Veh-Mar-Nom>MERCURY</Veh-Mar-Nom><Veh-Mar-Cod>28</Veh-Mar-Cod><Veh-Mar-Nom>MERCEDES BENZ</Veh-Mar-Nom><Veh-Mar-Cod>29</Veh-Mar-Cod><Veh-Mar-Nom>MITSUBISHI</Veh-Mar-Nom><Veh-Mar-Cod>30</Veh-Mar-Cod><Veh-Mar-Nom>NISSAN</Veh-Mar-Nom><Veh-Mar-Cod>31</Veh-Mar-Cod><Veh-Mar-Nom>OPEL</Veh-Mar-Nom><Veh-Mar-Cod>32</Veh-Mar-Cod><Veh-Mar-Nom>PEUGEOT</Veh-Mar-Nom><Veh-Mar-Cod>33</Veh-Mar-Cod><Veh-Mar-Nom>POLONEZ</Veh-Mar-Nom><Veh-Mar-Cod>34</Veh-Mar-Cod><Veh-Mar-Nom>PONTIAC</Veh-Mar-Nom><Veh-Mar-Cod>35</Veh-Mar-Cod><Veh-Mar-Nom>PORSCHE</Veh-Mar-Nom><Veh-Mar-Cod>36</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>37</Veh-Mar-Cod><Veh-Mar-Nom>ROVER-LAND ROV.</Veh-Mar-Nom><Veh-Mar-Cod>38</Veh-Mar-Cod><Veh-Mar-Nom>SAAB</Veh-Mar-Nom><Veh-Mar-Cod>39</Veh-Mar-Cod><Veh-Mar-Nom>SEAT</Veh-Mar-Nom><Veh-Mar-Cod>40</Veh-Mar-Cod><Veh-Mar-Nom>SKODA</Veh-Mar-Nom><Veh-Mar-Cod>42</Veh-Mar-Cod><Veh-Mar-Nom>SUBARU</Veh-Mar-Nom><Veh-Mar-Cod>43</Veh-Mar-Cod><Veh-Mar-Nom>SUZUKI</Veh-Mar-Nom><Veh-Mar-Cod>44</Veh-Mar-Cod><Veh-Mar-Nom>TAVRIA</Veh-Mar-Nom><Veh-Mar-Cod>45</Veh-Mar-Cod><Veh-Mar-Nom>TOYOTA</Veh-Mar-Nom><Veh-Mar-Cod>46</Veh-Mar-Cod><Veh-Mar-Nom>VOLKSWAGEN</Veh-Mar-Nom><Veh-Mar-Cod>47</Veh-Mar-Cod><Veh-Mar-Nom>VOLVO</Veh-Mar-Nom><Veh-Mar-Cod>48</Veh-Mar-Cod><Veh-Mar-Nom>PROTON</Veh-Mar-Nom><Veh-Mar-Cod>49</Veh-Mar-Cod><Veh-Mar-Nom>HUMMER</Veh-Mar-Nom><Veh-Mar-Cod>51</Veh-Mar-Cod><Veh-Mar-Nom>FERRARI</Veh-Mar-Nom><Veh-Mar-Cod>52</Veh-Mar-Cod><Veh-Mar-Nom>HAM-JIANG</Veh-Mar-Nom><Veh-Mar-Cod>53</Veh-Mar-Cod><Veh-Mar-Nom>LANCIA</Veh-Mar-Nom><Veh-Mar-Cod>54</Veh-Mar-Cod><Veh-Mar-Nom>ENIAK</Veh-Mar-Nom><Veh-Mar-Cod>55</Veh-Mar-Cod><Veh-Mar-Nom>MAHINDRA</Veh-Mar-Nom><Veh-Mar-Cod>56</Veh-Mar-Cod><Veh-Mar-Nom>RASTROJERO</Veh-Mar-Nom><Veh-Mar-Cod>57</Veh-Mar-Cod><Veh-Mar-Nom>TATA</Veh-Mar-Nom><Veh-Mar-Cod>58</Veh-Mar-Cod><Veh-Mar-Nom>BLAC</Veh-Mar-Nom><Veh-Mar-Cod>59</Veh-Mar-Cod><Veh-Mar-Nom>I.K.A. RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>60</Veh-Mar-Cod><Veh-Mar-Nom>AUSTIN</Veh-Mar-Nom><Veh-Mar-Cod>61</Veh-Mar-Cod><Veh-Mar-Nom>BERTONE</Veh-Mar-Nom><Veh-Mar-Cod>62</Veh-Mar-Cod><Veh-Mar-Nom>METRO</Veh-Mar-Nom><Veh-Mar-Cod>63</Veh-Mar-Cod><Veh-Mar-Nom>AGRALE</Veh-Mar-Nom><Veh-Mar-Cod>65</Veh-Mar-Cod><Veh-Mar-Nom>RANQUEL</Veh-Mar-Nom><Veh-Mar-Cod>67</Veh-Mar-Cod><Veh-Mar-Nom>MAESTRO</Veh-Mar-Nom><Veh-Mar-Cod>68</Veh-Mar-Cod><Veh-Mar-Nom>JINBEI</Veh-Mar-Nom><Veh-Mar-Cod>69</Veh-Mar-Cod><Veh-Mar-Nom>F.E.R.E.S.A.</Veh-Mar-Nom><Veh-Mar-Cod>77</Veh-Mar-Cod><Veh-Mar-Nom>NAKAI (CHANGAN)</Veh-Mar-Nom><Veh-Mar-Cod>79</Veh-Mar-Cod><Veh-Mar-Nom>G.A.Z.</Veh-Mar-Nom><Veh-Mar-Cod>80</Veh-Mar-Cod><Veh-Mar-Nom>HINO</Veh-Mar-Nom><Veh-Mar-Cod>81</Veh-Mar-Cod><Veh-Mar-Nom>IZH</Veh-Mar-Nom><Veh-Mar-Cod>85</Veh-Mar-Cod><Veh-Mar-Nom>UAZ</Veh-Mar-Nom><Veh-Mar-Cod>94</Veh-Mar-Cod><Veh-Mar-Nom>PIAGGIO</Veh-Mar-Nom><Veh-Mar-Cod>96</Veh-Mar-Cod><Veh-Mar-Nom>STAR (3-STAR)</Veh-Mar-Nom><Veh-Mar-Cod>97</Veh-Mar-Cod><Veh-Mar-Nom>YANTAI</Veh-Mar-Nom><Veh-Mar-Cod>98</Veh-Mar-Cod><Veh-Mar-Nom>JAC</Veh-Mar-Nom><Veh-Mar-Cod>99</Veh-Mar-Cod><Veh-Mar-Nom>HEIBAO</Veh-Mar-Nom><Veh-Mar-Cod>100</Veh-Mar-Cod><Veh-Mar-Nom>WULING MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>101</Veh-Mar-Cod><Veh-Mar-Nom>SPACE</Veh-Mar-Nom><Veh-Mar-Cod>102</Veh-Mar-Cod><Veh-Mar-Nom>MASERATI</Veh-Mar-Nom><Veh-Mar-Cod>103</Veh-Mar-Cod><Veh-Mar-Nom>SANTANA</Veh-Mar-Nom><Veh-Mar-Cod>104</Veh-Mar-Cod><Veh-Mar-Nom>SIAM DI TELLA</Veh-Mar-Nom><Veh-Mar-Cod>105</Veh-Mar-Cod><Veh-Mar-Nom>PLYMOUTH</Veh-Mar-Nom><Veh-Mar-Cod>106</Veh-Mar-Cod><Veh-Mar-Nom>MINI COOPER</Veh-Mar-Nom><Veh-Mar-Cod>107</Veh-Mar-Cod><Veh-Mar-Nom>ROLLS ROYCE</Veh-Mar-Nom><Veh-Mar-Cod>108</Veh-Mar-Cod><Veh-Mar-Nom>CHERY</Veh-Mar-Nom><Veh-Mar-Cod>109</Veh-Mar-Cod><Veh-Mar-Nom>LINCOLN</Veh-Mar-Nom><Veh-Mar-Cod>110</Veh-Mar-Cod><Veh-Mar-Nom>SMART</Veh-Mar-Nom><Veh-Mar-Cod>111</Veh-Mar-Cod><Veh-Mar-Nom>MACK</Veh-Mar-Nom><Veh-Mar-Cod>112</Veh-Mar-Cod><Veh-Mar-Nom>DFM</Veh-Mar-Nom><Veh-Mar-Cod>113</Veh-Mar-Cod><Veh-Mar-Nom>JMC</Veh-Mar-Nom><Veh-Mar-Cod>114</Veh-Mar-Cod><Veh-Mar-Nom>LIFAN</Veh-Mar-Nom><Veh-Mar-Cod>115</Veh-Mar-Cod><Veh-Mar-Nom>FOTON</Veh-Mar-Nom><Veh-Mar-Cod>116</Veh-Mar-Cod><Veh-Mar-Nom>GEELY</Veh-Mar-Nom><Veh-Mar-Cod>117</Veh-Mar-Cod><Veh-Mar-Nom>DS AUTOMOBILES</Veh-Mar-Nom><Veh-Mar-Cod>118</Veh-Mar-Cod><Veh-Mar-Nom>BAIC</Veh-Mar-Nom><Veh-Mar-Cod>119</Veh-Mar-Cod><Veh-Mar-Nom>DFSK</Veh-Mar-Nom><Veh-Mar-Cod>120</Veh-Mar-Cod><Veh-Mar-Nom>SHINERAY</Veh-Mar-Nom><Veh-Mar-Cod>121</Veh-Mar-Cod><Veh-Mar-Nom>GREAT WALL</Veh-Mar-Nom><Veh-Mar-Cod>122</Veh-Mar-Cod><Veh-Mar-Nom>HAVAL</Veh-Mar-Nom><Veh-Mar-Cod>124</Veh-Mar-Cod><Veh-Mar-Nom>CHANGAN</Veh-Mar-Nom><Veh-Mar-Cod>125</Veh-Mar-Cod><Veh-Mar-Nom>ZANELLA</Veh-Mar-Nom><Veh-Mar-Cod>126</Veh-Mar-Cod><Veh-Mar-Nom>SERO ELECTRIC</Veh-Mar-Nom><Veh-Mar-Cod>127</Veh-Mar-Cod><Veh-Mar-Nom>SOUEAST</Veh-Mar-Nom><Veh-Mar-Cod>128</Veh-Mar-Cod><Veh-Mar-Nom>MCLAREN</Veh-Mar-Nom><Veh-Mar-Cod>5001</Veh-Mar-Cod><Veh-Mar-Nom>SIN MARCA</Veh-Mar-Nom><Veh-Mar-Cod>5002</Veh-Mar-Cod><Veh-Mar-Nom>DODGE</Veh-Mar-Nom><Veh-Mar-Cod>5003</Veh-Mar-Cod><Veh-Mar-Nom>HERMANN</Veh-Mar-Nom><Veh-Mar-Cod>5004</Veh-Mar-Cod><Veh-Mar-Nom>RANDON</Veh-Mar-Nom><Veh-Mar-Cod>5005</Veh-Mar-Cod><Veh-Mar-Nom>OMBU</Veh-Mar-Nom><Veh-Mar-Cod>5006</Veh-Mar-Cod><Veh-Mar-Nom>SALTO</Veh-Mar-Nom><Veh-Mar-Cod>5007</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>5008</Veh-Mar-Cod><Veh-Mar-Nom>MONTENEGRO</Veh-Mar-Nom><Veh-Mar-Cod>5009</Veh-Mar-Cod><Veh-Mar-Nom>AFF</Veh-Mar-Nom><Veh-Mar-Cod>5010</Veh-Mar-Cod><Veh-Mar-Nom>PLUS CARGA</Veh-Mar-Nom><Veh-Mar-Cod>5011</Veh-Mar-Cod><Veh-Mar-Nom>DANES</Veh-Mar-Nom><Veh-Mar-Cod>5012</Veh-Mar-Cod><Veh-Mar-Nom>HELVETICA</Veh-Mar-Nom><Veh-Mar-Cod>5013</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUV</Veh-Mar-Nom><Veh-Mar-Cod>5014</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>5015</Veh-Mar-Cod><Veh-Mar-Nom>SOLA Y BRUSA</Veh-Mar-Nom><Veh-Mar-Cod>5018</Veh-Mar-Cod><Veh-Mar-Nom>KRONE</Veh-Mar-Nom><Veh-Mar-Cod>5020</Veh-Mar-Cod><Veh-Mar-Nom>JEEP</Veh-Mar-Nom><Veh-Mar-Cod>5021</Veh-Mar-Cod><Veh-Mar-Nom>PEGASO</Veh-Mar-Nom><Veh-Mar-Cod>5022</Veh-Mar-Cod><Veh-Mar-Nom>MALDONADO</Veh-Mar-Nom><Veh-Mar-Cod>5023</Veh-Mar-Cod><Veh-Mar-Nom>GRASSANI</Veh-Mar-Nom><Veh-Mar-Cod>5025</Veh-Mar-Cod><Veh-Mar-Nom>NAVARRO HERMANOS</Veh-Mar-Nom><Veh-Mar-Cod>5026</Veh-Mar-Cod><Veh-Mar-Nom>FERESA</Veh-Mar-Nom><Veh-Mar-Cod>5027</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUC</Veh-Mar-Nom><Veh-Mar-Cod>5028</Veh-Mar-Cod><Veh-Mar-Nom>INTEGRAL</Veh-Mar-Nom><Veh-Mar-Cod>5029</Veh-Mar-Cod><Veh-Mar-Nom>SSANGYONG</Veh-Mar-Nom><Veh-Mar-Cod>5031</Veh-Mar-Cod><Veh-Mar-Nom>GONELLA</Veh-Mar-Nom><Veh-Mar-Cod>5034</Veh-Mar-Cod><Veh-Mar-Nom>BONANO</Veh-Mar-Nom><Veh-Mar-Cod>5035</Veh-Mar-Cod><Veh-Mar-Nom>GMC CHEVETTE</Veh-Mar-Nom><Veh-Mar-Cod>5036</Veh-Mar-Cod><Veh-Mar-Nom>GENERAL MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>5037</Veh-Mar-Cod><Veh-Mar-Nom>PETINARI</Veh-Mar-Nom><Veh-Mar-Cod>5040</Veh-Mar-Cod><Veh-Mar-Nom>FARGO CAMION</Veh-Mar-Nom><Veh-Mar-Cod>5041</Veh-Mar-Cod><Veh-Mar-Nom>AST-PRA</Veh-Mar-Nom><Veh-Mar-Cod>5043</Veh-Mar-Cod><Veh-Mar-Nom>EL CRESPIN</Veh-Mar-Nom><Veh-Mar-Cod>5046</Veh-Mar-Cod><Veh-Mar-Nom>IES</Veh-Mar-Nom><Veh-Mar-Cod>5049</Veh-Mar-Cod><Veh-Mar-Nom>PRATI FRUE</Veh-Mar-Nom><Veh-Mar-Cod>5050</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU C</Veh-Mar-Nom><Veh-Mar-Cod>5052</Veh-Mar-Cod><Veh-Mar-Nom>IVECO</Veh-Mar-Nom><Veh-Mar-Cod>5053</Veh-Mar-Cod><Veh-Mar-Nom>VULCANO</Veh-Mar-Nom><Veh-Mar-Cod>5054</Veh-Mar-Cod><Veh-Mar-Nom></Veh-Mar-Nom><Veh-Mar-Cod>5057</Veh-Mar-Cod><Veh-Mar-Nom>CORMETAL</Veh-Mar-Nom><Veh-Mar-Cod>5064</Veh-Mar-Cod><Veh-Mar-Nom>LUKMAN</Veh-Mar-Nom><Veh-Mar-Cod>5065</Veh-Mar-Cod><Veh-Mar-Nom>GENTILE</Veh-Mar-Nom><Veh-Mar-Cod>5068</Veh-Mar-Cod><Veh-Mar-Nom>DATSUN</Veh-Mar-Nom></Marcas>";
                break;

                 //MARCAS PARA AUTO IMPORTADOS
                case '2':
                    $curl="<Marcas><Veh-Mar-Cod>1</Veh-Mar-Cod><Veh-Mar-Nom>ACURA</Veh-Mar-Nom><Veh-Mar-Cod>2</Veh-Mar-Cod><Veh-Mar-Nom>ALEKO</Veh-Mar-Nom><Veh-Mar-Cod>3</Veh-Mar-Cod><Veh-Mar-Nom>ALFA ROMEO</Veh-Mar-Nom><Veh-Mar-Cod>4</Veh-Mar-Cod><Veh-Mar-Nom>ARO</Veh-Mar-Nom><Veh-Mar-Cod>5</Veh-Mar-Cod><Veh-Mar-Nom>ASIA</Veh-Mar-Nom><Veh-Mar-Cod>6</Veh-Mar-Cod><Veh-Mar-Nom>AUDI</Veh-Mar-Nom><Veh-Mar-Cod>7</Veh-Mar-Cod><Veh-Mar-Nom>AUTOBIANCHI</Veh-Mar-Nom><Veh-Mar-Cod>8</Veh-Mar-Cod><Veh-Mar-Nom>BMW</Veh-Mar-Nom><Veh-Mar-Cod>9</Veh-Mar-Cod><Veh-Mar-Nom>BUIK</Veh-Mar-Nom><Veh-Mar-Cod>10</Veh-Mar-Cod><Veh-Mar-Nom>CADILLAC</Veh-Mar-Nom><Veh-Mar-Cod>11</Veh-Mar-Cod><Veh-Mar-Nom>CITROEN</Veh-Mar-Nom><Veh-Mar-Cod>12</Veh-Mar-Cod><Veh-Mar-Nom>CHEVROLET</Veh-Mar-Nom><Veh-Mar-Cod>13</Veh-Mar-Cod><Veh-Mar-Nom>CHRYSLER</Veh-Mar-Nom><Veh-Mar-Cod>14</Veh-Mar-Cod><Veh-Mar-Nom>DACIA</Veh-Mar-Nom><Veh-Mar-Cod>15</Veh-Mar-Cod><Veh-Mar-Nom>DAEWOO</Veh-Mar-Nom><Veh-Mar-Cod>16</Veh-Mar-Cod><Veh-Mar-Nom>DAIHATSU</Veh-Mar-Nom><Veh-Mar-Cod>17</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>18</Veh-Mar-Cod><Veh-Mar-Nom>FORD</Veh-Mar-Nom><Veh-Mar-Cod>19</Veh-Mar-Cod><Veh-Mar-Nom>HONDA</Veh-Mar-Nom><Veh-Mar-Cod>20</Veh-Mar-Cod><Veh-Mar-Nom>HYUNDAI</Veh-Mar-Nom><Veh-Mar-Cod>22</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU</Veh-Mar-Nom><Veh-Mar-Cod>23</Veh-Mar-Cod><Veh-Mar-Nom>JAGUAR</Veh-Mar-Nom><Veh-Mar-Cod>24</Veh-Mar-Cod><Veh-Mar-Nom>KIA</Veh-Mar-Nom><Veh-Mar-Cod>25</Veh-Mar-Cod><Veh-Mar-Nom>LADA</Veh-Mar-Nom><Veh-Mar-Cod>26</Veh-Mar-Cod><Veh-Mar-Nom>MAZDA</Veh-Mar-Nom><Veh-Mar-Cod>27</Veh-Mar-Cod><Veh-Mar-Nom>MERCURY</Veh-Mar-Nom><Veh-Mar-Cod>28</Veh-Mar-Cod><Veh-Mar-Nom>MERCEDES BENZ</Veh-Mar-Nom><Veh-Mar-Cod>29</Veh-Mar-Cod><Veh-Mar-Nom>MITSUBISHI</Veh-Mar-Nom><Veh-Mar-Cod>30</Veh-Mar-Cod><Veh-Mar-Nom>NISSAN</Veh-Mar-Nom><Veh-Mar-Cod>31</Veh-Mar-Cod><Veh-Mar-Nom>OPEL</Veh-Mar-Nom><Veh-Mar-Cod>32</Veh-Mar-Cod><Veh-Mar-Nom>PEUGEOT</Veh-Mar-Nom><Veh-Mar-Cod>33</Veh-Mar-Cod><Veh-Mar-Nom>POLONEZ</Veh-Mar-Nom><Veh-Mar-Cod>34</Veh-Mar-Cod><Veh-Mar-Nom>PONTIAC</Veh-Mar-Nom><Veh-Mar-Cod>35</Veh-Mar-Cod><Veh-Mar-Nom>PORSCHE</Veh-Mar-Nom><Veh-Mar-Cod>36</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>37</Veh-Mar-Cod><Veh-Mar-Nom>ROVER-LAND ROV.</Veh-Mar-Nom><Veh-Mar-Cod>38</Veh-Mar-Cod><Veh-Mar-Nom>SAAB</Veh-Mar-Nom><Veh-Mar-Cod>39</Veh-Mar-Cod><Veh-Mar-Nom>SEAT</Veh-Mar-Nom><Veh-Mar-Cod>40</Veh-Mar-Cod><Veh-Mar-Nom>SKODA</Veh-Mar-Nom><Veh-Mar-Cod>42</Veh-Mar-Cod><Veh-Mar-Nom>SUBARU</Veh-Mar-Nom><Veh-Mar-Cod>43</Veh-Mar-Cod><Veh-Mar-Nom>SUZUKI</Veh-Mar-Nom><Veh-Mar-Cod>44</Veh-Mar-Cod><Veh-Mar-Nom>TAVRIA</Veh-Mar-Nom><Veh-Mar-Cod>45</Veh-Mar-Cod><Veh-Mar-Nom>TOYOTA</Veh-Mar-Nom><Veh-Mar-Cod>46</Veh-Mar-Cod><Veh-Mar-Nom>VOLKSWAGEN</Veh-Mar-Nom><Veh-Mar-Cod>47</Veh-Mar-Cod><Veh-Mar-Nom>VOLVO</Veh-Mar-Nom><Veh-Mar-Cod>48</Veh-Mar-Cod><Veh-Mar-Nom>PROTON</Veh-Mar-Nom><Veh-Mar-Cod>49</Veh-Mar-Cod><Veh-Mar-Nom>HUMMER</Veh-Mar-Nom><Veh-Mar-Cod>51</Veh-Mar-Cod><Veh-Mar-Nom>FERRARI</Veh-Mar-Nom><Veh-Mar-Cod>52</Veh-Mar-Cod><Veh-Mar-Nom>HAM-JIANG</Veh-Mar-Nom><Veh-Mar-Cod>53</Veh-Mar-Cod><Veh-Mar-Nom>LANCIA</Veh-Mar-Nom><Veh-Mar-Cod>54</Veh-Mar-Cod><Veh-Mar-Nom>ENIAK</Veh-Mar-Nom><Veh-Mar-Cod>55</Veh-Mar-Cod><Veh-Mar-Nom>MAHINDRA</Veh-Mar-Nom><Veh-Mar-Cod>56</Veh-Mar-Cod><Veh-Mar-Nom>RASTROJERO</Veh-Mar-Nom><Veh-Mar-Cod>57</Veh-Mar-Cod><Veh-Mar-Nom>TATA</Veh-Mar-Nom><Veh-Mar-Cod>58</Veh-Mar-Cod><Veh-Mar-Nom>BLAC</Veh-Mar-Nom><Veh-Mar-Cod>59</Veh-Mar-Cod><Veh-Mar-Nom>I.K.A. RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>60</Veh-Mar-Cod><Veh-Mar-Nom>AUSTIN</Veh-Mar-Nom><Veh-Mar-Cod>61</Veh-Mar-Cod><Veh-Mar-Nom>BERTONE</Veh-Mar-Nom><Veh-Mar-Cod>62</Veh-Mar-Cod><Veh-Mar-Nom>METRO</Veh-Mar-Nom><Veh-Mar-Cod>63</Veh-Mar-Cod><Veh-Mar-Nom>AGRALE</Veh-Mar-Nom><Veh-Mar-Cod>65</Veh-Mar-Cod><Veh-Mar-Nom>RANQUEL</Veh-Mar-Nom><Veh-Mar-Cod>67</Veh-Mar-Cod><Veh-Mar-Nom>MAESTRO</Veh-Mar-Nom><Veh-Mar-Cod>68</Veh-Mar-Cod><Veh-Mar-Nom>JINBEI</Veh-Mar-Nom><Veh-Mar-Cod>69</Veh-Mar-Cod><Veh-Mar-Nom>F.E.R.E.S.A.</Veh-Mar-Nom><Veh-Mar-Cod>77</Veh-Mar-Cod><Veh-Mar-Nom>NAKAI (CHANGAN)</Veh-Mar-Nom><Veh-Mar-Cod>79</Veh-Mar-Cod><Veh-Mar-Nom>G.A.Z.</Veh-Mar-Nom><Veh-Mar-Cod>80</Veh-Mar-Cod><Veh-Mar-Nom>HINO</Veh-Mar-Nom><Veh-Mar-Cod>81</Veh-Mar-Cod><Veh-Mar-Nom>IZH</Veh-Mar-Nom><Veh-Mar-Cod>85</Veh-Mar-Cod><Veh-Mar-Nom>UAZ</Veh-Mar-Nom><Veh-Mar-Cod>94</Veh-Mar-Cod><Veh-Mar-Nom>PIAGGIO</Veh-Mar-Nom><Veh-Mar-Cod>96</Veh-Mar-Cod><Veh-Mar-Nom>STAR (3-STAR)</Veh-Mar-Nom><Veh-Mar-Cod>97</Veh-Mar-Cod><Veh-Mar-Nom>YANTAI</Veh-Mar-Nom><Veh-Mar-Cod>98</Veh-Mar-Cod><Veh-Mar-Nom>JAC</Veh-Mar-Nom><Veh-Mar-Cod>99</Veh-Mar-Cod><Veh-Mar-Nom>HEIBAO</Veh-Mar-Nom><Veh-Mar-Cod>100</Veh-Mar-Cod><Veh-Mar-Nom>WULING MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>101</Veh-Mar-Cod><Veh-Mar-Nom>SPACE</Veh-Mar-Nom><Veh-Mar-Cod>102</Veh-Mar-Cod><Veh-Mar-Nom>MASERATI</Veh-Mar-Nom><Veh-Mar-Cod>103</Veh-Mar-Cod><Veh-Mar-Nom>SANTANA</Veh-Mar-Nom><Veh-Mar-Cod>104</Veh-Mar-Cod><Veh-Mar-Nom>SIAM DI TELLA</Veh-Mar-Nom><Veh-Mar-Cod>105</Veh-Mar-Cod><Veh-Mar-Nom>PLYMOUTH</Veh-Mar-Nom><Veh-Mar-Cod>106</Veh-Mar-Cod><Veh-Mar-Nom>MINI COOPER</Veh-Mar-Nom><Veh-Mar-Cod>107</Veh-Mar-Cod><Veh-Mar-Nom>ROLLS ROYCE</Veh-Mar-Nom><Veh-Mar-Cod>108</Veh-Mar-Cod><Veh-Mar-Nom>CHERY</Veh-Mar-Nom><Veh-Mar-Cod>109</Veh-Mar-Cod><Veh-Mar-Nom>LINCOLN</Veh-Mar-Nom><Veh-Mar-Cod>110</Veh-Mar-Cod><Veh-Mar-Nom>SMART</Veh-Mar-Nom><Veh-Mar-Cod>111</Veh-Mar-Cod><Veh-Mar-Nom>MACK</Veh-Mar-Nom><Veh-Mar-Cod>112</Veh-Mar-Cod><Veh-Mar-Nom>DFM</Veh-Mar-Nom><Veh-Mar-Cod>113</Veh-Mar-Cod><Veh-Mar-Nom>JMC</Veh-Mar-Nom><Veh-Mar-Cod>114</Veh-Mar-Cod><Veh-Mar-Nom>LIFAN</Veh-Mar-Nom><Veh-Mar-Cod>115</Veh-Mar-Cod><Veh-Mar-Nom>FOTON</Veh-Mar-Nom><Veh-Mar-Cod>116</Veh-Mar-Cod><Veh-Mar-Nom>GEELY</Veh-Mar-Nom><Veh-Mar-Cod>117</Veh-Mar-Cod><Veh-Mar-Nom>DS AUTOMOBILES</Veh-Mar-Nom><Veh-Mar-Cod>118</Veh-Mar-Cod><Veh-Mar-Nom>BAIC</Veh-Mar-Nom><Veh-Mar-Cod>119</Veh-Mar-Cod><Veh-Mar-Nom>DFSK</Veh-Mar-Nom><Veh-Mar-Cod>120</Veh-Mar-Cod><Veh-Mar-Nom>SHINERAY</Veh-Mar-Nom><Veh-Mar-Cod>121</Veh-Mar-Cod><Veh-Mar-Nom>GREAT WALL</Veh-Mar-Nom><Veh-Mar-Cod>122</Veh-Mar-Cod><Veh-Mar-Nom>HAVAL</Veh-Mar-Nom><Veh-Mar-Cod>124</Veh-Mar-Cod><Veh-Mar-Nom>CHANGAN</Veh-Mar-Nom><Veh-Mar-Cod>125</Veh-Mar-Cod><Veh-Mar-Nom>ZANELLA</Veh-Mar-Nom><Veh-Mar-Cod>126</Veh-Mar-Cod><Veh-Mar-Nom>SERO ELECTRIC</Veh-Mar-Nom><Veh-Mar-Cod>127</Veh-Mar-Cod><Veh-Mar-Nom>SOUEAST</Veh-Mar-Nom><Veh-Mar-Cod>128</Veh-Mar-Cod><Veh-Mar-Nom>MCLAREN</Veh-Mar-Nom><Veh-Mar-Cod>5001</Veh-Mar-Cod><Veh-Mar-Nom>SIN MARCA</Veh-Mar-Nom><Veh-Mar-Cod>5002</Veh-Mar-Cod><Veh-Mar-Nom>DODGE</Veh-Mar-Nom><Veh-Mar-Cod>5003</Veh-Mar-Cod><Veh-Mar-Nom>HERMANN</Veh-Mar-Nom><Veh-Mar-Cod>5004</Veh-Mar-Cod><Veh-Mar-Nom>RANDON</Veh-Mar-Nom><Veh-Mar-Cod>5005</Veh-Mar-Cod><Veh-Mar-Nom>OMBU</Veh-Mar-Nom><Veh-Mar-Cod>5006</Veh-Mar-Cod><Veh-Mar-Nom>SALTO</Veh-Mar-Nom><Veh-Mar-Cod>5007</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>5008</Veh-Mar-Cod><Veh-Mar-Nom>MONTENEGRO</Veh-Mar-Nom><Veh-Mar-Cod>5009</Veh-Mar-Cod><Veh-Mar-Nom>AFF</Veh-Mar-Nom><Veh-Mar-Cod>5010</Veh-Mar-Cod><Veh-Mar-Nom>PLUS CARGA</Veh-Mar-Nom><Veh-Mar-Cod>5011</Veh-Mar-Cod><Veh-Mar-Nom>DANES</Veh-Mar-Nom><Veh-Mar-Cod>5012</Veh-Mar-Cod><Veh-Mar-Nom>HELVETICA</Veh-Mar-Nom><Veh-Mar-Cod>5013</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUV</Veh-Mar-Nom><Veh-Mar-Cod>5014</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>5015</Veh-Mar-Cod><Veh-Mar-Nom>SOLA Y BRUSA</Veh-Mar-Nom><Veh-Mar-Cod>5018</Veh-Mar-Cod><Veh-Mar-Nom>KRONE</Veh-Mar-Nom><Veh-Mar-Cod>5020</Veh-Mar-Cod><Veh-Mar-Nom>JEEP</Veh-Mar-Nom><Veh-Mar-Cod>5021</Veh-Mar-Cod><Veh-Mar-Nom>PEGASO</Veh-Mar-Nom><Veh-Mar-Cod>5022</Veh-Mar-Cod><Veh-Mar-Nom>MALDONADO</Veh-Mar-Nom><Veh-Mar-Cod>5023</Veh-Mar-Cod><Veh-Mar-Nom>GRASSANI</Veh-Mar-Nom><Veh-Mar-Cod>5025</Veh-Mar-Cod><Veh-Mar-Nom>NAVARRO HERMANOS</Veh-Mar-Nom><Veh-Mar-Cod>5026</Veh-Mar-Cod><Veh-Mar-Nom>FERESA</Veh-Mar-Nom><Veh-Mar-Cod>5027</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUC</Veh-Mar-Nom><Veh-Mar-Cod>5028</Veh-Mar-Cod><Veh-Mar-Nom>INTEGRAL</Veh-Mar-Nom><Veh-Mar-Cod>5029</Veh-Mar-Cod><Veh-Mar-Nom>SSANGYONG</Veh-Mar-Nom><Veh-Mar-Cod>5031</Veh-Mar-Cod><Veh-Mar-Nom>GONELLA</Veh-Mar-Nom><Veh-Mar-Cod>5034</Veh-Mar-Cod><Veh-Mar-Nom>BONANO</Veh-Mar-Nom><Veh-Mar-Cod>5035</Veh-Mar-Cod><Veh-Mar-Nom>GMC CHEVETTE</Veh-Mar-Nom><Veh-Mar-Cod>5036</Veh-Mar-Cod><Veh-Mar-Nom>GENERAL MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>5037</Veh-Mar-Cod><Veh-Mar-Nom>PETINARI</Veh-Mar-Nom><Veh-Mar-Cod>5040</Veh-Mar-Cod><Veh-Mar-Nom>FARGO CAMION</Veh-Mar-Nom><Veh-Mar-Cod>5041</Veh-Mar-Cod><Veh-Mar-Nom>AST-PRA</Veh-Mar-Nom><Veh-Mar-Cod>5043</Veh-Mar-Cod><Veh-Mar-Nom>EL CRESPIN</Veh-Mar-Nom><Veh-Mar-Cod>5046</Veh-Mar-Cod><Veh-Mar-Nom>IES</Veh-Mar-Nom><Veh-Mar-Cod>5049</Veh-Mar-Cod><Veh-Mar-Nom>PRATI FRUE</Veh-Mar-Nom><Veh-Mar-Cod>5050</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU C</Veh-Mar-Nom><Veh-Mar-Cod>5052</Veh-Mar-Cod><Veh-Mar-Nom>IVECO</Veh-Mar-Nom><Veh-Mar-Cod>5053</Veh-Mar-Cod><Veh-Mar-Nom>VULCANO</Veh-Mar-Nom><Veh-Mar-Cod>5054</Veh-Mar-Cod><Veh-Mar-Nom></Veh-Mar-Nom><Veh-Mar-Cod>5057</Veh-Mar-Cod><Veh-Mar-Nom>CORMETAL</Veh-Mar-Nom><Veh-Mar-Cod>5064</Veh-Mar-Cod><Veh-Mar-Nom>LUKMAN</Veh-Mar-Nom><Veh-Mar-Cod>5065</Veh-Mar-Cod><Veh-Mar-Nom>GENTILE</Veh-Mar-Nom><Veh-Mar-Cod>5068</Veh-Mar-Cod><Veh-Mar-Nom>DATSUN</Veh-Mar-Nom></Marcas>";
                break;

                 //MARCAS PARA PICKUP NACIONALES
                case '3':
                    $curl="<Marcas><Veh-Mar-Cod>1</Veh-Mar-Cod><Veh-Mar-Nom>ACURA</Veh-Mar-Nom><Veh-Mar-Cod>2</Veh-Mar-Cod><Veh-Mar-Nom>ALEKO</Veh-Mar-Nom><Veh-Mar-Cod>3</Veh-Mar-Cod><Veh-Mar-Nom>ALFA ROMEO</Veh-Mar-Nom><Veh-Mar-Cod>4</Veh-Mar-Cod><Veh-Mar-Nom>ARO</Veh-Mar-Nom><Veh-Mar-Cod>5</Veh-Mar-Cod><Veh-Mar-Nom>ASIA</Veh-Mar-Nom><Veh-Mar-Cod>6</Veh-Mar-Cod><Veh-Mar-Nom>AUDI</Veh-Mar-Nom><Veh-Mar-Cod>7</Veh-Mar-Cod><Veh-Mar-Nom>AUTOBIANCHI</Veh-Mar-Nom><Veh-Mar-Cod>8</Veh-Mar-Cod><Veh-Mar-Nom>BMW</Veh-Mar-Nom><Veh-Mar-Cod>9</Veh-Mar-Cod><Veh-Mar-Nom>BUIK</Veh-Mar-Nom><Veh-Mar-Cod>10</Veh-Mar-Cod><Veh-Mar-Nom>CADILLAC</Veh-Mar-Nom><Veh-Mar-Cod>11</Veh-Mar-Cod><Veh-Mar-Nom>CITROEN</Veh-Mar-Nom><Veh-Mar-Cod>12</Veh-Mar-Cod><Veh-Mar-Nom>CHEVROLET</Veh-Mar-Nom><Veh-Mar-Cod>13</Veh-Mar-Cod><Veh-Mar-Nom>CHRYSLER</Veh-Mar-Nom><Veh-Mar-Cod>14</Veh-Mar-Cod><Veh-Mar-Nom>DACIA</Veh-Mar-Nom><Veh-Mar-Cod>15</Veh-Mar-Cod><Veh-Mar-Nom>DAEWOO</Veh-Mar-Nom><Veh-Mar-Cod>16</Veh-Mar-Cod><Veh-Mar-Nom>DAIHATSU</Veh-Mar-Nom><Veh-Mar-Cod>17</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>18</Veh-Mar-Cod><Veh-Mar-Nom>FORD</Veh-Mar-Nom><Veh-Mar-Cod>19</Veh-Mar-Cod><Veh-Mar-Nom>HONDA</Veh-Mar-Nom><Veh-Mar-Cod>20</Veh-Mar-Cod><Veh-Mar-Nom>HYUNDAI</Veh-Mar-Nom><Veh-Mar-Cod>22</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU</Veh-Mar-Nom><Veh-Mar-Cod>23</Veh-Mar-Cod><Veh-Mar-Nom>JAGUAR</Veh-Mar-Nom><Veh-Mar-Cod>24</Veh-Mar-Cod><Veh-Mar-Nom>KIA</Veh-Mar-Nom><Veh-Mar-Cod>25</Veh-Mar-Cod><Veh-Mar-Nom>LADA</Veh-Mar-Nom><Veh-Mar-Cod>26</Veh-Mar-Cod><Veh-Mar-Nom>MAZDA</Veh-Mar-Nom><Veh-Mar-Cod>27</Veh-Mar-Cod><Veh-Mar-Nom>MERCURY</Veh-Mar-Nom><Veh-Mar-Cod>28</Veh-Mar-Cod><Veh-Mar-Nom>MERCEDES BENZ</Veh-Mar-Nom><Veh-Mar-Cod>29</Veh-Mar-Cod><Veh-Mar-Nom>MITSUBISHI</Veh-Mar-Nom><Veh-Mar-Cod>30</Veh-Mar-Cod><Veh-Mar-Nom>NISSAN</Veh-Mar-Nom><Veh-Mar-Cod>31</Veh-Mar-Cod><Veh-Mar-Nom>OPEL</Veh-Mar-Nom><Veh-Mar-Cod>32</Veh-Mar-Cod><Veh-Mar-Nom>PEUGEOT</Veh-Mar-Nom><Veh-Mar-Cod>33</Veh-Mar-Cod><Veh-Mar-Nom>POLONEZ</Veh-Mar-Nom><Veh-Mar-Cod>34</Veh-Mar-Cod><Veh-Mar-Nom>PONTIAC</Veh-Mar-Nom><Veh-Mar-Cod>35</Veh-Mar-Cod><Veh-Mar-Nom>PORSCHE</Veh-Mar-Nom><Veh-Mar-Cod>36</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>37</Veh-Mar-Cod><Veh-Mar-Nom>ROVER-LAND ROV.</Veh-Mar-Nom><Veh-Mar-Cod>38</Veh-Mar-Cod><Veh-Mar-Nom>SAAB</Veh-Mar-Nom><Veh-Mar-Cod>39</Veh-Mar-Cod><Veh-Mar-Nom>SEAT</Veh-Mar-Nom><Veh-Mar-Cod>40</Veh-Mar-Cod><Veh-Mar-Nom>SKODA</Veh-Mar-Nom><Veh-Mar-Cod>42</Veh-Mar-Cod><Veh-Mar-Nom>SUBARU</Veh-Mar-Nom><Veh-Mar-Cod>43</Veh-Mar-Cod><Veh-Mar-Nom>SUZUKI</Veh-Mar-Nom><Veh-Mar-Cod>44</Veh-Mar-Cod><Veh-Mar-Nom>TAVRIA</Veh-Mar-Nom><Veh-Mar-Cod>45</Veh-Mar-Cod><Veh-Mar-Nom>TOYOTA</Veh-Mar-Nom><Veh-Mar-Cod>46</Veh-Mar-Cod><Veh-Mar-Nom>VOLKSWAGEN</Veh-Mar-Nom><Veh-Mar-Cod>47</Veh-Mar-Cod><Veh-Mar-Nom>VOLVO</Veh-Mar-Nom><Veh-Mar-Cod>48</Veh-Mar-Cod><Veh-Mar-Nom>PROTON</Veh-Mar-Nom><Veh-Mar-Cod>49</Veh-Mar-Cod><Veh-Mar-Nom>HUMMER</Veh-Mar-Nom><Veh-Mar-Cod>51</Veh-Mar-Cod><Veh-Mar-Nom>FERRARI</Veh-Mar-Nom><Veh-Mar-Cod>52</Veh-Mar-Cod><Veh-Mar-Nom>HAM-JIANG</Veh-Mar-Nom><Veh-Mar-Cod>53</Veh-Mar-Cod><Veh-Mar-Nom>LANCIA</Veh-Mar-Nom><Veh-Mar-Cod>54</Veh-Mar-Cod><Veh-Mar-Nom>ENIAK</Veh-Mar-Nom><Veh-Mar-Cod>55</Veh-Mar-Cod><Veh-Mar-Nom>MAHINDRA</Veh-Mar-Nom><Veh-Mar-Cod>56</Veh-Mar-Cod><Veh-Mar-Nom>RASTROJERO</Veh-Mar-Nom><Veh-Mar-Cod>57</Veh-Mar-Cod><Veh-Mar-Nom>TATA</Veh-Mar-Nom><Veh-Mar-Cod>58</Veh-Mar-Cod><Veh-Mar-Nom>BLAC</Veh-Mar-Nom><Veh-Mar-Cod>59</Veh-Mar-Cod><Veh-Mar-Nom>I.K.A. RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>60</Veh-Mar-Cod><Veh-Mar-Nom>AUSTIN</Veh-Mar-Nom><Veh-Mar-Cod>61</Veh-Mar-Cod><Veh-Mar-Nom>BERTONE</Veh-Mar-Nom><Veh-Mar-Cod>62</Veh-Mar-Cod><Veh-Mar-Nom>METRO</Veh-Mar-Nom><Veh-Mar-Cod>63</Veh-Mar-Cod><Veh-Mar-Nom>AGRALE</Veh-Mar-Nom><Veh-Mar-Cod>65</Veh-Mar-Cod><Veh-Mar-Nom>RANQUEL</Veh-Mar-Nom><Veh-Mar-Cod>67</Veh-Mar-Cod><Veh-Mar-Nom>MAESTRO</Veh-Mar-Nom><Veh-Mar-Cod>68</Veh-Mar-Cod><Veh-Mar-Nom>JINBEI</Veh-Mar-Nom><Veh-Mar-Cod>69</Veh-Mar-Cod><Veh-Mar-Nom>F.E.R.E.S.A.</Veh-Mar-Nom><Veh-Mar-Cod>77</Veh-Mar-Cod><Veh-Mar-Nom>NAKAI (CHANGAN)</Veh-Mar-Nom><Veh-Mar-Cod>79</Veh-Mar-Cod><Veh-Mar-Nom>G.A.Z.</Veh-Mar-Nom><Veh-Mar-Cod>80</Veh-Mar-Cod><Veh-Mar-Nom>HINO</Veh-Mar-Nom><Veh-Mar-Cod>81</Veh-Mar-Cod><Veh-Mar-Nom>IZH</Veh-Mar-Nom><Veh-Mar-Cod>85</Veh-Mar-Cod><Veh-Mar-Nom>UAZ</Veh-Mar-Nom><Veh-Mar-Cod>94</Veh-Mar-Cod><Veh-Mar-Nom>PIAGGIO</Veh-Mar-Nom><Veh-Mar-Cod>96</Veh-Mar-Cod><Veh-Mar-Nom>STAR (3-STAR)</Veh-Mar-Nom><Veh-Mar-Cod>97</Veh-Mar-Cod><Veh-Mar-Nom>YANTAI</Veh-Mar-Nom><Veh-Mar-Cod>98</Veh-Mar-Cod><Veh-Mar-Nom>JAC</Veh-Mar-Nom><Veh-Mar-Cod>99</Veh-Mar-Cod><Veh-Mar-Nom>HEIBAO</Veh-Mar-Nom><Veh-Mar-Cod>100</Veh-Mar-Cod><Veh-Mar-Nom>WULING MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>101</Veh-Mar-Cod><Veh-Mar-Nom>SPACE</Veh-Mar-Nom><Veh-Mar-Cod>102</Veh-Mar-Cod><Veh-Mar-Nom>MASERATI</Veh-Mar-Nom><Veh-Mar-Cod>103</Veh-Mar-Cod><Veh-Mar-Nom>SANTANA</Veh-Mar-Nom><Veh-Mar-Cod>104</Veh-Mar-Cod><Veh-Mar-Nom>SIAM DI TELLA</Veh-Mar-Nom><Veh-Mar-Cod>105</Veh-Mar-Cod><Veh-Mar-Nom>PLYMOUTH</Veh-Mar-Nom><Veh-Mar-Cod>106</Veh-Mar-Cod><Veh-Mar-Nom>MINI COOPER</Veh-Mar-Nom><Veh-Mar-Cod>107</Veh-Mar-Cod><Veh-Mar-Nom>ROLLS ROYCE</Veh-Mar-Nom><Veh-Mar-Cod>108</Veh-Mar-Cod><Veh-Mar-Nom>CHERY</Veh-Mar-Nom><Veh-Mar-Cod>109</Veh-Mar-Cod><Veh-Mar-Nom>LINCOLN</Veh-Mar-Nom><Veh-Mar-Cod>110</Veh-Mar-Cod><Veh-Mar-Nom>SMART</Veh-Mar-Nom><Veh-Mar-Cod>111</Veh-Mar-Cod><Veh-Mar-Nom>MACK</Veh-Mar-Nom><Veh-Mar-Cod>112</Veh-Mar-Cod><Veh-Mar-Nom>DFM</Veh-Mar-Nom><Veh-Mar-Cod>113</Veh-Mar-Cod><Veh-Mar-Nom>JMC</Veh-Mar-Nom><Veh-Mar-Cod>114</Veh-Mar-Cod><Veh-Mar-Nom>LIFAN</Veh-Mar-Nom><Veh-Mar-Cod>115</Veh-Mar-Cod><Veh-Mar-Nom>FOTON</Veh-Mar-Nom><Veh-Mar-Cod>116</Veh-Mar-Cod><Veh-Mar-Nom>GEELY</Veh-Mar-Nom><Veh-Mar-Cod>117</Veh-Mar-Cod><Veh-Mar-Nom>DS AUTOMOBILES</Veh-Mar-Nom><Veh-Mar-Cod>118</Veh-Mar-Cod><Veh-Mar-Nom>BAIC</Veh-Mar-Nom><Veh-Mar-Cod>119</Veh-Mar-Cod><Veh-Mar-Nom>DFSK</Veh-Mar-Nom><Veh-Mar-Cod>120</Veh-Mar-Cod><Veh-Mar-Nom>SHINERAY</Veh-Mar-Nom><Veh-Mar-Cod>121</Veh-Mar-Cod><Veh-Mar-Nom>GREAT WALL</Veh-Mar-Nom><Veh-Mar-Cod>122</Veh-Mar-Cod><Veh-Mar-Nom>HAVAL</Veh-Mar-Nom><Veh-Mar-Cod>124</Veh-Mar-Cod><Veh-Mar-Nom>CHANGAN</Veh-Mar-Nom><Veh-Mar-Cod>125</Veh-Mar-Cod><Veh-Mar-Nom>ZANELLA</Veh-Mar-Nom><Veh-Mar-Cod>126</Veh-Mar-Cod><Veh-Mar-Nom>SERO ELECTRIC</Veh-Mar-Nom><Veh-Mar-Cod>127</Veh-Mar-Cod><Veh-Mar-Nom>SOUEAST</Veh-Mar-Nom><Veh-Mar-Cod>128</Veh-Mar-Cod><Veh-Mar-Nom>MCLAREN</Veh-Mar-Nom><Veh-Mar-Cod>5001</Veh-Mar-Cod><Veh-Mar-Nom>SIN MARCA</Veh-Mar-Nom><Veh-Mar-Cod>5002</Veh-Mar-Cod><Veh-Mar-Nom>DODGE</Veh-Mar-Nom><Veh-Mar-Cod>5003</Veh-Mar-Cod><Veh-Mar-Nom>HERMANN</Veh-Mar-Nom><Veh-Mar-Cod>5004</Veh-Mar-Cod><Veh-Mar-Nom>RANDON</Veh-Mar-Nom><Veh-Mar-Cod>5005</Veh-Mar-Cod><Veh-Mar-Nom>OMBU</Veh-Mar-Nom><Veh-Mar-Cod>5006</Veh-Mar-Cod><Veh-Mar-Nom>SALTO</Veh-Mar-Nom><Veh-Mar-Cod>5007</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>5008</Veh-Mar-Cod><Veh-Mar-Nom>MONTENEGRO</Veh-Mar-Nom><Veh-Mar-Cod>5009</Veh-Mar-Cod><Veh-Mar-Nom>AFF</Veh-Mar-Nom><Veh-Mar-Cod>5010</Veh-Mar-Cod><Veh-Mar-Nom>PLUS CARGA</Veh-Mar-Nom><Veh-Mar-Cod>5011</Veh-Mar-Cod><Veh-Mar-Nom>DANES</Veh-Mar-Nom><Veh-Mar-Cod>5012</Veh-Mar-Cod><Veh-Mar-Nom>HELVETICA</Veh-Mar-Nom><Veh-Mar-Cod>5013</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUV</Veh-Mar-Nom><Veh-Mar-Cod>5014</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>5015</Veh-Mar-Cod><Veh-Mar-Nom>SOLA Y BRUSA</Veh-Mar-Nom><Veh-Mar-Cod>5018</Veh-Mar-Cod><Veh-Mar-Nom>KRONE</Veh-Mar-Nom><Veh-Mar-Cod>5020</Veh-Mar-Cod><Veh-Mar-Nom>JEEP</Veh-Mar-Nom><Veh-Mar-Cod>5021</Veh-Mar-Cod><Veh-Mar-Nom>PEGASO</Veh-Mar-Nom><Veh-Mar-Cod>5022</Veh-Mar-Cod><Veh-Mar-Nom>MALDONADO</Veh-Mar-Nom><Veh-Mar-Cod>5023</Veh-Mar-Cod><Veh-Mar-Nom>GRASSANI</Veh-Mar-Nom><Veh-Mar-Cod>5025</Veh-Mar-Cod><Veh-Mar-Nom>NAVARRO HERMANOS</Veh-Mar-Nom><Veh-Mar-Cod>5026</Veh-Mar-Cod><Veh-Mar-Nom>FERESA</Veh-Mar-Nom><Veh-Mar-Cod>5027</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUC</Veh-Mar-Nom><Veh-Mar-Cod>5028</Veh-Mar-Cod><Veh-Mar-Nom>INTEGRAL</Veh-Mar-Nom><Veh-Mar-Cod>5029</Veh-Mar-Cod><Veh-Mar-Nom>SSANGYONG</Veh-Mar-Nom><Veh-Mar-Cod>5031</Veh-Mar-Cod><Veh-Mar-Nom>GONELLA</Veh-Mar-Nom><Veh-Mar-Cod>5034</Veh-Mar-Cod><Veh-Mar-Nom>BONANO</Veh-Mar-Nom><Veh-Mar-Cod>5035</Veh-Mar-Cod><Veh-Mar-Nom>GMC CHEVETTE</Veh-Mar-Nom><Veh-Mar-Cod>5036</Veh-Mar-Cod><Veh-Mar-Nom>GENERAL MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>5037</Veh-Mar-Cod><Veh-Mar-Nom>PETINARI</Veh-Mar-Nom><Veh-Mar-Cod>5040</Veh-Mar-Cod><Veh-Mar-Nom>FARGO CAMION</Veh-Mar-Nom><Veh-Mar-Cod>5041</Veh-Mar-Cod><Veh-Mar-Nom>AST-PRA</Veh-Mar-Nom><Veh-Mar-Cod>5043</Veh-Mar-Cod><Veh-Mar-Nom>EL CRESPIN</Veh-Mar-Nom><Veh-Mar-Cod>5046</Veh-Mar-Cod><Veh-Mar-Nom>IES</Veh-Mar-Nom><Veh-Mar-Cod>5049</Veh-Mar-Cod><Veh-Mar-Nom>PRATI FRUE</Veh-Mar-Nom><Veh-Mar-Cod>5050</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU C</Veh-Mar-Nom><Veh-Mar-Cod>5052</Veh-Mar-Cod><Veh-Mar-Nom>IVECO</Veh-Mar-Nom><Veh-Mar-Cod>5053</Veh-Mar-Cod><Veh-Mar-Nom>VULCANO</Veh-Mar-Nom><Veh-Mar-Cod>5054</Veh-Mar-Cod><Veh-Mar-Nom></Veh-Mar-Nom><Veh-Mar-Cod>5057</Veh-Mar-Cod><Veh-Mar-Nom>CORMETAL</Veh-Mar-Nom><Veh-Mar-Cod>5059</Veh-Mar-Cod><Veh-Mar-Nom>FORD</Veh-Mar-Nom><Veh-Mar-Cod>5064</Veh-Mar-Cod><Veh-Mar-Nom>LUKMAN</Veh-Mar-Nom><Veh-Mar-Cod>5065</Veh-Mar-Cod><Veh-Mar-Nom>GENTILE</Veh-Mar-Nom><Veh-Mar-Cod>5068</Veh-Mar-Cod><Veh-Mar-Nom>DATSUN</Veh-Mar-Nom></Marcas>";
                break;

                 //MARCAS PARA PICKUP IMPORTADAS
                case '4':
                    $curl="<Marcas><Veh-Mar-Cod>1</Veh-Mar-Cod><Veh-Mar-Nom>ACURA</Veh-Mar-Nom><Veh-Mar-Cod>2</Veh-Mar-Cod><Veh-Mar-Nom>ALEKO</Veh-Mar-Nom><Veh-Mar-Cod>3</Veh-Mar-Cod><Veh-Mar-Nom>ALFA ROMEO</Veh-Mar-Nom><Veh-Mar-Cod>4</Veh-Mar-Cod><Veh-Mar-Nom>ARO</Veh-Mar-Nom><Veh-Mar-Cod>5</Veh-Mar-Cod><Veh-Mar-Nom>ASIA</Veh-Mar-Nom><Veh-Mar-Cod>6</Veh-Mar-Cod><Veh-Mar-Nom>AUDI</Veh-Mar-Nom><Veh-Mar-Cod>7</Veh-Mar-Cod><Veh-Mar-Nom>AUTOBIANCHI</Veh-Mar-Nom><Veh-Mar-Cod>8</Veh-Mar-Cod><Veh-Mar-Nom>BMW</Veh-Mar-Nom><Veh-Mar-Cod>9</Veh-Mar-Cod><Veh-Mar-Nom>BUIK</Veh-Mar-Nom><Veh-Mar-Cod>10</Veh-Mar-Cod><Veh-Mar-Nom>CADILLAC</Veh-Mar-Nom><Veh-Mar-Cod>11</Veh-Mar-Cod><Veh-Mar-Nom>CITROEN</Veh-Mar-Nom><Veh-Mar-Cod>12</Veh-Mar-Cod><Veh-Mar-Nom>CHEVROLET</Veh-Mar-Nom><Veh-Mar-Cod>13</Veh-Mar-Cod><Veh-Mar-Nom>CHRYSLER</Veh-Mar-Nom><Veh-Mar-Cod>14</Veh-Mar-Cod><Veh-Mar-Nom>DACIA</Veh-Mar-Nom><Veh-Mar-Cod>15</Veh-Mar-Cod><Veh-Mar-Nom>DAEWOO</Veh-Mar-Nom><Veh-Mar-Cod>16</Veh-Mar-Cod><Veh-Mar-Nom>DAIHATSU</Veh-Mar-Nom><Veh-Mar-Cod>17</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>18</Veh-Mar-Cod><Veh-Mar-Nom>FORD</Veh-Mar-Nom><Veh-Mar-Cod>19</Veh-Mar-Cod><Veh-Mar-Nom>HONDA</Veh-Mar-Nom><Veh-Mar-Cod>20</Veh-Mar-Cod><Veh-Mar-Nom>HYUNDAI</Veh-Mar-Nom><Veh-Mar-Cod>22</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU</Veh-Mar-Nom><Veh-Mar-Cod>23</Veh-Mar-Cod><Veh-Mar-Nom>JAGUAR</Veh-Mar-Nom><Veh-Mar-Cod>24</Veh-Mar-Cod><Veh-Mar-Nom>KIA</Veh-Mar-Nom><Veh-Mar-Cod>25</Veh-Mar-Cod><Veh-Mar-Nom>LADA</Veh-Mar-Nom><Veh-Mar-Cod>26</Veh-Mar-Cod><Veh-Mar-Nom>MAZDA</Veh-Mar-Nom><Veh-Mar-Cod>27</Veh-Mar-Cod><Veh-Mar-Nom>MERCURY</Veh-Mar-Nom><Veh-Mar-Cod>28</Veh-Mar-Cod><Veh-Mar-Nom>MERCEDES BENZ</Veh-Mar-Nom><Veh-Mar-Cod>29</Veh-Mar-Cod><Veh-Mar-Nom>MITSUBISHI</Veh-Mar-Nom><Veh-Mar-Cod>30</Veh-Mar-Cod><Veh-Mar-Nom>NISSAN</Veh-Mar-Nom><Veh-Mar-Cod>31</Veh-Mar-Cod><Veh-Mar-Nom>OPEL</Veh-Mar-Nom><Veh-Mar-Cod>32</Veh-Mar-Cod><Veh-Mar-Nom>PEUGEOT</Veh-Mar-Nom><Veh-Mar-Cod>33</Veh-Mar-Cod><Veh-Mar-Nom>POLONEZ</Veh-Mar-Nom><Veh-Mar-Cod>34</Veh-Mar-Cod><Veh-Mar-Nom>PONTIAC</Veh-Mar-Nom><Veh-Mar-Cod>35</Veh-Mar-Cod><Veh-Mar-Nom>PORSCHE</Veh-Mar-Nom><Veh-Mar-Cod>36</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>37</Veh-Mar-Cod><Veh-Mar-Nom>ROVER-LAND ROV.</Veh-Mar-Nom><Veh-Mar-Cod>38</Veh-Mar-Cod><Veh-Mar-Nom>SAAB</Veh-Mar-Nom><Veh-Mar-Cod>39</Veh-Mar-Cod><Veh-Mar-Nom>SEAT</Veh-Mar-Nom><Veh-Mar-Cod>40</Veh-Mar-Cod><Veh-Mar-Nom>SKODA</Veh-Mar-Nom><Veh-Mar-Cod>42</Veh-Mar-Cod><Veh-Mar-Nom>SUBARU</Veh-Mar-Nom><Veh-Mar-Cod>43</Veh-Mar-Cod><Veh-Mar-Nom>SUZUKI</Veh-Mar-Nom><Veh-Mar-Cod>44</Veh-Mar-Cod><Veh-Mar-Nom>TAVRIA</Veh-Mar-Nom><Veh-Mar-Cod>45</Veh-Mar-Cod><Veh-Mar-Nom>TOYOTA</Veh-Mar-Nom><Veh-Mar-Cod>46</Veh-Mar-Cod><Veh-Mar-Nom>VOLKSWAGEN</Veh-Mar-Nom><Veh-Mar-Cod>47</Veh-Mar-Cod><Veh-Mar-Nom>VOLVO</Veh-Mar-Nom><Veh-Mar-Cod>48</Veh-Mar-Cod><Veh-Mar-Nom>PROTON</Veh-Mar-Nom><Veh-Mar-Cod>49</Veh-Mar-Cod><Veh-Mar-Nom>HUMMER</Veh-Mar-Nom><Veh-Mar-Cod>51</Veh-Mar-Cod><Veh-Mar-Nom>FERRARI</Veh-Mar-Nom><Veh-Mar-Cod>52</Veh-Mar-Cod><Veh-Mar-Nom>HAM-JIANG</Veh-Mar-Nom><Veh-Mar-Cod>53</Veh-Mar-Cod><Veh-Mar-Nom>LANCIA</Veh-Mar-Nom><Veh-Mar-Cod>54</Veh-Mar-Cod><Veh-Mar-Nom>ENIAK</Veh-Mar-Nom><Veh-Mar-Cod>55</Veh-Mar-Cod><Veh-Mar-Nom>MAHINDRA</Veh-Mar-Nom><Veh-Mar-Cod>56</Veh-Mar-Cod><Veh-Mar-Nom>RASTROJERO</Veh-Mar-Nom><Veh-Mar-Cod>57</Veh-Mar-Cod><Veh-Mar-Nom>TATA</Veh-Mar-Nom><Veh-Mar-Cod>58</Veh-Mar-Cod><Veh-Mar-Nom>BLAC</Veh-Mar-Nom><Veh-Mar-Cod>59</Veh-Mar-Cod><Veh-Mar-Nom>I.K.A. RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>60</Veh-Mar-Cod><Veh-Mar-Nom>AUSTIN</Veh-Mar-Nom><Veh-Mar-Cod>61</Veh-Mar-Cod><Veh-Mar-Nom>BERTONE</Veh-Mar-Nom><Veh-Mar-Cod>62</Veh-Mar-Cod><Veh-Mar-Nom>METRO</Veh-Mar-Nom><Veh-Mar-Cod>63</Veh-Mar-Cod><Veh-Mar-Nom>AGRALE</Veh-Mar-Nom><Veh-Mar-Cod>65</Veh-Mar-Cod><Veh-Mar-Nom>RANQUEL</Veh-Mar-Nom><Veh-Mar-Cod>67</Veh-Mar-Cod><Veh-Mar-Nom>MAESTRO</Veh-Mar-Nom><Veh-Mar-Cod>68</Veh-Mar-Cod><Veh-Mar-Nom>JINBEI</Veh-Mar-Nom><Veh-Mar-Cod>69</Veh-Mar-Cod><Veh-Mar-Nom>F.E.R.E.S.A.</Veh-Mar-Nom><Veh-Mar-Cod>77</Veh-Mar-Cod><Veh-Mar-Nom>NAKAI (CHANGAN)</Veh-Mar-Nom><Veh-Mar-Cod>79</Veh-Mar-Cod><Veh-Mar-Nom>G.A.Z.</Veh-Mar-Nom><Veh-Mar-Cod>80</Veh-Mar-Cod><Veh-Mar-Nom>HINO</Veh-Mar-Nom><Veh-Mar-Cod>81</Veh-Mar-Cod><Veh-Mar-Nom>IZH</Veh-Mar-Nom><Veh-Mar-Cod>85</Veh-Mar-Cod><Veh-Mar-Nom>UAZ</Veh-Mar-Nom><Veh-Mar-Cod>94</Veh-Mar-Cod><Veh-Mar-Nom>PIAGGIO</Veh-Mar-Nom><Veh-Mar-Cod>96</Veh-Mar-Cod><Veh-Mar-Nom>STAR (3-STAR)</Veh-Mar-Nom><Veh-Mar-Cod>97</Veh-Mar-Cod><Veh-Mar-Nom>YANTAI</Veh-Mar-Nom><Veh-Mar-Cod>98</Veh-Mar-Cod><Veh-Mar-Nom>JAC</Veh-Mar-Nom><Veh-Mar-Cod>99</Veh-Mar-Cod><Veh-Mar-Nom>HEIBAO</Veh-Mar-Nom><Veh-Mar-Cod>100</Veh-Mar-Cod><Veh-Mar-Nom>WULING MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>101</Veh-Mar-Cod><Veh-Mar-Nom>SPACE</Veh-Mar-Nom><Veh-Mar-Cod>102</Veh-Mar-Cod><Veh-Mar-Nom>MASERATI</Veh-Mar-Nom><Veh-Mar-Cod>103</Veh-Mar-Cod><Veh-Mar-Nom>SANTANA</Veh-Mar-Nom><Veh-Mar-Cod>104</Veh-Mar-Cod><Veh-Mar-Nom>SIAM DI TELLA</Veh-Mar-Nom><Veh-Mar-Cod>105</Veh-Mar-Cod><Veh-Mar-Nom>PLYMOUTH</Veh-Mar-Nom><Veh-Mar-Cod>106</Veh-Mar-Cod><Veh-Mar-Nom>MINI COOPER</Veh-Mar-Nom><Veh-Mar-Cod>107</Veh-Mar-Cod><Veh-Mar-Nom>ROLLS ROYCE</Veh-Mar-Nom><Veh-Mar-Cod>108</Veh-Mar-Cod><Veh-Mar-Nom>CHERY</Veh-Mar-Nom><Veh-Mar-Cod>109</Veh-Mar-Cod><Veh-Mar-Nom>LINCOLN</Veh-Mar-Nom><Veh-Mar-Cod>110</Veh-Mar-Cod><Veh-Mar-Nom>SMART</Veh-Mar-Nom><Veh-Mar-Cod>111</Veh-Mar-Cod><Veh-Mar-Nom>MACK</Veh-Mar-Nom><Veh-Mar-Cod>112</Veh-Mar-Cod><Veh-Mar-Nom>DFM</Veh-Mar-Nom><Veh-Mar-Cod>113</Veh-Mar-Cod><Veh-Mar-Nom>JMC</Veh-Mar-Nom><Veh-Mar-Cod>114</Veh-Mar-Cod><Veh-Mar-Nom>LIFAN</Veh-Mar-Nom><Veh-Mar-Cod>115</Veh-Mar-Cod><Veh-Mar-Nom>FOTON</Veh-Mar-Nom><Veh-Mar-Cod>116</Veh-Mar-Cod><Veh-Mar-Nom>GEELY</Veh-Mar-Nom><Veh-Mar-Cod>117</Veh-Mar-Cod><Veh-Mar-Nom>DS AUTOMOBILES</Veh-Mar-Nom><Veh-Mar-Cod>118</Veh-Mar-Cod><Veh-Mar-Nom>BAIC</Veh-Mar-Nom><Veh-Mar-Cod>119</Veh-Mar-Cod><Veh-Mar-Nom>DFSK</Veh-Mar-Nom><Veh-Mar-Cod>120</Veh-Mar-Cod><Veh-Mar-Nom>SHINERAY</Veh-Mar-Nom><Veh-Mar-Cod>121</Veh-Mar-Cod><Veh-Mar-Nom>GREAT WALL</Veh-Mar-Nom><Veh-Mar-Cod>122</Veh-Mar-Cod><Veh-Mar-Nom>HAVAL</Veh-Mar-Nom><Veh-Mar-Cod>124</Veh-Mar-Cod><Veh-Mar-Nom>CHANGAN</Veh-Mar-Nom><Veh-Mar-Cod>125</Veh-Mar-Cod><Veh-Mar-Nom>ZANELLA</Veh-Mar-Nom><Veh-Mar-Cod>126</Veh-Mar-Cod><Veh-Mar-Nom>SERO ELECTRIC</Veh-Mar-Nom><Veh-Mar-Cod>127</Veh-Mar-Cod><Veh-Mar-Nom>SOUEAST</Veh-Mar-Nom><Veh-Mar-Cod>128</Veh-Mar-Cod><Veh-Mar-Nom>MCLAREN</Veh-Mar-Nom><Veh-Mar-Cod>5001</Veh-Mar-Cod><Veh-Mar-Nom>SIN MARCA</Veh-Mar-Nom><Veh-Mar-Cod>5002</Veh-Mar-Cod><Veh-Mar-Nom>DODGE</Veh-Mar-Nom><Veh-Mar-Cod>5003</Veh-Mar-Cod><Veh-Mar-Nom>HERMANN</Veh-Mar-Nom><Veh-Mar-Cod>5004</Veh-Mar-Cod><Veh-Mar-Nom>RANDON</Veh-Mar-Nom><Veh-Mar-Cod>5005</Veh-Mar-Cod><Veh-Mar-Nom>OMBU</Veh-Mar-Nom><Veh-Mar-Cod>5006</Veh-Mar-Cod><Veh-Mar-Nom>SALTO</Veh-Mar-Nom><Veh-Mar-Cod>5007</Veh-Mar-Cod><Veh-Mar-Nom>FIAT</Veh-Mar-Nom><Veh-Mar-Cod>5008</Veh-Mar-Cod><Veh-Mar-Nom>MONTENEGRO</Veh-Mar-Nom><Veh-Mar-Cod>5009</Veh-Mar-Cod><Veh-Mar-Nom>AFF</Veh-Mar-Nom><Veh-Mar-Cod>5010</Veh-Mar-Cod><Veh-Mar-Nom>PLUS CARGA</Veh-Mar-Nom><Veh-Mar-Cod>5011</Veh-Mar-Cod><Veh-Mar-Nom>DANES</Veh-Mar-Nom><Veh-Mar-Cod>5012</Veh-Mar-Cod><Veh-Mar-Nom>HELVETICA</Veh-Mar-Nom><Veh-Mar-Cod>5013</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUV</Veh-Mar-Nom><Veh-Mar-Cod>5014</Veh-Mar-Cod><Veh-Mar-Nom>RENAULT</Veh-Mar-Nom><Veh-Mar-Cod>5015</Veh-Mar-Cod><Veh-Mar-Nom>SOLA Y BRUSA</Veh-Mar-Nom><Veh-Mar-Cod>5018</Veh-Mar-Cod><Veh-Mar-Nom>KRONE</Veh-Mar-Nom><Veh-Mar-Cod>5020</Veh-Mar-Cod><Veh-Mar-Nom>JEEP</Veh-Mar-Nom><Veh-Mar-Cod>5021</Veh-Mar-Cod><Veh-Mar-Nom>PEGASO</Veh-Mar-Nom><Veh-Mar-Cod>5022</Veh-Mar-Cod><Veh-Mar-Nom>MALDONADO</Veh-Mar-Nom><Veh-Mar-Cod>5023</Veh-Mar-Cod><Veh-Mar-Nom>GRASSANI</Veh-Mar-Nom><Veh-Mar-Cod>5025</Veh-Mar-Cod><Veh-Mar-Nom>NAVARRO HERMANOS</Veh-Mar-Nom><Veh-Mar-Cod>5026</Veh-Mar-Cod><Veh-Mar-Nom>FERESA</Veh-Mar-Nom><Veh-Mar-Cod>5027</Veh-Mar-Cod><Veh-Mar-Nom>NAVATUC</Veh-Mar-Nom><Veh-Mar-Cod>5028</Veh-Mar-Cod><Veh-Mar-Nom>INTEGRAL</Veh-Mar-Nom><Veh-Mar-Cod>5029</Veh-Mar-Cod><Veh-Mar-Nom>SSANGYONG</Veh-Mar-Nom><Veh-Mar-Cod>5031</Veh-Mar-Cod><Veh-Mar-Nom>GONELLA</Veh-Mar-Nom><Veh-Mar-Cod>5034</Veh-Mar-Cod><Veh-Mar-Nom>BONANO</Veh-Mar-Nom><Veh-Mar-Cod>5035</Veh-Mar-Cod><Veh-Mar-Nom>GMC CHEVETTE</Veh-Mar-Nom><Veh-Mar-Cod>5036</Veh-Mar-Cod><Veh-Mar-Nom>GENERAL MOTORS</Veh-Mar-Nom><Veh-Mar-Cod>5037</Veh-Mar-Cod><Veh-Mar-Nom>PETINARI</Veh-Mar-Nom><Veh-Mar-Cod>5040</Veh-Mar-Cod><Veh-Mar-Nom>FARGO CAMION</Veh-Mar-Nom><Veh-Mar-Cod>5041</Veh-Mar-Cod><Veh-Mar-Nom>AST-PRA</Veh-Mar-Nom><Veh-Mar-Cod>5043</Veh-Mar-Cod><Veh-Mar-Nom>EL CRESPIN</Veh-Mar-Nom><Veh-Mar-Cod>5046</Veh-Mar-Cod><Veh-Mar-Nom>IES</Veh-Mar-Nom><Veh-Mar-Cod>5049</Veh-Mar-Cod><Veh-Mar-Nom>PRATI FRUE</Veh-Mar-Nom><Veh-Mar-Cod>5050</Veh-Mar-Cod><Veh-Mar-Nom>ISUZU C</Veh-Mar-Nom><Veh-Mar-Cod>5052</Veh-Mar-Cod><Veh-Mar-Nom>IVECO</Veh-Mar-Nom><Veh-Mar-Cod>5053</Veh-Mar-Cod><Veh-Mar-Nom>VULCANO</Veh-Mar-Nom><Veh-Mar-Cod>5054</Veh-Mar-Cod><Veh-Mar-Nom></Veh-Mar-Nom><Veh-Mar-Cod>5057</Veh-Mar-Cod><Veh-Mar-Nom>CORMETAL</Veh-Mar-Nom><Veh-Mar-Cod>5059</Veh-Mar-Cod><Veh-Mar-Nom>FORD</Veh-Mar-Nom><Veh-Mar-Cod>5064</Veh-Mar-Cod><Veh-Mar-Nom>LUKMAN</Veh-Mar-Nom><Veh-Mar-Cod>5065</Veh-Mar-Cod><Veh-Mar-Nom>GENTILE</Veh-Mar-Nom><Veh-Mar-Cod>5068</Veh-Mar-Cod><Veh-Mar-Nom>DATSUN</Veh-Mar-Nom></Marcas>";
                break;

                default:

                $curl='';
                break;
            }
         }

        return $this->convertXMLToJSON($curl);  
    }

    public function getModelos($marca, $tipoVehiculo, $secCod, $año) 
    {
        $curl = $this->curl(config('app.compania_url'),"token=".$this->getToken()."&mensaje=\'<Cod_Req>204105</Cod_Req><Cia-Cod>1</Cia-Cod><Sec-Cod>".$secCod."</Sec-Cod><Veh-Tip-Cod>".$tipoVehiculo."</Veh-Tip-Cod><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Mar-Cod>".$marca."</Veh-Mar-Cod><Veh-Ano-Fab>".$año."</Veh-Ano-Fab>'");
          if($curl == 'falla') {
            $this->getModelos($marca, $tipoVehiculo, $secCod, $año);
        }else{
            info('retorno ok');
            //esto puede devolver falla?
            return $this->convertXMLToJSON($curl);
        }
    }   

    public function getTipoVehiculo($secCod) 
    {        
        /*$curl = $this->curl(config('app.compania_url'),"token=".$this->getToken()."&mensaje=\'<Cod_Req>204101</Cod_Req><Cia-Cod>1</Cia-Cod><Sec-Cod>".$secCod."</Sec-Cod><Rie-Cod>1</Rie-Cod>'");
        if($curl == 'falla') {
            $this->getTipoVehiculo($secCod);
        }*/
        //dd($curl);
        /*info('secCod: ----------------------------');
        info($secCod);
        info('curl: ----------------------------');
        info($curl);
        info('fin curl: ----------------------------');*/
        switch($secCod){
            //auto - se quito camiones para abajo por pedido de Gerena
            case '3':
                $curl="<Tipos><Veh-Tip-Cod>1</Veh-Tip-Cod><Veh-Tip-Nom>AUTO NACIONALES</Veh-Tip-Nom><Veh-Tip-Cod>2</Veh-Tip-Cod><Veh-Tip-Nom>AUTO IMPORTADOS</Veh-Tip-Nom><Veh-Tip-Cod>3</Veh-Tip-Cod><Veh-Tip-Nom>PICK-UPS NACIONALES</Veh-Tip-Nom><Veh-Tip-Cod>4</Veh-Tip-Cod><Veh-Tip-Nom>PICK-UPS IMPORTADAS</Veh-Tip-Nom></Tipos>";
            break;
            //moto
            case '24':
                $curl="<Tipos><Veh-Tip-Cod>1</Veh-Tip-Cod><Veh-Tip-Nom>MOTOCICLETA</Veh-Tip-Nom><Veh-Tip-Cod>2</Veh-Tip-Cod><Veh-Tip-Nom>SCOOTER/CICLOMOTOR</Veh-Tip-Nom><Veh-Tip-Cod>3</Veh-Tip-Cod><Veh-Tip-Nom>CUATRICICLO/TRICICLO</Veh-Tip-Nom></Tipos>";
            break;

            default:
                $curl='';
            break;
        }

        return $this->convertXMLToJSON($curl);          
    }   

    public function getUso($tipoVehiculo, $secCod)
    {
        info('getUso - tipoVehiculo: '.$tipoVehiculo);
        info('getUso - secCod: '.$secCod);

/*        $curl = $this->curl(config('app.compania_url'),"token=".$this->getToken()." &mensaje=\'<Cod_Req>204102</Cod_Req><Cia-Cod>1</Cia-Cod><Sec-Cod>".$secCod."</Sec-Cod><Rie-Cod>1</Rie-Cod><Veh-Tip-Cod>".$tipoVehiculo."</Veh-Tip-Cod>'");
         if($curl == 'falla') $this->getUso($tipoVehiculo, $secCod);

         info('inicio curl getUSO --------------------');
         info($curl);
         info('fin curl getUSO --------------------');*/

         if($secCod=='24'){
            switch($tipoVehiculo){
                //MARCAS PARA MOTOCICLETA
                case '1':
                    $curl='<Usos><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Uso-Nom>HASTA 250 CC.</Veh-Uso-Nom><Veh-Uso-Cod>2</Veh-Uso-Cod><Veh-Uso-Nom>MAS DE 250 CC.</Veh-Uso-Nom><Veh-Uso-Cod>3</Veh-Uso-Cod><Veh-Uso-Nom>HASTA 250CC. C/GRUA</Veh-Uso-Nom><Veh-Uso-Cod>4</Veh-Uso-Cod><Veh-Uso-Nom>MAS DE 250CC.C/GRUA</Veh-Uso-Nom><Veh-Uso-Cod>5</Veh-Uso-Cod><Veh-Uso-Nom>COMERCIAL</Veh-Uso-Nom></Usos>';
                break;

                 //MARCAS PARA SCOOTER
                case '2':
                    $curl='<Usos><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Uso-Nom>HASTA 250 CC.</Veh-Uso-Nom><Veh-Uso-Cod>2</Veh-Uso-Cod><Veh-Uso-Nom>MAS DE 250 CC.</Veh-Uso-Nom><Veh-Uso-Cod>3</Veh-Uso-Cod><Veh-Uso-Nom>HASTA 250CC. C/GRUA</Veh-Uso-Nom><Veh-Uso-Cod>4</Veh-Uso-Cod><Veh-Uso-Nom>MAS DE 250CC. C/GRUA</Veh-Uso-Nom><Veh-Uso-Cod>5</Veh-Uso-Cod><Veh-Uso-Nom>COMERCIAL</Veh-Uso-Nom></Usos>';
                break;

                 //MARCAS PARA CUATRICICLO
                case '3':
                    $curl='<Usos><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Uso-Nom>MAS DE 250 CC.</Veh-Uso-Nom><Veh-Uso-Cod>2</Veh-Uso-Cod><Veh-Uso-Nom>MAS DE 250CC.C/GRUA</Veh-Uso-Nom></Usos>';
                break;

                default:

                $curl='';
                break;
            }
            //3 = automotor
         }else if($secCod=='3'){
            switch($tipoVehiculo){
                //MARCAS PARA AUTOS NACIONALES
                case '1':
                    $curl='<Usos><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Uso-Nom>PARTICULAR</Veh-Uso-Nom><Veh-Uso-Cod>2</Veh-Uso-Cod><Veh-Uso-Nom>REMISES</Veh-Uso-Nom><Veh-Uso-Cod>3</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS CON PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>4</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS SIN PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>5</Veh-Uso-Cod><Veh-Uso-Nom>DE ALQUILER S/CHOFER</Veh-Uso-Nom></Usos>';
                break;

                 //MARCAS PARA AUTO IMPORTADOS
                case '2':
                    $curl='<Usos><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Uso-Nom>PARTICULAR</Veh-Uso-Nom><Veh-Uso-Cod>2</Veh-Uso-Cod><Veh-Uso-Nom>REMISES</Veh-Uso-Nom><Veh-Uso-Cod>3</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS SIN PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>4</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS CON PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>5</Veh-Uso-Cod><Veh-Uso-Nom>DE ALQUILER S/CHOFER</Veh-Uso-Nom></Usos>';
                break;

                 //MARCAS PARA PICKUP NACIONALES
                case '3':
                    $curl='<Usos><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"A" COMERCIAL</Veh-Uso-Nom><Veh-Uso-Cod>2</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"B" COMERCIAL</Veh-Uso-Nom><Veh-Uso-Cod>7</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"A" PARTICULAR</Veh-Uso-Nom><Veh-Uso-Cod>8</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"B" PARTICULAR</Veh-Uso-Nom><Veh-Uso-Cod>9</Veh-Uso-Cod><Veh-Uso-Nom>SER/ESC/ESP.H/15 ASI</Veh-Uso-Nom><Veh-Uso-Cod>10</Veh-Uso-Cod><Veh-Uso-Nom>SER/ESC/ESP.H/100 KM</Veh-Uso-Nom><Veh-Uso-Cod>11</Veh-Uso-Cod><Veh-Uso-Nom>SER/ESPEC.S/LIM. KM</Veh-Uso-Nom><Veh-Uso-Cod>12</Veh-Uso-Cod><Veh-Uso-Nom>4 x 4</Veh-Uso-Nom><Veh-Uso-Cod>13</Veh-Uso-Cod><Veh-Uso-Nom>TRANSP/ESCOLAR/ESPEC</Veh-Uso-Nom><Veh-Uso-Cod>14</Veh-Uso-Cod><Veh-Uso-Nom>REMISES</Veh-Uso-Nom><Veh-Uso-Cod>15</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS CON PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>16</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS SIN PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>17</Veh-Uso-Cod><Veh-Uso-Nom>DE ALQUILER S/CHOFER</Veh-Uso-Nom></Usos>';
                break;

                 //MARCAS PARA PICKUP IMPORTADAS
                case '4':
                    $curl='<Usos><Veh-Uso-Cod>1</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"A" COMERCIAL</Veh-Uso-Nom><Veh-Uso-Cod>2</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"B" COMERCIAL</Veh-Uso-Nom><Veh-Uso-Cod>7</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"A" PARTICULAR</Veh-Uso-Nom><Veh-Uso-Cod>8</Veh-Uso-Cod><Veh-Uso-Nom>TIPO"B" PARTICULAR</Veh-Uso-Nom><Veh-Uso-Cod>9</Veh-Uso-Cod><Veh-Uso-Nom>SER/ESC/ESP.H/15 ASI</Veh-Uso-Nom><Veh-Uso-Cod>10</Veh-Uso-Cod><Veh-Uso-Nom>SER/ESC/ESP.H/100 KM</Veh-Uso-Nom><Veh-Uso-Cod>11</Veh-Uso-Cod><Veh-Uso-Nom>SER/ESPEC.S/LIM. Km.</Veh-Uso-Nom><Veh-Uso-Cod>12</Veh-Uso-Cod><Veh-Uso-Nom>4 x 4</Veh-Uso-Nom><Veh-Uso-Cod>13</Veh-Uso-Cod><Veh-Uso-Nom>TRANSP/ESCOLAR/ESPEC</Veh-Uso-Nom><Veh-Uso-Cod>14</Veh-Uso-Cod><Veh-Uso-Nom>REMISES</Veh-Uso-Nom><Veh-Uso-Cod>15</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS SIN PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>16</Veh-Uso-Cod><Veh-Uso-Nom>TAXIS CON PARAD/FIJA</Veh-Uso-Nom><Veh-Uso-Cod>17</Veh-Uso-Cod><Veh-Uso-Nom>DE ALQUILER S/CHOFER</Veh-Uso-Nom></Usos>';
                break;

                default:

                $curl='';
                break;
            }
         }

        return $this->convertXMLToJSON($curl);               
    }

    public function getNombre($array)
    {
        $array = $this->split($array);
        return $array[1];
    }   

    public function getId($array) 
    {
        $array = $this->split($array);     
        return $array[0];
    }


    private function split($array) 
    {
        return explode(":", $array, 2);
    }    


    private function getCodigoProvincia($nombre_provincia)
    {

        $identificador_provincia = 99;

        switch ($nombre_provincia) 
        {

        case 'CABA':
        $identificador_provincia = 1;
        break;

        case 'BA':
        $identificador_provincia = 2;
        break;

        case 'CT':
        $identificador_provincia = 3;
        break;

        case 'CBA':
        $identificador_provincia = 4;
        break;

        case 'CR':
        $identificador_provincia = 5;
        break;

        case 'CC':
        $identificador_provincia = 6;
        break;

        case 'CH':
        $identificador_provincia = 7;
        break;

        case 'ER':
        $identificador_provincia = 8;
        break;

        case 'FO':
        $identificador_provincia = 9;
        break;


        case 'JY':
        $identificador_provincia = 10;
        break;

        case 'LP':
        $identificador_provincia = 11;
        break;

        case 'LR':
        $identificador_provincia = 12;
        break;


        case 'MZ':
        $identificador_provincia = 13;
        break;

        case 'MN':
        $identificador_provincia = 14;
        break;

        case 'NQ':
        $identificador_provincia = 15;
        break;


        case 'RN':
        $identificador_provincia = 16;
        break;

        case 'SA':
        $identificador_provincia = 17;
        break;

        case 'SJ':
        $identificador_provincia = 18;
        break;

        case 'SL':
        $identificador_provincia = 19;
        break;

        case 'SC':
        $identificador_provincia = 20;
        break;

        case 'SF':
        $identificador_provincia = 21;
        break;


        case 'SE':
        $identificador_provincia = 22;
        break;

        case 'TF':
        $identificador_provincia = 23;
        break;

        case 'TM':
        $identificador_provincia = 24;
        break;

        case 'NO ESPECIFICADO':
        $identificador_provincia = 99;
        break;

        default:
        $identificador_provincia = 99;
        break;

        }

        return $identificador_provincia;
    }    
}
