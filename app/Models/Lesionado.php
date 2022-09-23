<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesionado extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "telefono",
        "tipo_documento_id",
        "documento_numero",
        "codigo_postal",
        "domicilio",
        "estado_civil",
        "fecha_nacimiento",
        "relacion",
        "tipo",
        "gravedad_lesion",
        "alcoholemia",
        "alcoholemia_se_nego",
        "centro_asistencial"
    ];

    protected $casts = [
        'alcoholemia' => 'boolean',
        'alcoholemia_se_nego' => 'boolean',
    ];

    protected $dates = ['fecha_nacimiento'];

    public function denuncia()
    {
        return $this->belongsTo(DenunciaSiniestro::class, 'denuncia_siniestro_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
}
