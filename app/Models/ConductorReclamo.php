<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ConductorReclamo extends Model
{
    use HasFactory;

    protected $table = 'reclamo_conductores';

    protected $fillable = [
        'nombre',
        'telefono',
        'fecha_nacimiento',
        'tipo_documento_id',
        'documento_numero',
        'domicilio',
        'codigo_postal',
        'pais_id',
        'province_id',
        'city_id',
        'otro_pais_provincia_localidad',
        'licencia_numero',
        'licencia_clase',
        'alcoholemia',
        'alcoholemia_se_nego',
        'lesiones',
        'gravedad_lesion',
        'centro_asistencial'
    ];

    protected $casts = [
        'alcoholemia' => 'boolean',
        'alcoholemia_se_nego' => 'boolean',
        'lesiones' => 'boolean',
    ];

    protected $dates = ['fecha_nacimiento'];

    public function getEsMenorEnSiniestroAttribute()
    {
        $edad = $this->fecha_nacimiento != null ? $this->fecha_nacimiento->diffInYears($this->reclamo->fecha) : $this->reclamo->reclamante->fecha_nacimiento->diffInYears($this->reclamo->fecha);
        return $edad < 18;
    }

    public function reclamo()
    {
        return $this->belongsTo(ReclamoTercero::class, 'reclamo_tercero_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
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

    public function documentos(): MorphMany
    {
        return $this->morphMany(DocumentosReclamo::class, 'documentable');
    }
}
