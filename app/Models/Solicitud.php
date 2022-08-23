<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Solicitud extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'user_id',
        'estado_inquilino_uno',
        'estado_propietario_dos',
        'estado_contrato_tres',
        'estado_inmobiliaria_cuatro',
        'estado_aval_cinco',
        'status',
        'monto',
        'cotizacion_id',
        'inquilino_id',
        'inmobiliaria_id',
        'propietario_id'
    ];

    public function cotizacion()
    {
        return $this->belongsTo('App\Models\Cotizacion');
    }
    public function inquilino()
    {
        return $this->belongsTo('App\Models\Inquilino');
    }

    public function propietario()
    {
        return $this->belongsTo('App\Models\Propietario');
    }
    public function documentos()
    {
        return $this->hasMany('App\Models\DocumentoPoliza');
    }


    public function user() {

        return $this->belongsTo('App\Models\User');
    }

        public function inmobiliaria() {

        return $this->belongsTo('App\Models\User');
    }

    public function rechazos()
    {
        return $this->hasMany('App\Models\Rechazo');
    }

    public function pago()
    {
        return $this->hasOne('App\Models\Pago');
    }







}
