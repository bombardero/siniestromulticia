<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosDenuncia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'type', 'url','path','denuncia_siniestro_id'];

    public function denunciaSiniestro()
    {
        return $this->belongsTo(DenunciaSiniestro::class);
    }
}
