<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono',
        'domicilio',
        'codigo_postal',
        'pais_id',
        'province_id',
        'city_id',
        'otro_pais_provincia_localidad',
        'tipo_documento_id',
        'documento_numero',
        'lesiones',
        'conductor'
    ];

    protected $casts = [
        'lesiones' => 'boolean',
        'conductor' => 'boolean'
    ];

    public function reclamo()
    {
        return $this->belongsTo(ReclamoTercero::class, 'reclamo_tercero_id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
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
