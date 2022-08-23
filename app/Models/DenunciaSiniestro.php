<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DenunciaSiniestro extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ["state","identificador", "precarga_dominio_vehiculo_asegurado", "precarga_fecha_siniestro", "precarga_hora_siniestro", "precarga_lugar", "precarga_codigo_postal", "precarga_direccion_siniestro", "precarga_conductor_vehiculo_nombre", "precarga_descripcion", "precarga_responsable_contacto_nombre", "precarga_responsable_contacto_domicilio", "precarga_responsable_contacto_telefono", "precarga_responsable_contacto_email","carga_paso_6_intervino_si","carga_paso_6_intervino_no","carga_paso_6_datos_si","carga_paso_6_datos_no"];

    public function lugar(){
        return $this->hasOne(LugarSiniestro::class)->latest();
    }

    public function conductor(){
        return $this->hasOne(Conductor::class)->latest();
    }

    public function asegurado(){
        return $this->hasOne(Asegurado::class)->latest();
    }

    public function vehiculo(){
        return $this->hasOne(Vehiculo::class)->latest();
    }

    public function vehiculoTerceros(){
        return $this->hasMany(VehiculoTercero::class);
    }

    public function danioMateriales(){
        return $this->hasMany(DanioMaterial::class);
    }

    public function lesionados(){
        return $this->hasMany(Lesionado::class);
    }

    public function detalleSiniestro(){
        return $this->hasOne(DetalleSiniestro::class);
    }

    public function documentosDenuncia(){
        return $this->hasMany(DocumentosDenuncia::class);
    }    

    public function denunciante(){
        return $this->hasOne(Denunciante::class)->latest();
    }    

    public function observaciones(){
        return $this->hasMany(Observacion::class)->latest();
    }
}
