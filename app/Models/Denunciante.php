<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denunciante extends Model
{
    use HasFactory;

    protected $fillable = [
    'nombre',
    'telefono',
    'domicilio',
    'codigo_postal',
    'province_id',
    'city_id',
    'tipo_documento_id',
    'documento_numero',
    'asegurado',
    'asegurado_relacion',
    ];

    protected $casts = [
        'asegurado' => 'boolean',
    ];

    public function denuncia(){
        return $this->belongsTo(DenunciaSiniestro::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function localidad()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
}
