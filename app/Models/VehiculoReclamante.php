<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoReclamante extends Model
{
    use HasFactory;

    protected $table = 'reclamo_vehiculo_terceros';

    protected $fillable = [
        'dominio',
        'tipo',
        'anio',
        'marca_id',
        'modelo_id',
        'otra_marca',
        'otro_modelo',
        'compania_seguros',
        'numero_poliza',
        'tipo_cobertura',
        'franquicia',
        'reclamante_conductor',
        'conductor_nombre',
        'conductor_telefono',
        'conductor_tipo_documento_id',
        'conductor_documento_numero',
        'conductor_domicilio',
        'conductor_codigo_postal',
        'conductor_pais_id',
        'conductor_province_id',
        'conductor_province_id',
        'conductor_city_id',
        'conductor_otro_pais_provincia_localidad',
        'licencia_numero',
        'licencia_clase'
    ];

    protected $casts = [
        'reclamante_conductor' => 'boolean',
    ];

    public function reclamo()
    {
        return $this->belongsTo(ReclamoTercero::class);
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
