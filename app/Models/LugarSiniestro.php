<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarSiniestro extends Model
{
    use HasFactory;

    protected $fillable = ["carga_paso_2_provincia_id", "carga_paso_2_localidad_id", "carga_paso_2_calle", "carga_paso_2_calzada_id", "carga_paso_2_calzada_detalle", "carga_paso_2_interseccion", "carga_paso_2_cruce_senalizado", "carga_paso_2_tren_si", "carga_paso_2_tren_no", "carga_paso_2_semaforo", "carga_paso_2_semaforo_funciona", "carga_paso_2_semaforo_intermitente", "carga_paso_2_semaforo_color"];

    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }
}
