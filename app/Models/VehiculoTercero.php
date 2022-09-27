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
        "otra_marca",
        "otro_modelo",
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
        "conductor_tipo_documento_id",
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

    protected $casts = [
        'uso_particular' => 'boolean',
        'uso_comercial' => 'boolean',
        'uso_taxi' => 'boolean',
        'uso_tpp' => 'boolean',
        'uso_urgencia' => 'boolean',
        'uso_seguridad' => 'boolean',
        'conductor_alcoholemia' => 'boolean',
        'conductor_alcoholemia_se_nego' => 'boolean',
        'conductor_habitual' => 'boolean',
    ];

    protected $dates = ['conductor_vencimiento'];

    public function denuncia()
    {
        return $this->belongsTo(DenunciaSiniestro::class, 'denuncia_siniestro_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    public function tipoDocumentoPropietario()
    {
        return $this->belongsTo(TipoDocumento::class, 'propietario_tipo_documento_id');
    }

    public function tipoDocumentoConductor()
    {
        return $this->belongsTo(TipoDocumento::class, 'conductor_tipo_documento_id');
    }

    public function tipoCarnetConductor()
    {
        return $this->belongsTo(TipoCarnet::class, 'conductor_tipo_carnet_id');
    }

}
