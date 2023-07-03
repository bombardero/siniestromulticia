<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class DanioMaterialReclamo extends Model
{
    use HasFactory;

    protected $table = "reclamo_danio_materiales";

    protected $fillable = [
        'tipo',
        'detalles',
    ];

    const TIPOS = [
        'Inmueble',
        'Bicicleta',
        'Cartel',
        'Frente de Inmueble',
    ];

    public function reclamo()
    {
        return $this->belongsTo(ReclamoTercero::class, 'reclamo_tercero_id');
    }

    public function documentos(): MorphMany
    {
        return $this->morphMany(DocumentosReclamo::class, 'documentable');
    }
}
