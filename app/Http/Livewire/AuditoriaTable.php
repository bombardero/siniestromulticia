<?php

namespace App\Http\Livewire;

use App\Models\DocumentoInquilino;
use App\Models\DocumentoPoliza;
use App\Models\Inquilino;
use App\Models\Propietario;
use App\Models\Solicitud;
use App\Models\User;
use Livewire\Component;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit;
class AuditoriaTable extends Component
{
	public $solicitud;
	public function mount(Solicitud $solicitud)
	{
		$this->solicitud = $solicitud;
	}
    public function render()
    {
    	//$audits = Audit::where('');
    	$audits_prop = Propietario::find($this->solicitud->propietario_id)->audits;
    	$audits_inq = Inquilino::find($this->solicitud->propietario_id)->audits;
  
    	//$audits_doc_inq = DocumentoInquilino::where('inquilino_id',$this->solicitud->inquilino_id)->with('audits')->get();

          
    
		//dd(DocumentoInquilino::where('inquilino_id',$this->solicitud->inquilino_id)->get());
    	//dd(DocumentoPoliza::find($this->solicitud->id)->audits);
    	$merged = $audits_prop->merge($audits_inq)->sortByDesc('created_at');
    	//dd($merged->all());
        //dd($audits_doc_inq->last()->audits);
        return view('livewire.auditoria-table',['auditorias' => $merged->where('new_values', '!=', null,''), 'solicitud' => $this->solicitud]);
    }
}
