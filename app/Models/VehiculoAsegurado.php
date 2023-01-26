<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoAsegurado extends Model
{
    use HasFactory;

    protected $table = 'reclamo_vehiculo_asegurados';

    protected $fillable = [
        'dominio',
        'tipo',
        'anio',
        'marca_id',
        'modelo_id',
        'otra_marca',
        'otro_modelo',
        'propietario_nombre',
        'propietario_telefono',
        'propietario_tipo_documento_id',
        'propietario_documento_numero',
        'propietario_domicilio',
        'propietario_codigo_postal',
        'propietario_pais_id',
        'propietario_province_id',
        'propietario_province_id',
        'propietario_city_id',
        'propietario_otro_pais_provincia_localidad',
        'propietario_conductor',
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
    ];

    protected $casts = [
        'propietario_conductor' => 'boolean',
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
