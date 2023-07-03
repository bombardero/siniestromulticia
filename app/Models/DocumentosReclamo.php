<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DocumentosReclamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'type',
        'formato',
        'url',
        'path',
        'reclamo_tercero_id'];

    public function reclamo()
    {
        return $this->belongsTo(ReclamoTercero::class);
    }

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
