<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class VehiculoReclamo extends Model
{
    use HasFactory;

    protected $table = 'reclamo_vehiculos';

    protected $fillable = [
        'dominio',
        'tipo',
        'anio',
        'marca_id',
        'modelo_id',
        'otra_marca',
        'otro_modelo',
        'en_transferencia',
        'con_seguro',
        'compania_seguros',
        'numero_poliza',
        'tipo_cobertura',
        'franquicia',
    ];

    protected $casts = [
        'en_transferencia' => 'boolean',
        'con_seguro' => 'boolean',
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

    public function documentos(): MorphMany
    {
        return $this->morphMany(DocumentosReclamo::class, 'documentable');
    }
}
