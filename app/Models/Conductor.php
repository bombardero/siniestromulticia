<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;
    protected $table = "conductores";

    protected $fillable = [
        "nombre",
        "telefono",
        "domicilio",
        "codigo_postal",
        "pais_id",
        "province_id",
        "city_id",
        "fecha_nacimiento",
        "tipo_documento_id",
        "documento_numero",
        "ocupacion",
        "numero_registro",
        "estado_civil",
        "tipo_carnet_id",
        "carnet_categoria",
        "carnet_vencimiento",
        "alcoholemia",
        "alcoholemia_se_nego",
        "habitual",
        "asegurado",
        "asegurado_relacion"
    ];

    protected $casts = [
        'asegurado' => 'boolean',
    ];

    protected $dates = ['carnet_vencimiento', 'fecha_nacimiento'];

    public function denuncia()
    {
        return $this->belongsTo(DenunciaSiniestro::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function localidad()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    public function tipoCarnet()
    {
        return $this->belongsTo(TipoCarnet::class, 'tipo_carnet_id');
    }
}
