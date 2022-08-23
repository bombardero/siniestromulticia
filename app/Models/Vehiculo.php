<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = ["carga_paso_5_vehiculo_marca_id", "carga_paso_5_vehiculo_modelo_id", "carga_paso_5_vehiculo_tipo", "carga_paso_5_vehiculo_anio", "carga_paso_5_vehiculo_dominio", "carga_paso_5_vehiculo_motor", "carga_paso_5_vehiculo_chasis", "carga_paso_5_vehiculo_particular", "carga_paso_5_vehiculo_comercial", "carga_paso_5_vehiculo_taxi", "carga_paso_5_vehiculo_tp", "carga_paso_5_vehiculo_urgencia", "carga_paso_5_vehiculo_seguridad", "carga_paso_5_vehiculo_siniestro_danio", "carga_paso_5_vehiculo_siniestro_robo", "carga_paso_5_vehiculo_siniestro_incendio", "carga_paso_5_vehiculo_detalles"];

    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }
}
