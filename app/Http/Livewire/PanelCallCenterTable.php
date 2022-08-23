<?php

namespace App\Http\Livewire;

use App\Models\CotizacionVehiculo;
use Livewire\Component;
use Livewire\WithPagination;

class PanelCallCenterTable extends Component
{
    use WithPagination;

    public $search;
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

             $cotizaciones = CotizacionVehiculo::where('id', 'like', '%'.$search . '%')
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at','DESC')
            ->paginate(15);


            return view('livewire.panel-call-center-table',[   
            'cotizaciones' => $cotizaciones]);    
        
        
    }
}
