<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Inquilino extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'nombre',
        'dni',
        'telefono',
        'email',
        'city_id',
        'domicilio',
        'province_id',
        'sueldo_uno',
        'sueldo_dos',
        'sueldo_tres',
        'type',
    ];
    protected $auditInclude = [
        'nombre',
        'dni',
        'telefono',
        'city_id',
        'domicilio',
        'province_id',
        'sueldo_uno',
        'sueldo_dos',
        'sueldo_tres',
    ];
    protected $auditExclude = [
        'type',
        'id',
    ];
    public function solicitudes()
    {
        return $this->hasMany('App\Models\Solicitud');
    }

    public function documentos()
    {
        return $this->hasMany('App\Models\DocumentoInquilino');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
    
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
