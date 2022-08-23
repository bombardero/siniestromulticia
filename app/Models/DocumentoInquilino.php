<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class DocumentoInquilino extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
     protected $fillable = [
        'type',
        'url',
        'nombre',
        'inquilino_id'
    ];

    protected $auditInclude = [
        'type',
        'url',
    ];
    public function inquilino()
    {
        return $this->belongsTo('App\Models\Inquilino');
    }
}
