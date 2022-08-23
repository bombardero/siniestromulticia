<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesionado extends Model
{
    use HasFactory;

    protected $fillable = ["carga_paso_8_lesionado_nombre", "carga_paso_8_lesionado_telefono", "carga_paso_8_lesionado_documento_id", "carga_paso_8_lesionado_documento_numero", "carga_paso_8_lesionado_codigo_postal", "carga_paso_8_lesionado_domicilio", "carga_paso_8_lesionado_estado_civil", "carga_paso_8_lesionado_fecha_nacimiento", "carga_paso_8_lesionado_relacion", "carga_paso_8_lesionado_conductor", "carga_paso_8_lesionado_pasajero_otro", "carga_paso_8_lesionado_peaton", "carga_paso_8_lesionado_pasajero_asegurado", "carga_paso_8_lesionado_leve", "carga_paso_8_lesionado_grave", "carga_paso_8_lesionado_mortal", "carga_paso_8_lesionado_alcoholemia_si", "carga_paso_8_lesionado_alcoholemia_no", "carga_paso_8_lesionado_alcoholemia_nego", "carga_paso_8_lesionado_centro_asistencial"];
}
