<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{

    use HasFactory;

    protected $fillable = [
        'codigo_mp',
        'referencia_externa',
        'status',
        'monto',
        'solicitud_id'
    ];

    public function solicitud()
    {
        return $this->belongsTo('App\Models\Solicitud');
    }

}


