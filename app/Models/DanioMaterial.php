<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanioMaterial extends Model
{
    use HasFactory;

    protected $table = "danio_materiales";

    protected $fillable = [
        "detalles",
        "propietario_nombre",
        "propietario_tipo_documento_id",
        "propietario_documento_numero",
        "propietario_codigo_postal",
        "propietario_domicilio"
    ];
}
