<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSiniestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'carga_paso_10_comisaria',
        'carga_paso_10_acta',
        'carga_paso_10_juzgado',
        'carga_paso_10_folio',
        'carga_paso_10_sumario',
        'carga_paso_10_secretaria',
        'carga_paso_10_url_detalle',
        'carga_paso_10_descripcion',
        'denuncia_siniestro_id'
    ];    

    public function denunciaSiniestro()
    {
        return $this->belongsTo(DenunciaSiniestro::class, 'denuncia_siniestro_id');
    }
}
