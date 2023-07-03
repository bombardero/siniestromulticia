<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class LesionadoReclamo extends Model
{
    use HasFactory;

    protected $table = "reclamo_lesionados";

    protected $fillable = [
        'nombre',
        'telefono',
        'tipo_documento_id',
        'documento_numero',
        'codigo_postal',
        'domicilio',
        'codigo_postal',
        'pais_id',
        'province_id',
        'city_id',
        'otro_pais_provincia_localidad',
        'fecha_nacimiento',
        'tipo',
        'gravedad_lesion',
        'alcoholemia',
        'alcoholemia_se_nego',
        'centro_asistencial',
        'reclamante'
    ];

    protected $casts = [
        'alcoholemia' => 'boolean',
        'alcoholemia_se_nego' => 'boolean',
        'reclamante' => 'boolean'
    ];

    protected $dates = ['fecha_nacimiento'];

    public function getEsMenorEnSiniestroAttribute()
    {
        return $this->fecha_nacimiento->diffInYears($this->reclamo->fecha) < 18;
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
