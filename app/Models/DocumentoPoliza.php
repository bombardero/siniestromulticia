<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class DocumentoPoliza extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'nombre',
        'type',
        'url',
        'solicitud_id'
    ];
    public function solicitud()
    {
        return $this->belongsTo('App\Models\Solicitud');
    }
}
