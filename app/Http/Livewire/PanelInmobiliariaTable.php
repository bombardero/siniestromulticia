<?php

namespace App\Http\Livewire;

use App\Models\Propietario;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PanelInmobiliariaTable extends Component
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
    
        $user = Auth::user();
        $search = $this->search;

        if(!$this->search)
        {

            if(Auth::user()->hasRole('inmobiliaria'))
            {
                $solicitudes = Solicitud::where('inmobiliaria_id',Auth::id())->with('propietario')->orderBy('id','desc')->paginate(15);
            }

            else
            $solicitudes = $user->solicitudes()->with('propietario')->orderBy('id','desc')->paginate(15);
        }
        else
        {

            
            if(Auth::user()->hasRole('inmobiliaria'))
            {
                $solicitudes = Solicitud::where('inmobiliaria_id',Auth::id())->whereHas('propietario', function($query) use ($search)
                {
                        $query->where('dni', 'like', '%'.$search.'%')
                             ->orWhere('nombre', 'like', '%'.$search.'%');
                })
                ->paginate(15);
            }
            else{
            $solicitudes = $user->solicitudes()->whereHas('propietario', function($query) use ($search)
                {
                        $query->where('dni', 'like', '%'.$search.'%')
                             ->orWhere('nombre', 'like', '%'.$search.'%');
                })
                ->paginate(15);
            }
        }

      /*
        $solicitudes = DB::table('solicituds')->where('user_id',Auth::id())->get();


        $solicitudes = Solicitud::join('propietarios','solicituds.propietario_id','propietarios.id')
            ->where('nombre', 'like',$search)
            ->paginate(2);
            */

        return view('livewire.panel-inmobiliaria-table',[   
            'solicitudes' => $solicitudes]);    
        
        

    }
}
