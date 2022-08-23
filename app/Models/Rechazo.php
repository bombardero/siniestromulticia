<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rechazo extends Model
{
    use HasFactory;
     protected $fillable = [
        'type',
        'motivo',
      	'solicitud_id'

    ];
    public function solicitud()
    {
        return $this->belongsTo('App\Models\Solicitud');
    }
}


