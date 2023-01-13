<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReclamoTercero extends Model
{
    use HasFactory, SoftDeletes;

    const ESTADOS = [
        'ingresado',
        'aceptado',
        'rechazado',
        'cerrado',
        'legales',
        'investigacion',
        'derivado-proveedor',
        'solicitud-documentacion',
        'informe-pericial',
        'pendiente-de-pago',
        'esperando-baja-de-unidad'
    ];

    protected $fillable = [
        "identificador",
        "estado_carga",
        "dominio_vehiculo_asegurado",
        "dominio_vehiculo_tercero",
        "fecha",
        "hora",
        "lugar_nombre",
        "codigo_postal",
        "direccion",
        "descripcion",
        "responsable_contacto_nombre",
        "responsable_contacto_domicilio",
        "responsable_contacto_telefono",
        "responsable_contacto_email",

        "finalized_at"
    ];

    protected $casts = [
        'finalized_at' => 'datetime'
    ];
    protected $dates = ['fecha'];

    public function reclamante()
    {
        return $this->hasOne(Reclamante::class);
    }



}
