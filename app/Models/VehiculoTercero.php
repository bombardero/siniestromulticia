<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoTercero extends Model
{
    use HasFactory;

    protected $fillable = ["carga_paso_6_vehiculo_terceros_propietario_nombre", "carga_paso_6_vehiculo_terceros_propietario_telefono", "carga_paso_6_vehiculo_terceros_propietario_documento_id", "carga_paso_6_vehiculo_terceros_propietario_documento_numero", "carga_paso_6_vehiculo_terceros_propietario_codigo_postal", "carga_paso_6_vehiculo_terceros_propietario_domicilio", "carga_paso_6_vehiculo_terceros_marca_id", "carga_paso_6_vehiculo_terceros_modelo_id", "carga_paso_6_vehiculo_terceros_tipo", "carga_paso_6_vehiculo_terceros_anio", "carga_paso_6_vehiculo_terceros_dominio", "carga_paso_6_vehiculo_terceros_motor", "carga_paso_6_vehiculo_terceros_chasis", "carga_paso_6_vehiculo_terceros_particular", "carga_paso_6_vehiculo_terceros_comercial", "carga_paso_6_vehiculo_terceros_taxi", "carga_paso_6_vehiculo_terceros_tp", "carga_paso_6_vehiculo_terceros_urgencia", "carga_paso_6_vehiculo_terceros_seguridad", "carga_paso_6_vehiculo_terceros_detalles", "carga_paso_6_vehiculo_terceros_conductor_nombre", "carga_paso_6_vehiculo_terceros_conductor_telefono", "carga_paso_6_vehiculo_terceros_conductor_documento_id", "carga_paso_6_vehiculo_terceros_conductor_documento_numero", "carga_paso_6_vehiculo_terceros_conductor_codigo_postal", "carga_paso_6_vehiculo_terceros_conductor_domicilio", "carga_paso_6_vehiculo_terceros_conductor_registro", "carga_paso_6_vehiculo_terceros_conductor_categoria", "carga_paso_6_vehiculo_terceros_conductor_vencimiento", "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_si", "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_no", "carga_paso_6_vehiculo_terceros_conductor_alcoholemia_nego", "carga_paso_6_vehiculo_terceros_conductor_habitual_si", "carga_paso_6_vehiculo_terceros_conductor_habitual_no"];

    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }

}
