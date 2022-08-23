<?php

namespace App\Http\Livewire;

use App\Events\EstadoSolicitudCambio;
use App\Models\Propietario;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PanelOperarioTable extends Component
{
    use WithPagination;
    public $search;
    public $confirming;
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {

        $this->fill(request()->only('search'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
     
             $search = $this->search;


            $solicitudes = Solicitud::whereHas('propietario', function($query) use ($search) {
                 $query->where('nombre', 'like', '%'. $search . '%')
                            ->orWhere('dni', 'like', '%'.$search.'%');
            })->whereHas('inquilino',function($query) use ($search) {
                 $query->orWhere('nombre','like', '%'. $search . '%');
            })
            ->whereHas('documentos')
            ->whereHas('inmobiliaria')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at','DESC')
            ->paginate(15);


            return view('livewire.panel-operario-table',[   
            'solicitudes' => $solicitudes]);    
        
        

    }

    public function aprobar(Solicitud $solicitud)
    {
        
       $solicitud = Solicitud::find($solicitud->id);
       $solicitud->update(['status' => 'Aprobada']);

       EstadoSolicitudCambio::dispatch($solicitud);


    }
}
