<?php

namespace App\Policies;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagadaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
   
   //Cada usuario rol cliente puede almacenar sus solicitudes
   //Cada usuario rol inmobiliaria puede almacenar solicitudes de sus clientes
    //Operario no puede guardar

    public function store(User $user, Solicitud $solicitud)
    {
        if($solicitud->user_id == $user->id && (!$user->hasRole('operario') || !$user->hasRole('productor')) || $solicitud->inmobiliaria_id == $user->id){

            return true;
        }else{
            echo "NO estas autorizado a realizar esta accion";
            return false; 
        }

    }
    
    //Solo se actualiza solicitud si:
    //Estado es:
    // Completa
    // InCompleta
    // Rechazada
    public function update(User $user, Solicitud $solicitud)
    {
        if($solicitud->status == 'Incompleta' || $solicitud->status == 'Completa' || $solicitud->status == 'Rechazada')
        {
            return true;
        }
        elseif($solicitud->status == 'Aprobada' || $solicitud->pago->status == 'Pagada')
        {
            return false;
        }
        else
        {
            echo "NO estas autorizado a realizar esta accion";
            return false; 
        }



    }

   }




