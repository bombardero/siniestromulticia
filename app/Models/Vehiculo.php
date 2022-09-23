<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        "marca_id",
        "modelo_id",
        "otra_marca",
        "otro_modelo",
        "tipo",
        "anio",
        "dominio",
        "motor",
        "chasis",
        "uso_particular",
        "uso_comercial",
        "uso_taxi_remis",
        "uso_tpp",
        "uso_urgencia",
        "uso_seguridad",
        "siniestro_danio",
        "siniestro_robo",
        "siniestro_incendio",
        "detalles"
    ];

    public function denuncia()
    {
        return $this->belongsTo(DenunciaSiniestro::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }
}
