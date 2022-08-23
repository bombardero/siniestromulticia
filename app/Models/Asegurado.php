<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asegurado extends Model
{
    use HasFactory;

    protected $fillable = ["carga_paso_4_asegurado_nombre", "carga_paso_4_asegurado_documento_id", "carga_paso_4_asegurado_documento_numero", "carga_paso_4_asegurado_domicilio", "carga_paso_4_asegurado_codigo_postal", "carga_paso_4_asegurado_pais_id", "carga_paso_4_asegurado_provincia_id", "carga_paso_4_asegurado_localidad_id", "carga_paso_4_asegurado_ocupacion", "carga_paso_4_asegurado_telefono"];

    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }

}
