<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotizacion extends Model
{   
    use HasFactory, SoftDeletes;

    public function solicitud()
    {
        return $this->hasOne('App\Models\Solicitud');
    }
}
