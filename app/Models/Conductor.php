<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;
    protected $table = "conductores";

    protected $fillable = ["carga_paso_3_nombre", "carga_paso_3_telefono", "carga_paso_3_domicilio", "carga_paso_3_codigo_postal", "carga_paso_3_pais_id", "carga_paso_3_provincia_id", "carga_paso_3_localidad_id", "carga_paso_3_fecha_nacimiento", "carga_paso_3_documento_id", "carga_paso_3_documento_numero", "carga_paso_3_ocupacion", "carga_paso_3_numero_registro", "carga_paso_3_estado_civil", "carga_paso_3_carnet_id", "carga_paso_3_carnet_categoria", "carga_paso_3_carnet_vencimiento", "carga_paso_3_alcoholemia_si", "carga_paso_3_alcoholemia_no", "carga_paso_3_alcoholemia_nego", "carga_paso_3_habitual_si", "carga_paso_3_habitual_no", "carga_paso_3_asegurado_si", "carga_paso_3_asegurado_no", "carga_paso_3_asegurado_relacion"];

    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }
}
