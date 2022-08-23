<?php

namespace App\Policies;

use App\Models\Inquilino;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InquilinoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    
    public function store(User $user, Solicitud $solicitud)
    {
        return $user->id === $solicitud->user_id;
    }

    public function update(User $user, Inquilino $inquilino)
    {
        //
    }

}
