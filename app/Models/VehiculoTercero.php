<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoTercero extends Model
{
    use HasFactory;

    protected $fillable = [
        "propietario_nombre",
        "propietario_telefono",
        "propietario_tipo_documento_id",
        "propietario_documento_numero",
        "propietario_codigo_postal",
        "propietario_domicilio",
        "marca_id",
        "modelo_id",
        "tipo",
        "anio",
        "dominio",
        "motor",
        "chasis",
        "uso_particular",
        "uso_comercial",
        "uso_taxi",
        "uso_tpp",
        "uso_urgencia",
        "uso_seguridad",
        "detalles",
        "conductor_nombre",
        "conductor_telefono",
        "conductor_documento_id",
        "conductor_documento_numero",
        "conductor_codigo_postal",
        "conductor_domicilio",
        "conductor_registro",
        "conductor_tipo_carnet_id",
        "conductor_categoria",
        "conductor_vencimiento",
        "conductor_alcoholemia",
        "conductor_alcoholemia_se_nego",
        "conductor_habitual"
    ];

    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }

}
