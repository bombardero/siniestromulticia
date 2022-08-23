<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denunciante extends Model
{
    protected $fillable = [
    'carga_paso_12_nombre',
    'carga_paso_12_telefono',
    'carga_paso_12_domicilio',
    'carga_paso_12_codigo_postal',
    'carga_paso_12_provincia_id',
    'carga_paso_12_localidad_id',
    'carga_paso_12_documento_id',
    'carga_paso_12_documento_numero',
    'carga_paso_12_asegurado_si',
    'carga_paso_12_asegurado_no',
    'carga_paso_12_asegurado_relacion',
    'carga_paso_12_fecha',
    'carga_paso_12_hora',
    'carga_paso_12_lugar'];

    
    
    
    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }
    
    
    
    
    
    
    
    
    
    use HasFactory;
}
