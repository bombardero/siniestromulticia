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

    public function denuncia()
    {
        return $this->belongsTo(DenunciaSiniestro::class, 'denuncia_siniestro_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'propietario_tipo_documento_id');
    }
}
