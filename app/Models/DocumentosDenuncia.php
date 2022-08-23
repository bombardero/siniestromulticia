<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosDenuncia extends Model
{
    protected $fillable = ['nombre', 'type', 'url','denuncia_siniestro_id'];
    use HasFactory;

    public function denunciaSiniestro()
    {
        return $this->belongsTo(DenunciaSiniestro::class);
    }
}
