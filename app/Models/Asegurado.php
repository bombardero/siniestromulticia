<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asegurado extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "tipo_documento_id",
        "documento_numero",
        "domicilio",
        "codigo_postal",
        "pais_id",
        "province_id",
        "city_id",
        "ocupacion",
        "telefono"
    ];

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

}
